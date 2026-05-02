<?php

// Start session
session_start();

// Load Composer dependencies (including phpdotenv)
require_once __DIR__ . '/../vendor/autoload.php';

// Load the .env file from the root of the project
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Create the database connection using the .env variables
$connection = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}