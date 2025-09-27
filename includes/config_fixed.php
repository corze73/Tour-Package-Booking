<?php
// Optimized config.php for InfinityFree hosting
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

// InfinityFree optimized database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => false
        )
    );
} catch(PDOException $e) {
    // More detailed error for troubleshooting
    $error_msg = "Database connection failed: " . $e->getMessage();
    $error_msg .= "<br><br>Connection details:";
    $error_msg .= "<br>Host: " . DB_HOST;
    $error_msg .= "<br>Database: " . DB_NAME;
    $error_msg .= "<br>User: " . DB_USER;
    die($error_msg);
}

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>