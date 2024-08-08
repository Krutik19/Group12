<?php
include '../Back-End/session_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Reservation.css">
    <link rel="stylesheet" href="../Style/index.css">
    <title>Reservation</title>
</head>
<body>
<section class="hero-wrap">
        <div id="carouselExampleCaptions" class="hero-div">
            <div class="overlay"></div>
            <div class="hero-img">
                <div class="hero-class">
                    <img src="../image/restaurant-690569_1920.jpg" class="caro-img" alt="...">
                    <div class="carousel-caption">
                        <div class="heading-section book-info">
                            <div>
                                <span class="subheading">Reservation</span>
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
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Menu.php">Menu</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="Chef.php">Chef</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Reservation.php">Reservation</a>
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

    <section class="form-reservation">
        <div class="about-form book-form">
            <form action="../Back-End/submit_reservation.php" method="POST" class="appointment-form">
                
                
                <h3 class="form-title">Book your Table</h3>
                
                <div class="form-group">
                    <input type="text" name="customer_name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                
                <div class="form-group">
                    <input type="date" name="reservation_date" class="form-control book_date" placeholder="Reservation Date" required>
                </div>
                
                <div class="form-group">
                    <select name="guests" class="form-control" required>
                        <option value="">Guests</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea name="special_requests" class="form-control" placeholder="Special Requests"></textarea>
                </div>
                
                <div class="btn-reservation">
                    <button class="btn-submit" style="width: 50%" type="submit">Book Your Table Now</button>
                </div>
            </form>
        </div>
    </section>

    <footer><?php include 'Footer.php'; ?></footer>

   
    <script>
        <?php if (isset($_SESSION['reservation_message'])): ?>
        alert('<?php echo $_SESSION['reservation_message']; ?>');
        <?php unset($_SESSION['reservation_message']); ?>
        <?php endif; ?> 
    </script>
</body>
</html>
