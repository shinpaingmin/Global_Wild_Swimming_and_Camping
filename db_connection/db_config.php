<?php

// Database configuration
define('DB_HOST', '');        // change your localhost name
define('DB_USERNAME', '');      // change your username
define('DB_PASSWORD', '');         // change your password
define('DB_NAME', 'gwsc_db');               // change your db_name

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// connection error handling
if($conn->connect_errno) {
    die("Connection error: " . $conn->connect_error);
}
return $conn;

?>
