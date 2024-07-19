<?php
include 'DBConnection.php'; // Adjust path as necessary

// Check if category_id is provided via GET request
if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Prepare SQL query to fetch menu items for the selected category
    $query = "SELECT * FROM menu_items WHERE category_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the category_id parameter
    mysqli_stmt_bind_param($stmt, 'i', $categoryId);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch data as associative array
    $menuItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($menuItems as &$item) {
    $item['price'] = (float) $item['price']; // Convert price to float
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Output JSON response
    header('Content-Type: application/json');
    echo json_encode($menuItems);
} else {
    // If category_id is not provided, return empty array
    echo json_encode([]);
}
?>
