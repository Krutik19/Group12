<?php
include '../../Admin/Back-End/ReviewOperation.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="../../Admin/Css/Manage_review.css">
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
            </ul>
        </div>
    </nav>
    <h2>Manage Reviews</h2>

    <table>
        <tr>
            <th>Review ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Review Text</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['review_id']}</td>
                        <td>{$row['customer_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['review_text']}</td>
                        <td>{$row['rating']}</td>
                        <td class='action-buttons'>
                            <form method='post' action=''>
                                <input type='hidden' name='review_id' value='{$row['review_id']}'>
                                <input type='submit' name='delete' value='Delete' class='delete'>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='no-reviews'>No reviews found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
