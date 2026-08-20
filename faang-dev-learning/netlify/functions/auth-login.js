import bcrypt from 'bcryptjs'
import mysql from 'mysql2/promise'

const headers = {
  'Content-Type': 'application/json',
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Methods': 'POST, OPTIONS',
  'Access-Control-Allow-Headers': 'Content-Type'
}

const response = (statusCode, body) => ({ statusCode, headers, body: JSON.stringify(body) })
const databaseConfig = () => ({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
  port: Number(process.env.DB_PORT || 3306)
})

export const handler = async (event) => {
  if (event.httpMethod === 'OPTIONS') return { statusCode: 204, headers, body: '' }
  if (event.httpMethod !== 'POST') return response(405, { success: false, message: 'Method not allowed' })

  let data
  try { data = JSON.parse(event.body || '{}') } catch { return response(400, { success: false, message: 'Invalid request' }) }
  const email = String(data.email || '').trim().toLowerCase()
  const password = String(data.password || '')
  let connection
  try {
    connection = await mysql.createConnection(databaseConfig())
    const [rows] = await connection.execute('SELECT id, name, email, password_hash FROM auth_users WHERE email = ? LIMIT 1', [email])
    const user = rows[0]
    if (!user || !(await bcrypt.compare(password, user.password_hash))) return response(401, { success: false, message: 'That email or password does not match' })
    return response(200, { success: true, user: { id: user.id, name: user.name, email: user.email } })
  } catch { return response(500, { success: false, message: 'Authentication service is unavailable' }) }
  finally { await connection?.end() }
}
