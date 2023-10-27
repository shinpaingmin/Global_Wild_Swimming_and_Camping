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
        $enquiry_type_id = $_POST['enquiry_type_id'];
        $subject = $_POST['subject'];
        $description = $_POST['description'];

        $sql2 = "INSERT INTO `enquiry`
                (`enquiry_type_id`, `user_id`, `subject`, `description`)
                VALUES
                ($enquiry_type_id, $user_id, '$subject', '$description')";

        $result2 = $conn->query($sql2);

        if($result2) {
            $message = "Form submitted successfully";
        } else {
            die("Form submission failed:" . $conn->error);
        }
        
    }
?>


    <section class="contact-page">
        
        <form class="contact-form" method="POST">
            <h1 class="title-blue">Contact Form</h1>
            <?php if(isset($message)): ?>
                <h1 class="success text-center"><?= $message ?></h1>
            <?php endif; ?>
            <div>
                <label for="enquiry-type">Enquiry Type:</label>
                <select name="enquiry_type_id" id="enquiry-type" required>
                    <option value=""  disabled selected>Choose enquiry type</option>
                <?php   
                    $sql1 = "SELECT * FROM enquiry_type";

                    $result1 = $conn->query($sql1);

                    if($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) { ?>

                            <option value="<?= $row1['enquiry_type_id'] ?>"><?= $row1['enquiry_type'] ?></option>

                    <?php   }
                    }
                ?>
                </select>
            </div>
            <div>
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" maxlength="255" placeholder="max word count- 255" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea name="description" id="description" cols="30" rows="10" maxlength="800" placeholder="max word count - 800" required></textarea>
            </div>
            <div class="justify-center">
                <input type="submit" value="Submit Form" class="enquiry-btn" name="submit">
            </div>
            <div class="justify-center">
                    <span>Read our </span> &nbsp;
                    <a href="privacy&policy.php" class="privacy-link">Privacy & Policy</a>
            </div>
            <h1 class="alert text-center">Notice: You must log into your account before submitting form</h1>
        </form>
    </section>

<?php
    include "utilities/footer.php";
?>