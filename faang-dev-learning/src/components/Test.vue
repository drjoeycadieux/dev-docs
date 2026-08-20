<script setup>
const testConnection = () => {
  console.log({
    host: import.meta.env.VITE_DB_HOST,
    user: import.meta.env.VITE_DB_USER,
    database: import.meta.env.VITE_DB_NAME,
    port: import.meta.env.VITE_DB_PORT
  })
}
</script>

<template>
  <button @click="testConnection">
    Test connection
  </button>
</template>