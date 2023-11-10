<?php
    $register_failed = false;
    // check if the register button was clicked
    if(isset($_POST['register'])) {
        // check if the first name is empty
        if(empty($_POST['firstname'])) {
            $firstname_required = "First Name is required!";
            $register_failed = true;
        }

        // check if the last name is empty
        if(empty($_POST['lastname'])) {
            $lastname_required = "Last Name is required!";
            $register_failed = true;
        }
        
        // check if the email is valid
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email_required = "Valid email is required!";
            $register_failed = true;
        }

        // check if the password is at least 8 characters
        if(strlen($_POST['password']) < 8) {
            $password_required = "Password must be at least 8 characters";
            $register_failed = true;
        }
        // check if the password is strong enough
        else if(!checkStrongPassword($_POST['password'])) {
            $password_required = "At least one uppercase, one lowercase, number and special character";
            $register_failed = true;
        }
        // check if the confirm password match
        else if($_POST['password'] !== $_POST['confirmPassword']) {
            $password_match = "Passwords must match!";
            $register_failed = true;
        } else {
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);   // hash password if the requirements are satisfied
        }

        // adjust phone number if it exists
        if(!empty($_POST['phoneNumber'])) {
            $phoneNumber = strval($_POST['phoneNumber']);
            $phoneLength = strlen($phoneNumber);        // assigned to a variable for better performance

            if($phoneLength < 7 || $phoneLength > 15) {
                $phone_required = "Phone Number must be 7 to 15 numbers";
                $register_failed = true;
            }
        }

        if(empty($_POST['checkbox'])) {
            $terms_required = "You must agree Terms & Conditions";
            $register_failed = true;
        }

        if(!empty($_POST['g-recaptcha-response'])) {
            $secretkey = '';    // Generate your own secret key
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = $_POST['g-recaptcha-response'];
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
            $result = file_get_contents($url);
            
            $data = json_decode($result);

            if($data->success == true) {
                $g_recaptcha_success = true;
            } else {
                $g_recaptcha_required = "Recaptcha Failed";
                $register_failed = true;
            }
        }
        else {
            $g_recaptcha_required = "Recaptcha is required";
            $register_failed = true;
        }


        // include file for creating accounts
        if($register_failed == false) {
            include "create_account.php";
        }
        

        

        
    } 

    // check strong password function
    function checkStrongPassword($password): bool {
        // Check if the password contains at least one uppercase letter, one lowercase letter, one number and one special character
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?~])/', $password)) {
            return false;
        }

        // Return true if the password is strong
        return true;
    }
?>
