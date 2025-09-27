<?php
// Alternative config.php for InfinityFree - if main one doesn't work
// Database configuration for InfinityFree
define('DB_HOST', 'sql203.infinityfree.com'); 
define('DB_USER', 'if0_40035033');      
define('DB_PASS', 'hTPFj5yvAlHB');  // MySQL password for InfinityFree
define('DB_NAME', 'if0_40035033_tours');

// Site configuration
define('SITE_NAME', 'Adventure Tours Demo');
define('SITE_URL', 'https://adventuretours.infinityfreeapp.com'); // Your actual URL
define('ADMIN_EMAIL', 'demo@adventuretours.com');

// Payment gateway configuration (placeholder)
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
define('PAYPAL_CLIENT_SECRET', 'your_paypal_client_secret');
define('PAYPAL_MODE', 'sandbox'); // 'sandbox' or 'live'

// Upload configuration
define('UPLOAD_PATH', 'uploads/tours/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Database connection - Alternative method for InfinityFree
try {
    // Try different connection methods for InfinityFree
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    
} catch(PDOException $e) {
    // If connection fails, try without charset
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch(PDOException $e2) {
        die("Connection failed: " . $e2->getMessage() . "<br>Original error: " . $e->getMessage());
    }
}

// Start session
session_start();
?>