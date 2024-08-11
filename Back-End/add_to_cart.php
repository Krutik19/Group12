<?php
session_start(); // Start the session
include 'DBConnection.php'; // Adjust path as necessary

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Get input data
$data = json_decode(file_get_contents('php://input'), true);
$item_id = $data['item_id'];
$quantity = $data['quantity'];

// Check if the item already exists in the cart
$query = "SELECT * FROM Cart_Items WHERE user_id = ? AND item_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $user_id, $item_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Update quantity if item already exists
    $query = "UPDATE Cart_Items SET quantity = quantity + ? WHERE user_id = ? AND item_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $quantity, $user_id, $item_id);
    mysqli_stmt_execute($stmt);
    $success = mysqli_stmt_affected_rows($stmt) > 0;
} else {
    // Insert new item into the cart
    $query = "INSERT INTO Cart_Items (user_id, item_id, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $user_id, $item_id, $quantity);
    mysqli_stmt_execute($stmt);
    $success = mysqli_stmt_affected_rows($stmt) > 0;
}

// Close statement
mysqli_stmt_close($stmt);

// Output response
header('Content-Type: application/json');
echo json_encode(['success' => $success]);
?>
