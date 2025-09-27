<?php
require_once 'includes/functions.php';

// Get filters
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$difficulty = isset($_GET['difficulty']) ? sanitizeInput($_GET['difficulty']) : '';
$price_range = isset($_GET['price_range']) ? sanitizeInput($_GET['price_range']) : '';
$sort = isset($_GET['sort']) ? sanitizeInput($_GET['sort']) : 'newest';

// Build query
$where_conditions = ["t.status = 'active'"];
$params = [];

if ($search) {
    $where_conditions[] = "(t.title LIKE :search OR t.description LIKE :search OR t.location LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

if ($difficulty) {
    $where_conditions[] = "t.difficulty_level = :difficulty";
    $params[':difficulty'] = $difficulty;
}

if ($price_range) {
    switch ($price_range) {
        case 'under-500':
            $where_conditions[] = "COALESCE(t.discount_price, t.price) < 500";
            break;
        case '500-1000':
            $where_conditions[] = "COALESCE(t.discount_price, t.price) BETWEEN 500 AND 1000";
            break;
        case '1000-2000':
            $where_conditions[] = "COALESCE(t.discount_price, t.price) BETWEEN 1000 AND 2000";
            break;
        case 'over-2000':
            $where_conditions[] = "COALESCE(t.discount_price, t.price) > 2000";
            break;
    }
}

// Sort options
$order_by = "t.created_at DESC"; // default
switch ($sort) {
    case 'price-low':
        $order_by = "COALESCE(t.discount_price, t.price) ASC";
        break;
    case 'price-high':
        $order_by = "COALESCE(t.discount_price, t.price) DESC";
        break;
    case 'rating':
        $order_by = "avg_rating DESC";
        break;
    case 'popular':
        $order_by = "review_count DESC";
        break;
}

// Execute query
$sql = "SELECT t.*, 
        (SELECT image_path FROM tour_images WHERE tour_id = t.id AND is_primary = 1 LIMIT 1) as primary_image,
        (SELECT AVG(rating) FROM reviews WHERE tour_id = t.id AND status = 'approved') as avg_rating,
        (SELECT COUNT(*) FROM reviews WHERE tour_id = t.id AND status = 'approved') as review_count
        FROM tours t 
        WHERE " . implode(' AND ', $where_conditions) . "
        ORDER BY " . $order_by;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$tours = $stmt->fetchAll();

$page_title = "All Tours - " . SITE_NAME;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="Browse all our amazing tour packages. Find your perfect adventure with filters for difficulty, price, and location.">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .filters-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .filters-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .filter-select,
        .filter-input {
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.875rem;
        }
        
        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .results-count {
            color: #666;
            font-size: 0.875rem;
        }
        
        .sort-options {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .tours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .no-results h3 {
            color: #666;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .filters-row {
                grid-template-columns: 1fr;
            }
            
            .results-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            
            .tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="index.php"><?php echo SITE_NAME; ?></a>
            </div>
            <nav>
                <ul class="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="tours.php" class="active">Tours</a></li>
                    <li><a href="index.php#gallery">Gallery</a></li>
                    <li><a href="index.php#reviews">Reviews</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
                <button class="mobile-menu-toggle">☰</button>
            </nav>
        </div>
    </header>

    <div class="container" style="margin-top: 2rem;">
        <!-- Page Header -->
        <div class="section-header text-center mb-4">
            <h1 class="section-title">All Tours</h1>
            <p class="section-subtitle">Discover amazing destinations and create unforgettable memories</p>
        </div>

        <!-- Filters -->
        <div class="filters-section">
            <form method="GET" action="" id="filter-form">
                <div class="filters-row">
                    <div class="filter-group">
                        <label class="filter-label">Search Tours</label>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                               placeholder="Search by name, location..." class="filter-input">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Difficulty Level</label>
                        <select name="difficulty" class="filter-select">
                            <option value="">All Levels</option>
                            <option value="Easy" <?php echo $difficulty === 'Easy' ? 'selected' : ''; ?>>Easy</option>
                            <option value="Moderate" <?php echo $difficulty === 'Moderate' ? 'selected' : ''; ?>>Moderate</option>
                            <option value="Challenging" <?php echo $difficulty === 'Challenging' ? 'selected' : ''; ?>>Challenging</option>
                            <option value="Expert" <?php echo $difficulty === 'Expert' ? 'selected' : ''; ?>>Expert</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Price Range</label>
                        <select name="price_range" class="filter-select">
                            <option value="">All Prices</option>
                            <option value="under-500" <?php echo $price_range === 'under-500' ? 'selected' : ''; ?>>Under $500</option>
                            <option value="500-1000" <?php echo $price_range === '500-1000' ? 'selected' : ''; ?>>$500 - $1,000</option>
                            <option value="1000-2000" <?php echo $price_range === '1000-2000' ? 'selected' : ''; ?>>$1,000 - $2,000</option>
                            <option value="over-2000" <?php echo $price_range === 'over-2000' ? 'selected' : ''; ?>>Over $2,000</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Sort By</label>
                        <select name="sort" class="filter-select">
                            <option value="newest" <?php echo $sort === 'newest' ? 'selected' : ''; ?>>Newest First</option>
                            <option value="price-low" <?php echo $sort === 'price-low' ? 'selected' : ''; ?>>Price: Low to High</option>
                            <option value="price-high" <?php echo $sort === 'price-high' ? 'selected' : ''; ?>>Price: High to Low</option>
                            <option value="rating" <?php echo $sort === 'rating' ? 'selected' : ''; ?>>Highest Rated</option>
                            <option value="popular" <?php echo $sort === 'popular' ? 'selected' : ''; ?>>Most Popular</option>
                        </select>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="tours.php" class="btn btn-outline">Clear All</a>
                </div>
            </form>
        </div>

        <!-- Results -->
        <div class="results-header">
            <div class="results-count">
                Found <?php echo count($tours); ?> tour<?php echo count($tours) !== 1 ? 's' : ''; ?>
            </div>
        </div>

        <!-- Tours Grid -->
        <?php if (!empty($tours)): ?>
            <div class="tours-grid">
                <?php foreach ($tours as $tour): ?>
                    <?php
                    $primary_image = $tour['primary_image'] ?: 'assets/images/default-tour.svg';
                    $discount = $tour['discount_price'] ? round((($tour['price'] - $tour['discount_price']) / $tour['price']) * 100) : 0;
                    ?>
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo htmlspecialchars($primary_image); ?>" 
                                 alt="<?php echo htmlspecialchars($tour['title']); ?>" loading="lazy">
                            <?php if ($discount > 0): ?>
                                <div class="card-badge"><?php echo $discount; ?>% OFF</div>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title"><?php echo htmlspecialchars($tour['title']); ?></h3>
                            <p class="card-description"><?php echo htmlspecialchars($tour['short_description']); ?></p>
                            
                            <div class="card-meta">
                                <span>📍 <?php echo htmlspecialchars($tour['location']); ?></span>
                                <span>⏰ <?php echo htmlspecialchars($tour['duration']); ?></span>
                            </div>
                            
                            <div class="card-meta">
                                <span>👥 Max <?php echo $tour['max_people']; ?> people</span>
                                <span>🏔️ <?php echo htmlspecialchars($tour['difficulty_level']); ?></span>
                            </div>
                            
                            <?php if ($tour['avg_rating']): ?>
                                <div class="rating mb-2">
                                    <div data-rating="<?php echo formatRating($tour['avg_rating']); ?>"></div>
                                    <span class="rating-text">(<?php echo $tour['review_count']; ?> reviews)</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-price">
                                <?php if ($tour['discount_price']): ?>
                                    <?php echo formatPrice($tour['discount_price']); ?>
                                    <span class="card-price-old"><?php echo formatPrice($tour['price']); ?></span>
                                <?php else: ?>
                                    <?php echo formatPrice($tour['price']); ?>
                                <?php endif; ?>
                                <small>per person</small>
                            </div>
                            
                            <div class="card-actions mt-3">
                                <a href="tour-details.php?id=<?php echo $tour['id']; ?>" class="btn btn-primary" style="width: 100%;">
                                    View Details & Book
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <h3>No tours found</h3>
                <p>Try adjusting your filters or search criteria to find more tours.</p>
                <a href="tours.php" class="btn btn-primary mt-3">View All Tours</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php echo SITE_NAME; ?></h3>
                    <p>Creating unforgettable travel experiences worldwide.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="tours.php">Tours</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
    <script>
        // Auto-submit form when filters change
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filter-form');
            const filterInputs = filterForm.querySelectorAll('select, input');
            
            filterInputs.forEach(input => {
                if (input.type !== 'text') {
                    input.addEventListener('change', function() {
                        filterForm.submit();
                    });
                }
            });
            
            // For search input, submit on Enter key
            const searchInput = filterForm.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        filterForm.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>