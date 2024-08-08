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
    <link rel="stylesheet" href="../Style/About.css">
</head>

<body>
<section class="hero-wrap">
        <div id="carouselExampleCaptions" class="hero-div">
            <div class="overlay"></div>
            <div class="hero-img">
                <div class="hero-class">
                    <img src="../image/bg_4.jpg" class="caro-img" alt="...">
                    <div class="carousel-caption">
                        <div class="heading-section book-info">
                            <div>
                                <span class="subheading">About Us</span>
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
                        <p class="phone"><span>Phone no:</span><a href="#"> +1 28654 35647 </a> or <span>email us: </span><a href="#"> taste.it@email.com</a></p>
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
                            <a class="nav-link" href="ContactUs.php">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="AboutUs.php">About</a>
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
    <section class="aboutContent1">
        <div class="aboutContainer">
            <header class="aboutHeader">
                <h1>About Taste.it</h1>
            </header>
            <section class="aboutContent2">
                <p>Welcome to <strong>Taste.it</strong>! We are passionate about bringing you the best recipes, cooking tips, and culinary inspiration. Our mission is to make cooking accessible, enjoyable, and delicious for everyone, whether you're a beginner or a seasoned chef.</p>
    
                <h2>Our Story</h2>
                <p>Taste.it was founded in 1958 by a group of food enthusiasts who wanted to share their love for cooking with the world. We started as a small blog and have grown into a vibrant community of food lovers from all over the globe. Our team of writers, chefs, and food photographers are dedicated to creating and curating the best content for our readers.</p>
    
                <h2>What We Offer</h2>
                <ul>
                    <li>Hundreds of delicious and easy-to-follow recipes</li>
                    <li>Expert cooking tips and techniques</li>
                    <li>In-depth reviews of kitchen gadgets and products</li>
                    <li>Seasonal and holiday cooking guides</li>
                    <li>Engaging videos and step-by-step tutorials</li>
                </ul>
    
                <h2>Join Our Community</h2>
                <p>We believe that cooking is more fun when shared with others. Join our community of food lovers on social media, subscribe to our newsletter, and participate in our forums to share your culinary creations and get inspired by others.</p>
    
                <p>Thank you for visiting Taste.it. We hope you enjoy our content and get inspired to cook something amazing today!</p>
            </section>
        </div>
    </section>
    <section id="happy-cust">
        <div class="overlay"></div>
        <div class="container">
            <div class="menu-title">
                <div class="happy-head heading-section">
                    <span class="subheading">Testimony</span>
                    <h2 class="book-head cust-head">Happy Customer</h2>
                </div>
            </div>
            <div>
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-inner happy-inner">
                        <div class="carousel-item happy-item">
                            <div class="carousel-caption happy-cap">
                                <p class="happy-para">This is soooo good! I needed a non-chocolate dessert & this was perfect! I used a 20 oz can of pineapple & it was great. I froze my stick of butter & sliced into very thin pieces to place all over the top. I'll definitely make this again!</p>
                                <div class="user-img">
                                </div>
                                <p>John Gustavo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include 'Footer.php'; ?>
    </footer>
    
    
</body>

</html>