<script setup>
import { ref } from 'vue'

const props = defineProps({
  activeTab: {
    type: String,
    default: 'home'
  }
})

const emit = defineEmits(['update:activeTab'])

const isMenuOpen = ref(false)

const tabs = [
  { id: 'home', label: 'Home', icon: '🏠' },
  { id: 'learning-path', label: 'Learning Path', icon: '🗺️' },
  { id: 'topics', label: 'Topics', icon: '📚' },
  { id: 'resources', label: 'Resources', icon: '🔗' },
  { id: 'interview', label: 'Interview Prep', icon: '💼' }
]

const setActiveTab = (tabId) => {
  emit('update:activeTab', tabId)
  isMenuOpen.value = false
}

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}
</script>

<template>
  <header class="header">
    <div class="header-content">
      <div class="logo">
        <span class="logo-icon">🚀</span>
        <h1>FAANG Dev Learning</h1>
      </div>
      
      <!-- Hamburger Menu Button -->
      <button class="hamburger-btn" @click="toggleMenu" :class="{ active: isMenuOpen }" aria-label="Toggle menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
      
      <nav class="nav" :class="{ 'nav-open': isMenuOpen }">
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
  gap: 1rem;
  position: relative;
}

.logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex-shrink: 0;
}

.logo-icon {
  font-size: 2rem;
}

.logo h1 {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0;
  white-space: nowrap;
}

.nav {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
  transition: all 0.3s ease;
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
  white-space: nowrap;
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

/* Hamburger Menu Button */
.hamburger-btn {
  display: none;
  flex-direction: column;
  justify-content: space-between;
  width: 30px;
  height: 24px;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0;
  z-index: 101;
  flex-shrink: 0;
}

.hamburger-line {
  width: 100%;
  height: 3px;
  background: white;
  border-radius: 2px;
  transition: all 0.3s ease;
}

.hamburger-btn.active .hamburger-line:nth-child(1) {
  transform: translateY(10.5px) rotate(45deg);
}

.hamburger-btn.active .hamburger-line:nth-child(2) {
  opacity: 0;
}

.hamburger-btn.active .hamburger-line:nth-child(3) {
  transform: translateY(-10.5px) rotate(-45deg);
}

/* Mobile Responsive Styles */
@media (max-width: 992px) {
  .header {
    padding: 1rem 1.5rem;
  }
  
  .nav-btn {
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
  }
}

@media (max-width: 768px) {
  .header {
    padding: 0.75rem 1rem;
  }
  
  .hamburger-btn {
    display: flex;
  }
  
  .nav {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    flex-direction: column;
    padding: 0;
    gap: 0;
    max-height: 0;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  
  .nav.nav-open {
    max-height: 500px;
    padding: 1rem 0;
  }
  
  .nav-btn {
    width: calc(100% - 2rem);
    margin: 0.25rem 1rem;
    padding: 0.875rem 1.25rem;
    justify-content: flex-start;
    border-radius: 8px;
  }
  
  .nav-btn:hover {
    transform: translateX(4px);
  }
  
  .logo h1 {
    font-size: 1.25rem;
  }
  
  .logo-icon {
    font-size: 1.75rem;
  }
}

@media (max-width: 480px) {
  .header {
    padding: 0.625rem 0.875rem;
  }
  
  .logo h1 {
    font-size: 1.1rem;
  }
  
  .logo-icon {
    font-size: 1.5rem;
  }
  
  .nav-btn {
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
  }
}
</style>
