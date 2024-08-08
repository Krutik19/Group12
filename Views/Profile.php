<?php
include '../Back-End/Profile.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../Style/index.css" />
    <link rel="stylesheet" href="../Style/Profile.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg container">
            <div class="container-fluid desktop-nav">
                <a class="navbar-brand" href="#"><span>Taste.</span>it</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Menu.php">Menu</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="Chef.php">Chef</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link" href="Reservation.php">Reservation</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ContactUs.php">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="AboutUs.php">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Cart.php">Cart</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Profile.php">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($first_name); ?></h1>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Phone Number: <?php echo htmlspecialchars($phone_number); ?></p>
        <p>Address: <?php echo htmlspecialchars($address); ?></p>

        <!-- Display success or error message -->
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div id='popup-message' class='message'>" . $_SESSION['message'] . "</div>";
            // Unset the message after displaying it
            unset($_SESSION['message']);
        }
        ?>

        <!-- Update Profile Form -->
        <form method="post" class="update-form">
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" placeholder="First Name" required>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" placeholder="Last Name" required>
            <input type="text" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" placeholder="Phone Number" required>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" placeholder="Address" required>
            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <!-- Logout Form -->
        <form method="post" class="logout-form">
            <button type="submit" name="logout" class="btn">Logout</button>
        </form>
    </div>
    <script>
        // Show the message and hide it after 3 seconds
        const messageElement = document.getElementById('popup-message');
        if (messageElement) {
            messageElement.style.display = 'block';
            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
