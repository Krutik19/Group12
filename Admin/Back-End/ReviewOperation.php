<?php
// manage_reviews.php

require '../../Back-End/DBConnection.php';

// Function to handle the delete operation
function handlePostRequest($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle delete review
        if (isset($_POST['delete'])) {
            $review_id = $_POST['review_id'];

            $sql = "DELETE FROM Reviews WHERE review_id=$review_id";
            if ($conn->query($sql) === TRUE) {
                echo "Review deleted successfully";
            } else {
                echo "Error deleting review: " . $conn->error;
            }
        }

        // Redirect to avoid form resubmission
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Call the function to handle POST requests
handlePostRequest($conn);

// Fetch all reviews
$sql = "SELECT * FROM Reviews";
$result = $conn->query($sql);
?>