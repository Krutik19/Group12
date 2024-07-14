<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/Login-Signup.php");
    exit();
}
?>
