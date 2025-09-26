<?php
// Tour Package Booking Website - Setup Script
// This script helps set up the database and initial configuration

echo "<h1>Tour Package Booking Website - Setup</h1>";

// Check if config file exists
if (!file_exists('includes/config.php')) {
    echo "<div style='color: red;'>Error: config.php file not found. Please create it first.</div>";
    exit;
}

require_once 'includes/config.php';

echo "<h2>Database Setup</h2>";

try {
    // Test database connection
    $test_connection = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $test_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div style='color: green;'>✓ Database connection successful</div>";
    
    // Create database if it doesn't exist
    $test_connection->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    echo "<div style='color: green;'>✓ Database '" . DB_NAME . "' created/verified</div>";
    
    // Switch to the tour booking database
    $test_connection->exec("USE " . DB_NAME);
    
    // Read and execute schema file
    $schema_file = 'database/schema.sql';
    if (file_exists($schema_file)) {
        $schema_sql = file_get_contents($schema_file);
        
        // Split the SQL file into individual statements
        $statements = array_filter(array_map('trim', explode(';', $schema_sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                $test_connection->exec($statement);
            }
        }
        
        echo "<div style='color: green;'>✓ Database schema created successfully</div>";
        echo "<div style='color: green;'>✓ Sample data inserted</div>";
    } else {
        echo "<div style='color: red;'>Error: schema.sql file not found</div>";
    }
    
} catch (PDOException $e) {
    echo "<div style='color: red;'>Database Error: " . $e->getMessage() . "</div>";
    exit;
}

echo "<h2>File Permissions Check</h2>";

// Check upload directory permissions
$upload_dirs = [
    'uploads/tours',
    'assets/images'
];

foreach ($upload_dirs as $dir) {
    if (is_dir($dir)) {
        if (is_writable($dir)) {
            echo "<div style='color: green;'>✓ Directory '$dir' is writable</div>";
        } else {
            echo "<div style='color: orange;'>⚠ Directory '$dir' is not writable - you may need to set permissions</div>";
        }
    } else {
        echo "<div style='color: red;'>✗ Directory '$dir' does not exist</div>";
    }
}

echo "<h2>Configuration Summary</h2>";
echo "<ul>";
echo "<li><strong>Site Name:</strong> " . SITE_NAME . "</li>";
echo "<li><strong>Database:</strong> " . DB_NAME . "</li>";
echo "<li><strong>Admin Email:</strong> " . ADMIN_EMAIL . "</li>";
echo "<li><strong>Upload Path:</strong> " . UPLOAD_PATH . "</li>";
echo "</ul>";

echo "<h2>Default Admin Account</h2>";
echo "<div style='background: #f0f8ff; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<p><strong>Username:</strong> admin</p>";
echo "<p><strong>Password:</strong> admin123</p>";
echo "<p><em>Please change this password after your first login!</em></p>";
echo "</div>";

echo "<h2>Next Steps</h2>";
echo "<ol>";
echo "<li>Visit the <a href='index.php'>website homepage</a> to test the public interface</li>";
echo "<li>Login to the <a href='admin/login.php'>admin panel</a> to manage tours and bookings</li>";
echo "<li>Upload tour images to the uploads/tours/ directory</li>";
echo "<li>Configure your email settings for booking confirmations</li>";
echo "<li>Set up your payment gateway (PayPal integration included)</li>";
echo "</ol>";

echo "<h2>Important Security Notes</h2>";
echo "<div style='background: #fff3cd; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<ul>";
echo "<li>Change the default admin password immediately</li>";
echo "<li>Remove or protect this setup.php file after installation</li>";
echo "<li>Configure proper file permissions on your server</li>";
echo "<li>Set up SSL certificate for secure transactions</li>";
echo "<li>Configure email settings in config.php</li>";
echo "</ul>";
echo "</div>";

echo "<div style='margin-top: 30px; padding: 20px; background: #d4edda; border-radius: 5px;'>";
echo "<h3 style='color: #155724;'>Setup Complete! 🎉</h3>";
echo "<p>Your Tour Package Booking Website is now ready to use.</p>";
echo "<p><a href='index.php' style='background: #667eea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Visit Website</a> ";
echo "<a href='admin/login.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px;'>Admin Login</a></p>";
echo "</div>";

echo "<style>
body { 
    font-family: Arial, sans-serif; 
    max-width: 800px; 
    margin: 0 auto; 
    padding: 20px;
    line-height: 1.6;
    color: #333;
}
h1, h2 { 
    color: #667eea; 
    border-bottom: 2px solid #eee; 
    padding-bottom: 10px;
}
ul, ol { 
    margin-left: 20px; 
}
li { 
    margin-bottom: 5px; 
}
</style>";
?>