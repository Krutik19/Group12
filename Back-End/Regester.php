<?php
require_once 'DBconnection.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkEmailQuery = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        $message = "Account with email '$email' already exists. Please use a different email.";
    } else {
        $conn->begin_transaction();

        $sqlUsers = "INSERT INTO Users (email, password_hash)
                     VALUES ('$email', '$hashedPassword')";

        if ($conn->query($sqlUsers) === TRUE) {
            $userId = $conn->insert_id;
            $sqlProfiles = "INSERT INTO Profiles (user_id, first_name, last_name, phone_number)
                            VALUES ('$userId', '$firstName', '$lastName', '$phone')";

            if ($conn->query($sqlProfiles) === TRUE) {
                $conn->commit();
                $message = "Registration successful!";
            } else {
                $conn->rollback();
                $message = "Error inserting into Profiles table: " . $conn->error;
            }
        } else {
            $message = "Error inserting into Users table: " . $conn->error;
            $conn->rollback();
        }
    }

    $conn->close();
}

session_start();
$_SESSION['message'] = $message;

header("Location: ../Views/Login-Signup.php");
exit();
?>
