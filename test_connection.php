<?php
// Database Connection Test for InfinityFree
require_once 'includes/config.php';

echo "<h1>Database Connection Test</h1>";
echo "<hr>";

try {
    // Test database connection
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=3306",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    
    echo "<p style='color: green;'>✅ <strong>Database connection successful!</strong></p>";
    
    // Test if tables exist
    $tables = ['tours', 'bookings', 'reviews', 'admin_users', 'contact_messages', 'tour_images'];
    echo "<h2>Table Status:</h2>";
    
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
            $count = $stmt->fetchColumn();
            echo "<p style='color: green;'>✅ Table '$table': $count records</p>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ Table '$table': " . $e->getMessage() . "</p>";
        }
    }
    
    // Test sample data
    echo "<h2>Sample Data Check:</h2>";
    try {
        $stmt = $pdo->query("SELECT title, price FROM tours LIMIT 3");
        $tours = $stmt->fetchAll();
        
        if (count($tours) > 0) {
            echo "<p style='color: green;'>✅ <strong>Sample tours found:</strong></p>";
            echo "<ul>";
            foreach ($tours as $tour) {
                echo "<li>" . htmlspecialchars($tour['title']) . " - $" . $tour['price'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠️ No sample tours found</p>";
        }
        
        // Check admin user
        $stmt = $pdo->query("SELECT username FROM admin_users WHERE username = 'admin'");
        $admin = $stmt->fetch();
        
        if ($admin) {
            echo "<p style='color: green;'>✅ Admin user exists: " . htmlspecialchars($admin['username']) . "</p>";
        } else {
            echo "<p style='color: red;'>❌ Admin user not found</p>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Error checking sample data: " . $e->getMessage() . "</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ <strong>Database connection failed:</strong><br>";
    echo htmlspecialchars($e->getMessage()) . "</p>";
    
    echo "<h2>Connection Details:</h2>";
    echo "<ul>";
    echo "<li><strong>Host:</strong> " . DB_HOST . "</li>";
    echo "<li><strong>Database:</strong> " . DB_NAME . "</li>";
    echo "<li><strong>Username:</strong> " . DB_USER . "</li>";
    echo "<li><strong>Password:</strong> " . (DB_PASS ? '[SET]' : '[NOT SET]') . "</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<h2>Next Steps:</h2>";
echo "<ol>";
echo "<li>If connection successful, visit <a href='index.php'>your homepage</a></li>";
echo "<li>Test <a href='admin/login.php'>admin login</a> (admin/admin123)</li>";
echo "<li>Create 'uploads' folder if not exists</li>";
echo "<li><strong>Delete this file (test_connection.php) after testing</strong></li>";
echo "</ol>";

echo "<p><small>Generated: " . date('Y-m-d H:i:s') . "</small></p>";
?>