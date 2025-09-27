// Mock data for local development and demos
window.mockData = {
    tours: [
        {
            id: 1,
            title: "Himalayan Adventure Trek",
            description: "Experience the breathtaking beauty of the Himalayas with our guided trek through pristine mountain trails.",
            short_description: "7-day guided trek through stunning Himalayan landscapes",
            duration: "7 days",
            location: "Nepal Himalayas",
            price: 1299.00,
            discount_price: 999.00,
            max_people: 12,
            difficulty_level: "Challenging",
            rating: 4.8,
            total_reviews: 124,
            image_url: "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
            gallery: ["https://images.unsplash.com/photo-1506905925346-21bda4d32df4", "https://images.unsplash.com/photo-1544735716-392fe2489ffa", "https://images.unsplash.com/photo-1570641963303-92ce4845ed4c"],
            includes: "Professional guide, Accommodation, All meals, Equipment rental, Transportation",
            excludes: "International flights, Personal equipment, Travel insurance, Tips"
        },
        {
            id: 2,
            title: "African Safari Experience",
            description: "Witness the Big Five in their natural habitat during this unforgettable African safari adventure.",
            short_description: "5-day luxury safari with wildlife photography opportunities",
            duration: "5 days",
            location: "Kenya & Tanzania",
            price: 2199.00,
            discount_price: null,
            max_people: 8,
            difficulty_level: "Easy",
            rating: 4.9,
            total_reviews: 87,
            image_url: "https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
            gallery: ["https://images.unsplash.com/photo-1516426122078-c23e76319801", "https://images.unsplash.com/photo-1551632811-561732d1e306", "https://images.unsplash.com/photo-1547036967-23d11aacaee0"],
            includes: "Luxury accommodation, All meals, Game drives, Professional guide, Airport transfers",
            excludes: "International flights, Visa fees, Travel insurance, Personal expenses"
        },
        {
            id: 3,
            title: "Amazon Rainforest Expedition",
            description: "Explore the world's largest rainforest and discover incredible biodiversity in the heart of the Amazon.",
            short_description: "6-day eco-adventure in pristine Amazon rainforest",
            duration: "6 days",
            location: "Peru Amazon Basin",
            price: 1599.00,
            discount_price: 1299.00,
            max_people: 10,
            difficulty_level: "Moderate",
            rating: 4.7,
            total_reviews: 96,
            image_url: "https://images.unsplash.com/photo-1540979388789-6cee28a1cdc9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
            gallery: ["https://images.unsplash.com/photo-1540979388789-6cee28a1cdc9", "https://images.unsplash.com/photo-1520637836862-4d197d17c35a", "https://images.unsplash.com/photo-1441974231531-c6227db76b6e"],
            includes: "Eco-lodge accommodation, All meals, Guided excursions, Boat transfers, Equipment",
            excludes: "International flights, Vaccinations, Travel insurance, Alcoholic beverages"
        },
        {
            id: 4,
            title: "Northern Lights Adventure",
            description: "Chase the magical Aurora Borealis across the Arctic wilderness in this once-in-a-lifetime experience.",
            short_description: "4-day Arctic adventure with Northern Lights viewing",
            duration: "4 days",
            location: "Iceland & Norway",
            price: 1899.00,
            discount_price: null,
            max_people: 15,
            difficulty_level: "Easy",
            rating: 4.6,
            total_reviews: 73,
            image_url: "https://images.unsplash.com/photo-1531366936337-7c912a4589a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
            gallery: ["https://images.unsplash.com/photo-1531366936337-7c912a4589a7", "https://images.unsplash.com/photo-1520637836862-4d197d17c35a", "https://images.unsplash.com/photo-1544735716-392fe2489ffa"],
            includes: "Hotel accommodation, All meals, Northern Lights tours, Professional guide, Warm clothing",
            excludes: "International flights, Travel insurance, Personal expenses, Optional activities"
        },
        {
            id: 5,
            title: "Great Wall Discovery Tour",
            description: "Walk along the most iconic sections of the Great Wall while exploring ancient Chinese culture and history.",
            short_description: "5-day cultural tour with Great Wall hiking",
            duration: "5 days",
            location: "Beijing, China",
            price: 899.00,
            discount_price: 699.00,
            max_people: 20,
            difficulty_level: "Moderate",
            rating: 4.5,
            total_reviews: 156,
            image_url: "https://images.unsplash.com/photo-1508804185872-d7badad00f7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
            gallery: ["https://images.unsplash.com/photo-1508804185872-d7badad00f7d", "https://images.unsplash.com/photo-1570641963303-92ce4845ed4c", "https://images.unsplash.com/photo-1547036967-23d11aacaee0"],
            includes: "Hotel accommodation, All meals, Great Wall tours, Cultural sites, Professional guide",
            excludes: "International flights, Visa fees, Travel insurance, Personal shopping"
        },
        {
            id: 6,
            title: "Mediterranean Island Hopping",
            description: "Sail through crystal-clear waters and explore pristine islands in the beautiful Mediterranean Sea.",
            short_description: "8-day sailing adventure through Greek islands",
            duration: "8 days",
            location: "Greek Islands",
            price: 1799.00,
            discount_price: 1499.00,
            max_people: 12,
            difficulty_level: "Easy",
            rating: 4.8,
            total_reviews: 92,
            image_url: "https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
            gallery: ["https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff", "https://images.unsplash.com/photo-1544735716-392fe2489ffa", "https://images.unsplash.com/photo-1516426122078-c23e76319801"],
            includes: "Yacht accommodation, All meals, Island tours, Snorkeling equipment, Skipper",
            excludes: "International flights, Travel insurance, Port fees, Personal expenses"
        }
    ],
    
    reviews: [
        {
            id: 1,
            tour_id: 1,
            customer_name: "Sarah Johnson",
            rating: 5,
            comment: "Absolutely incredible experience! The guides were knowledgeable and the scenery was breathtaking. Would definitely book again!",
            date: "2024-08-15"
        },
        {
            id: 2,
            tour_id: 2,
            customer_name: "Michael Chen",
            rating: 5,
            comment: "Best safari experience ever! We saw all the Big Five and the accommodations were luxury. Highly recommended!",
            date: "2024-07-22"
        },
        {
            id: 3,
            tour_id: 3,
            customer_name: "Emma Thompson",
            rating: 4,
            comment: "Amazing biodiversity and professional guides. The Amazon is truly a wonder of the world. Great value for money.",
            date: "2024-06-10"
        },
        {
            id: 4,
            tour_id: 1,
            customer_name: "David Rodriguez",
            rating: 5,
            comment: "Life-changing trek through the Himalayas. Perfect organization and safety measures. The team was fantastic!",
            date: "2024-05-18"
        },
        {
            id: 5,
            tour_id: 4,
            customer_name: "Lisa Anderson",
            rating: 5,
            comment: "The Northern Lights were magical! Professional service and great accommodations. Exceeded all expectations.",
            date: "2024-03-12"
        },
        {
            id: 6,
            tour_id: 5,
            customer_name: "James Wilson",
            rating: 4,
            comment: "Great cultural experience walking the Great Wall. Our guide was very informative about Chinese history.",
            date: "2024-04-25"
        }
    ],
    
    stats: {
        total_tours: 6,
        total_bookings: 1247,
        satisfied_customers: 1189,
        average_rating: 4.7
    }
};

// Mock API functions for local development
window.mockAPI = {
    async getTours() {
        return { success: true, data: window.mockData.tours };
    },
    
    async getTour(id) {
        const tour = window.mockData.tours.find(t => t.id === parseInt(id));
        return tour ? { success: true, data: tour } : { success: false, error: 'Tour not found' };
    },
    
    async getReviews(tourId = null) {
        let reviews = window.mockData.reviews;
        if (tourId) {
            reviews = reviews.filter(r => r.tour_id === parseInt(tourId));
        }
        return { success: true, data: reviews };
    },
    
    async submitContact(data) {
        console.log('Mock contact submission:', data);
        return { success: true, message: 'Message sent successfully! (Demo mode)' };
    },
    
    async submitBooking(data) {
        console.log('Mock booking submission:', data);
        return { success: true, message: 'Booking submitted successfully! (Demo mode)', booking_id: 'DEMO-' + Date.now() };
    }
};