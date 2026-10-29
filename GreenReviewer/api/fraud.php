<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cases = [];
    $sql = "SELECT s.audit_id, s.user_id, u.user_code, u.full_name, s.activity_name, s.points_claimed, s.device_ip, s.verifier, s.activity_time, a.decision, a.created_at AS actioned_at FROM suspicious_activity s LEFT JOIN `user` u ON u.user_id = s.user_id LEFT JOIN fraud_case_actions a ON a.action_id = (SELECT x.action_id FROM fraud_case_actions x WHERE x.audit_id = s.audit_id ORDER BY x.created_at DESC LIMIT 1) ORDER BY s.activity_time DESC";
    $result = mysqli_query($conn, $sql); while ($row = mysqli_fetch_assoc($result)) $cases[] = $row;
    api_response(true, 'Fraud cases loaded.', ['cases' => $cases]);
}
$auditId = filter_input(INPUT_POST, 'audit_id', FILTER_VALIDATE_INT); $decision = $_POST['decision'] ?? '';
if (!$auditId || !in_array($decision, ['locked', 'dismissed'], true)) api_response(false, 'Invalid fraud decision.');
mysqli_begin_transaction($conn);
try {
    $stmt = mysqli_prepare($conn, 'SELECT user_id FROM suspicious_activity WHERE audit_id = ? FOR UPDATE'); mysqli_stmt_bind_param($stmt, 'i', $auditId); mysqli_stmt_execute($stmt);
    $case = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt)); if (!$case) throw new RuntimeException('Fraud case not found.');
    $reviewerId = (int)$_SESSION['user_id']; $userId = (int)$case['user_id'];
    $stmt = mysqli_prepare($conn, 'INSERT INTO fraud_case_actions (audit_id, user_id, decision, performed_by) VALUES (?, ?, ?, ?)'); mysqli_stmt_bind_param($stmt, 'iisi', $auditId, $userId, $decision, $reviewerId); mysqli_stmt_execute($stmt);
    if ($decision === 'locked' && $userId) { $status = 'Freeze'; $stmt = mysqli_prepare($conn, 'UPDATE `user` SET status = ? WHERE user_id = ?'); mysqli_stmt_bind_param($stmt, 'si', $status, $userId); mysqli_stmt_execute($stmt); $stmt = mysqli_prepare($conn, 'UPDATE user_profile SET status = ? WHERE user_id = ?'); mysqli_stmt_bind_param($stmt, 'si', $status, $userId); mysqli_stmt_execute($stmt); }
    mysqli_commit($conn); api_response(true, $decision === 'locked' ? 'Account locked and action recorded.' : 'Flag dismissed and action recorded.');
} catch (Throwable $e) { mysqli_rollback($conn); api_response(false, $e->getMessage()); }
