<?php
// Simple diagnostic script for InfinityFree
echo "<h1>InfinityFree Diagnostic Tool</h1>";
echo "<hr>";

// PHP Version check
echo "<h2>PHP Environment</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "PDO Available: " . (extension_loaded('pdo') ? 'YES' : 'NO') . "<br>";
echo "PDO MySQL Available: " . (extension_loaded('pdo_mysql') ? 'YES' : 'NO') . "<br>";

// Database connection test with multiple methods
echo "<h2>Database Connection Tests</h2>";

$host = 'sql203.infinityfree.com';
$user = 'if0_40035033';
$pass = 'hTPFj5yvAlHB';
$db = 'if0_40035033_tours';

echo "<p><strong>Connection Details:</strong><br>";
echo "Host: $host<br>";
echo "User: $user<br>";
echo "Database: $db<br>";
echo "Password: " . (strlen($pass) > 0 ? '[SET - ' . strlen($pass) . ' chars]' : '[NOT SET]') . "</p>";

// Method 1: Basic PDO
echo "<h3>Method 1: Basic PDO Connection</h3>";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo "<p style='color: green;'>✅ SUCCESS: Basic PDO connection works!</p>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tours");
    $result = $stmt->fetch();
    echo "<p style='color: green;'>✅ Query test: Found " . $result['count'] . " tours</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ FAILED: " . $e->getMessage() . "</p>";
    
    // Method 2: Try with different options
    echo "<h3>Method 2: PDO with Options</h3>";
    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8", 
            $user, 
            $pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        echo "<p style='color: green;'>✅ SUCCESS: PDO with options works!</p>";
    } catch (Exception $e2) {
        echo "<p style='color: red;'>❌ FAILED: " . $e2->getMessage() . "</p>";
        
        // Method 3: Try mysqli
        echo "<h3>Method 3: MySQLi Connection</h3>";
        try {
            $mysqli = new mysqli($host, $user, $pass, $db);
            if ($mysqli->connect_error) {
                throw new Exception($mysqli->connect_error);
            }
            echo "<p style='color: green;'>✅ SUCCESS: MySQLi connection works!</p>";
            $mysqli->close();
        } catch (Exception $e3) {
            echo "<p style='color: red;'>❌ FAILED: " . $e3->getMessage() . "</p>";
        }
    }
}

echo "<hr>";
echo "<h2>Recommendations</h2>";
echo "<p>If all methods fail, the issue might be:</p>";
echo "<ul>";
echo "<li>MySQL password is incorrect</li>";
echo "<li>Database name is wrong</li>";
echo "<li>InfinityFree server issues</li>";
echo "<li>Account not fully activated</li>";
echo "</ul>";

echo "<p><a href='index.php'>← Back to Homepage</a></p>";
echo "<p><small>Generated: " . date('Y-m-d H:i:s') . "</small></p>";
?>