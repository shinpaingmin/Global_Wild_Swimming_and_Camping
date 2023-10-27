<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";
?>

    <!-- features intro start  -->
    <section class="features">
        <div>
            <img src="img/forest.jpg" alt="Feature Photo">
        </div>
    </section>

    <section class="location-image-container">
        <h1 class="text-center location-main-title">Leisure Facilities & Activities</h1>
        <div class="image-container">
            <?php
                $sql1 = "SELECT facility.* 
                        FROM `facility`
                        INNER JOIN `facility_type` ON facility.facility_type_id = facility_type.facility_type_id
                        WHERE facility_type.facility_type = 'leisure'
                        ORDER BY facility.facility_id ASC
                        ";

                $result1 = $conn->query($sql1);

                if($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row1['facility_image']) ?>" alt="<?= $row1['facility_name'] ?>">
                            
                        </div>
                        
                        <h1 class="location-title"><?= $row1['facility_name'] ?></h1>
                    </div>
                <?php    }
                }
            ?>
        </div>
    </section>

    <section class="location-image-container">
        <h1 class="text-center location-main-title">Amenities</h1>
        <div class="image-container">
            <?php
                $sql2 = "SELECT facility.* 
                        FROM `facility`
                        INNER JOIN `facility_type` ON facility.facility_type_id = facility_type.facility_type_id
                        WHERE facility_type.facility_type = 'amenity'
                        ORDER BY facility.facility_id ASC
                        ";

                $result2 = $conn->query($sql2);

                if($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row2['facility_image']) ?>" alt="<?= $row2['facility_name'] ?>">
                            
                        </div>
                        
                        <h1 class="location-title"><?= $row2['facility_name'] ?></h1>
                    </div>
                <?php    }
                }
            ?>
        </div>
    </section>

    <section class="location-image-container">
        <h1 class="text-center location-main-title">Near by Amenities</h1>
        <div class="image-container">
            <?php
                $sql3 = "SELECT nearby_amenity.* 
                        FROM `nearby_amenity`
                        ";

                $result3 = $conn->query($sql3);

                if($result3->num_rows > 0) {
                    while($row3 = $result3->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row3['nearby_amenity_image']) ?>" alt="<?= $row3['nearby_amenity'] ?>">
                            
                        </div>
                        
                        <h1 class="location-title"><?= $row3['nearby_amenity'] ?></h1>
                    </div>
                <?php    }
                }
            ?>
        </div>
    </section>

    <section class="location-image-container">
        <h1 class="location-main-title text-center">Wearable Technology Categories</h1>
        <div class="image-container">
            <?php
                $sql5 = "SELECT facility.* 
                        FROM `facility`
                        INNER JOIN `facility_type` ON facility.facility_type_id = facility_type.facility_type_id
                        WHERE facility_type.facility_type = 'wearable technology'
                        ORDER BY facility.facility_id ASC
                        ";

                $result5 = $conn->query($sql5);

                if($result5->num_rows > 0) {
                    while($row5 = $result5->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row5['facility_image']) ?>" alt="<?= $row5['facility_name'] ?>">
                            
                        </div>
                        
                        <h1 class="location-title"><?= $row5['facility_name'] ?></h1>
                    </div>
                <?php    }
                }
            ?>
        </div>
    </section>

    <section class="location-image-container">
        <h1 class="location-main-title">Rules & Regulations</h1>
        <ul class="rules">
            <?php
                $sql4 = "SELECT * FROM `rule`";

                $result4 = $conn->query($sql4);

                if($result4->num_rows > 0) {
                    while($row4 = $result4->fetch_assoc()) { ?>
                        <li><?= $row4['description'] ?></li>
                <?php    }
                }
            ?>
        </ul>
    </section>


<?php
    include "utilities/footer.php";
?>