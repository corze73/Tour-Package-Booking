const { Client } = require('pg');

// Database connection
const getDbClient = async () => {
  const client = new Client({
    connectionString: process.env.DATABASE_URL,
    ssl: {
      rejectUnauthorized: false
    }
  });
  await client.connect();
  return client;
};

exports.handler = async (event, context) => {
  // Enable CORS
  const headers = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Headers': 'Content-Type',
    'Access-Control-Allow-Methods': 'GET, POST, OPTIONS',
    'Content-Type': 'application/json'
  };

  if (event.httpMethod === 'OPTIONS') {
    return { statusCode: 200, headers, body: '' };
  }

  try {
    const client = await getDbClient();
    
    if (event.httpMethod === 'GET') {
      // Get all tours or featured tours
      const featured = event.queryStringParameters?.featured === 'true';
      const limit = event.queryStringParameters?.limit || null;
      
      let query = `
        SELECT t.*, 
               COALESCE(AVG(r.rating), 0) as avg_rating,
               COUNT(r.id) as review_count
        FROM tours t 
        LEFT JOIN reviews r ON t.id = r.tour_id AND r.status = 'approved'
        WHERE t.status = 'active'
      `;
      
      if (featured) {
        query += ' AND t.featured = true';
      }
      
      query += ' GROUP BY t.id ORDER BY t.created_at DESC';
      
      if (limit) {
        query += ` LIMIT ${parseInt(limit)}`;
      }
      
      const result = await client.query(query);
      await client.end();
      
      return {
        statusCode: 200,
        headers,
        body: JSON.stringify(result.rows)
      };
    }
    
    if (event.httpMethod === 'POST') {
      // Create booking
      const booking = JSON.parse(event.body);
      
      const query = `
        INSERT INTO bookings (tour_id, customer_name, customer_email, customer_phone, 
                             num_people, booking_date, total_amount, special_requests)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8)
        RETURNING id
      `;
      
      const values = [
        booking.tour_id,
        booking.customer_name,
        booking.customer_email,
        booking.customer_phone,
        booking.num_people,
        booking.booking_date,
        booking.total_amount,
        booking.special_requests
      ];
      
      const result = await client.query(query, values);
      await client.end();
      
      return {
        statusCode: 201,
        headers,
        body: JSON.stringify({ 
          success: true, 
          booking_id: result.rows[0].id,
          message: 'Booking created successfully'
        })
      };
    }
    
  } catch (error) {
    console.error('Database error:', error);
    return {
      statusCode: 500,
      headers,
      body: JSON.stringify({ 
        error: 'Database error', 
        message: error.message 
      })
    };
  }
  
  return {
    statusCode: 405,
    headers,
    body: JSON.stringify({ error: 'Method not allowed' })
  };
};