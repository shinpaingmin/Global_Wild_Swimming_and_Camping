<?php
    session_start();
    include "db_connection/db_config.php";

    // if the user id does not exist in session
    if(!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
        header("Location: login.php");
        exit;
    }


        $user_id = $_SESSION['userID'];
        $location_id = $_GET['locationid'];
        $activity = (int) $_GET['activity'];

        if($activity === 1) {       
            // for camping
              // check again to ensure no duplicate bookings because user can reload the page even after they submitted the form
            $checkInDate = $_GET['check-in'];
            $checkOutDate = $_GET['check-out'];

            $sql1 = "SELECT * FROM `booking`
                WHERE booking.location_id = $location_id AND
                ('$checkInDate' <= booking.check_out_date AND '$checkOutDate' >= booking.check_in_date)";

        } else {
            $checkInDate = $_GET['check-in'];
            $checkOutDate = $_GET['check-in'];      // check-in and check-out are the same for swimming

          
            $sql1 = "SELECT * FROM `booking`
            WHERE booking.location_id = $location_id AND
            booking.check_in_date = '$checkInDate'";
            
        }

        $result1 = $conn->query($sql1);

        if($result1->num_rows > 0) {
            $message = "This location has already been booked by someone";
            header("Location: availability.php?message=" . urlencode($message));
            exit;
        } 
        
        // if the booking is still available, we will calculate the price and insert record into table
        if($activity === 1) {
            // calculate total price for camping            
            // create datetime object for check-in and check-out dates
            $checkin = new DateTime($checkInDate);
            $checkout = new DateTime($checkOutDate );

            $interval = $checkin->diff($checkout);

            $number_of_days = $interval->format('%a')+1;

            $price_per_day = (int) $_GET['price-per-day'];

            // calculate total price 
            $totalPrice = $price_per_day * $number_of_days;

            // insert into booking table
            $sql2 = "INSERT INTO `booking`
                (`user_id`, `location_id`, `check_in_date`, `check_out_date`, `total_price`)
                VALUES
                ($user_id, $location_id, '$checkInDate', '$checkOutDate', $totalPrice)
                ";
            
        } else {
            $totalPrice =  (int) $_GET['price-per-day'];    // swimming is only one day
            // insert into booking table
            $sql2 = "INSERT INTO `booking`
                (`user_id`, `location_id`, `check_in_date`, `check_out_date`, `total_price`)
                VALUES
                ($user_id, $location_id, '$checkInDate', '$checkOutDate', $totalPrice)
                ";
            
        }
                $result2 = $conn->query($sql2);

                if($result2) {
                    $success = "Complete booking successfully. You can make payment on the booking history page";
                    header("Location: availability.php?success=" . urlencode($success));
                    exit;
                } else {
                    die("Booking Failed:" . $conn->error);
                }


        

?>
