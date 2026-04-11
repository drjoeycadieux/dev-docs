<script setup>
import { ref } from 'vue'

const props = defineProps({
  activeTab: {
    type: String,
    default: 'home'
  }
})

const emit = defineEmits(['update:activeTab'])

const tabs = [
  { id: 'home', label: 'Home', icon: '🏠' },
  { id: 'learning-path', label: 'Learning Path', icon: '🗺️' },
  { id: 'topics', label: 'Topics', icon: '📚' },
  { id: 'resources', label: 'Resources', icon: '🔗' },
  { id: 'interview', label: 'Interview Prep', icon: '💼' }
]

const setActiveTab = (tabId) => {
  emit('update:activeTab', tabId)
}
</script>

<template>
  <header class="header">
    <div class="header-content">
      <div class="logo">
        <span class="logo-icon">🚀</span>
        <h1>FAANG Dev Learning</h1>
      </div>
      
      <nav class="nav">
        <button
          v-for="tab in tabs"
          :key="tab.id"
          :class="['nav-btn', { active: activeTab === tab.id }]"
          @click="setActiveTab(tab.id)"
        >
          <span class="nav-icon">{{ tab.icon }}</span>
          <span class="nav-label">{{ tab.label }}</span>
        </button>
      </nav>
    </div>
  </header>
</template>

<style scoped>
.header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 1rem 2rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 100;
}

.header-content {
  max-width: 1400px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.logo-icon {
  font-size: 2rem;
}

.logo h1 {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0;
}

.nav {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.nav-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.25rem;
  border: none;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.95rem;
  font-weight: 500;
}

.nav-btn:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
}

.nav-btn.active {
  background: white;
  color: #667eea;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.nav-icon {
  font-size: 1.2rem;
}

@media (max-width: 768px) {
  .header-content {
    flex-direction: column;
    text-align: center;
  }
  
  .logo {
    justify-content: center;
  }
  
  .nav {
    justify-content: center;
  }
  
  .nav-btn {
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
  }
}
</style>
