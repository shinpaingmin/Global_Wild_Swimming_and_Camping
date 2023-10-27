<?php

    include "db_connection/db_config.php";

    if(isset($_GET['booking_id']) && !empty($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];
        $sql1 = "DELETE FROM `booking`
                WHERE booking.booking_id = $booking_id
                ";
        $result1 = $conn->query($sql1);
        if($result1) {
            $message = "Booking cancelled successfully!";

        } else {
            $message = "Booking cancellation failed";    

        }
        header("Location: history.php?message=" . $message);
        exit;
    }

?>