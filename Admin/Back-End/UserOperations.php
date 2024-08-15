<?php
include '../../Back-End/DBConnection.php';

// Handle user deletion
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    // Delete related records from Profiles table
    $sql = "DELETE FROM Profiles WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();

    // Then delete the user
    $sql = "DELETE FROM Users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    if ($stmt->execute()) {
        header('Location: ../../Admin/View/Manage_User.php?status=deleted');
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }
    $stmt->close();
}

// Handle user update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE Users SET email = ?, password_hash = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $email, $password_hash, $user_id);
    } else {
        $sql = "UPDATE Users SET email = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $email, $user_id);
    }

    if ($stmt->execute()) {
        header('Location: ../../Admin/View/Manage_User.php?status=updated');
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
    $stmt->close();
}

// Fetch all non-admin users
$sql = "SELECT * FROM Users WHERE is_admin = 0";
$result = $conn->query($sql);
?>