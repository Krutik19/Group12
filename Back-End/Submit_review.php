<?php
session_start();

include 'DBConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $review_text = $conn->real_escape_string($_POST['review_text']);

    $sql = "INSERT INTO reviews (customer_name, email, review_text, rating, created_at) 
            VALUES ('$customer_name', '$email', '$review_text', '$rating', NOW())";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Review submitted successfully!";
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: ../Views/ContactUs.php");
    exit();
}
?>
