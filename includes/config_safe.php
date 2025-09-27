<?php
// Minimal config.php that won't crash the site
// Database configuration
define('DB_HOST', 'sql203.infinityfree.com'); 
define('DB_USER', 'if0_40035033');      
define('DB_PASS', 'hTPFj5yvAlHB');
define('DB_NAME', 'if0_40035033_tours');

// Site configuration
define('SITE_NAME', 'Adventure Tours Demo');
define('SITE_URL', 'https://adventuretours.infinityfreeapp.com');
define('ADMIN_EMAIL', 'demo@adventuretours.com');

// Payment gateway configuration (placeholder)
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
define('PAYPAL_CLIENT_SECRET', 'your_paypal_client_secret');
define('PAYPAL_MODE', 'sandbox');

// Upload configuration
define('UPLOAD_PATH', 'uploads/tours/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024);

// Safe database connection - won't crash if it fails
$pdo = null;
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Don't die - just log the error and continue
    error_log("Database connection failed: " . $e->getMessage());
    $pdo = null;
}

// Helper function to check if database is available
function isDatabaseConnected() {
    global $pdo;
    return $pdo !== null;
}

// Start session safely
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>