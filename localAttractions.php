<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";
?>
    <section class="location-image-container local-attractions">
        <h1 class="text-center location-main-title">Local Attractions</h1>
        <div class="image-container">
            <?php
                $sql1 = "SELECT * FROM `local_attraction`";

                $result1 = $conn->query($sql1);

                if($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row1['local_attraction_image']) ?>" alt="<?= $row1['local_attraction_name'] ?>">
                            
                        </div>
                        
                        <h1 class="location-title"><?= $row1['local_attraction_name'] ?></h1>
                    </div>
                <?php    }
                }
            ?>
        </div>
    </section>
<?php
    include "utilities/footer.php";
?>