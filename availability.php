<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";    
?>

    <section class="availability">
        <?php
            if(isset($_GET['message'])) { ?>
                <h1 class="alert text-center"><?= urldecode($_GET['message']) ?></h1>
        <?php    }
        ?>
        <?php
            if(isset($_GET['success'])) { ?>
                <h1 class="success text-center"><?= urldecode($_GET['success']) ?></h1>
        <?php    }
        ?>
        <h1 class="check title-blue">Check Availability</h1>

        <h1 class="alert text-center">Notice: You must log into your account before booking</h1>

        <!-- availability form start  -->
        <div class="availability-form">

            <form id="swimming" class="form-input" method="POST">
                <h1 class="check title-blue">Swimming</h1>
                <div>
                    <label>Choose Date:</label>
                    <input type="date" name="date" id="date" required>
                </div>
                <div>
                    <input type="hidden" name="activity" value="2">
                    <button type="submit" name="swimmingCheck" id="submit-btn">Check Availability</button>
                </div>
            </form>

            <form id="camping" class="form-input" method="POST">
                <h1 class="check title-blue">Camping</h1>
                <div>
                    <label>Check-In Date:</label>
                    <input type="date" name="checkInDate" id="date" required>
                </div>
                <div>
                    <label>Check-Out Date:</label>
                    <input type="date" name="checkOutDate" id="date" required>
                </div>
                <div>
                    <label for="">Choose Pitch Type:</label>
                    <select name="pitch_type_id" required>
                        <option value="" disabled selected>Choose Pitch Type</option>
                        <?php
                            $sql = "SELECT *FROM `pitch_type`";                            
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['pitch_type_id'] ?>"><?= $row['pitch_type'] ?></option>

                            <?php }
                        ?>
            
                    </select>
                </div>
                <input type="hidden" name="activity" value="1">
                <button type="submit" name="campingCheck" id="submit-btn">Check Availability</button>
            </form>

        </div>
    </section>
    
<?php
// check to ensure the check-in date is less than check-out date
    if(isset($_POST['campingCheck'])) {
        if($_POST['checkInDate'] > $_POST['checkOutDate']) { ?>
            <h1 class="alertdate">Check-in date is greater than check-out date</h1>
        <?php    $invalidDate = true;
        } else {
            $invalidDate = false;
        }
    }
    // check availability for swimming 
    include "utilities/swimming-available-check.php";

    // check availability for camping
    include "utilities/camping-available-check.php";

    include "utilities/footer.php";
?>