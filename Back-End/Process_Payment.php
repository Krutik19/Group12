<?php
require '../vendor/autoload.php';

// Stripe API key
\Stripe\Stripe::setApiKey('sk_test_51PgCN0G5usHw8cVal9xbkpZdbOq1o9jyVJVLAsgIAD5YMBjckgLCTwcoxYWz7G8CVa8XYPEZiXjPRP1pGtY621st00Lqr9MlQf');

header('Content-Type: application/json');

$token = $_POST['stripeToken'];
$cardholder_name = $_POST['cardholder-name'];

try {
  $charge = \Stripe\Charge::create([
    'amount' => 5000,
    'currency' => 'usd',
    'source' => $token,
    'description' => 'Example charge'
  ]);

  echo json_encode(['status' => 'success', 'charge_id' => $charge->id]);
} catch (\Stripe\Exception\CardException $e) {
  echo json_encode(['status' => 'error', 'error' => $e->getMessage()]);
}
?>