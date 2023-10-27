<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";
?>

    <!-- hero section start  -->
    <section class="home">
        <div class="slide-container">
            <div class="slideshow">
                <img src="img/hero1.jpg" alt="campsite 1" class="img-slide">
                <img src="img/hero2.jpg" alt="campsite 2" class="img-slide">
                <img src="img/hero3.jpg" alt="campsite 3" class="img-slide">
                <img src="img/hero4.jpg" alt="campsite 4" class="img-slide">
            </div>
        </div>

        <div class="content active">
            <h1>Wonderful<br><span>Campsite</span></h1>
            <p>Nature's beauty, peaceful serenity. Discover pure bliss!</p>
        </div>

        <div class="content">
            <h1>Camping<br><span>Enjoy</span></h1>
            <p>Find bliss in the wild, campfires, and starry nights</p>
        </div>

        <div class="content">
            <h1>Nature is<br><span>Calling you</span></h1>
            <p>It's time to embrace the great outdoors</p>
        </div>

        <div class="content">
            <h1>Feel Nature<br><span>Relax</span></h1>
            <p>Nature's embrace, a sanctuary for peace and relaxation </p>
        </div>
        
        <form action="explore.php" method="POST" class="search-form">
            <input type="search" name="searchValue" class="search-bar" placeholder="eg. camping, tent, mountain ......">
            <button type="submit" name="searchBtn" class="search-btn">Explore</button>
        </form>

        <div class="slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>

    <!-- pitch types availaible section start  -->
    <section>
        <h1 class="title">&ldquo; Start your adventure here with us ! &rdquo;</h1>
        <p class="description">Dive into a world where the beauty of nature comes into contact with the excitement of outdoor
            explorations. Warmly welcome to our &ldquo; Global Wild Swimming and Camping &rdquo;, the beginning of a memorable moments ...
        </p>

        <h1 class="subtitle">Pitch Types and Availability</h1>

        <div class="pitch-types-container">
            <div class="pitch-card">
                <i class="fa-solid fa-person-swimming"></i>
                <strong>Swimming</strong>
            </div>
            <div class="pitch-card">
                <i class="fa-solid fa-tent"></i>
                <strong>Tent Pitch</strong>
            </div>
            <div class="pitch-card">
                <i class="fa-solid fa-caravan"></i>
                <strong>Caravan Pitch</strong>
            </div>
            <div class="pitch-card">
                <i class="fa-solid fa-truck"></i>
                <strong>Motorhome Pitch</strong>
            </div>
        </div>
    </section>

    <section class="location-image-container">
            <div class="image-container">
                <?php
                    $sql1 = "SELECT * FROM `pitch_type`";

                    $result1 = $conn->query($sql1);

                    if($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) { ?>
                            <div>
                                <div class="image">
                                <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row1['pitch_type_image']) ?>" alt="<?= $row1['pitch_type'] ?>">
                                </div>
                                <h1 class="location-title"><?= $row1['pitch_type'] ?></h1>
                            </div>
                    <?php    }
                    }
                ?>
            </div>
    </section>

    <section class="location-image-container">
        <h1 class="subtitle">Breathtaking Views!</h1>
        <div class="image-container">
            <?php
                $sql2 = "SELECT * FROM `location_type`
                        ";

                $result2 = $conn->query($sql2);

                if($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) { ?>
                    <div>
                        <div class="image">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row2['location_type_image']) ?>" alt="<?= $row2['location_type'] ?>">
                            
                        </div>
                        
                        <h1 class="location-title"><?= $row2['location_type'] ?></h1>
                    </div>
                <?php    }
                }
            ?>
        </div>
    </section>

    <!-- map location start  -->
    <section class="map">
        <h1 class="map-title">Map & Locations</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423284.0441597976!2d-118.7413859382046!3d34.02060845719856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA!5e0!3m2!1sen!2sus!4v1696858849745!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

<?php
    include "utilities/footer.php";
?>