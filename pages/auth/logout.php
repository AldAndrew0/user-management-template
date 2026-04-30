<?php
require_once '../../includes/header.php';

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: /pages/auth/login.php');
exit;
?>