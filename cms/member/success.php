<?php
require_once 'stripe-php/init.php'; // Include Stripe PHP SDK

// Set your secret API key
\Stripe\Stripe::setApiKey('sk_test_51Nn3SfFai0RMyBsIk1fmupsx9p7KtELDIqXTJo6iAvdMDqvPanLjr38EjgZnLOT1q1IWZrZQvot7hmYHaQXofWrr00EhABMcEq'); // Replace with your Stripe Secret Key

if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    try {
        // Retrieve the Checkout Session from Stripe
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // Check the payment status
        if ($session->payment_status === 'paid') {
            // Payment is successful
            // Insert payment details into the database
            $customer_email = $session->customer_details->email; // Customer email
            $amount_paid = $session->amount_total / 100; // Convert from cents to dollars
		
			echo "Payment Successful";

        } else {
            // Payment failed or incomplete
            echo "Payment verification failed.";
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "No session ID provided.";
}
?>
