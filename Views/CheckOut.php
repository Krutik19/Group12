<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="../Style/CheckOut.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <div class="checkout-form">
            <form  action="../Back-End/CheckOut.php" method="post">
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
                </div>
                <button type="submit" class="submit-button">Place Order</button>
            </form>
        </div>
    </div>
</body>
</html>
