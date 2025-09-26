<?php
require_once 'config.php';

// Tour functions
function getAllTours($limit = null, $featured_only = false) {
    global $pdo;
    
    $sql = "SELECT t.*, 
            (SELECT image_path FROM tour_images WHERE tour_id = t.id AND is_primary = 1 LIMIT 1) as primary_image,
            (SELECT AVG(rating) FROM reviews WHERE tour_id = t.id AND status = 'approved') as avg_rating,
            (SELECT COUNT(*) FROM reviews WHERE tour_id = t.id AND status = 'approved') as review_count
            FROM tours t 
            WHERE t.status = 'active'";
    
    if ($featured_only) {
        $sql .= " AND t.featured = 1";
    }
    
    $sql .= " ORDER BY t.created_at DESC";
    
    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    
    $stmt = $pdo->prepare($sql);
    if ($limit) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTourById($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT t.*, 
                          (SELECT AVG(rating) FROM reviews WHERE tour_id = t.id AND status = 'approved') as avg_rating,
                          (SELECT COUNT(*) FROM reviews WHERE tour_id = t.id AND status = 'approved') as review_count
                          FROM tours t WHERE t.id = :id AND t.status = 'active'");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function getTourImages($tour_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM tour_images WHERE tour_id = :tour_id ORDER BY is_primary DESC, id ASC");
    $stmt->bindParam(':tour_id', $tour_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTourReviews($tour_id, $limit = null) {
    global $pdo;
    
    $sql = "SELECT * FROM reviews WHERE tour_id = :tour_id AND status = 'approved' ORDER BY created_at DESC";
    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tour_id', $tour_id);
    if ($limit) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll();
}

// Booking functions
function createBooking($data) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO bookings (tour_id, customer_name, customer_email, customer_phone, 
                          num_people, booking_date, total_amount, special_requests) 
                          VALUES (:tour_id, :customer_name, :customer_email, :customer_phone, 
                          :num_people, :booking_date, :total_amount, :special_requests)");
    
    $stmt->bindParam(':tour_id', $data['tour_id']);
    $stmt->bindParam(':customer_name', $data['customer_name']);
    $stmt->bindParam(':customer_email', $data['customer_email']);
    $stmt->bindParam(':customer_phone', $data['customer_phone']);
    $stmt->bindParam(':num_people', $data['num_people']);
    $stmt->bindParam(':booking_date', $data['booking_date']);
    $stmt->bindParam(':total_amount', $data['total_amount']);
    $stmt->bindParam(':special_requests', $data['special_requests']);
    
    if ($stmt->execute()) {
        return $pdo->lastInsertId();
    }
    return false;
}

function updateBookingPayment($booking_id, $payment_status, $payment_method, $payment_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("UPDATE bookings SET payment_status = :payment_status, 
                          payment_method = :payment_method, payment_id = :payment_id,
                          status = CASE WHEN :payment_status = 'paid' THEN 'confirmed' ELSE status END
                          WHERE id = :booking_id");
    
    $stmt->bindParam(':booking_id', $booking_id);
    $stmt->bindParam(':payment_status', $payment_status);
    $stmt->bindParam(':payment_method', $payment_method);
    $stmt->bindParam(':payment_id', $payment_id);
    
    return $stmt->execute();
}

function getBookingById($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT b.*, t.title as tour_title FROM bookings b 
                          JOIN tours t ON b.tour_id = t.id WHERE b.id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

// Review functions
function addReview($data) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO reviews (tour_id, booking_id, customer_name, customer_email, 
                          rating, review_text) VALUES (:tour_id, :booking_id, :customer_name, 
                          :customer_email, :rating, :review_text)");
    
    $stmt->bindParam(':tour_id', $data['tour_id']);
    $stmt->bindParam(':booking_id', $data['booking_id']);
    $stmt->bindParam(':customer_name', $data['customer_name']);
    $stmt->bindParam(':customer_email', $data['customer_email']);
    $stmt->bindParam(':rating', $data['rating']);
    $stmt->bindParam(':review_text', $data['review_text']);
    
    return $stmt->execute();
}

// Contact form
function saveContactMessage($data) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) 
                          VALUES (:name, :email, :subject, :message)");
    
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':subject', $data['subject']);
    $stmt->bindParam(':message', $data['message']);
    
    return $stmt->execute();
}

// Utility functions
function formatPrice($price) {
    return '$' . number_format($price, 2);
}

function formatRating($rating) {
    return number_format($rating, 1);
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sendEmail($to, $subject, $message, $from = null) {
    if (!$from) {
        $from = ADMIN_EMAIL;
    }
    
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($to, $subject, $message, $headers);
}

// Admin functions
function authenticateAdmin($username, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>