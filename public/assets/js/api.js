// API client for Netlify Functions
class TourAPI {
    constructor() {
        this.baseURL = '/.netlify/functions';
    }

    async request(endpoint, options = {}) {
        const url = `${this.baseURL}${endpoint}`;
        const config = {
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            },
            ...options
        };

        try {
            const response = await fetch(url, config);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('API request failed:', error);
            throw error;
        }
    }

    // Get all tours
    async getTours(options = {}) {
        const params = new URLSearchParams();
        if (options.featured) params.append('featured', 'true');
        if (options.limit) params.append('limit', options.limit);
        
        const query = params.toString() ? `?${params.toString()}` : '';
        return this.request(`/tours${query}`);
    }

    // Get featured tours
    async getFeaturedTours(limit = 6) {
        return this.getTours({ featured: true, limit });
    }

    // Get reviews
    async getReviews() {
        return this.request('/reviews');
    }

    // Submit contact form
    async submitContact(contactData) {
        return this.request('/contact', {
            method: 'POST',
            body: JSON.stringify(contactData)
        });
    }

    // Submit booking
    async submitBooking(bookingData) {
        return this.request('/tours', {
            method: 'POST',
            body: JSON.stringify(bookingData)
        });
    }

    // Admin login
    async adminLogin(credentials) {
        return this.request('/admin/login', {
            method: 'POST',
            body: JSON.stringify(credentials)
        });
    }

    // Get dashboard stats
    async getDashboardStats() {
        return this.request('/admin/dashboard');
    }
}

// Create global API instance
window.tourAPI = new TourAPI();

// DOM Content Loaded handler
document.addEventListener('DOMContentLoaded', async function() {
    // Load featured tours on homepage
    if (document.getElementById('featured-tours-grid')) {
        await loadFeaturedTours();
    }

    // Load reviews on homepage
    if (document.getElementById('reviews-grid')) {
        await loadReviews();
    }

    // Load all tours on tours page
    if (document.getElementById('tours-grid')) {
        await loadAllTours();
    }

    // Setup contact form
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        setupContactForm(contactForm);
    }

    // Setup booking forms
    const bookingForms = document.querySelectorAll('.booking-form');
    bookingForms.forEach(setupBookingForm);
});

// Load featured tours
async function loadFeaturedTours() {
    const grid = document.getElementById('featured-tours-grid');
    try {
        const tours = await window.tourAPI.getFeaturedTours(6);
        grid.innerHTML = tours.map(tour => createTourCard(tour)).join('');
    } catch (error) {
        console.error('Failed to load featured tours:', error);
        grid.innerHTML = '<div class="error">Failed to load tours. Please try again later.</div>';
    }
}

// Load all tours
async function loadAllTours() {
    const grid = document.getElementById('tours-grid');
    try {
        const tours = await window.tourAPI.getTours();
        grid.innerHTML = tours.map(tour => createTourCard(tour)).join('');
    } catch (error) {
        console.error('Failed to load tours:', error);
        grid.innerHTML = '<div class="error">Failed to load tours. Please try again later.</div>';
    }
}

// Load reviews
async function loadReviews() {
    const grid = document.getElementById('reviews-grid');
    try {
        const reviews = await window.tourAPI.getReviews();
        grid.innerHTML = reviews.map(review => createReviewCard(review)).join('');
    } catch (error) {
        console.error('Failed to load reviews:', error);
        grid.innerHTML = '<div class="error">Failed to load reviews. Please try again later.</div>';
    }
}

// Create tour card HTML
function createTourCard(tour) {
    const discountPrice = tour.discount_price ? `<span class="original-price">$${tour.price}</span> $${tour.discount_price}` : `$${tour.price}`;
    const rating = tour.avg_rating ? '★'.repeat(Math.round(tour.avg_rating)) + '☆'.repeat(5 - Math.round(tour.avg_rating)) : '☆☆☆☆☆';
    
    return `
        <div class="tour-card">
            <div class="tour-image">
                <img src="assets/images/default-tour.svg" alt="${tour.title}" loading="lazy">
                ${tour.featured ? '<span class="featured-badge">Featured</span>' : ''}
            </div>
            <div class="tour-content">
                <h3><a href="tour-details.html?id=${tour.id}">${tour.title}</a></h3>
                <p class="tour-description">${tour.short_description}</p>
                <div class="tour-details">
                    <span class="duration">📅 ${tour.duration}</span>
                    <span class="location">📍 ${tour.location}</span>
                    <span class="difficulty">⭐ ${tour.difficulty_level}</span>
                </div>
                <div class="tour-rating">
                    <span class="stars">${rating}</span>
                    <span class="review-count">(${tour.review_count || 0} reviews)</span>
                </div>
                <div class="tour-footer">
                    <div class="price">${discountPrice}</div>
                    <a href="tour-details.html?id=${tour.id}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    `;
}

// Create review card HTML
function createReviewCard(review) {
    const stars = '★'.repeat(review.rating) + '☆'.repeat(5 - review.rating);
    return `
        <div class="review-card">
            <div class="review-header">
                <h4>${review.customer_name}</h4>
                <div class="rating">${stars}</div>
            </div>
            <p class="review-text">${review.review_text}</p>
            <div class="review-tour">Tour: ${review.tour_title}</div>
        </div>
    `;
}

// Setup contact form
function setupContactForm(form) {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const contactData = {
            name: formData.get('name'),
            email: formData.get('email'),
            subject: formData.get('subject'),
            message: formData.get('message')
        };

        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.textContent = 'Sending...';
        submitButton.disabled = true;

        try {
            await window.tourAPI.submitContact(contactData);
            alert('Message sent successfully! We\'ll get back to you soon.');
            form.reset();
        } catch (error) {
            alert('Failed to send message. Please try again.');
            console.error('Contact form error:', error);
        } finally {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        }
    });
}

// Setup booking form
function setupBookingForm(form) {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const bookingData = {
            tour_id: formData.get('tour_id'),
            customer_name: formData.get('customer_name'),
            customer_email: formData.get('customer_email'),
            customer_phone: formData.get('customer_phone'),
            num_people: parseInt(formData.get('num_people')),
            booking_date: formData.get('booking_date'),
            total_amount: parseFloat(formData.get('total_amount')),
            special_requests: formData.get('special_requests')
        };

        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.textContent = 'Processing...';
        submitButton.disabled = true;

        try {
            const result = await window.tourAPI.submitBooking(bookingData);
            alert(`Booking confirmed! Your booking ID is: ${result.booking_id}`);
            form.reset();
        } catch (error) {
            alert('Failed to process booking. Please try again.');
            console.error('Booking form error:', error);
        } finally {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        }
    });
}