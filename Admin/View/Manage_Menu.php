<?php
include '../../Admin/Back-End/MenuOperations.php';
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../../Views/Login-Signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <link rel="stylesheet" href="../../Admin/Css/Manage_menu.css">
</head>
<body>
    
    <nav class="navbar">
        <div class="brand-title">Admin Panel</div>
        <a href="javascript:void(0);" class="toggle-button" onclick="toggleMenu()">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links" id="navbarLinks">
            <ul>
                <li><a href="../../Admin/View/DashBoard.php">Dashboard</a></li>
                <li><a href="../../Admin/View/Manage_User.php">Manage Users</a></li>
                <li><a href="../../Admin/View/Manage_Chef.php">Manage Chefs</a></li>
                <li><a href="../../Admin/View/Manage_Menu.php">Manage Menu</a></li>
                <li><a href="../../Admin/View/Manage_Reservation.php">Manage Reservations</a></li>
                <li><a href="../../Admin/View/Manage_Reviews.php">Manage Reviews</a></li>
                <li><a href="?action=logout">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
    <div id="popup-message" class="popup-message" style="display: none;"></div>
        <!-- Categories Management -->
        <div class="header">
            <h2>Manage Categories</h2>
            <button id="add-category-button">Add New Category</button>
        </div>
        <div class="categories-grid">
            <?php foreach ($categories as $category): ?>
                <div class="category-card">
                    <h3><?php echo htmlspecialchars($category['category_name']); ?></h3>
                    <a href="#" onclick="editCategory(<?php echo $category['category_id']; ?>)">Update</a>
                    <a href="#" onclick="deleteCategory(<?php echo $category['category_id']; ?>)">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Add New Category Form -->
        <div class="form-container" id="add-category-form" style="display: none;">
            <h2>Add New Category</h2>
            <form method="post" action="Manage_Menu.php">
                <input type="hidden" name="category_action" value="add">
                <label for="category_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required>
                <button type="submit">Add Category</button>
            </form>
        </div>

        <!-- Update Category Form -->
        <div class="form-container" id="update-category-form" style="display: none;">
            <h2>Update Category</h2>
            <form method="post" action="Manage_Menu.php">
                <input type="hidden" name="category_action" value="update">
                <input type="hidden" id="update-category-id" name="category_id">
                <label for="update-category_name">Category Name:</label>
                <input type="text" id="update-category_name" name="category_name" required>
                <button type="submit">Update Category</button>
            </form>
        </div>

        <!-- Menu Items Management -->
        <div class="header">
            <h2>Manage Menu Items</h2>
            <button id="add-menu-item-button">Add New Menu Item</button>
        </div>
        <div class="menu-items-grid">
            <?php foreach ($menu_items as $item): ?>
                <div class="menu-item-card">
                    <h3><?php echo htmlspecialchars($item['item_name']); ?></h3>
                    <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" style="width: 100px; height: 100px;">
                    <a href="#" onclick="editMenuItem(<?php echo $item['item_id']; ?>)">Update</a>
                    <a href="#" onclick="deleteMenuItem(<?php echo $item['item_id']; ?>)">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Add New Menu Item Form -->
        <div class="form-container" id="add-menu-item-form" style="display: none;">
            <h2>Add New Menu Item</h2>
            <form method="post" action="Manage_Menu.php">
                <input type="hidden" name="menu_action" value="add">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" required>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" required>
                <button type="submit">Add Menu Item</button>
            </form>
        </div>

        <!-- Update Menu Item Form -->
        <div class="form-container" id="update-menu-item-form" style="display: none;">
            <h2>Update Menu Item</h2>
            <form method="post" action="Manage_Menu.php">
                <input type="hidden" name="menu_action" value="update">
                <input type="hidden" id="update-item-id" name="item_id">
                <label for="update-category_id">Category:</label>
                <select id="update-category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="update-item_name">Item Name:</label>
                <input type="text" id="update-item_name" name="item_name" required>
                <label for="update-description">Description:</label>
                <input type="text" id="update-description" name="description" required>
                <label for="update-price">Price:</label>
                <input type="number" id="update-price" name="price" step="0.01" required>
                <label for="update-image_url">Image URL:</label>
                <input type="text" id="update-image_url" name="image_url" required>
                <button type="submit">Update Menu Item</button>
            </form>
        </div>
    </div>

    <script src="../../Admin/Js/Manage_menu.js"></script>
    <script>
        function showPopup(message) {
            var popup = document.getElementById('popup-message');
            popup.textContent = message;
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
            }, 3000);
        }

        // Example of showing popup with a message
        <?php if (!empty($message)): ?>
            showPopup("<?php echo htmlspecialchars($message); ?>");
        <?php endif; ?>
    </script>
</body>
</html>
