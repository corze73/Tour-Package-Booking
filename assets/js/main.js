// Tour Package Booking Website - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const nav = document.querySelector('.nav');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.header') && nav && nav.classList.contains('active')) {
            nav.classList.remove('active');
        }
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
    
    // Gallery modal
    initGalleryModal();
    
    // Booking form functionality
    initBookingForm();
    
    // Review form
    initReviewForm();
    
    // Price calculator
    initPriceCalculator();
    
    // Auto-hide alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);
});

// Form validation
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            showFieldError(field, 'This field is required');
            isValid = false;
        } else {
            clearFieldError(field);
            
            // Email validation
            if (field.type === 'email' && !isValidEmail(field.value)) {
                showFieldError(field, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Phone validation
            if (field.type === 'tel' && !isValidPhone(field.value)) {
                showFieldError(field, 'Please enter a valid phone number');
                isValid = false;
            }
            
            // Date validation
            if (field.type === 'date' && new Date(field.value) < new Date()) {
                showFieldError(field, 'Please select a future date');
                isValid = false;
            }
        }
    });
    
    return isValid;
}

function showFieldError(field, message) {
    clearFieldError(field);
    field.style.borderColor = '#dc3545';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
    field.style.borderColor = '#e9ecef';
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
}

// Gallery modal functionality
function initGalleryModal() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    if (galleryItems.length === 0) return;
    
    // Create modal
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
        <div class="modal-content" style="max-width: 90%; max-height: 90%;">
            <button class="modal-close">&times;</button>
            <img src="" alt="" style="width: 100%; height: auto; border-radius: 10px;">
        </div>
    `;
    
    document.body.appendChild(modal);
    
    const modalImg = modal.querySelector('img');
    const closeBtn = modal.querySelector('.modal-close');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            modalImg.src = img.src;
            modalImg.alt = img.alt;
            modal.classList.add('active');
        });
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

// Booking form functionality
function initBookingForm() {
    const bookingForm = document.getElementById('booking-form');
    if (!bookingForm) return;
    
    const dateInput = bookingForm.querySelector('input[name="booking_date"]');
    const peopleInput = bookingForm.querySelector('input[name="num_people"]');
    const totalElement = document.querySelector('.total-amount');
    
    // Set minimum date to today
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
    
    // Real-time price calculation
    if (peopleInput && totalElement) {
        const basePrice = parseFloat(totalElement.dataset.basePrice) || 0;
        
        peopleInput.addEventListener('input', function() {
            const numPeople = parseInt(this.value) || 1;
            const total = basePrice * numPeople;
            totalElement.textContent = formatPrice(total);
        });
    }
    
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm(this)) return;
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Processing...';
        submitBtn.disabled = true;
        
        // Submit form via AJAX
        const formData = new FormData(this);
        
        fetch('process_booking.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Booking submitted successfully! You will receive a confirmation email shortly.', 'success');
                this.reset();
                if (data.redirect) {
                    setTimeout(() => window.location.href = data.redirect, 2000);
                }
            } else {
                showAlert(data.message || 'An error occurred. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred. Please try again.', 'error');
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });
}

// Review form functionality
function initReviewForm() {
    const reviewForm = document.getElementById('review-form');
    if (!reviewForm) return;
    
    const stars = reviewForm.querySelectorAll('.star-rating .star');
    const ratingInput = reviewForm.querySelector('input[name="rating"]');
    
    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = index + 1;
            ratingInput.value = rating;
            
            stars.forEach((s, i) => {
                s.classList.toggle('active', i < rating);
            });
        });
        
        star.addEventListener('mouseenter', function() {
            const hoverRating = index + 1;
            stars.forEach((s, i) => {
                s.classList.toggle('hover', i < hoverRating);
            });
        });
    });
    
    reviewForm.addEventListener('mouseleave', function() {
        stars.forEach(s => s.classList.remove('hover'));
    });
    
    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!ratingInput.value) {
            showAlert('Please select a rating', 'error');
            return;
        }
        
        if (!validateForm(this)) return;
        
        const formData = new FormData(this);
        
        fetch('submit_review.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Thank you for your review! It will be published after moderation.', 'success');
                this.reset();
                stars.forEach(s => s.classList.remove('active'));
                ratingInput.value = '';
            } else {
                showAlert(data.message || 'An error occurred. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred. Please try again.', 'error');
        });
    });
}

// Price calculator
function initPriceCalculator() {
    const calculators = document.querySelectorAll('.price-calculator');
    
    calculators.forEach(calculator => {
        const peopleInput = calculator.querySelector('.people-input');
        const totalElement = calculator.querySelector('.total-price');
        const basePrice = parseFloat(calculator.dataset.basePrice) || 0;
        
        if (peopleInput && totalElement) {
            peopleInput.addEventListener('input', function() {
                const numPeople = parseInt(this.value) || 1;
                const total = basePrice * numPeople;
                totalElement.textContent = formatPrice(total);
            });
        }
    });
}

// Utility functions
function formatPrice(price) {
    return '$' + price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    
    // Insert at top of page
    const container = document.querySelector('.container') || document.body;
    container.insertBefore(alertDiv, container.firstChild);
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        alertDiv.style.opacity = '0';
        alertDiv.style.transform = 'translateY(-20px)';
        alertDiv.style.transition = 'opacity 0.3s, transform 0.3s';
        setTimeout(() => alertDiv.remove(), 300);
    }, 5000);
}

// Star rating functionality
function createStarRating(rating, maxStars = 5) {
    let starsHtml = '';
    for (let i = 1; i <= maxStars; i++) {
        const starClass = i <= rating ? 'star' : 'star empty';
        starsHtml += `<span class="${starClass}">★</span>`;
    }
    return starsHtml;
}

// Initialize star ratings on page load
document.addEventListener('DOMContentLoaded', function() {
    const ratingElements = document.querySelectorAll('[data-rating]');
    ratingElements.forEach(element => {
        const rating = parseFloat(element.dataset.rating);
        element.innerHTML = createStarRating(rating);
    });
});

// Image lazy loading
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize lazy loading if supported
if ('IntersectionObserver' in window) {
    document.addEventListener('DOMContentLoaded', initLazyLoading);
}

// Scroll to top functionality
function addScrollToTop() {
    const scrollBtn = document.createElement('button');
    scrollBtn.innerHTML = '↑';
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #667eea;
        color: white;
        border: none;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 1000;
    `;
    
    document.body.appendChild(scrollBtn);
    
    window.addEventListener('scroll', () => {
        scrollBtn.style.opacity = window.pageYOffset > 500 ? '1' : '0';
    });
    
    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Initialize scroll to top
document.addEventListener('DOMContentLoaded', addScrollToTop);