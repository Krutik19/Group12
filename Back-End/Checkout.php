<?php
session_start();

include 'DBConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $billingFirstName = $conn->real_escape_string($_POST['billing-FirstName']);
    $billingLastName = $conn->real_escape_string($_POST['billing-LastName']);
    $billingNumber = $conn->real_escape_string($_POST['billing-Number']);
    $billingEmail = $conn->real_escape_string($_POST['billing-Email']);
    $billingaddress = $conn->real_escape_string($_POST['billing-address']);
    $billingcity = $conn->real_escape_string($_POST['billing-city']);
    $billingzip = $conn->real_escape_string($_POST['billing-zip']);
    $totalAmount = $conn->real_escape_string($_POST['totalAmount']);

    $sql = "INSERT INTO CheckOut (FirstName, LastName, billingNumber, Email, billingAddress, city, zip, totalAmount, created_at) 
            VALUES ('$billingFirstName', '$billingLastName', '$billingNumber', '$billingEmail', '$billingAddress', '$billingCity', '$billingZip', '$totalAmount', NOW())";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "CheckOut successfully!";
        
        header("Location: ../Views/Payment.php?totalAmount=" . urlencode($totalAmount));
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        
    }

    $conn->close();
}
?>
 