<?php
// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /pages/auth/login.php');
    exit;
}