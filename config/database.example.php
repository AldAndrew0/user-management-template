<?php

// Database configuration
// Copy this file, rename it to database.php and fill in your credentials
define('DB_HOST', '');      // es. localhost
define('DB_USER', '');      // es. root
define('DB_PASS', '');      // your database password
define('DB_NAME', '');      // es. user_management

// Create connection
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}