# Tour Package Booking Website

A complete tour package booking system built with PHP, MySQL, HTML, CSS, and JavaScript. This system allows travelers to browse tour packages, make bookings, and leave reviews, while providing administrators with a comprehensive dashboard to manage tours, bookings, and customer interactions.


## Features


### Frontend Features

- **Responsive Design**: Mobile-first approach with beautiful, modern UI

- **Tour Browsing**: Filter tours by difficulty, price range, location, and more

- **Detailed Tour Pages**: Rich photo galleries, itineraries, and customer reviews

- **Real-time Booking**: Instant booking with price calculations

- **Customer Reviews**: Verified review system with star ratings

- **Contact Form**: Direct communication with tour operators

- **Photo Gallery**: High-resolution image galleries for each tour

- **Search Functionality**: Advanced search and filtering options


### Backend Features

- **Admin Dashboard**: Comprehensive statistics and quick access to key functions

- **Tour Management**: Create, edit, and manage tour packages with multiple images

- **Booking Management**: Track bookings, payments, and customer details

- **Review Moderation**: Approve or reject customer reviews

- **Email Notifications**: Automatic confirmation emails for bookings and inquiries

- **Payment Integration**: Ready for PayPal and other payment gateways

- **User Management**: Secure admin authentication system


## Technical Specifications


- **Backend**: PHP 7.4+ with PDO for database interactions

- **Database**: MySQL 5.7+ with optimized schema

- **Frontend**: Pure CSS3 with CSS Grid and Flexbox for responsive layouts

- **JavaScript**: Vanilla JavaScript with ES6+ features

- **Security**: SQL injection prevention, XSS protection, and CSRF tokens

- **SEO Optimized**: Semantic HTML, meta tags, and structured data

- **Performance**: Optimized images, lazy loading, and efficient queries


## Installation


### Prerequisites

- PHP 7.4 or higher

- MySQL 5.7 or higher

- Web server (Apache/Nginx)

- mod_rewrite enabled (for clean URLs)


### Step 1: Download and Setup

1. Clone or download the project files

2. Place files in your web server directory

3. Create a MySQL database for the project


### Step 2: Configuration

1. Edit `includes/config.php` with your database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'tour_booking');
```


2. Update site settings:
```php
define('SITE_NAME', 'Your Tour Company');
define('ADMIN_EMAIL', 'admin@yoursite.com');
```


### Step 3: Database Setup

1. Run the setup script by visiting `http://yoursite.com/setup.php`

2. The script will automatically create tables and insert sample data

3. Remove or secure the setup.php file after installation


### Step 4: File Permissions
Set appropriate permissions for upload directories:
```bash
chmod 755 uploads/
chmod 755 uploads/tours/
chmod 755 assets/images/
```


## Default Admin Credentials

**Username**: `admin`
**Password**: `admin123`

⚠️ **Important**: Change these credentials immediately after first login!


## Directory Structure

```
Tour Package Booking/
├── admin/                  # Admin panel files
│   ├── dashboard.php      # Main admin dashboard
│   ├── login.php          # Admin login page
│   └── logout.php         # Logout functionality
├── assets/                 # Static assets
│   ├── css/
│   │   └── style.css      # Main stylesheet
│   ├── js/
│   │   └── main.js        # JavaScript functionality
│   └── images/            # Site images
├── database/
│   └── schema.sql         # Database schema and sample data
├── includes/
│   ├── config.php         # Configuration settings
│   └── functions.php      # PHP functions and utilities
├── uploads/
│   └── tours/             # Tour image uploads
├── index.php              # Homepage
├── tours.php              # All tours listing
├── tour-details.php       # Individual tour details
├── process_booking.php    # Booking form handler
├── contact.php            # Contact form handler
└── setup.php              # Installation script
```


## Usage Guide


### For Administrators


1. **Login**: Visit `/admin/login.php` and use admin credentials

2. **Dashboard**: Overview of bookings, tours, and revenue

3. **Tour Management**: Add new tours with images and detailed descriptions

4. **Booking Management**: Review and manage customer bookings

5. **Review Moderation**: Approve or reject customer reviews


### For Customers


1. **Browse Tours**: Filter by price, difficulty, location, and dates

2. **View Details**: Rich tour pages with galleries and reviews

3. **Make Bookings**: Real-time booking with instant confirmation

4. **Leave Reviews**: Share experiences with star ratings

5. **Contact Support**: Direct communication through contact forms


## Customization


### Styling

- Edit `assets/css/style.css` for visual customizations

- Responsive breakpoints are defined for mobile, tablet, and desktop

- CSS variables are used for easy color scheme changes


### Functionality

- Add new fields to the database by modifying `database/schema.sql`

- Extend PHP functions in `includes/functions.php`

- Customize email templates in `process_booking.php`


### Payment Integration
The system includes placeholder code for PayPal integration:

1. Configure PayPal credentials in `config.php`

2. Implement payment processing in `process_booking.php`

3. Add payment confirmation webhooks


## Security Features


- **SQL Injection Protection**: All queries use prepared statements

- **XSS Prevention**: Input sanitization and output escaping

- **Authentication**: Secure admin login with password hashing

- **File Upload Security**: Restricted file types and validation

- **Session Management**: Secure session handling


## SEO Optimization


- Semantic HTML structure

- Meta descriptions and title tags

- Open Graph tags for social sharing

- Schema.org structured data

- Clean, descriptive URLs

- Optimized images with alt tags


## Browser Compatibility


- Chrome 70+

- Firefox 65+

- Safari 12+

- Edge 79+

- Mobile browsers (iOS Safari, Chrome Mobile)


## Performance Features


- **Image Optimization**: Lazy loading and responsive images

- **CSS Optimization**: Minified stylesheets and efficient selectors

- **JavaScript Optimization**: Vanilla JS with minimal dependencies

- **Database Optimization**: Indexed queries and efficient schema

- **Caching**: Browser caching headers and optimized assets


## Troubleshooting


### Common Issues


1. **Database Connection Error**
   - Check database credentials in `config.php`
   - Ensure MySQL service is running
   - Verify database permissions


2. **Image Upload Issues**
   - Check file permissions on upload directories
   - Verify upload_max_filesize in php.ini
   - Ensure proper folder structure exists


3. **Email Not Sending**
   - Configure SMTP settings
   - Check server mail configuration
   - Verify email addresses are valid


### Error Logs

- Check PHP error logs for debugging

- Enable error reporting during development

- Monitor server logs for performance issues


## Support

For technical support or customization requests:

- Review the documentation thoroughly

- Check the troubleshooting section

- Examine the code comments for guidance


## License

This project is created for educational and demonstration purposes. Please ensure compliance with local laws and regulations when using for commercial purposes.


## Changelog


### Version 1.0.0

- Initial release with complete booking system

- Admin dashboard and management features

- Responsive design and mobile optimization

- Email integration and notifications

- Review system and photo galleries

- Advanced search and filtering

---
