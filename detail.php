<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";

    if(!isset($_GET['id'])) {
        header("Location: explore.php");
        exit;
    } else {
        $location_id = $_GET['id'];
    }
?>

    <section class="detail-page">
       <div class="detail-container">
            <div class="detail-location-img">
            <?php
                
                $sql1 = "SELECT location_image.location_image, location.location_name
                        FROM `location_image` 
                        INNER JOIN `location` ON location_image.location_id = location.location_id
                        WHERE location_image.location_id = $location_id";

                $result1 = $conn->query($sql1);

                if($row1 = $result1->fetch_assoc()) { ?>
                    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row1['location_image']) ?>" alt="<?= $row1['location_name'] ?>">
            <?php    }
            ?>
            </div>
            <?php
                
                $sql2 = "SELECT AVG(rating) as avg_rating
                        FROM `review`
                        WHERE review.location_id = $location_id"; 
                $result2 = $conn->query($sql2);
                if($row2 = $result2->fetch_assoc()) { ?>
                    <h1 class="text-center location-title">
                        <?= $row1['location_name'] ?>
                        <?php
                            for ($i=0; $i < $row2['avg_rating']; $i++) { ?>
                                <i class="fa fa-star"></i>
                        <?php    }
                        ?>
                    </h1>
            <?php    }
            ?>
    
            <?php
                $sql3 = "SELECT location.*,  activity.activity_name
                FROM `location`
                INNER JOIN `activity` ON location.activity_id = activity.activity_id
                WHERE 
                    location.location_id = $location_id";

                $result3 = $conn->query($sql3);
        

                if($row3 = $result3->fetch_assoc()) { ?>
                    <div class="activity">
                        <?php if(strcasecmp("camping", $row3['activity_name']) === 0): ?>
                                        <i class="fa-solid fa-tent"></i>
                                        <span><?= $row3['activity_name'] ?></span>
                                    <?php elseif(strcasecmp("swimming", $row3['activity_name']) === 0): ?>
                                        <i class="fa-solid fa-person-swimming"></i>
                                        <span><?= $row3['activity_name'] ?></span>
                        <?php endif; ?>
                    </div>
                     <p><strong>Location:</strong> &nbsp; <?= $row3['description'] ?></p>
                     <p><strong>Contact Number:</strong> &nbsp; <?= $row3['phone_number'] ?></p>
                     <?php
                        if(!empty($row3['pitch_type_id'])) {
                            $pitch_type_id = $row3['pitch_type_id'];
                            $sql4 = "SELECT pitch_type.pitch_type 
                                FROM `pitch_type`
                                WHERE pitch_type.pitch_type_id = $pitch_type_id";
                            $result4 = $conn->query($sql4);
                            if($row4 = $result4->fetch_assoc()) { ?>
                                <p><strong>Pitch Type:</strong> &nbsp; <?= $row3['pitch_quantity'] ?> <?= $row4['pitch_type'] ?>/es</p>
                     <?php   }
                     
                        }
                        
        
                    ?>    
                        
                    <p><strong>Price per day:</strong> &nbsp; $<?= (int) $row3['price_per_day'] ?></p>
                    
                    <a href="availability.php" class="booking"><i class="fa-solid fa-calendar-days"></i> Availability</a>
            <?php    } else {
                echo "no record";
            }
            ?>
           
            
       </div>
    </section>

    <section>
    <h1 class="title-blue text-center">More Images ...</h1>
        <div class="image-container">
        
        <?php
            $sql5 = "SELECT * FROM location_image 
                    WHERE location_image.location_id = $location_id";
            
            $result5 = $conn->query($sql5);
            if($result5->num_rows > 0) {
                while($row5 = $result5->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row5['location_image']) ?>" alt="<?= $row3['location_name'] ?>">
                            
                        </div>
                    </div>
        <?php   }
            }
        ?>
        </div>
    </section>

    <!-- map location start  -->
    <section class="map">
        <h1 class="title-blue">Location</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52906.31446869564!2d-118.50993887588774!3d34.027331124381696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2a4cec2910019%3A0xb4170ab5ff23f5ab!2sSanta%20Monica%2C%20CA!5e0!3m2!1sen!2sus!4v1697715720602!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
    </section>       
<?php
    include "utilities/footer.php";
?>