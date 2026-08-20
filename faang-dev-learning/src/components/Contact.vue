<script setup>
import { ref } from 'vue'

const form = ref({
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  address: '',
  city: '',
  province: '',
  postal_code: '',
  message: ''
})

const result = ref('')
const loading = ref(false)
const contactApiUrl = import.meta.env.VITE_CONTACT_API_URL || '/api/save.php'

const submitForm = async () => {
  result.value = ''
  loading.value = true

  try {
    const response = await fetch(contactApiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(form.value)
    })

    const responseText = await response.text()
    let data

    try {
      data = JSON.parse(responseText)
    } catch {
      throw new Error(`The contact service returned an invalid response (HTTP ${response.status})`)
    }

    if (!response.ok || !data.success) {
      throw new Error(data.message || 'Request failed')
    }

    result.value = data.message

    form.value = {
      first_name: '',
      last_name: '',
      email: '',
      phone: '',
      address: '',
      city: '',
      province: '',
      postal_code: '',
      message: ''
    }

  } catch (error) {
    console.error(error)
    result.value = error instanceof TypeError
      ? 'Unable to reach the contact service. Check the API URL and CORS configuration.'
      : error.message
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="page">

    <div class="form-card">

      <div class="form-header">
        <h1>Contact Us</h1>
        <p>Fill out the form below and we'll get back to you.</p>
      </div>

      <form @submit.prevent="submitForm">

        <div class="form-row">

          <div class="form-group">
            <label>First Name</label>
            <input
              v-model="form.first_name"
              type="text"
              placeholder="John"
              required
            />
          </div>

          <div class="form-group">
            <label>Last Name</label>
            <input
              v-model="form.last_name"
              type="text"
              placeholder="Smith"
              required
            />
          </div>

        </div>

        <div class="form-row">

          <div class="form-group">
            <label>Email</label>
            <input
              v-model="form.email"
              type="email"
              placeholder="john@example.com"
              required
            />
          </div>

          <div class="form-group">
            <label>Phone</label>
            <input
              v-model="form.phone"
              type="tel"
              placeholder="514-555-1234"
            />
          </div>

        </div>

        <div class="form-group">
          <label>Address</label>
          <input
            v-model="form.address"
            type="text"
            placeholder="123 Main Street"
          />
        </div>

        <div class="form-row">

          <div class="form-group">
            <label>City</label>
            <input
              v-model="form.city"
              type="text"
              placeholder="Montreal"
            />
          </div>

          <div class="form-group">
            <label>Province</label>
            <select v-model="form.province">
              <option value="">Select province</option>
              <option value="Quebec">Quebec</option>
              <option value="Ontario">Ontario</option>
              <option value="British Columbia">
                British Columbia
              </option>
              <option value="Alberta">Alberta</option>
              <option value="Manitoba">Manitoba</option>
              <option value="Saskatchewan">Saskatchewan</option>
              <option value="Nova Scotia">Nova Scotia</option>
              <option value="New Brunswick">
                New Brunswick
              </option>
            </select>
          </div>

          <div class="form-group small">
            <label>Postal Code</label>
            <input
              v-model="form.postal_code"
              type="text"
              placeholder="H1A 1A1"
            />
          </div>

        </div>

        <div class="form-group">
          <label>Message</label>
          <textarea
            v-model="form.message"
            rows="6"
            placeholder="Write your message..."
          ></textarea>
        </div>

        <button
          type="submit"
          :disabled="loading"
        >
          <span v-if="loading">Saving...</span>
          <span v-else>Submit Form</span>
        </button>

        <div
          v-if="result"
          class="result"
          :class="{
            success: result.includes('success'),
            error: !result.includes('success')
          }"
        >
          {{ result }}
        </div>

      </form>

    </div>

  </div>
</template>

<style scoped>

* {
  box-sizing: border-box;
}

.page {
  min-height: 100vh;
  padding: 50px 20px;
  background: #f3f4f6;
  font-family:
    Inter,
    -apple-system,
    BlinkMacSystemFont,
    "Segoe UI",
    sans-serif;
}

.form-card {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  padding: 40px;
  background: #ffffff;
  border-radius: 16px;
  box-shadow:
    0 10px 30px rgba(0, 0, 0, 0.08);
}

.form-header {
  margin-bottom: 30px;
}

.form-header h1 {
  margin: 0 0 8px;
  color: #111827;
  font-size: 32px;
  font-weight: 700;
}

.form-header p {
  margin: 0;
  color: #6b7280;
  font-size: 15px;
}

.form-row {
  display: flex;
  gap: 20px;
}

.form-group {
  flex: 1;
  margin-bottom: 20px;
}

.form-group.small {
  max-width: 180px;
}

label {
  display: block;
  margin-bottom: 7px;
  color: #374151;
  font-size: 14px;
  font-weight: 600;
}

input,
select,
textarea {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  outline: none;
  background: #ffffff;
  color: #111827;
  font-family: inherit;
  font-size: 15px;
  transition:
    border-color 0.2s,
    box-shadow 0.2s;
}

input::placeholder,
textarea::placeholder {
  color: #9ca3af;
}

input:focus,
select:focus,
textarea:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

textarea {
  min-height: 140px;
  resize: vertical;
}

button {
  width: 100%;
  margin-top: 5px;
  padding: 14px 20px;
  border: none;
  border-radius: 8px;
  background: #2563eb;
  color: #ffffff;
  font-family: inherit;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition:
    background 0.2s,
    transform 0.1s;
}

button:hover:not(:disabled) {
  background: #1d4ed8;
}

button:active:not(:disabled) {
  transform: translateY(1px);
}

button:disabled {
  background: #93c5fd;
  cursor: not-allowed;
}

.result {
  margin-top: 20px;
  padding: 13px 16px;
  border-radius: 8px;
  font-size: 14px;
}

.result.success {
  background: #dcfce7;
  color: #166534;
  border: 1px solid #86efac;
}

.result.error {
  background: #fee2e2;
  color: #991b1b;
  border: 1px solid #fca5a5;
}

@media (max-width: 700px) {

  .page {
    padding: 20px 12px;
  }

  .form-card {
    padding: 25px 20px;
  }

  .form-header h1 {
    font-size: 26px;
  }

  .form-row {
    flex-direction: column;
    gap: 0;
  }

  .form-group.small {
    max-width: none;
  }

}

</style>