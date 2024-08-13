<?php
session_start();
include '../Back-End/DBConnection.php'; 

$user_id = $_SESSION['user_id']; 

$cart_query = "SELECT ci.cart_item_id, mi.item_name, mi.description, mi.price, ci.quantity, mi.image_url 
               FROM Cart_Items ci 
               JOIN Menu_Items mi ON ci.item_id = mi.item_id 
               WHERE ci.user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$cart_result = $stmt->get_result();
$cart_items = $cart_result->fetch_all(MYSQLI_ASSOC);

$total_items = array_sum(array_column($cart_items, 'quantity'));
$subtotal = array_sum(array_map(function($item) {
    return $item['price'] * $item['quantity'];
}, $cart_items));
$tax = $subtotal * 0.13; 
$delivery_charge = 5;
$total_amount = $subtotal + $tax + $delivery_charge;

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="../Style/CheckOut.css">
</head>
<body>
<div class="container">
        <div class="checkout-container">
            <h1>Checkout</h1>
            <div class="checkout-form">
                <form action="../Back-End/CheckOut.php" method="post">
                    <div class="section">
                        <h2>Billing and Shipping Details</h2>
                        <label for="billing-FirstName">First Name</label>
                        <input type="text" id="billing-FirstName" name="billing-FirstName" required>

                        <label for="billing-LastName">Last Name</label>
                        <input type="text" id="billing-LastName" name="billing-LastName" required>

                        <label for="billing-Number">Number</label>
                        <input type="number" id="billing-Number" name="billing-Number" required>

                        <label for="billing-Email">Email</label>
                        <input type="email" id="billing-Email" name="billing-Email" required>

                        <label for="billing-address">Address</label>
                        <input type="text" id="billing-address" name="billing-address" required>

                        <label for="billing-city">City</label>
                        <input type="text" id="billing-city" name="billing-city" required>

                        <label for="billing-zip">ZIP Code</label>
                        <input type="text" id="billing-zip" name="billing-zip" required>

                        <input type="hidden" name="totalAmount" value="<?php echo $total_amount; ?>">
                    </div>
                    <button type="submit" class="submit-button">Place Order</button>
                </form>
            </div>
        </div>

        <div class="cart-summary-container">
            <section id="cartSummary">
                <h2>Order Summary</h2>
                <p>Total Items: <span id="totalItems"><?php echo $total_items; ?></span></p>
                <p>Subtotal: <span id="subtotal">$<?php echo number_format($subtotal, 2); ?></span></p>
                <p>Tax: <span id="tax">$<?php echo number_format($tax, 2); ?></span></p>
                <p>Delivery Charge: <span id="deliveryCharge">$<?php echo number_format($delivery_charge, 2); ?></span></p>
                <p>Total Amount: <span id="totalAmount">$<?php echo number_format($total_amount, 2); ?></span></p>
            </section>

            <section id="cartItemsContainer">
                <h2>Your Cart Items</h2>
                <?php if (empty($cart_items)) : ?>
                    <p>No items in cart</p>
                <?php else : ?>
                    <?php foreach ($cart_items as $item) : ?>
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>">
                            <div class="card-content">
                                <h3><?php echo htmlspecialchars($item['item_name']); ?></h3>
                                <p><?php echo htmlspecialchars($item['description']); ?></p>
                                <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </div>
    </div>
</body>
</html>
