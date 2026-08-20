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

const loading = ref(false)
const success = ref('')
const error = ref('')

const submitForm = async () => {
  loading.value = true
  success.value = ''
  error.value = ''

  try {
    const response = await fetch(
      'https://dev-learning-code.netlify.app/api/save.php',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(form.value)
      }
    )

    const data = await response.json()

    if (!response.ok || !data.success) {
      throw new Error(data.message || 'Something went wrong')
    }

    success.value = `Saved successfully! ID: ${data.id}`

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

  } catch (err) {
    error.value = err.message
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="form-container">

    <h1>Contact Form</h1>

    <form @submit.prevent="submitForm">

      <div class="row">
        <div class="field">
          <label>First Name</label>
          <input
            v-model="form.first_name"
            type="text"
            required
          />
        </div>

        <div class="field">
          <label>Last Name</label>
          <input
            v-model="form.last_name"
            type="text"
            required
          />
        </div>
      </div>

      <div class="field">
        <label>Email</label>
        <input
          v-model="form.email"
          type="email"
          required
        />
      </div>

      <div class="field">
        <label>Phone</label>
        <input
          v-model="form.phone"
          type="tel"
        />
      </div>

      <div class="field">
        <label>Address</label>
        <input
          v-model="form.address"
          type="text"
        />
      </div>

      <div class="row">

        <div class="field">
          <label>City</label>
          <input
            v-model="form.city"
            type="text"
          />
        </div>

        <div class="field">
          <label>Province</label>
          <input
            v-model="form.province"
            type="text"
          />
        </div>

      </div>

      <div class="field">
        <label>Postal Code</label>
        <input
          v-model="form.postal_code"
          type="text"
        />
      </div>

      <div class="field">
        <label>Message</label>
        <textarea
          v-model="form.message"
          rows="5"
        ></textarea>
      </div>

      <button
        type="submit"
        :disabled="loading"
      >
        {{ loading ? 'Saving...' : 'Save' }}
      </button>

      <p v-if="success" class="success">
        {{ success }}
      </p>

      <p v-if="error" class="error">
        {{ error }}
      </p>

    </form>

  </div>
</template>

<style scoped>

.form-container {
  max-width: 700px;
  margin: 40px auto;
  padding: 30px;
}

.row {
  display: flex;
  gap: 20px;
}

.field {
  flex: 1;
  display: flex;
  flex-direction: column;
  margin-bottom: 18px;
}

label {
  margin-bottom: 6px;
  font-weight: bold;
}

input,
textarea {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 16px;
}

textarea {
  resize: vertical;
}

button {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 6px;
  background: #2563eb;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

button:disabled {
  opacity: 0.6;
}

.success {
  color: green;
  margin-top: 15px;
}

.error {
  color: red;
  margin-top: 15px;
}

@media (max-width: 600px) {
  .row {
    flex-direction: column;
    gap: 0;
  }
}

</style>