<?php
// Password Setup Helper for InfinityFree
// Run this once to generate a secure password hash for config.php

if ($_GET['action'] === 'generate' && isset($_GET['password'])) {
    $password = $_GET['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    echo "<h2>Password Configuration Helper</h2>";
    echo "<p>For password: <strong>" . htmlspecialchars($password) . "</strong></p>";
    echo "<p>Add this to your config.php:</p>";
    echo "<pre>define('DB_PASS', '" . htmlspecialchars($password) . "');</pre>";
    echo "<hr>";
    echo "<p>Also, your admin password hash is:</p>";
    echo "<pre>" . htmlspecialchars($hash) . "</pre>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Setup - Adventure Tours</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-group { margin: 20px 0; }
        input[type="password"], input[type="text"] { padding: 10px; width: 300px; border: 1px solid #ddd; }
        button { padding: 10px 20px; background: #007cba; color: white; border: none; cursor: pointer; }
        .warning { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Adventure Tours - Password Setup</h1>
    
    <div class="warning">
        <strong>Security Notice:</strong> Delete this file after setup is complete!
    </div>
    
    <h2>Step 1: Set Your MySQL Password</h2>
    <p>Enter the MySQL password you set in InfinityFree control panel:</p>
    
    <form method="GET">
        <input type="hidden" name="action" value="generate">
        <div class="form-group">
            <label>MySQL Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Generate Config</button>
    </form>
    
    <h2>Current Configuration Status</h2>
    <ul>
        <li>Database Host: sql203.infinityfree.com</li>
        <li>Database User: if0_40035033</li>
        <li>Database Name: if0_40035033_tours</li>
        <li>Admin Login: admin / admin123</li>
    </ul>
    
    <h2>Next Steps</h2>
    <ol>
        <li>Set MySQL password in InfinityFree control panel</li>
        <li>Use this tool to generate the config</li>
        <li>Update includes/config.php with the generated line</li>
        <li>Test your website</li>
        <li><strong>Delete this file (password_setup.php)</strong></li>
    </ol>
</body>
</html>