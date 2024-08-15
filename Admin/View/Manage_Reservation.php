<?php
include '../../Admin/Back-End/ReservationOperations.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Reservations</title>
    <link rel="stylesheet" href="../../Admin/Css/Manage_reservation.css">
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
    <h2>Manage Reservations</h2>

    <table>
        <tr>
            <th>Reservation ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Reservation Date</th>
            <th>Number of Guests</th>
            <th>Special Requests</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['reservation_id']}</td>
                        <form method='post' action=''>
                            <td><input type='text' name='customer_name' value='{$row['customer_name']}'></td>
                            <td><input type='email' name='email' value='{$row['email']}'></td>
                            <td><input type='datetime-local' name='reservation_date' value='".date('Y-m-d\TH:i', strtotime($row['reservation_date']))."'></td>
                            <td><input type='number' name='number_of_guests' value='{$row['number_of_guests']}'></td>
                            <td><input type='text' name='special_requests' value='{$row['special_requests']}'></td>
                            <td class='action-buttons'>
                                <input type='hidden' name='reservation_id' value='{$row['reservation_id']}'>
                                <input type='submit' name='update' value='Update' class='update'>
                                <input type='submit' name='delete' value='Delete' class='delete'>
                            </td>
                        </form>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No reservations found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>