<?php
include '../../Admin/Back-End/UserOperations.php';
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
    <title>Admin Users</title>
    <link rel="stylesheet" href="../../Admin/Css/Manage_user.css">
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
    <h1>Users</h1>

    <?php if (isset($_GET['status'])): ?>
        <p><?php echo htmlspecialchars($_GET['status']) === 'deleted' ? 'User deleted successfully.' : 'User updated successfully.'; ?></p>
    <?php endif; ?>

    <!-- Table to display users -->
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                <td>
                    <a class="b" href="#edit<?php echo htmlspecialchars($row['user_id']); ?>" onclick="document.getElementById('edit<?php echo htmlspecialchars($row['user_id']); ?>').style.display='block'">Edit</a>
                    <a class="b" href="?delete=<?php echo htmlspecialchars($row['user_id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Edit User Forms -->
    <?php
    $result->data_seek(0); // Reset result pointer
    while ($row = $result->fetch_assoc()): ?>
    <div id="edit<?php echo htmlspecialchars($row['user_id']); ?>" style="display:none;">
        <h2>Edit User - ID: <?php echo htmlspecialchars($row['user_id']); ?></h2>
        <form method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <br>
            <button type="submit" name="update">Update User</button>
        </form>
        <button onclick="document.getElementById('edit<?php echo htmlspecialchars($row['user_id']); ?>').style.display='none'">Close</button>
    </div>
    <?php endwhile; ?>

    <script>
        // Close all edit forms when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.edit-btn')) {
                var modals = document.getElementsByClassName('edit-modal');
                for (var i = 0; i < modals.length; i++) {
                    var openModal = modals[i];
                    if (openModal.style.display === "block") {
                        openModal.style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
