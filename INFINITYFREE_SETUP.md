# InfinityFree Setup Instructions

## Important: MySQL Password Setup

Your database is set up but you need to set a MySQL password:

### Step 1: Set MySQL Password
1. Go to InfinityFree Control Panel
2. Click on "MySQL Databases"
3. Look for "Change Password" or similar option
4. Set a secure password for user `if0_40035033`

### Step 2: Update config.php
1. Edit `includes/config.php` on your server
2. Replace `YOUR_MYSQL_PASSWORD_HERE` with your actual password:
```php
define('DB_PASS', 'your_actual_password');
```

### Step 3: Create uploads folder
1. In File Manager, create folder: `uploads`
2. Set permissions to 755 or 777

### Step 4: Test Your Website
Visit: https://adventuretours.infinityfreeapp.com

### Step 5: Test Admin Panel
Visit: https://adventuretours.infinityfreeapp.com/admin
- Username: `admin`
- Password: `admin123`

## Database Connection Details
- **Host:** sql203.infinityfree.com
- **Username:** if0_40035033
- **Database:** if0_40035033_tours
- **Port:** 3306

## Troubleshooting
If you get "Access denied" errors, double-check:
1. MySQL password is set correctly
2. Password is updated in config.php
3. Database name is exactly: `if0_40035033_tours`