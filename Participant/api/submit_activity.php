<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Participant', 'Member']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    api_response(false, 'POST requests only.');
}

$activityType = trim($_POST['activity_type'] ?? '');
$notes = trim($_POST['notes'] ?? '');
$location = trim($_POST['location'] ?? 'Campus location unavailable');
$allowed = ['recycling' => 50, 'transit' => 30, 'ewaste' => 75, 'cup' => 10, 'volunteer' => 100];

if (!isset($allowed[$activityType])) {
    api_response(false, 'Choose a valid activity type.');
}
if (empty($_FILES['proof']) || $_FILES['proof']['error'] !== UPLOAD_ERR_OK) {
    api_response(false, 'A photo proof is required.');
}
if ($_FILES['proof']['size'] > 5 * 1024 * 1024) {
    api_response(false, 'Proof image must be 5 MB or smaller.');
}

$mime = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['proof']['tmp_name']);
$extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
if (!isset($extensions[$mime])) {
    api_response(false, 'Use a JPG, PNG, or WebP image.');
}

$uploadDir = __DIR__ . '/../../uploads/proofs';
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
    api_response(false, 'Could not prepare the proof upload folder.');
}
$fileName = bin2hex(random_bytes(16)) . '.' . $extensions[$mime];
if (!move_uploaded_file($_FILES['proof']['tmp_name'], $uploadDir . '/' . $fileName)) {
    api_response(false, 'Could not save the proof image.');
}

$proofPath = 'uploads/proofs/' . $fileName;
$points = $allowed[$activityType];
$userId = (int)$_SESSION['user_id'];
$stmt = mysqli_prepare($conn, 'INSERT INTO activity_submissions (user_id, activity_type, notes, proof_path, location, requested_points) VALUES (?, ?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($stmt, 'issssi', $userId, $activityType, $notes, $proofPath, $location, $points);

if (!mysqli_stmt_execute($stmt)) {
    @unlink($uploadDir . '/' . $fileName);
    api_response(false, 'Could not save your activity.');
}

api_response(true, 'Activity submitted for reviewer approval.', ['submission_id' => mysqli_insert_id($conn)]);
