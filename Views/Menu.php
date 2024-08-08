<?php
include '../Back-End/session_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../Style/index.css">
    <link rel="stylesheet" href="../Style/Menu.css">
</head>
<body>
<section class="hero-wrap">
    <div id="carouselExampleCaptions" class="hero-div">
        <div class="overlay"></div>
        <div class="hero-img">
            <div class="hero-class">
                <img src="../image/image_1.jpg" class="caro-img" alt="...">
                <div class="carousel-caption">
                    <div class="heading-section book-info">
                        <div>
                            <span class="subheading">Menu</span>
                            <h2 class="book-head" style="color: aliceblue;">Welcome to Taste.it</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-top">
        <div class="container">
            <div class="nav-top">
                <div class="nav-phone">
                    <p class="phone"><span>Phone no:</span><a href="#"> +1 28654 35647 </a> or <span>email us:
                        </span><a href="#"> taste.it@email.com</a></p>
                </div>
                <div class="nav-date">
                    <p class="date">Mon-Fri/9:00-21:00, Sat-Sun/10:00-20:00</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg container">
        <div class="container-fluid desktop-nav">
            <a class="navbar-brand" href="#"><span>Taste.</span>it</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link"  href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Menu.php">Menu</a>
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
                            <a class="nav-link" href="Profile.php">Profile</a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
    <h1>Select a Category</h1>
    <select id="categoryDropdown">
        <option value="">Select a category</option>
        <?php
        include '../Back-End/DBConnection.php'; 

        $query = "SELECT * FROM categories";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . htmlspecialchars($row['category_id']) . "'>" . htmlspecialchars($row['category_name']) . "</option>";
            }
        } else {
            echo "<option value=''>Error fetching categories</option>";
        }
        ?>
    </select>

    <div id="productsContainer" class="card-container"></div>
    <footer><?php include 'Footer.php'; ?></footer>

    <script src="../Js/Menu.js"></script>
</body>
</html>
