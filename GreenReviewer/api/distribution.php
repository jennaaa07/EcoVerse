<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $history=[]; $result=mysqli_query($conn, 'SELECT d.*, u.full_name AS reviewer_name FROM reward_distributions d LEFT JOIN `user` u ON u.user_id = COALESCE(d.collected_by, d.verified_by) ORDER BY d.verified_at DESC LIMIT 10'); while($row=mysqli_fetch_assoc($result)) $history[]=$row;
    api_response(true, 'Distribution history loaded.', ['history'=>$history]);
}
$code = strtoupper(trim($_POST['voucher_code'] ?? '')); $action = $_POST['action'] ?? 'verify';
if (!preg_match('/^[A-Z0-9-]{4,50}$/', $code)) api_response(false, 'Enter a valid voucher code.');
$reviewerId=(int)$_SESSION['user_id'];
if ($action === 'verify') {
    $stmt=mysqli_prepare($conn, 'SELECT distribution_id, status, reward_name, participant_code FROM reward_distributions WHERE voucher_code=? LIMIT 1'); mysqli_stmt_bind_param($stmt,'s',$code); mysqli_stmt_execute($stmt); $found=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$found) { $rewardName='Pending reward verification'; $participantCode=null; $stmt=mysqli_prepare($conn, 'INSERT INTO reward_distributions (voucher_code, reward_name, participant_code, verified_by) VALUES (?, ?, ?, ?)'); mysqli_stmt_bind_param($stmt,'sssi',$code,$rewardName,$participantCode,$reviewerId); mysqli_stmt_execute($stmt); $found=['distribution_id'=>mysqli_insert_id($conn),'status'=>'verified','reward_name'=>$rewardName,'participant_code'=>'Not recorded']; }
    api_response(true, 'Voucher verification saved.', ['distribution'=>$found]);
}
$id=filter_input(INPUT_POST,'distribution_id',FILTER_VALIDATE_INT); if(!$id || $action!=='collect') api_response(false,'Invalid distribution request.');
$status='collected'; $stmt=mysqli_prepare($conn,'UPDATE reward_distributions SET status=?, collected_by=?, collected_at=NOW() WHERE distribution_id=? AND status="verified"'); mysqli_stmt_bind_param($stmt,'sii',$status,$reviewerId,$id); mysqli_stmt_execute($stmt); if(mysqli_stmt_affected_rows($stmt)!==1) api_response(false,'Voucher is already collected or not found.'); api_response(true,'Collection saved to distribution history.');
