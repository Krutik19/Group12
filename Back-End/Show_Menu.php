<?php
include 'DBConnection.php'; 

if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    $query = "SELECT * FROM menu_items WHERE category_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, 'i', $categoryId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $menuItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($menuItems as &$item) {
    $item['price'] = (float) $item['price']; 
    }


    mysqli_stmt_close($stmt);

    header('Content-Type: application/json');
    echo json_encode($menuItems);
} else {
    echo json_encode([]);
}
?>
