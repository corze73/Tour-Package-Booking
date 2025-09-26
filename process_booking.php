<?php
require_once 'includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Validate required fields
$required_fields = ['tour_id', 'customer_name', 'customer_email', 'booking_date', 'num_people'];
$errors = [];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
    }
}

// Additional validations
if (!empty($_POST['customer_email']) && !isValidEmail($_POST['customer_email'])) {
    $errors[] = 'Please enter a valid email address';
}

if (!empty($_POST['num_people']) && ($_POST['num_people'] < 1 || $_POST['num_people'] > 50)) {
    $errors[] = 'Number of people must be between 1 and 50';
}

if (!empty($_POST['booking_date']) && strtotime($_POST['booking_date']) < strtotime('today')) {
    $errors[] = 'Booking date must be in the future';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Get tour details
$tour = getTourById($_POST['tour_id']);
if (!$tour) {
    echo json_encode(['success' => false, 'message' => 'Tour not found']);
    exit;
}

// Calculate total amount
$price_per_person = $tour['discount_price'] ?: $tour['price'];
$total_amount = $price_per_person * (int)$_POST['num_people'];

// Prepare booking data
$booking_data = [
    'tour_id' => (int)$_POST['tour_id'],
    'customer_name' => sanitizeInput($_POST['customer_name']),
    'customer_email' => sanitizeInput($_POST['customer_email']),
    'customer_phone' => sanitizeInput($_POST['customer_phone'] ?? ''),
    'num_people' => (int)$_POST['num_people'],
    'booking_date' => $_POST['booking_date'],
    'total_amount' => $total_amount,
    'special_requests' => sanitizeInput($_POST['special_requests'] ?? '')
];

try {
    // Create booking
    $booking_id = createBooking($booking_data);
    
    if ($booking_id) {
        // Send confirmation email to customer
        $customer_email_subject = "Booking Confirmation - " . $tour['title'];
        $customer_email_body = generateBookingConfirmationEmail($booking_id, $tour, $booking_data);
        sendEmail($booking_data['customer_email'], $customer_email_subject, $customer_email_body);
        
        // Send notification email to admin
        $admin_email_subject = "New Booking Received - " . $tour['title'];
        $admin_email_body = generateAdminBookingNotification($booking_id, $tour, $booking_data);
        sendEmail(ADMIN_EMAIL, $admin_email_subject, $admin_email_body);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Booking submitted successfully! You will receive a confirmation email shortly.',
            'booking_id' => $booking_id,
            'redirect' => 'booking-confirmation.php?id=' . $booking_id
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create booking. Please try again.']);
    }
    
} catch (Exception $e) {
    error_log('Booking error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred while processing your booking. Please try again.']);
}

function generateBookingConfirmationEmail($booking_id, $tour, $booking_data) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; }
            .content { background: #f9f9f9; padding: 20px; }
            .booking-details { background: white; padding: 20px; border-radius: 5px; margin: 20px 0; }
            .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
            .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>' . SITE_NAME . '</h1>
                <h2>Booking Confirmation</h2>
            </div>
            
            <div class="content">
                <p>Dear ' . htmlspecialchars($booking_data['customer_name']) . ',</p>
                
                <p>Thank you for your booking! We have received your tour booking request and it is currently being processed.</p>
                
                <div class="booking-details">
                    <h3>Booking Details</h3>
                    <div class="detail-row">
                        <strong>Booking ID:</strong>
                        <span>#' . $booking_id . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Tour:</strong>
                        <span>' . htmlspecialchars($tour['title']) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Date:</strong>
                        <span>' . date('F j, Y', strtotime($booking_data['booking_date'])) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Number of People:</strong>
                        <span>' . $booking_data['num_people'] . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Total Amount:</strong>
                        <span>' . formatPrice($booking_data['total_amount']) . '</span>
                    </div>
                </div>
                
                <p><strong>What happens next?</strong></p>
                <ul>
                    <li>Our team will review your booking within 24 hours</li>
                    <li>You will receive a confirmation email with payment instructions</li>
                    <li>Once payment is received, your booking will be confirmed</li>
                    <li>We will send you detailed tour information and meeting point details</li>
                </ul>
                
                <p>If you have any questions, please don\'t hesitate to contact us at ' . ADMIN_EMAIL . ' or call us at +1 (555) 123-4567.</p>
                
                <p>We look forward to providing you with an amazing travel experience!</p>
                
                <p>Best regards,<br>The ' . SITE_NAME . ' Team</p>
            </div>
            
            <div class="footer">
                <p>&copy; ' . date('Y') . ' ' . SITE_NAME . '. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}

function generateAdminBookingNotification($booking_id, $tour, $booking_data) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #28a745; color: white; padding: 20px; text-align: center; }
            .content { background: #f9f9f9; padding: 20px; }
            .booking-details { background: white; padding: 20px; border-radius: 5px; margin: 20px 0; }
            .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>New Booking Received</h1>
            </div>
            
            <div class="content">
                <p>A new booking has been received and requires your attention.</p>
                
                <div class="booking-details">
                    <h3>Booking Information</h3>
                    <div class="detail-row">
                        <strong>Booking ID:</strong>
                        <span>#' . $booking_id . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Tour:</strong>
                        <span>' . htmlspecialchars($tour['title']) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Customer:</strong>
                        <span>' . htmlspecialchars($booking_data['customer_name']) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Email:</strong>
                        <span>' . htmlspecialchars($booking_data['customer_email']) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Phone:</strong>
                        <span>' . htmlspecialchars($booking_data['customer_phone']) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Date:</strong>
                        <span>' . date('F j, Y', strtotime($booking_data['booking_date'])) . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>People:</strong>
                        <span>' . $booking_data['num_people'] . '</span>
                    </div>
                    <div class="detail-row">
                        <strong>Total:</strong>
                        <span>' . formatPrice($booking_data['total_amount']) . '</span>
                    </div>
                    ' . ($booking_data['special_requests'] ? '
                    <div class="detail-row">
                        <strong>Special Requests:</strong>
                        <span>' . htmlspecialchars($booking_data['special_requests']) . '</span>
                    </div>
                    ' : '') . '
                </div>
                
                <p>Please review this booking in the admin panel and contact the customer to arrange payment and confirmation.</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}
?>