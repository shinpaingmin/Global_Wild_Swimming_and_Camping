<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";

    if(isset($_POST['submit'])) {
        // if the user id does not exist in session
        if(!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header("Location: login.php");
            exit;
        }
        $user_id = $_SESSION['userID'];
        $location_id = $_POST['location_id'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $rating = (int) $rating;

        $sql2 = "INSERT INTO `review`
                (`user_id`, `location_id`, `rating`, `comment`)
                VALUES
                ($user_id, $location_id, $rating, '$comment')";

        $result2 = $conn->query($sql2);

        if($result2) {
            $message = "Review submitted successfully";
        } else {
            die("Form submission failed:" . $conn->error);
        }
        
    }
?>
    <section class="review-page">
        <form class="review-form" method="POST">
            <h1 class="title-blue">Give Feedback</h1>
            <?php if(isset($message)): ?>
                <h1 class="success text-center"><?= $message ?></h1>
            <?php endif; ?>
            <div>
                <label for="location-id">Choose location:</label>
                <select name="location_id" id="location-id" required>
                    <option value="" disabled selected>Choose location</option>
                    <?php   
                        $sql1 = "SELECT *
                                FROM `location`";
                        $result1 = $conn->query($sql1);

                        if($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) { ?>
                                <option value="<?= $row1['location_id'] ?>"><?= $row1['location_name'] ?></option>
                        <?php    }
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" required>
                    <option value="" selected disabled>Choose rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div>
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" cols="30" rows="10" maxlength="100" placeholder="max word count- 100" required></textarea>
            </div>
            <div class="justify-center">
                <input type="submit" value="Submit Feedback" class="review-btn" name="submit">
            </div>
            <h1 class="alert text-center">Notice: You must log into your account before submitting form</h1>
        </form>
    </section>

    <h1 class="text-center margin-bottom title-blue">Copies of Reviews</h1>
    <section class="review-container">
        
        <?php
            $sql3 = "SELECT review.*, user.firstname, user.surname, location.location_name 
                    FROM `review`
                    INNER JOIN `user` ON review.user_id = user.user_id 
                    INNER JOIN `location` ON review.location_id = location.location_id 
                    ORDER BY review.rating DESC
                    ";

            $result3 = $conn->query($sql3);

            if($result3->num_rows > 0) {
                while($row3 = $result3->fetch_assoc()) { ?>
                    <div class="review-card">
                        <?php 
                            $random_color_arr = ['orange', 'pink', 'gray', 'green', 'yellow', 'purple', 'brown'];
                            $random_color_index = array_rand($random_color_arr);         // return random number
                            $random_color = $random_color_arr[$random_color_index];
                        ?>
                        <div class="review-header">
                            <span class="profile-logo <?= $random_color ?>"><?= $row3['firstname'][0] ?></span>
                            <span class="user-name">
                                <p class="username">
                                    <?= $row3['firstname'] . " " . $row3['surname'] ?>
                                </p>
                                <small>
                                    <?php
                                        $created_at = date('F j, Y', strtotime($row3['created_at']));
                                    ?>
                                    <?= $created_at ?>
                                </small>
                            </span>

                            <?php
                                $rating_star = (int) $row3['rating'];

                                // looping stars
                                for ($i=0; $i < $rating_star; $i++) { ?>
                                    <i class="fa-solid fa-star"></i>
                            <?php    }
                            ?>
                        </div>
                        <p class="review-content">&ldquo; <?= $row3['comment'] ?> &rdquo;</p>
                    
                        
                        <p class="review-content text-end">(<?= $row3['location_name'] ?>)</p>

                      
                    </div>
            <?php    }
            }
        ?>
        
    </section>
<?php
    include "utilities/footer.php";
?>