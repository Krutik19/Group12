<?php
include '../Back-End/session_check.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Taste</title>
    <link rel="stylesheet" href="../Style/index.css" />
  </head>

  <body>
  <section class="hero-wrap">
        <div id="carouselExampleCaptions" class="hero-div">
            <div class="overlay"></div>
            <div class="hero-img">
                <div class="hero-class">
                    <img src="../image/food-1932466_1920.jpg" class="caro-img" alt="BG-Image">
                    <div class="carousel-caption">
                        <span class="caro-title">Taste.it Restaurant</span>
                        <h1 class="caro-heading">Cooking Since</h1>
                        <span class="caro-subhead">1958</span>
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
                    <div class="info">
                      <div id="time"></div>
                      <div id="weather"></div>
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    
    <section>
      <div class="container">
        <div class="about-sec">
          <div class="about-form info-container">
            <p class="info-para-home">
              Find the best dishes cooked by our master chefs with love. We have
              100 of dishes and drinks, book your table or get your favorite
              meal or beverage to your door within 30-45 minitues. Yes, we do
              care about your health its why we use fresh vegetables.
            </p>
          </div>
          <div class="about-img img">
            <div>
              <div class="About-div">
                <div class="heading-section book-info">
                  <div>
                    <span class="subheading">About</span>
                    <h2 class="book-head">Welcome to Taste.it</h2>
                  </div>
                </div>
                <div class="book-info">
                  <p>
                    The main event at almost every BBQ is meat, but that doesn't
                    always have to be the case! Renowned chef and season 10
                    winner Kristen Kish takes the helm as host, bringing a fresh
                    perspective and unexpected twists. 15 talented, rising star
                    chefs from across the US compete for the coveted title,
                    bringing their unique skills, culinary heritage and
                    innovative flavors.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
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
                  <p class="happy-para">
                    This is soooo good! I needed a non-chocolate dessert & this
                    was perfect! I used a 20 oz can of pineapple & it was great.
                    I froze my stick of butter & sliced into very thin pieces to
                    place all over the top. I'll definitely make this again!
                  </p>
                  <div class="user-img"></div>
                  <p>John Gustavo</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="book-table">
      <div>
        <div>
          <div class="book-div">
            <h2>We Make Delicious & Nutritious Food</h2>
            <a href="Reservation.html">Book A Table Now</a>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <?php include 'Footer.php'; ?>
    </footer>
    <script src="../Js/time-weather API.js"></script>
  </body>
</html>
