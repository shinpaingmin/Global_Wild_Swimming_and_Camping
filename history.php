<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";

    // if the user id does not exist in session
    if(!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
        header("Location: login.php");
        exit;
    }
?>

    <section class="history-page">
        <?php if(isset($_GET['message'])): ?>
                <h1 class="success text-center"><?= $_GET['message'] ?></h1>
        <?php endif; ?>
        <h1 class="text-center history-title title-blue">
            Booking History
        </h1>
        <table class="margin-top">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Total Price</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $user_id = $_SESSION['userID'];
                $sql1 = "SELECT booking.*, location.location_name
                        FROM `booking`
                        INNER JOIN `location` ON booking.location_id = location.location_id
                        WHERE booking.user_id = $user_id
                        ORDER BY booking.payment_status = 'Pending' DESC,
                        booking.check_in_date ASC
                        ";

                $result1 = $conn->query($sql1);

                if($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) { ?>
                    <tr>
                        <td data-label="Location"><?= $row1['location_name'] ?></td>
                        <td data-label="Check-in Date"><?= $row1['check_in_date'] ?></td>
                        <td data-label="Check-out Date"><?= $row1['check_out_date'] ?></td>
                        <td data-label="Total Price">$<?= (int) $row1['total_price'] ?></td>
                        <td data-label="Payment Status"><?= $row1['payment_status'] ?></td>
                        <td data-label="Actions">
                            <?php if($row1['payment_status'] === 'Pending'): ?>
                                <a href="stripe-check-out.php?bookingid=<?= $row1['booking_id'] ?>&location=<?=  $row1['location_name']  ?>&totalprice=<?= $row1['total_price'] ?>&check-in=<?= $row1['check_in_date'] ?>&check-out=<?= $row1['check_out_date'] ?>" class="pay-btn">
                                    <i class="fa-solid fa-dollar-sign"></i> &nbsp;Pay
                                </a> &nbsp;
                                <a href="cancel.php?booking_id=<?= $row1['booking_id'] ?>" class="cancel-btn" onclick="return confirmSubmit();">Cancel</a>
                            <?php else: ?> 
                                <button class="pay-btn disable" disabled>
                                    <i class="fa-solid fa-dollar-sign"></i> &nbsp;Pay
                                </button> &nbsp;
                                <button class="cancel-btn disable" onclick="return confirmSubmit();" disabled>Cancel</button>
                            <?php endif;  ?>

                        </td>
                    </tr>
                <?php  
                    
                    }
            } else { ?>
            <!-- for no record  -->
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
            <?php }
            ?>
                
            </tbody>
        </table>
    </section>

<?php
    include "utilities/footer.php";
?>