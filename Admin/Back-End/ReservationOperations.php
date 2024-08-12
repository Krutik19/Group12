<?php

require '../../Back-End/DBConnection.php';
$message = "";

function handlePostRequest($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        if (isset($_POST['update'])) {
            $reservation_id = $_POST['reservation_id'];
            $customer_name = $_POST['customer_name'];
            $email = $_POST['email'];
            $reservation_date = $_POST['reservation_date'];
            $number_of_guests = $_POST['number_of_guests'];
            $special_requests = $_POST['special_requests'];

            $sql = "UPDATE Reservations SET ";
            $sql .= "customer_name='" . $customer_name . "', ";
            $sql .= "email='" . $email . "', ";
            $sql .= "reservation_date='" . $reservation_date . "', ";
            $sql .= "number_of_guests=" . $number_of_guests . ", ";
            $sql .= "special_requests='" . $special_requests . "' ";
            $sql .= "WHERE reservation_id=" . $reservation_id;
            
            if ($conn->query($sql) === TRUE) {
                $message = "Reservation updated successfully";
            } else {
                $message =  "Error updating reservation: " . $conn->error;
            }
        }

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

handlePostRequest($conn);

$sql = "SELECT * FROM Reservations";
$result = $conn->query($sql);
?>