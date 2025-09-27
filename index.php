<?php
require_once 'includes/functions.php';

// Get featured tours
$featured_tours = getAllTours(6, true);
$all_tours = getAllTours(12);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Discover Amazing Adventures</title>
    <meta name="description" content="Book amazing tour packages with Adventure Tours. Explore breathtaking destinations with our guided tours and create unforgettable memories.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">
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
                    <li><a href="#home">Home</a></li>
                    <li><a href="#tours">Tours</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="admin/login.php">Admin</a></li>
                </ul>
                <button class="mobile-menu-toggle">☰</button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Amazing Adventures</h1>
                <p>Explore breathtaking destinations with our carefully crafted tour packages. Create memories that last a lifetime with our expert guides and exceptional service.</p>
                <div class="hero-buttons">
                    <a href="#tours" class="btn btn-primary">Explore Tours</a>
                    <a href="#contact" class="btn btn-outline">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Tours Section -->
    <section id="tours" class="section">
        <div class="container">
            <h2 class="section-title">Featured Tours</h2>
            <p class="section-subtitle">Discover our most popular destinations and experiences</p>
            
            <div class="row">
                <?php foreach ($featured_tours as $tour): ?>
                    <?php
                    $images = getTourImages($tour['id']);
                    $primary_image = $tour['primary_image'] ?: 'assets/images/default-tour.svg';
                    $discount = $tour['discount_price'] ? round((($tour['price'] - $tour['discount_price']) / $tour['price']) * 100) : 0;
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-image">
                                <img src="<?php echo htmlspecialchars($primary_image); ?>" 
                                     alt="<?php echo htmlspecialchars($tour['title']); ?>">
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
                                    <a href="tour-details.php?id=<?php echo $tour['id']; ?>" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="tours.php" class="btn btn-outline">View All Tours</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title">Why Choose Adventure Tours?</h2>
            <p class="section-subtitle">We provide exceptional service and unforgettable experiences</p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">🌟</div>
                        <h3>Expert Guides</h3>
                        <p>Our experienced guides are passionate about sharing their knowledge and ensuring your safety throughout your journey.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">🛡️</div>
                        <h3>Safe & Secure</h3>
                        <p>Your safety is our priority. We maintain the highest safety standards and provide comprehensive insurance coverage.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">💎</div>
                        <h3>Premium Experience</h3>
                        <p>We carefully select accommodations, restaurants, and activities to ensure you have the best possible experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="section">
        <div class="container">
            <h2 class="section-title">Photo Gallery</h2>
            <p class="section-subtitle">Get a glimpse of the amazing experiences waiting for you</p>
            
            <div class="gallery">
                <div class="gallery-item">
                    <img src="assets/images/gallery-1.svg" alt="Mountain Adventure" loading="lazy">
                    <div class="gallery-overlay">
                        <h4>Mountain Adventures</h4>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/gallery-2.svg" alt="Beach Paradise" loading="lazy">
                    <div class="gallery-overlay">
                        <h4>Beach Paradise</h4>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/gallery-3.svg" alt="Desert Safari" loading="lazy">
                    <div class="gallery-overlay">
                        <h4>Desert Safari</h4>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/gallery-4.svg" alt="City Tours" loading="lazy">
                    <div class="gallery-overlay">
                        <h4>City Tours</h4>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/gallery-5.svg" alt="Cultural Experiences" loading="lazy">
                    <div class="gallery-overlay">
                        <h4>Cultural Experiences</h4>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/gallery-6.svg" alt="Wildlife Safari" loading="lazy">
                    <div class="gallery-overlay">
                        <h4>Wildlife Safari</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section id="reviews" class="section bg-light">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Read genuine reviews from our satisfied travelers</p>
            
            <div class="row">
                <?php
                // Get recent reviews from all tours
                $recent_reviews = $pdo->query("
                    SELECT r.*, t.title as tour_title 
                    FROM reviews r 
                    JOIN tours t ON r.tour_id = t.id 
                    WHERE r.status = 'approved' 
                    ORDER BY r.created_at DESC 
                    LIMIT 6
                ")->fetchAll();
                
                foreach ($recent_reviews as $review):
                ?>
                    <div class="col-md-6">
                        <div class="review">
                            <div class="review-header">
                                <div class="review-info">
                                    <h4 class="review-author"><?php echo htmlspecialchars($review['customer_name']); ?></h4>
                                    <p class="review-tour"><?php echo htmlspecialchars($review['tour_title']); ?></p>
                                </div>
                                <div class="review-rating">
                                    <div data-rating="<?php echo $review['rating']; ?>"></div>
                                    <span class="review-date"><?php echo date('M j, Y', strtotime($review['created_at'])); ?></span>
                                </div>
                            </div>
                            <p class="review-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2 class="section-title">Get in Touch</h2>
            <p class="section-subtitle">Have questions? We'd love to hear from you</p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form">
                        <form id="contact-form" action="contact.php" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="message">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <h3>Contact Information</h3>
                        <div class="contact-item">
                            <strong>📍 Address:</strong>
                            <p>123 Adventure Street<br>Travel City, TC 12345</p>
                        </div>
                        <div class="contact-item">
                            <strong>📞 Phone:</strong>
                            <p>+1 (555) 123-4567</p>
                        </div>
                        <div class="contact-item">
                            <strong>✉️ Email:</strong>
                            <p><?php echo ADMIN_EMAIL; ?></p>
                        </div>
                        <div class="contact-item">
                            <strong>🕒 Hours:</strong>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php echo SITE_NAME; ?></h3>
                    <p>We create unforgettable travel experiences with our carefully curated tour packages. Explore the world with confidence and comfort.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#tours">Tours</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#reviews">Reviews</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Tour Categories</h3>
                    <ul>
                        <li><a href="tours.php?category=adventure">Adventure Tours</a></li>
                        <li><a href="tours.php?category=cultural">Cultural Tours</a></li>
                        <li><a href="tours.php?category=beach">Beach Holidays</a></li>
                        <li><a href="tours.php?category=city">City Breaks</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved. | Designed for adventure seekers worldwide.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>