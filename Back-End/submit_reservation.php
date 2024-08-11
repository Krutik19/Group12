<?php
session_start();

include 'DBConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $email = htmlspecialchars($_POST['email']);
    $reservation_date = $_POST['reservation_date'];
    $number_of_guests = $_POST['guests'];
    $special_requests = htmlspecialchars($_POST['special_requests']);

    $sql = "INSERT INTO Reservations (customer_name, email, reservation_date, number_of_guests, special_requests)
            VALUES ('$customer_name', '$email', '$reservation_date', '$number_of_guests', '$special_requests')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['reservation_message'] = "Reservation successfully submitted!";
    } else {
        $_SESSION['reservation_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $_SESSION['reservation_message'] = "Form submission error!";
}

$conn->close();

header("Location: ../Views/Reservation.php");
exit();
?>
