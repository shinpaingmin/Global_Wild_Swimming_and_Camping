<?php
    $is_invalid = false;        // Login failed


    // if there is locked 
    if(isset($_SESSION['lockedTime'])) {
        $difference = time() - $_SESSION['lockedTime'];
        if($difference > 600) {
            $_SESSION['locked'] = false;
            $_SESSION['login_attempts'] = 0;
            unset($_SESSION['lockedTime']);
            // echo "here";
            header("Location: login.php");
            exit;
        }
    }

    // if($_SERVER['REQUEST_METHOD'] == "GET") {
    //     $_SESSION['error'] = "";
    // }

    // check if the login button clicks
    if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
       
       // use sql statement to avoid SQL injections
       $sql = sprintf("SELECT * FROM `user`
                WHERE email = '%s'",
                $conn->real_escape_string($_POST['login_email']));

        // sql query 
        $result = $conn->query($sql);

        // get user information
        $user = $result->fetch_assoc();

        if($user) {
            // check the password
            if(password_verify($_POST['password'], $user['password_hash'])) {
    
                
                    
                    $_SESSION['userID'] = $user['user_id'];

                header("Location: index.php");
                exit;
            }
        }

        $is_invalid = true;
        isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] += 1 : $_SESSION['login_attempts'] = 1;

        if($_SESSION['login_attempts'] > 2) {
            $_SESSION['locked'] = true;
        }
    }
?>