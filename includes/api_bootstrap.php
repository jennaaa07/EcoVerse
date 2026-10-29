<?php
session_start();
require_once __DIR__ . '/db_connect.php';

header('Content-Type: application/json; charset=utf-8');

function api_response(bool $success, string $message, array $data = []): never {
    http_response_code($success ? 200 : 400);
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $data));
    exit;
}

function api_require_role(array $roles): void {
    if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'] ?? '', $roles, true)) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please log in with the correct role.']);
        exit;
    }
}
