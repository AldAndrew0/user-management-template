<?php
require_once '../../config/database.php';

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: /pages/auth/login.php');
exit;
?>