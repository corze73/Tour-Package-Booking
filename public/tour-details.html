<?php
require_once 'includes/functions.php';

$tour_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$tour_id) {
    header('Location: tours.php');
    exit;
}

$tour = getTourById($tour_id);
if (!$tour) {
    header('Location: tours.php');
    exit;
}

$images = getTourImages($tour_id);
$reviews = getTourReviews($tour_id, 10);
$related_tours = getAllTours(3);

$page_title = htmlspecialchars($tour['title']) . ' - ' . SITE_NAME;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($tour['short_description']); ?>">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .tour-gallery {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 300px 300px;
            gap: 10px;
            margin-bottom: 2rem;
        }
        
        .tour-gallery .main-image {
            grid-row: 1 / 3;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .tour-gallery .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .tour-gallery .thumb {
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .tour-gallery .thumb:hover {
            transform: scale(1.05);
        }
        
        .tour-gallery .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .booking-card {
            position: sticky;
            top: 100px;
        }
        
        .price-display {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        
        .price-display .current-price {
            font-size: 2rem;
            font-weight: 700;
        }
        
        .price-display .old-price {
            font-size: 1.2rem;
            text-decoration: line-through;
            opacity: 0.7;
        }
        
        .tour-highlights {
            list-style: none;
            padding: 0;
        }
        
        .tour-highlights li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .tour-highlights li:before {
            content: '✓';
            color: #28a745;
            font-weight: bold;
            margin-right: 0.5rem;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .tabs {
            display: flex;
            border-bottom: 2px solid #eee;
            margin-bottom: 2rem;
        }
        
        .tab {
            padding: 1rem 2rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .tab.active {
            border-bottom-color: #667eea;
            color: #667eea;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .tour-gallery {
                grid-template-columns: 1fr;
                grid-template-rows: 250px;
            }
            
            .tour-gallery .main-image {
                grid-row: 1;
            }
            
            .booking-card {
                position: static;
                margin-top: 2rem;
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
                    <li><a href="tours.php">Tours</a></li>
                    <li><a href="index.php#gallery">Gallery</a></li>
                    <li><a href="index.php#reviews">Reviews</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
                <button class="mobile-menu-toggle">☰</button>
            </nav>
        </div>
    </header>

    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-md-8">
                <!-- Tour Gallery -->
                <?php if (!empty($images)): ?>
                    <div class="tour-gallery">
                        <div class="main-image">
                            <img id="main-tour-image" src="<?php echo htmlspecialchars($images[0]['image_path']); ?>" 
                                 alt="<?php echo htmlspecialchars($tour['title']); ?>">
                        </div>
                        <?php for ($i = 1; $i < min(4, count($images)); $i++): ?>
                            <div class="thumb" onclick="changeMainImage('<?php echo htmlspecialchars($images[$i]['image_path']); ?>')">
                                <img src="<?php echo htmlspecialchars($images[$i]['image_path']); ?>" 
                                     alt="<?php echo htmlspecialchars($tour['title']); ?>">
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <!-- Tour Title and Basic Info -->
                <div class="tour-header">
                    <h1><?php echo htmlspecialchars($tour['title']); ?></h1>
                    <div class="tour-meta" style="display: flex; gap: 2rem; margin: 1rem 0; color: #666;">
                        <span>📍 <?php echo htmlspecialchars($tour['location']); ?></span>
                        <span>⏰ <?php echo htmlspecialchars($tour['duration']); ?></span>
                        <span>👥 Max <?php echo $tour['max_people']; ?> people</span>
                        <span>🏔️ <?php echo htmlspecialchars($tour['difficulty_level']); ?></span>
                    </div>
                    
                    <?php if ($tour['avg_rating']): ?>
                        <div class="rating mb-2">
                            <div data-rating="<?php echo formatRating($tour['avg_rating']); ?>"></div>
                            <span class="rating-text">(<?php echo $tour['review_count']; ?> reviews)</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tour Details Tabs -->
                <div class="tour-details">
                    <div class="tabs">
                        <div class="tab active" onclick="showTab('overview')">Overview</div>
                        <div class="tab" onclick="showTab('itinerary')">Itinerary</div>
                        <div class="tab" onclick="showTab('includes')">What's Included</div>
                        <div class="tab" onclick="showTab('reviews')">Reviews</div>
                    </div>

                    <div id="overview" class="tab-content active">
                        <h3>Tour Overview</h3>
                        <p><?php echo nl2br(htmlspecialchars($tour['description'])); ?></p>
                        
                        <h4>Tour Highlights</h4>
                        <ul class="tour-highlights">
                            <li>Professional guide throughout the journey</li>
                            <li>Small group size for personalized experience</li>
                            <li>All safety equipment provided</li>
                            <li>Stunning photo opportunities</li>
                            <li>Cultural immersion experiences</li>
                        </ul>
                    </div>

                    <div id="itinerary" class="tab-content">
                        <h3>Day by Day Itinerary</h3>
                        <?php if ($tour['itinerary']): ?>
                            <div class="itinerary-content">
                                <?php echo nl2br(htmlspecialchars($tour['itinerary'])); ?>
                            </div>
                        <?php else: ?>
                            <p>Detailed itinerary will be provided upon booking confirmation.</p>
                        <?php endif; ?>
                    </div>

                    <div id="includes" class="tab-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="color: #28a745;">✓ What's Included</h4>
                                <?php if ($tour['includes']): ?>
                                    <ul>
                                        <?php foreach (explode("\n", $tour['includes']) as $item): ?>
                                            <?php if (trim($item)): ?>
                                                <li><?php echo htmlspecialchars(trim($item)); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>Details will be provided upon inquiry.</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <h4 style="color: #dc3545;">✗ What's Not Included</h4>
                                <?php if ($tour['excludes']): ?>
                                    <ul>
                                        <?php foreach (explode("\n", $tour['excludes']) as $item): ?>
                                            <?php if (trim($item)): ?>
                                                <li><?php echo htmlspecialchars(trim($item)); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>Details will be provided upon inquiry.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div id="reviews" class="tab-content">
                        <h3>Customer Reviews</h3>
                        <?php if (!empty($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <div class="review">
                                    <div class="review-header">
                                        <div class="review-info">
                                            <h4 class="review-author"><?php echo htmlspecialchars($review['customer_name']); ?></h4>
                                            <div data-rating="<?php echo $review['rating']; ?>"></div>
                                        </div>
                                        <span class="review-date"><?php echo date('M j, Y', strtotime($review['created_at'])); ?></span>
                                    </div>
                                    <p class="review-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No reviews yet. Be the first to review this tour!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Booking Card -->
                <div class="card booking-card">
                    <div class="price-display">
                        <?php if ($tour['discount_price']): ?>
                            <div class="current-price"><?php echo formatPrice($tour['discount_price']); ?></div>
                            <div class="old-price"><?php echo formatPrice($tour['price']); ?></div>
                        <?php else: ?>
                            <div class="current-price"><?php echo formatPrice($tour['price']); ?></div>
                        <?php endif; ?>
                        <small>per person</small>
                    </div>
                    
                    <div class="card-content">
                        <form id="booking-form" action="process_booking.php" method="POST">
                            <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                            
                            <div class="form-group">
                                <label class="form-label" for="booking_date">Tour Date *</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="num_people">Number of People *</label>
                                <input type="number" class="form-control" id="num_people" name="num_people" 
                                       min="1" max="<?php echo $tour['max_people']; ?>" value="1" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="customer_name">Full Name *</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="customer_email">Email *</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="customer_phone">Phone</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="special_requests">Special Requests</label>
                                <textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
                            </div>
                            
                            <div class="price-calculator" data-base-price="<?php echo $tour['discount_price'] ?: $tour['price']; ?>">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-weight: 600;">
                                    <span>Total Amount:</span>
                                    <span class="total-amount"><?php echo formatPrice($tour['discount_price'] ?: $tour['price']); ?></span>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Book Now</button>
                        </form>
                        
                        <div class="booking-info mt-3">
                            <small>
                                <strong>Free cancellation</strong> up to 24 hours before the tour.<br>
                                <strong>Instant confirmation</strong> - You'll receive a confirmation email immediately.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact -->
                <div class="card mt-3">
                    <div class="card-content">
                        <h4>Need Help?</h4>
                        <p>Our travel experts are here to help you plan the perfect trip.</p>
                        <a href="tel:+15551234567" class="btn btn-outline" style="width: 100%; margin-bottom: 0.5rem;">📞 Call Us</a>
                        <a href="mailto:<?php echo ADMIN_EMAIL; ?>" class="btn btn-outline" style="width: 100%;">✉️ Email Us</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Tours -->
        <?php if (!empty($related_tours)): ?>
            <section class="section">
                <h2 class="section-title">You Might Also Like</h2>
                <div class="row">
                    <?php foreach (array_slice($related_tours, 0, 3) as $related_tour): ?>
                        <?php if ($related_tour['id'] != $tour['id']): ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="<?php echo htmlspecialchars($related_tour['primary_image'] ?: 'assets/images/default-tour.svg'); ?>" 
                                             alt="<?php echo htmlspecialchars($related_tour['title']); ?>">
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title"><?php echo htmlspecialchars($related_tour['title']); ?></h3>
                                        <p class="card-description"><?php echo htmlspecialchars($related_tour['short_description']); ?></p>
                                        <div class="card-price"><?php echo formatPrice($related_tour['price']); ?></div>
                                        <a href="tour-details.php?id=<?php echo $related_tour['id']; ?>" class="btn btn-primary mt-2">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
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
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }
        
        function changeMainImage(imageSrc) {
            document.getElementById('main-tour-image').src = imageSrc;
        }
        
        // Price calculator for booking form
        document.addEventListener('DOMContentLoaded', function() {
            const peopleInput = document.getElementById('num_people');
            const totalElement = document.querySelector('.total-amount');
            const basePrice = <?php echo $tour['discount_price'] ?: $tour['price']; ?>;
            
            if (peopleInput && totalElement) {
                peopleInput.addEventListener('input', function() {
                    const numPeople = parseInt(this.value) || 1;
                    const total = basePrice * numPeople;
                    totalElement.textContent = '$' + total.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                });
            }
        });
    </script>
</body>
</html>