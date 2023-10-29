<?php
    $bookingid = $_GET['bookingid'];
    $checkin = $_GET['check-in'];
    $checkout = $_GET['check-out'];
    // load necessary class files
    require __DIR__ . "/vendor/autoload.php";

    $stripe_secret_key = "";  // Generate your own secret key 

    // passing api key
    \Stripe\Stripe::setApiKey($stripe_secret_key);

    // create checkout session for payment page
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/Global_Wild_Swimming_and_Camping/success.php?booking_id=" . $bookingid,
        "cancel_url" => "http://localhost/Global_Wild_Swimming_and_Camping/history.php",
        
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => $_GET['totalprice'] * 100,
                    "product_data" => [
                        "name" => $_GET['location'],
                        "description" => "Payment for booking id " . $bookingid . ", Check-in-date: " . $checkin . ", Check-out-date: " . $checkout,
                    ]
                ]
            ]
        ]
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
?>
