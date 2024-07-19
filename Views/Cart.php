<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../Style/index.css">
    <link rel="stylesheet" href="../Style/Cart.css"> <!-- Create Cart.css for cart specific styles -->
</head>
<body>
    <header>
        <h1 class="Cart-tag">Your Cart</h1>
    </header>

    <section class="cart-items">
        <div id="cartItemsContainer" class="card-container">
            <!-- Cart items will be dynamically added here -->
        </div>

        <div class="cart-summary">
            <h2>Cart Summary</h2>
            <div class="summary-details">
                <p>Total Items: <span id="totalItems">0</span></p>
                <p>Subtotal: <span id="subtotal">$0.00</span></p>
                <p>Tax (10%): <span id="tax">$0.00</span></p>
                <p>Delivery Charge: <span id="deliveryCharge">$5.00</span></p>
                <h3>Total Amount: <span id="totalAmount">$0.00</span></h3>
            </div>
            <button id="buyButton">Buy Now</button>
        </div>
    </section>

    <footer><?php include 'Footer.php'; ?></footer>

    <script src="../Js/Cart.js"></script>
</body>
</html>
