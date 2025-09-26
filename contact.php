<?php
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#contact');
    exit;
}

// Validate required fields
$required_fields = ['name', 'email', 'message'];
$errors = [];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = ucfirst($field) . ' is required';
    }
}

// Email validation
if (!empty($_POST['email']) && !isValidEmail($_POST['email'])) {
    $errors[] = 'Please enter a valid email address';
}

if (!empty($errors)) {
    $_SESSION['error'] = implode(', ', $errors);
    header('Location: index.php#contact');
    exit;
}

// Prepare contact data
$contact_data = [
    'name' => sanitizeInput($_POST['name']),
    'email' => sanitizeInput($_POST['email']),
    'subject' => sanitizeInput($_POST['subject'] ?? 'General Inquiry'),
    'message' => sanitizeInput($_POST['message'])
];

try {
    // Save message to database
    if (saveContactMessage($contact_data)) {
        // Send email to admin
        $admin_subject = "New Contact Message from " . $contact_data['name'];
        $admin_message = "
        <h2>New Contact Message</h2>
        <p><strong>Name:</strong> " . htmlspecialchars($contact_data['name']) . "</p>
        <p><strong>Email:</strong> " . htmlspecialchars($contact_data['email']) . "</p>
        <p><strong>Subject:</strong> " . htmlspecialchars($contact_data['subject']) . "</p>
        <p><strong>Message:</strong></p>
        <p>" . nl2br(htmlspecialchars($contact_data['message'])) . "</p>
        ";
        
        sendEmail(ADMIN_EMAIL, $admin_subject, $admin_message, $contact_data['email']);
        
        // Send confirmation to customer
        $customer_subject = "Thank you for contacting " . SITE_NAME;
        $customer_message = "
        <h2>Thank you for your message!</h2>
        <p>Dear " . htmlspecialchars($contact_data['name']) . ",</p>
        <p>We have received your message and will get back to you as soon as possible.</p>
        <p><strong>Your message:</strong></p>
        <p>" . nl2br(htmlspecialchars($contact_data['message'])) . "</p>
        <p>Best regards,<br>The " . SITE_NAME . " Team</p>
        ";
        
        sendEmail($contact_data['email'], $customer_subject, $customer_message);
        
        $_SESSION['success'] = 'Thank you for your message! We will get back to you soon.';
    } else {
        $_SESSION['error'] = 'Sorry, there was an error sending your message. Please try again.';
    }
} catch (Exception $e) {
    error_log('Contact form error: ' . $e->getMessage());
    $_SESSION['error'] = 'Sorry, there was an error sending your message. Please try again.';
}

header('Location: index.php#contact');
exit;
?>