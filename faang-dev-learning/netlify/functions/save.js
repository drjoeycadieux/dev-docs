import mysql from 'mysql2/promise'

const headers = {
  'Content-Type': 'application/json',
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Methods': 'POST, OPTIONS',
  'Access-Control-Allow-Headers': 'Content-Type'
}

const response = (statusCode, body) => ({
  statusCode,
  headers,
  body: JSON.stringify(body)
})

export const handler = async (event) => {
  if (event.httpMethod === 'OPTIONS') {
    return { statusCode: 204, headers, body: '' }
  }

  if (event.httpMethod !== 'POST') {
    return response(405, { success: false, message: 'Method not allowed' })
  }

  let data

  try {
    data = JSON.parse(event.body || '{}')
  } catch {
    return response(400, { success: false, message: 'Invalid request' })
  }

  const firstName = data.first_name || ''
  const lastName = data.last_name || ''
  const email = data.email || ''
  const phone = data.phone || ''
  const address = data.address || ''
  const city = data.city || ''
  const province = data.province || ''
  const postalCode = data.postal_code || ''
  const message = data.message || ''

  if (!firstName || !lastName || !email) {
    return response(400, {
      success: false,
      message: 'First name, last name and email are required'
    })
  }

  let connection

  try {
    connection = await mysql.createConnection({
      host: process.env.DB_HOST,
      user: process.env.DB_USER,
      password: process.env.DB_PASSWORD,
      database: process.env.DB_NAME,
      port: Number(process.env.DB_PORT || 3306)
    })

    const [result] = await connection.execute(
      `INSERT INTO users (
        first_name, last_name, email, phone, address, city, province, postal_code, message
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
      [firstName, lastName, email, phone, address, city, province, postalCode, message]
    )

    return response(200, {
      success: true,
      message: 'User saved successfully',
      id: result.insertId
    })
  } catch (error) {
    console.error('Contact submission failed:', error)
    return response(500, { success: false, message: 'Failed to save user' })
  } finally {
    await connection?.end()
  }
}
