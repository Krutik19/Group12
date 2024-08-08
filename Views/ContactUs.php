<?php
include '../Back-End/session_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste</title>
    <link rel="stylesheet" href="../Style/index.css">
    <link rel="stylesheet" href="../Style/Contact.css">
</head>
<body>
<section class="hero-wrap">
        <div id="carouselExampleCaptions" class="hero-div">
            <div class="overlay"></div>
            <div class="hero-img">
                <div class="hero-class">
                    <img src="../image/abundance-1868573.jpg" class="caro-img" alt="...">
                    <div class="carousel-caption">
                        <div class="heading-section book-info">
                            <div>
                                <span class="subheading">Contact Us</span>
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
                            <a class="nav-link" href="Reservation.php">Reservation</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="ContactUs.php">Contact</a>
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
    <section class="Contact-form">
        <div class="form-wrapper">
            <h2>Contact Us</h2>
            <form action="../Back-End/Submit_review.php" method="post">
                <label for="input-name">Name</label>
                <input type="text" id="input-name" name="customer_name" required>

                <label for="input-email">Email</label>
                <input type="email" id="input-email" name="email" required>

                <label for="input-phone">Phone Number</label>
                <input type="tel" id="input-phone" name="phone" required>

                <label for="input-rating">Rating</label>
                <select id="input-rating" name="rating" required>
                    <option value="">Select Rating</option>
                    <option value="1">1 - Poor</option>
                    <option value="2">2 - Fair</option>
                    <option value="3">3 - Average</option>
                    <option value="4">4 - Good</option>
                    <option value="5">5 - Excellent</option>
                </select>

                <label for="input-message">Message</label>
                <textarea id="input-message" name="review_text" rows="5" required></textarea>

                <div class="btn-contact">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <section class="book-table">
        <div>
            <div>
                <div class="book-div">
                    <h2>We Make Delicious & Nutritious Food</h2>
                    <a href="./Reservation.php">Book A Table Now</a>
                </div>
            </div>
        </div>
    </section>
    <footer><?php include 'Footer.php'; ?></footer>

    <script>
    <?php if (isset($_SESSION['message'])): ?>
        alert('<?php echo $_SESSION['message']; ?>');
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    </script>
</body>
</html>
