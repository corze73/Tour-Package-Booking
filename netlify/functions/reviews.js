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
    'Access-Control-Allow-Headers': 'Content-Type',
    'Access-Control-Allow-Methods': 'GET, OPTIONS',
    'Content-Type': 'application/json'
  };

  if (event.httpMethod === 'OPTIONS') {
    return { statusCode: 200, headers, body: '' };
  }

  if (event.httpMethod !== 'GET') {
    return {
      statusCode: 405,
      headers,
      body: JSON.stringify({ error: 'Method not allowed' })
    };
  }

  try {
    const client = await getDbClient();
    
    const query = `
      SELECT r.*, t.title as tour_title
      FROM reviews r
      JOIN tours t ON r.tour_id = t.id
      WHERE r.status = 'approved'
      ORDER BY r.created_at DESC
      LIMIT 10
    `;
    
    const result = await client.query(query);
    await client.end();
    
    return {
      statusCode: 200,
      headers,
      body: JSON.stringify(result.rows)
    };
    
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
};