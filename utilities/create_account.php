<?php
// we have to use two different sql statements because the phone number is optional
// sql statement if the phone number exists 
if (!empty($_POST['phoneNumber'])) {
    // Prevent SQL injections
    $sql = "INSERT INTO `user` (`firstname`, `surname`, `email`, `password_hash`, `phone_number`)
        VALUES (?, ?, ?, ?, ?)";
    
    // initialize the statement
    $stmt = $conn->stmt_init();     

    // prepare the statement
    if(!$stmt->prepare($sql)) {
        die("SQL error: " . $conn->error);
    }

    // bind the statement with values
    $stmt->bind_param("sssss",
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['email'],
                    $password_hash,
                    $phoneNumber);

    mysqli_report(MYSQLI_REPORT_OFF);  // To close unnecessary mysql report messages 

    // execute the statement
    if($stmt->execute()) {
        $success = "Created an account successfully";
    } else {
        // check if the email is already taken
        $conn->errno === 1062 ? $email_taken = "Email has already been taken by others" : die($conn->error . "" . $conn->errno);
    }
} else {
    // sql statement if the phone number does not exist
    $sql = "INSERT INTO `user` (`firstname`, `surname`, `email`, `password_hash`)
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->stmt_init();

    if(!$stmt->prepare($sql)) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("ssss",
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['email'],
                    $password_hash);

    mysqli_report(MYSQLI_REPORT_OFF);  // To close unnecessary mysql report messages 
    
    // execute the statement
    if($stmt->execute()) {
        $success = "Created an account successfully!";
    } else {
        // check if the email is already taken
        $conn->errno === 1062 ?  $email_taken = "Email has already been taken by others"  : die($conn->error . "" . $conn->errno);
    }
}
?>