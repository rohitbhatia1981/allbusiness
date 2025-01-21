<?php include "../../private/settings.php";

$sqlPlans="select * from tbl_plans_ps where plan_status=1 and plan_id='".$database->filter($_GET['p'])."'";
$resPlans=$database->get_results($sqlPlans);
$rowPlans=$resPlans[0];

$plantitle=$rowPlans['plan_ad_title']." for ".$rowPlans['plan_days']." days";
$planPrice=$rowPlans['plan_price']*100;

$_SESSION['sessPlanId']=$rowPlans['plan_id'];
$_SESSION['sessListingId']=decryptId($_GET['l']);


require_once 'stripe-php/init.php'; // Path to your Stripe SDK

// Set your secret API key
\Stripe\Stripe::setApiKey('sk_test_51QXdQWK81eXYN2UM9otYfvYfINoiNfKce44aum7UPOtz0B8XYAxfyeU0JvyhffbDREZCRwSaqMoP7btDAXB0kfxf00if4b96EY'); // Replace with your Stripe Secret Key

header('Content-Type: application/json');

// Get parameters from the request

$success_url = URL . 'cms/member/success.php?session_id={CHECKOUT_SESSION_ID}';
$cancel_url = URL.'cms/member/index.php?c=ps-business';

try {
    // Create a Stripe Checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'aud',
                'product_data' => [
                    'name' => ucfirst($plantitle),
                ],
                'unit_amount' => $planPrice, // Amount in cents
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
