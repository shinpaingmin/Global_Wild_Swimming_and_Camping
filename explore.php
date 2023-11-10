<?php
    include  "utilities/header.php";
    include "db_connection/db_config.php";
?>

        <!-- search bar  -->
        <section>
            <form method="POST" class="search-form align">
                <input type="search" name="searchValue" class="search-bar" placeholder="eg. camping, tent, mountain ......" value="<?= $_POST['searchValue'] ?? "" ?>">
                <button type="submit" name="searchBtn" class="search-btn">Explore</button>
            </form>
        </section>

        <!-- showing result records  -->
        <section>
            
            <?php
            // searching value in the database
            if(isset($_POST['searchBtn'])) {
                if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])) {
                $searchValue = $_POST['searchValue'];       // user input

                // sql statement for searching user input in the database
                $sql1 = "SELECT location.*, location_type.location_type, activity.activity_name
                        FROM `location`
                        LEFT JOIN location_type ON location.location_type_id = location_type.location_type_id
                        LEFT JOIN activity ON location.activity_id = activity.activity_id
                        LEFT JOIN pitch_type ON location.pitch_type_id = pitch_type.pitch_type_id
                        WHERE 
                            location.location_name LIKE '%$searchValue%' OR
                            location_type.location_type LIKE '%$searchValue%' OR
                            activity.activity_name LIKE '%$searchValue%' OR
                            pitch_type.pitch_type LIKE '%$searchValue%'
                        
                            "
                        ;
                } else {
                    $sql1 = "SELECT location.*, location_type.location_type, activity.activity_name
                            FROM `location`
                            INNER JOIN location_type ON location.location_type_id = location_type.location_type_id
                            INNER JOIN activity ON location.activity_id = activity.activity_id";
                }
                // sql statement execute
                $result1 = $conn->query($sql1); ?>

                <h1 class="total-result">Total Result: <?= $result1->num_rows ?? 0 ?></h1>
                
                <?php
                // checking if the records exist
                if($result1->num_rows > 0) { 
                    
                    // turn the records into associative array and looping all the records
                    while($row1 = $result1->fetch_assoc()) { ?>
                        
                        <div class="record">
                            <div class="record-image-container">

                                <?php
                                    // declare variable to re-use
                                    $location_id = $row1['location_id'];
                                    $location_name = $row1['location_name'];
                                    $location_description = $row1['description'];
                                    $location_type = $row1['location_type'];
                                    $activity_name = $row1['activity_name'];
                                    $pitch_type_id = $row1['pitch_type_id'];
                                    $pitch_quantity = $row1['pitch_quantity'];
                                    $price_per_day = $row1['price_per_day'];
                                    
                                    // another sql statement to retrieve the location image from another related table
                                    $sql2 = "SELECT location_image.location_image
                                            FROM `location_image`
                                            WHERE
                                                location_image.location_id = $location_id ";
                                    
                                    // sql statement execute
                                    $result2 = $conn->query($sql2);
                                ?>

                                <!-- I don't use while loop here because I only want the first picture of the location  -->
                                <?php if($row2 = $result2->fetch_assoc()): ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row2['location_image']) ?>" alt="<?= $location_name ?>">
                                <?php endif; ?>                                
                            </div>

                            <div class="record-content">
                                <div class="activity">
                                    <!-- strcasecmp to check whether the two strings are equal without case-sensitive, it returns 0 if they match  -->
                                    <?php if(strcasecmp("camping", $activity_name) === 0): ?>
                                        <i class="fa-solid fa-tent"></i>
                                        <span><?= $activity_name ?></span>
                                    <?php elseif(strcasecmp("swimming", $activity_name) === 0): ?>
                                        <i class="fa-solid fa-person-swimming"></i>
                                        <span><?= $activity_name ?></span>
                                    <?php endif; ?>
                                </div>
                                <h1><?= $location_name ?>
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
                                           
                                    <?php    }
                                    ?>
                                </h1>
                                <p><?= $location_description ?></p>
                                <ul>
                                    <!-- check whether the pitch type exists because only camping needs pitch type, swimming doesn't need it  -->
                                    <?php if($pitch_type_id) { 

                                        // another sql statement to retrieve pitch type from another related table
                                        $sql3 = "SELECT pitch_type.pitch_type 
                                                FROM `pitch_type`
                                                INNER JOIN `location` ON pitch_type.pitch_type_id = location.pitch_type_id
                                                WHERE pitch_type.pitch_type_id = $pitch_type_id";

                                        // sql statement execute
                                        $result3 = $conn->query($sql3);
                                    ?>

                                    <?php if($row3 = $result3->fetch_assoc()): ?> 
                                        <li><?= $pitch_quantity ?> <?= $row3['pitch_type'] ?>/es</li>
                                    <?php endif; ?>
                                    <?php
                                    }
                                    ?>
                                        
                                    <!-- (int) was used to change decimal to integer  -->
                                    <li>$<?= (int) $price_per_day ?> per day</li>
                                    
                                </ul>
                                <a href="detail.php?id=<?= $location_id ?>" class="detail-btn"><i class="fa-regular fa-file-lines"></i> Detail</a>
                            </div>
                        </div>
                    
            <?php    } 
              

            }  else {
                echo "no record";
            }
            } else { ?>
                    <section class="find-container">
                        <h1 class="subtitle">Find Something ...</h1>
                        <img src="img/find.jpg" alt="find something" class="find">    
                    </section>
        <?php    }

            ?>              
         
                
                
        </section>

<?php
    include "utilities/footer.php"
?>