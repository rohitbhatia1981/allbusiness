<?php
require_once 'stripe-php/init.php'; // Path to your Stripe SDK

// Set your secret API key
\Stripe\Stripe::setApiKey('sk_test_51Nn3SfFai0RMyBsIk1fmupsx9p7KtELDIqXTJo6iAvdMDqvPanLjr38EjgZnLOT1q1IWZrZQvot7hmYHaQXofWrr00EhABMcEq'); // Replace with your Stripe Secret Key

header('Content-Type: application/json');

// Get parameters from the request
$plan = 'default-plan';
$amount = 1000; // Default $10 in cents
$success_url = 'http://localhost/test/stripe/redirection-from-page/success.php';
$cancel_url = 'http://localhost/test/stripe/redirection-from-page/index.php';

try {
    // Create a Stripe Checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => ucfirst($plan),
                ],
                'unit_amount' => $amount, // Amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $success_url,
        'cancel_url' => $cancel_url,
    ]);

    // Redirect to Stripe Checkout
    header("Location: " . $session->url);
    exit;
} catch (Exception $e) {
    // Handle error
    echo 'Error: ' . $e->getMessage();
    exit;
}
?>
