<?php

require_once 'DBConnection.php';


$message = '';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];

            $profileQuery = "SELECT profile_id FROM Profiles WHERE user_id = ?";
            $profileStmt = $conn->prepare($profileQuery);
            $profileStmt->bind_param("i", $row['id']);
            $profileStmt->execute();
            $profileResult = $profileStmt->get_result();

            if ($profileResult->num_rows > 0) {
                $profileRow = $profileResult->fetch_assoc();
                $_SESSION['profile_id'] = $profileRow['profile_id'];
            } else {
                $_SESSION['profile_id'] = null; 
            }

            $profileStmt->close();

            $stmt->close();
            $conn->close();

            header("Location: ../Views/index.php");
            exit();
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
}

$_SESSION['message'] = $message;

header("Location: ../Views/Login-Signup.php");
exit();
?>
