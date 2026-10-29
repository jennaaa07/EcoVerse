<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);
$history=[]; $result=mysqli_query($conn, "SELECT s.submission_id, u.user_code, s.activity_type, s.requested_points, s.status, s.reviewed_at FROM activity_submissions s INNER JOIN `user` u ON u.user_id=s.user_id WHERE s.status <> 'pending' ORDER BY s.reviewed_at DESC LIMIT 10"); while($row=mysqli_fetch_assoc($result)) $history[]=$row; api_response(true,'Claim history loaded.',['history'=>$history]);
