<?php
include 'DBConnection.php'; // Adjust path as necessary

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$cart_item_id = $data['cart_item_id'];

// Assuming user_id is obtained from session
session_start(); // Ensure session is started
$user_id = $_SESSION['user_id']; // Adjust as per your session handling

// Prepare SQL query to delete cart item
$query = "DELETE FROM Cart_Items WHERE cart_item_id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $query);

// Bind parameters
mysqli_stmt_bind_param($stmt, 'ii', $cart_item_id, $user_id);

// Execute query
if (mysqli_stmt_execute($stmt)) {
    // Check if the deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'Item not found or not belonging to user'];
    }
} else {
    $response = ['success' => false, 'message' => mysqli_error($conn)];
}

// Close statement
mysqli_stmt_close($stmt);

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close connection
$conn->close();
?>
