<?php

    include "db_connection/db_config.php";

    if(isset($_GET['booking_id']) && !empty($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];
        $sql1 = "UPDATE `booking`
                SET booking.payment_status = 'Confirmed'
                WHERE booking.booking_id = $booking_id";
        $result1 = $conn->query($sql1);

        // if success
        if($result1) {
            $message = "Thank you for your payment!";
           
        } else {
            $message = "Payment Failed";
           
        }
        header("Location: history.php?message=" . $message);
        exit;
    }
    
?>