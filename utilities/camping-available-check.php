<?php

if(isset($_POST['campingCheck']) && isset($invalidDate) && !$invalidDate) {
    $checkInDate = date('Y-m-d', strtotime($_POST['checkInDate']));   // change date format
    $checkOutDate = date('Y-m-d', strtotime($_POST['checkOutDate']));   // change date format
    $pitch_type_id = $_POST['pitch_type_id'];
    $activity = $_POST['activity'];

    //retrieving reserved locations
    $sql1 = "SELECT booking.location_id
            FROM `booking`
            INNER JOIN `location` ON booking.location_id = location.location_id
            WHERE location.activity_id = $activity AND
            location.pitch_type_id = $pitch_type_id AND
            ('$checkInDate' <= booking.check_out_date AND '$checkOutDate' >= booking.check_in_date)
            ";
    
    //execute sql statement
    $result1 = $conn->query($sql1);

    // array to store retrieved reserved location ids
    $reserved_location_arr = [];

    // check if the reserved locations exist
    if($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
            $reserved_location_arr[] = $row1['location_id'];
        }
    }

    // if the reserved location array is not empty
    if(!empty($reserved_location_arr)) {

        //retrieve available locations by filtering reserved locations, used implode method to destructure array into strings
        $sql2 = "SELECT location.*
                FROM `location`
                WHERE
                location_id NOT IN (" . implode(', ', $reserved_location_arr) . ") AND
                location.activity_id = $activity AND
                location.pitch_type_id = $pitch_type_id
                ";
    } else {
        // if all the campsites are available
        $sql2 = "SELECT location.*
                FROM `location`
                WHERE 
                location.activity_id = $activity AND
                location.pitch_type_id = $pitch_type_id
                ";
    }
        // execute second sql statement
        $result2 = $conn->query($sql2); ?>
        <section>
            <h1 class="total-result">Total available campsites on '<?= $_POST['checkInDate'] ?>' to '<?= $_POST['checkOutDate'] ?>' = <?= $result2->num_rows ?></h1>
        <?php
        // if the records exist
        if($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) { ?>

                <div class="record">
                    <div class="record-image-container">
                        <?php
                            $location_id = $row2['location_id'];
                            // retrieve specific location image
                            $sql3 = "SELECT location_image.location_image
                                    FROM `location_image`
                                    WHERE 
                                        location_image.location_id = $location_id";

                            $result3 = $conn->query($sql3);
                        ?>
                        <!-- only need first picture of the location for showing -->
                        <?php if($row3 = $result3->fetch_assoc()): ?>
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row3['location_image']) ?>" alt="<?= $row2['location_name'] ?>">
                        <?php endif; ?>
                    </div>

                    <div class="record-content">
                        <div class="activity">
                            <i class="fa-solid fa-tent"></i>
                            <span>Camping</span>
                        </div>
                        <h1><?= $row2['location_name'] ?>
                        <?php
                                        $sql4 = "SELECT AVG(rating) AS avg_rating
                                                FROM `review`
                                                WHERE review.location_id = $location_id 
                                                ";
                                        $result4 = $conn->query($sql4);

                                        if($row4 = $result4->fetch_assoc()) { 
                                            $avg_rating = (int) $row4['avg_rating'];
                                            for ($i=0; $i < $avg_rating; $i++) { ?>
                                                <i class="fa-solid fa-star"></i>
                                       <?php     }
                                            ?>
                                           
                            <?php    } ?>
                        </h1>
                        <p><?= $row2['description'] ?></p>
                        <ul>
                            <?php
                                // retrieve pitch type
                                $sql4 = "SELECT *
                                        FROM `pitch_type`
                                        WHERE pitch_type.pitch_type_id = $pitch_type_id
                                        ";
                                
                                // execute sql statement
                                $result4 = $conn->query($sql4);
                            ?>

                            <?php if($row4 = $result4->fetch_assoc()): ?> 
                                    <li><?= $row2['pitch_quantity'] ?> <?= $row4['pitch_type'] ?>/es</li>
                            <?php endif; ?>
                            
                            <li>$<?= (int) $row2['price_per_day'] ?> per day</li>
                            
                        </ul>
                        <a href="booking.php?locationid=<?= $location_id ?>&check-in=<?= $checkInDate ?>&check-out=<?= $checkOutDate ?>&price-per-day=<?= $row2['price_per_day'] ?>&activity=<?= $activity ?>" class="booking" onclick="return confirmSubmit();"><i class="fa-solid fa-calendar-days"></i> Booking</a>
                    </div>
                            </div>
                </div>
            <?php } ?>
        

        <?php
        } else { 
           echo "There is no available campsite during this time period";
             
         
       } ?>
       </section>
<?php }

?>