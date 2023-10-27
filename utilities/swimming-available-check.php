<?php
    if(isset($_POST['swimmingCheck'])) {
        $date = date('Y-m-d', strtotime($_POST['date']));   // change date format
        $activity = $_POST['activity'];
    
        // retrieving reserved locations
        $sql1 = "SELECT booking.location_id 
                FROM `booking`
                INNER JOIN `location` ON booking.location_id = location.location_id
                WHERE location.activity_id = $activity AND
                booking.check_in_date = '$date'
                ";
    
        // execute sql statement
        $result1 = $conn->query($sql1);
        
        // array to store retrieved reserved location ids
        $reserved_location_arr = [];
    
        // check if the reserved locations exist
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $reserved_location_arr[] = $row1['location_id'];        // push each id into an array
                
            }
        } 
    
        // if the reserved location array is not empty
        if(!empty($reserved_location_arr)) {
    
            // retrieve available locations by filtering reserved locations, used implode method to destructure array into strings
            $sql2 = "SELECT location.*
                    FROM `location`
                    WHERE 
                    location_id NOT IN (" . implode(', ', $reserved_location_arr) . ") AND
                    location.activity_id = $activity
                    ";
        }  else {
            
            // if all the swimming spots are available
            $sql2 = "SELECT location.*
                    FROM `location`
                    WHERE 
                    location.activity_id = $activity
                    ";
        }  
            // excute second sql statement
            $result2 = $conn->query($sql2); ?>
            <section>
                <h1 class="total-result">Total available swimming spots on '<?= $_POST['date'] ?>' = <?= $result2->num_rows ?></h1>
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
                                <i class="fa-solid fa-person-swimming"></i>
                                <span>Swimming</span>
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
                                                    <i class="fa-solid fa-star margin-top"></i>
                                        <?php     }
                                                ?>
                                            
                                    <?php    } ?>
                            </h1>
                            <p><?= $row2['description'] ?></p>
                            <ul>
                                <li>$<?= (int) $row2['price_per_day'] ?> per day</li>
                            </ul>
                            <a href="booking.php?locationid=<?= $location_id ?>&check-in=<?= $date ?>&price-per-day=<?= $row2['price_per_day'] ?>&activity=<?= $activity ?>" class="booking" onclick="return confirmSubmit();"><i class="fa-solid fa-calendar-days"></i> Booking</a>
                        </div>
                    </div>
                <?php    } ?>
    
            <?php
            } else {
                // if there is no record available
                echo "There is no available swimming spot on this date";
            } ?>
            </section> 
   <?php }
?>