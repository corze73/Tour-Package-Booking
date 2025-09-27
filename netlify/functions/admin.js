const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const { Client } = require('pg');

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
  const headers = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Headers': 'Content-Type, Authorization',
    'Access-Control-Allow-Methods': 'GET, POST, OPTIONS',
    'Content-Type': 'application/json'
  };

  if (event.httpMethod === 'OPTIONS') {
    return { statusCode: 200, headers, body: '' };
  }

  try {
    const client = await getDbClient();

    if (event.httpMethod === 'POST' && event.path.includes('/login')) {
      // Admin login
      const { username, password } = JSON.parse(event.body);
      
      const query = 'SELECT * FROM admin_users WHERE username = $1';
      const result = await client.query(query, [username]);
      
      if (result.rows.length === 0) {
        await client.end();
        return {
          statusCode: 401,
          headers,
          body: JSON.stringify({ error: 'Invalid credentials' })
        };
      }
      
      const user = result.rows[0];
      const validPassword = await bcrypt.compare(password, user.password);
      
      if (!validPassword) {
        await client.end();
        return {
          statusCode: 401,
          headers,
          body: JSON.stringify({ error: 'Invalid credentials' })
        };
      }
      
      const token = jwt.sign(
        { id: user.id, username: user.username, role: user.role },
        process.env.JWT_SECRET || 'demo-secret-key',
        { expiresIn: '24h' }
      );
      
      await client.end();
      
      return {
        statusCode: 200,
        headers,
        body: JSON.stringify({ 
          success: true, 
          token,
          user: {
            id: user.id,
            username: user.username,
            role: user.role
          }
        })
      };
    }

    if (event.httpMethod === 'GET' && event.path.includes('/dashboard')) {
      // Get dashboard stats
      const [toursResult, bookingsResult, messagesResult] = await Promise.all([
        client.query('SELECT COUNT(*) as count FROM tours WHERE status = $1', ['active']),
        client.query('SELECT COUNT(*) as count FROM bookings'),
        client.query('SELECT COUNT(*) as count FROM contact_messages WHERE status = $1', ['new'])
      ]);
      
      await client.end();
      
      return {
        statusCode: 200,
        headers,
        body: JSON.stringify({
          tours: parseInt(toursResult.rows[0].count),
          bookings: parseInt(bookingsResult.rows[0].count),
          messages: parseInt(messagesResult.rows[0].count)
        })
      };
    }
    
  } catch (error) {
    console.error('Admin API error:', error);
    return {
      statusCode: 500,
      headers,
      body: JSON.stringify({ 
        error: 'Server error', 
        message: error.message 
      })
    };
  }
  
  return {
    statusCode: 404,
    headers,
    body: JSON.stringify({ error: 'Endpoint not found' })
  };
};