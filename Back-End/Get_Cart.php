<?php
session_start();
include 'DBConnection.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT ci.cart_item_id, mi.item_id, mi.item_name, mi.description, mi.price, mi.image_url, ci.quantity
          FROM Cart_Items ci
          INNER JOIN Menu_Items mi ON ci.item_id = mi.item_id
          WHERE ci.user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['price'] = (float) $row['price']; // Cast price to float
    $cartItems[] = $row;
}

mysqli_stmt_close($stmt);

header('Content-Type: application/json');
echo json_encode($cartItems);
?>
