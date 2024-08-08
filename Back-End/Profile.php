<?php
// Start the session
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include DB connection
require_once 'DBConnection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/Login-Signup.php");
    exit();
}

// Fetch user details from session
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$phone_number = $_SESSION['phone_number'] ?? '';
$address = $_SESSION['address'] ?? '';

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $new_first_name = $conn->real_escape_string($_POST['first_name']);
    $new_last_name = $conn->real_escape_string($_POST['last_name']);
    $new_phone_number = $conn->real_escape_string($_POST['phone_number']);
    $new_address = $conn->real_escape_string($_POST['address']);

    $update_sql = "UPDATE Profiles SET first_name = ?, last_name = ?, phone_number = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $new_first_name, $new_last_name, $new_phone_number, $new_address, $user_id);

    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['first_name'] = $new_first_name;
        $_SESSION['last_name'] = $new_last_name;
        $_SESSION['phone_number'] = $new_phone_number;
        $_SESSION['address'] = $new_address;

        // Set a success message in the session
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating profile: " . $conn->error;
    }

    $stmt->close();

    // Redirect to the same page to prevent form resubmission
    header("Location: Profile.php");
    exit();
}

// Handle logout request
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../Views/Login-Signup.php");
    exit();
}
?>