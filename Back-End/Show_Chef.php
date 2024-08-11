<?php
header('Content-Type: application/json');
include 'DBConnection.php';

// Query to select all chefs
$query = "SELECT * FROM Chefs";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $chefs = array();
    while ($row = $result->fetch_assoc()) {
        $chefs[] = $row;
    }
    echo json_encode(['success' => true, 'chefs' => $chefs]);
} else {
    echo json_encode(['success' => false, 'message' => 'No chefs found.']);
}

$conn->close();
?>
