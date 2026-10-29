<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') api_response(false, 'POST requests only.');
$submissionId = filter_input(INPUT_POST, 'submission_id', FILTER_VALIDATE_INT);
$decision = $_POST['decision'] ?? '';
if (!$submissionId || !in_array($decision, ['approved', 'rejected'], true)) api_response(false, 'Invalid review request.');

mysqli_begin_transaction($conn);
try {
    $stmt = mysqli_prepare($conn, 'SELECT user_id, requested_points, status FROM activity_submissions WHERE submission_id = ? FOR UPDATE');
    mysqli_stmt_bind_param($stmt, 'i', $submissionId);
    mysqli_stmt_execute($stmt);
    $claim = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$claim || $claim['status'] !== 'pending') throw new RuntimeException('This claim has already been reviewed.');

    $reviewerId = (int)$_SESSION['user_id'];
    $status = $decision;
    $stmt = mysqli_prepare($conn, 'UPDATE activity_submissions SET status = ?, reviewer_id = ?, reviewed_at = NOW() WHERE submission_id = ?');
    mysqli_stmt_bind_param($stmt, 'sii', $status, $reviewerId, $submissionId);
    mysqli_stmt_execute($stmt);

    if ($decision === 'approved') {
        $points = (int)$claim['requested_points'];
        $userId = (int)$claim['user_id'];
        $stmt = mysqli_prepare($conn, 'UPDATE user_profile SET green_points = COALESCE(green_points, 0) + ? WHERE user_id = ?');
        mysqli_stmt_bind_param($stmt, 'ii', $points, $userId);
        mysqli_stmt_execute($stmt);
        $type = 'activity_approval';
        $source = 'submission';
        $stmt = mysqli_prepare($conn, 'INSERT INTO point_transactions (user_id, amount, transaction_type, source_type, source_id, created_by) VALUES (?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'iissii', $userId, $points, $type, $source, $submissionId, $reviewerId);
        mysqli_stmt_execute($stmt);
    }
    mysqli_commit($conn);
    api_response(true, $decision === 'approved' ? 'Claim approved and points awarded.' : 'Claim rejected.');
} catch (Throwable $e) {
    mysqli_rollback($conn);
    api_response(false, $e->getMessage());
}
