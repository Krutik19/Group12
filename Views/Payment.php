<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <link rel="stylesheet" type="text/css" href="../Style/Payment.css" />
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div class="container">
        <h2>Payment Form</h2>
        <form id="payment-form" action="backend/process_payment.php" method="POST">
            <div class="form-group">
                <label for="cardholder-name">Cardholder Name</label>
                <input type="text" id="cardholder-name" name="cardholder-name" required />
            </div>
            <div class="form-group">
                <label for="card-element">Card Number</label>
                <div id="card-element"></div>
            </div>
            <div class="form-group">
                <label for="card-expiry-element">Expiry Date</label>
                <div id="card-expiry-element"></div>
            </div>
            <div class="form-group">
                <label for="card-cvc-element">CVC</label>
                <div id="card-cvc-element"></div>
            </div>
            <div id="card-errors" role="alert"></div>
            <button type="submit">Submit Payment</button>
        </form>
    </div>

    <script src="../Js/Payment.js"></script>
</body>
</html>