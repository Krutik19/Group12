<?php
include '../../Admin/Back-End/ChefOperations.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Chefs</title>
    <link rel="stylesheet" href="../../Admin/Css/Manage_Chef.css">
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

    <div class="container">
    <div class="header">
            <h1>Manage Chefs</h1>
            <button id="add-chef-button">Add New Chef</button>
        </div>
        <div class="chefs-grid">
            <?php foreach ($chefs as $chef): ?>
                <div class="chef-card">
                    <img src="<?php echo htmlspecialchars($chef['image_url']); ?>" alt="<?php echo htmlspecialchars($chef['name']); ?>">
                    <h3><?php echo htmlspecialchars($chef['name']); ?></h3>
                    <p><?php echo htmlspecialchars($chef['specialty']); ?></p>
                    <a href="#" onclick="editChef(<?php echo $chef['chef_id']; ?>)">Update</a>
                    <a href="#" onclick="deleteChef(<?php echo $chef['chef_id']; ?>)">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-container" id="add-chef-form" style="display: none;">
            <h2>Add New Chef</h2>
            <form method="post" action="Manage_Chef.php">
                <input type="hidden" name="action" value="add">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4" required></textarea>
                
                <label for="specialty">Specialty:</label>
                <input type="text" id="specialty" name="specialty" required>
                
                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" required>
                
                <button type="submit">Add Chef</button>
            </form>
        </div>

        <div class="form-container" id="update-chef-form" style="display: none;">
            <h2>Update Chef</h2>
            <form method="post" action="Manage_Chef.php" onsubmit="return submitUpdateForm();">
                <input type="hidden" name="action" value="update">
                <input type="hidden" id="update-chef-id" name="chef_id">
                
                <label for="update-name">Name:</label>
                <input type="text" id="update-name" name="name" required>
                
                <label for="update-bio">Bio:</label>
                <textarea id="update-bio" name="bio" rows="4" required></textarea>
                
                <label for="update-specialty">Specialty:</label>
                <input type="text" id="update-specialty" name="specialty" required>
                
                <label for="update-image_url">Image URL:</label>
                <input type="text" id="update-image_url" name="image_url" required>
                
                <button type="submit">Update Chef</button>
            </form>
        </div>
    </div>

    <script src='../../Admin/Js/Manage_Chef.js'></script>
    <script>
        function toggleMenu() {
            var navbarLinks = document.getElementById('navbarLinks');
            navbarLinks.classList.toggle('active');
        }
    </script>
</body>
</html>
