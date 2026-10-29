<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);

$result = mysqli_query($conn, "SELECT s.submission_id, u.user_code, u.full_name, s.activity_type, s.notes, s.proof_path, s.requested_points, s.submitted_at FROM activity_submissions s INNER JOIN `user` u ON u.user_id = s.user_id WHERE s.status = 'pending' ORDER BY s.submitted_at ASC");
$claims = [];
while ($row = mysqli_fetch_assoc($result)) $claims[] = $row;
api_response(true, 'Pending claims loaded.', ['claims' => $claims]);
