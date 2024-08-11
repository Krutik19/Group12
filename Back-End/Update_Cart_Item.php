<?php

include 'DBConnection.php';
include 'session_check.php';

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['cart_item_id']) || !isset($data['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    exit;
}

$cart_item_id = $data['cart_item_id'];
$quantity = $data['quantity'];

$query = "UPDATE Cart_Items SET quantity = ? WHERE cart_item_id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'iii', $quantity, $cart_item_id, $user_id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update quantity.']);
}

mysqli_stmt_close($stmt);
?>
