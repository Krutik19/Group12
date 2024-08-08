<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include DB connection
require_once 'DBConnection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            // Regenerate session ID
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['is_admin'] = $row['is_admin'];

            // Get profile details
            $profileQuery = "SELECT * FROM profiles WHERE user_id = ?";
            $profileStmt = $conn->prepare($profileQuery);
            $profileStmt->bind_param("i", $row['user_id']);
            $profileStmt->execute();
            $profileResult = $profileStmt->get_result();

            if ($profileResult->num_rows > 0) {
                $profileRow = $profileResult->fetch_assoc();
                $_SESSION['profile_id'] = $profileRow['profile_id'];
                $_SESSION['first_name'] = $profileRow['first_name'];
                $_SESSION['last_name'] = $profileRow['last_name'];
                $_SESSION['phone_number'] = $profileRow['phone_number'];
                $_SESSION['address'] = $profileRow['address'];
            }

            $profileStmt->close();
            $stmt->close();
            $conn->close();

            if ($_SESSION['is_admin']) {
                header("Location: ../Admin/View/DashBoard.php");
            } else {
                header("Location: ../Views/index.php");
            }
            exit();
        } else {
            $_SESSION['message'] = "Incorrect email or password.";
        }
    } else {
        $_SESSION['message'] = "Incorrect email or password.";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../Views/Login-Signup.php");
    exit();
}
?>
