<?php
include '../../Back-End/DBConnection.php';

$message = ""; // To store feedback messages

// Handle category operations
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_action'])) {
    if ($_POST['category_action'] == 'add') {
        $category_name = $_POST['category_name'];
        $query = "INSERT INTO Categories (category_name) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $category_name);
        if ($stmt->execute()) {
            $message = "New category added successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($_POST['category_action'] == 'update') {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $query = "UPDATE Categories SET category_name=? WHERE category_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $category_name, $category_id);
        if ($stmt->execute()) {
            $message = "Category updated successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle category deletion
if (isset($_GET['category_action']) && $_GET['category_action'] == 'delete') {
    $category_id = $_GET['category_id'];
    $query = "DELETE FROM Categories WHERE category_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $category_id);
    if ($stmt->execute()) {
        $message = "Category deleted successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_action'])) {
    if ($_POST['menu_action'] == 'add') {
        $category_id = $_POST['category_id'];
        $item_name = $_POST['item_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_url = $_POST['image_url'];
        $query = "INSERT INTO Menu_Items (category_id, item_name, description, price, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issis", $category_id, $item_name, $description, $price, $image_url);
        if ($stmt->execute()) {
            $message = "New menu item added successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($_POST['menu_action'] == 'update') {
        $item_id = $_POST['item_id'];
        $category_id = $_POST['category_id'];
        $item_name = $_POST['item_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_url = $_POST['image_url'];
        $query = "UPDATE Menu_Items SET category_id=?, item_name=?, description=?, price=?, image_url=? WHERE item_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issisi", $category_id, $item_name, $description, $price, $image_url, $item_id);
        if ($stmt->execute()) {
            $message = "Menu item updated successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle menu item deletion
if (isset($_GET['menu_action']) && $_GET['menu_action'] == 'delete') {
    $item_id = $_GET['item_id'];
    $query = "DELETE FROM Menu_Items WHERE item_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $item_id);
    if ($stmt->execute()) {
        $message = "Menu item deleted successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch categories and menu items from the database
$categories_query = "SELECT * FROM Categories";
$categories_result = $conn->query($categories_query);

$menu_items_query = "SELECT * FROM Menu_Items";
$menu_items_result = $conn->query($menu_items_query);

$categories = [];
if ($categories_result->num_rows > 0) {
    while ($row = $categories_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$menu_items = [];
if ($menu_items_result->num_rows > 0) {
    while ($row = $menu_items_result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}

$conn->close();
?>
