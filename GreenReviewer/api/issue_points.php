<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') api_response(false, 'POST requests only.');

$userCode = trim($_POST['participant_id'] ?? '');
$points = filter_input(INPUT_POST, 'points', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 1000]]);
if ($userCode === '' || !$points) api_response(false, 'Enter a valid participant ID and point value.');

mysqli_begin_transaction($conn);
try {
    $stmt = mysqli_prepare($conn, 'SELECT user_id FROM `user` WHERE user_code = ? AND role IN ("Participant", "Member") AND status = "Active" LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $userCode);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$user) throw new RuntimeException('Active participant ID not found.');
    $userId = (int)$user['user_id'];
    $reviewerId = (int)$_SESSION['user_id'];
    $stmt = mysqli_prepare($conn, 'UPDATE user_profile SET green_points = COALESCE(green_points, 0) + ? WHERE user_id = ?');
    mysqli_stmt_bind_param($stmt, 'ii', $points, $userId);
    mysqli_stmt_execute($stmt);
    $type = 'reviewer_pos'; $source = 'pos'; $sourceId = 0;
    $stmt = mysqli_prepare($conn, 'INSERT INTO point_transactions (user_id, amount, transaction_type, source_type, source_id, created_by) VALUES (?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'iissii', $userId, $points, $type, $source, $sourceId, $reviewerId);
    mysqli_stmt_execute($stmt);
    mysqli_commit($conn);
    api_response(true, "$points points issued to $userCode.");
} catch (Throwable $e) { mysqli_rollback($conn); api_response(false, $e->getMessage()); }
