<?php
require_once __DIR__ . '/../../includes/api_bootstrap.php';
api_require_role(['Reviewer']);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $items = [];
    $result = mysqli_query($conn, 'SELECT rewardid, rewardname, category, pointsrequired, quantity, status FROM reward ORDER BY rewardid');
    while ($row = mysqli_fetch_assoc($result)) $items[] = $row;
    $history = [];
    $result = mysqli_query($conn, 'SELECT a.*, r.rewardname, u.full_name FROM inventory_audit a LEFT JOIN reward r ON r.rewardid = a.reward_id LEFT JOIN `user` u ON u.user_id = a.performed_by ORDER BY a.created_at DESC LIMIT 8');
    while ($row = mysqli_fetch_assoc($result)) $history[] = $row;
    api_response(true, 'Inventory loaded.', ['items' => $items, 'history' => $history]);
}

$payload = json_decode($_POST['items'] ?? '', true);
if (!is_array($payload) || !$payload) api_response(false, 'No inventory items were supplied.');
mysqli_begin_transaction($conn);
try {
    $reviewerId = (int)$_SESSION['user_id'];
    foreach ($payload as $item) {
        $id = trim($item['id'] ?? ''); $name = trim($item['name'] ?? ''); $category = trim($item['category'] ?? 'Product');
        $cost = filter_var($item['cost'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
        $stock = filter_var($item['stock'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
        if ($name === '' || $cost === false || $stock === false) throw new RuntimeException('Each inventory item needs a name, cost and stock count.');
        $status = $stock > 0 ? 'Active' : 'Out of Stock';
        if ($id === '') {
            $id = 'RV' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
            $popularity = 'New'; $image = '';
            $stmt = mysqli_prepare($conn, 'INSERT INTO reward (rewardid, rewardname, pointsrequired, quantity, popularity, status, category, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'ssiissss', $id, $name, $cost, $stock, $popularity, $status, $category, $image);
            mysqli_stmt_execute($stmt);
            $action = 'created'; $oldCost = null; $oldStock = null;
        } else {
            $stmt = mysqli_prepare($conn, 'SELECT pointsrequired, quantity FROM reward WHERE rewardid = ? FOR UPDATE');
            mysqli_stmt_bind_param($stmt, 's', $id); mysqli_stmt_execute($stmt);
            $old = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            if (!$old) throw new RuntimeException('Reward ' . $id . ' was not found.');
            $oldCost = (int)$old['pointsrequired']; $oldStock = (int)$old['quantity'];
            $stmt = mysqli_prepare($conn, 'UPDATE reward SET rewardname = ?, category = ?, pointsrequired = ?, quantity = ?, status = ? WHERE rewardid = ?');
            mysqli_stmt_bind_param($stmt, 'ssiiss', $name, $category, $cost, $stock, $status, $id); mysqli_stmt_execute($stmt);
            $action = 'updated';
        }
        $stmt = mysqli_prepare($conn, 'INSERT INTO inventory_audit (reward_id, action_type, old_cost, new_cost, old_quantity, new_quantity, performed_by) VALUES (?, ?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssiiiii', $id, $action, $oldCost, $cost, $oldStock, $stock, $reviewerId); mysqli_stmt_execute($stmt);
    }
    mysqli_commit($conn); api_response(true, 'Inventory changes and audit history saved.');
} catch (Throwable $e) { mysqli_rollback($conn); api_response(false, $e->getMessage()); }
