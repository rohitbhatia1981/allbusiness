<?php include "../../private/settings.php";
require_once 'stripe-php/init.php'; // Include Stripe PHP SDK

// Set your secret API key
\Stripe\Stripe::setApiKey('sk_test_51QXdQWK81eXYN2UM9otYfvYfINoiNfKce44aum7UPOtz0B8XYAxfyeU0JvyhffbDREZCRwSaqMoP7btDAXB0kfxf00if4b96EY'); // Replace with your Stripe Secret Key

if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    try {
        // Retrieve the Checkout Session from Stripe
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // Check the payment status
        if ($session->payment_status === 'paid') {
            // Payment is successful
            // Insert payment details into the database
			
			$paymentIntentId = $session->payment_intent;
            $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
            // Get the payment ID
            $paymentId = $paymentIntent->id;
			
			
            $customer_email = $session->customer_details->email; // Customer email
            $amount_paid = $session->amount_total / 100; // Convert from cents to dollars
			
			
			$sqlPlans="select * from tbl_plans_ps where plan_status=1 and plan_id='".$database->filter($_SESSION['sessPlanId'])."'";
			$resPlans=$database->get_results($sqlPlans);
			$rowPlans=$resPlans[0];
			
			//business_active_status
			
			$days=$rowPlans['plan_days'];
			$currentDate = date('Y-m-d'); // Current date
			$expiryDate = date('Y-m-d', strtotime("+$days days"));
			
						$updateListing = array(
							 'business_active_status' => 1,							 
							 'business_plan_id' => $rowPlans['plan_id'],
							 'business_plan_expiry_date' => $expiryDate,
							 'business_plan_bumpup_total' => $rowPlans['plan_bump_up'],
							 'business_plan_bumpup_used' => 0							
							 
							 );
				
							$where_clause = array(
								'business_id' => $_SESSION['sessListingId']
							);
							$database->update('tbl_business', $updateListing, $where_clause, 1);
			
			
					//--------Insert into Payment
					
				$names = array(
				'payment_amount' => $amount_paid,
				'payment_listing_id' => $_SESSION['sessListingId'],
				'payment_status' => 1,
				'payment_stripe_id' =>$paymentId,				 
				'payment_date' => $currentDate			
				
				);

				$add_query = $database->insert( 'tbl_payments', $names );
					
					//------end inserting
			
		
			print "<script>window.location='".URL.'cms/member/index.php?c=ps-business&payment=1'."'</script>";

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
