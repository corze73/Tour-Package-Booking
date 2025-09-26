-- Tour Package Booking Database Schema

CREATE DATABASE IF NOT EXISTS tour_booking;
USE tour_booking;

-- Tours table
CREATE TABLE tours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    short_description VARCHAR(500),
    duration VARCHAR(100),
    location VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    discount_price DECIMAL(10,2) DEFAULT NULL,
    max_people INT DEFAULT 20,
    difficulty_level ENUM('Easy', 'Moderate', 'Challenging', 'Expert') DEFAULT 'Easy',
    includes TEXT,
    excludes TEXT,
    itinerary TEXT,
    featured BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tour images table
CREATE TABLE tour_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tour_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    alt_text VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bookings table
CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tour_id INT NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20),
    num_people INT NOT NULL,
    booking_date DATE NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    payment_method VARCHAR(50),
    payment_id VARCHAR(255),
    special_requests TEXT,
    status ENUM('confirmed', 'pending', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id)
);

-- Reviews table
CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tour_id INT NOT NULL,
    booking_id INT,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id),
    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);

-- Admin users table
CREATE TABLE admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager') DEFAULT 'manager',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact messages table
CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO tours (title, description, short_description, duration, location, price, discount_price, max_people, difficulty_level, includes, excludes, itinerary, featured) VALUES
('Himalayan Adventure Trek', 'Experience the breathtaking beauty of the Himalayas with our guided trek through pristine mountain trails. This adventure offers stunning views, cultural immersion, and unforgettable memories.', 'Guided trek through pristine Himalayan trails with stunning mountain views', '7 Days / 6 Nights', 'Nepal, Himalayas', 1299.00, 999.00, 12, 'Challenging', 'Professional guide, Accommodation, Meals, Transportation, Permits', 'International flights, Personal expenses, Tips', 'Day 1: Arrival in Kathmandu\nDay 2-3: Trek to base camp\nDay 4-5: Summit attempt\nDay 6: Descent\nDay 7: Return to Kathmandu', TRUE),

('Tropical Island Paradise', 'Discover pristine beaches, crystal-clear waters, and vibrant marine life in this tropical getaway. Perfect for relaxation and water activities.', 'Relaxing beach vacation with water activities and pristine beaches', '5 Days / 4 Nights', 'Maldives', 2500.00, 1999.00, 20, 'Easy', 'Resort accommodation, All meals, Snorkeling equipment, Airport transfers', 'International flights, Spa services, Alcoholic beverages', 'Day 1: Arrival and beach relaxation\nDay 2: Snorkeling and diving\nDay 3: Island hopping\nDay 4: Water sports\nDay 5: Departure', TRUE),

('Desert Safari Experience', 'Embark on an thrilling desert adventure with camel rides, dune bashing, and traditional Bedouin experiences under the starlit sky.', 'Thrilling desert adventure with camel rides and traditional experiences', '3 Days / 2 Nights', 'Dubai, UAE', 899.00, NULL, 15, 'Moderate', 'Desert camp accommodation, All meals, Camel rides, 4WD transportation', 'International flights, Personal expenses, Souvenirs', 'Day 1: Arrival and dune bashing\nDay 2: Camel trek and desert camp\nDay 3: Traditional breakfast and departure', FALSE),

('European City Explorer', 'Explore the rich history, stunning architecture, and vibrant culture of Europe''s most beautiful cities in this comprehensive tour.', 'Multi-city European tour covering history, architecture, and culture', '10 Days / 9 Nights', 'Paris, Rome, Barcelona', 3299.00, 2799.00, 25, 'Easy', 'Hotel accommodation, Breakfast, Guided tours, Inter-city transportation', 'Lunch and dinner, International flights, Personal expenses', 'Day 1-3: Paris exploration\nDay 4-6: Rome historical sites\nDay 7-9: Barcelona culture\nDay 10: Departure', TRUE);

-- Insert sample admin user (password: admin123)
INSERT INTO admin_users (username, email, password, role) VALUES
('admin', 'admin@adventuretours.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample reviews
INSERT INTO reviews (tour_id, customer_name, customer_email, rating, review_text, status) VALUES
(1, 'John Smith', 'john@email.com', 5, 'Amazing experience! The guide was knowledgeable and the views were breathtaking. Highly recommended!', 'approved'),
(1, 'Sarah Johnson', 'sarah@email.com', 4, 'Great trek but quite challenging. Make sure you''re physically prepared. The accommodation was comfortable.', 'approved'),
(2, 'Mike Wilson', 'mike@email.com', 5, 'Perfect honeymoon destination! The resort was beautiful and the staff was incredibly friendly.', 'approved'),
(3, 'Emma Davis', 'emma@email.com', 4, 'Loved the desert experience! The camel ride was fun and the camp was authentic.', 'approved');