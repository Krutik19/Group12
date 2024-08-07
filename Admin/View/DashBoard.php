<?php
// Include the database connection
include '../../Back-End/DBConnection.php';

// Fetch the counts
$chefsCount = $conn->query("SELECT COUNT(*) as count FROM Chefs")->fetch_assoc()['count'];
$categoriesCount = $conn->query("SELECT COUNT(*) as count FROM Categories")->fetch_assoc()['count'];
$menuItemsCount = $conn->query("SELECT COUNT(*) as count FROM Menu_Items")->fetch_assoc()['count'];
$reservationsCount = $conn->query("SELECT COUNT(*) as count FROM Reservations")->fetch_assoc()['count'];
$reviewsCount = $conn->query("SELECT COUNT(*) as count FROM Reviews")->fetch_assoc()['count'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../Admin/Css/Dashboard.css">
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
                <li><a href="../../Admin/View/Manage_Chef.php">Manage Chefs</a></li>
                <li><a href="../../Admin/View/Manage_Menu.php">Manage Menu</a></li>
                <li><a href="../../Admin/View/Manage_Reservation.php">Manage Reservations</a></li>
                <li><a href="../../Admin/View/Manage_Reviews.php">Manage Reviews</a></li>
            </ul>
        </div>
    </nav>
    <div class="dashboard-container">
        <a href="../../Admin/View/Manage_Chef.php" class="card">
            <div class="icon">👨‍🍳</div>
            <div class="circle"><?php echo $chefsCount; ?></div>
            <p>Chefs</p>
        </a>
        <a href="../../Admin/View/Manage_Menu.php" class="card">
            <div class="icon">📂</div>
            <div class="circle"><?php echo $categoriesCount; ?></div>
            <p>Categories</p>
        </a>
        <a href="../../Admin/View/Manage_Menu.php" class="card">
            <div class="icon">🍽️</div>
            <div class="circle"><?php echo $menuItemsCount; ?></div>
            <p>Menu Items</p>
        </a>
        <a href="../../Admin/View/Manage_Reservation.php" class="card">
            <div class="icon">📅</div>
            <div class="circle"><?php echo $reservationsCount; ?></div>
            <p>Reservations</p>
        </a>
        <a href="../../Admin/View/Manage_Reviews.php" class="card">
            <div class="icon">⭐</div>
            <div class="circle"><?php echo $reviewsCount; ?></div>
            <p>Reviews</p>
        </a>
    </div>
    <script>
        function toggleMenu() {
            var navbarLinks = document.getElementById('navbarLinks');
            navbarLinks.classList.toggle('active');
        }
    </script>
</body>
</html>
