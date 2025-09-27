<?php
require_once '../includes/functions.php';
requireAdmin();

// Get dashboard statistics
$stats = [];
$stats['total_tours'] = $pdo->query("SELECT COUNT(*) FROM tours WHERE status = 'active'")->fetchColumn();
$stats['total_bookings'] = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
$stats['pending_bookings'] = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status = 'pending'")->fetchColumn();
$stats['total_revenue'] = $pdo->query("SELECT COALESCE(SUM(total_amount), 0) FROM bookings WHERE payment_status = 'paid'")->fetchColumn();

// Get recent bookings
$recent_bookings = $pdo->query("
    SELECT b.*, t.title as tour_title 
    FROM bookings b 
    JOIN tours t ON b.tour_id = t.id 
    ORDER BY b.created_at DESC 
    LIMIT 10
")->fetchAll();

// Get pending reviews
$pending_reviews = $pdo->query("
    SELECT r.*, t.title as tour_title 
    FROM reviews r 
    JOIN tours t ON r.tour_id = t.id 
    WHERE r.status = 'pending' 
    ORDER BY r.created_at DESC 
    LIMIT 5
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 0;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            background: #34495e;
            border-bottom: 1px solid #4a5a6a;
        }
        
        .sidebar-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            border-bottom: 1px solid #34495e;
        }
        
        .sidebar-menu a {
            display: block;
            padding: 1rem 1.5rem;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #34495e;
            color: white;
        }
        
        .main-content {
            flex: 1;
            background: #f8f9fa;
        }
        
        .admin-header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-content {
            padding: 2rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #667eea;
            display: block;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .data-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .data-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }
        
        .data-table tr:hover {
            background: #f8f9fa;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-paid {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .quick-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .quick-actions .btn {
            padding: 0.75rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .admin-wrapper {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                position: static;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><?php echo SITE_NAME; ?></h3>
                <p>Admin Panel</p>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php" class="active">📊 Dashboard</a></li>
                <li><a href="tours.php">🏔️ Tours</a></li>
                <li><a href="bookings.php">📅 Bookings</a></li>
                <li><a href="reviews.php">⭐ Reviews</a></li>
                <li><a href="messages.php">💬 Messages</a></li>
                <li><a href="settings.php">⚙️ Settings</a></li>
                <li><a href="logout.php">🚪 Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div class="admin-user">
                    Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                    <a href="logout.php" class="btn btn-outline" style="margin-left: 1rem;">Logout</a>
                </div>
            </div>
            
            <!-- Content -->
            <div class="admin-content">
                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-number"><?php echo $stats['total_tours']; ?></span>
                        <span class="stat-label">Active Tours</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number"><?php echo $stats['total_bookings']; ?></span>
                        <span class="stat-label">Total Bookings</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number"><?php echo $stats['pending_bookings']; ?></span>
                        <span class="stat-label">Pending Bookings</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number"><?php echo formatPrice($stats['total_revenue']); ?></span>
                        <span class="stat-label">Total Revenue</span>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="tours.php?action=add" class="btn btn-primary">➕ Add New Tour</a>
                    <a href="bookings.php" class="btn btn-outline">📅 View All Bookings</a>
                    <a href="../index.php" target="_blank" class="btn btn-outline">🌐 View Website</a>
                </div>
                
                <!-- Recent Bookings -->
                <div class="section-card">
                    <h2>Recent Bookings</h2>
                    <?php if (!empty($recent_bookings)): ?>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Tour</th>
                                    <th>Date</th>
                                    <th>People</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_bookings as $booking): ?>
                                    <tr>
                                        <td>#<?php echo $booking['id']; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($booking['customer_name']); ?></strong><br>
                                            <small><?php echo htmlspecialchars($booking['customer_email']); ?></small>
                                        </td>
                                        <td><?php echo htmlspecialchars($booking['tour_title']); ?></td>
                                        <td><?php echo date('M j, Y', strtotime($booking['booking_date'])); ?></td>
                                        <td><?php echo $booking['num_people']; ?></td>
                                        <td><?php echo formatPrice($booking['total_amount']); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $booking['status']; ?>">
                                                <?php echo ucfirst($booking['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="bookings.php?action=view&id=<?php echo $booking['id']; ?>" 
                                               class="btn btn-sm btn-outline">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No bookings found.</p>
                    <?php endif; ?>
                </div>
                
                <!-- Pending Reviews -->
                <?php if (!empty($pending_reviews)): ?>
                    <div class="section-card mt-4">
                        <h2>Pending Reviews</h2>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Tour</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_reviews as $review): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($review['customer_name']); ?></td>
                                        <td><?php echo htmlspecialchars($review['tour_title']); ?></td>
                                        <td>
                                            <div data-rating="<?php echo $review['rating']; ?>"></div>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars(substr($review['review_text'], 0, 100)); ?>
                                            <?php if (strlen($review['review_text']) > 100): ?>...<?php endif; ?>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($review['created_at'])); ?></td>
                                        <td>
                                            <a href="reviews.php?action=approve&id=<?php echo $review['id']; ?>" 
                                               class="btn btn-sm btn-success">Approve</a>
                                            <a href="reviews.php?action=reject&id=<?php echo $review['id']; ?>" 
                                               class="btn btn-sm btn-outline">Reject</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/main.js"></script>
</body>
</html>