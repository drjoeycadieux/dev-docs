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
  const name = String(data.name || '').trim()
  const email = String(data.email || '').trim().toLowerCase()
  const password = String(data.password || '')
  if (!name || !/^\S+@\S+\.\S+$/.test(email) || password.length < 8) return response(400, { success: false, message: 'Name, a valid email and an 8-character password are required' })

  let connection
  try {
    connection = await mysql.createConnection(databaseConfig())
    const [result] = await connection.execute('INSERT INTO auth_users (name, email, password_hash) VALUES (?, ?, ?)', [name, email, await bcrypt.hash(password, 12)])
    return response(200, { success: true, user: { id: result.insertId, name, email } })
  } catch (error) {
    return response(error.code === 'ER_DUP_ENTRY' ? 409 : 500, { success: false, message: error.code === 'ER_DUP_ENTRY' ? 'An account with that email already exists' : 'Unable to create account' })
  } finally { await connection?.end() }
}
