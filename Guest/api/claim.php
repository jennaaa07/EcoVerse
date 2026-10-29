<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') api_response(false, 'POST requests only.');
if (!isset($_SESSION['guest_session_id'])) api_response(false, 'Guest session not found. Refresh and try again.');

$sessionId = $_SESSION['guest_session_id'];
$points = 50;
mysqli_begin_transaction($conn);
try {
    $stmt = mysqli_prepare($conn, 'SELECT points, status FROM guest_sessions WHERE guest_session_id = ? FOR UPDATE');
    mysqli_stmt_bind_param($stmt, 's', $sessionId);
    mysqli_stmt_execute($stmt);
    $guest = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$guest || $guest['status'] !== 'active') throw new RuntimeException('Guest session is no longer active.');
    $stmt = mysqli_prepare($conn, 'UPDATE guest_sessions SET points = points + ?, updated_at = NOW() WHERE guest_session_id = ?');
    mysqli_stmt_bind_param($stmt, 'is', $points, $sessionId);
    mysqli_stmt_execute($stmt);
    $type = 'guest_deposit'; $source = 'guest_claim'; $sourceId = 0; $createdBy = 0;
    $stmt = mysqli_prepare($conn, 'INSERT INTO point_transactions (guest_session_id, amount, transaction_type, source_type, source_id, created_by) VALUES (?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sissii', $sessionId, $points, $type, $source, $sourceId, $createdBy);
    mysqli_stmt_execute($stmt);
    mysqli_commit($conn);
    api_response(true, 'Deposit saved to your guest session.', ['points' => (int)$guest['points'] + $points]);
} catch (Throwable $e) { mysqli_rollback($conn); api_response(false, $e->getMessage()); }
