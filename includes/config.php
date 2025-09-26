<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tour_booking');

// Site configuration
define('SITE_NAME', 'Adventure Tours');
define('SITE_URL', 'http://localhost/tour-booking');
define('ADMIN_EMAIL', 'admin@adventuretours.com');

// Payment gateway configuration (placeholder)
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
define('PAYPAL_CLIENT_SECRET', 'your_paypal_client_secret');
define('PAYPAL_MODE', 'sandbox'); // 'sandbox' or 'live'

// Upload configuration
define('UPLOAD_PATH', 'uploads/tours/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Database connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Start session
session_start();
?>