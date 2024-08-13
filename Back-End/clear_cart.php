<?php
session_start();
require_once 'DBConnection.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/Login-Signup.php"); 
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "DELETE FROM Cart_Items WHERE user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    
    $_SESSION['message'] = "Cart has been successfully cleared.";
} else {
    
    $_SESSION['message'] = "Failed to clear cart. Please try again.";
}

$stmt->close();
$conn->close();


header("Location: ../Views/cart.php");
exit();
?>
