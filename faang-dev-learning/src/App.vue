<script setup>
import { ref } from 'vue'
import AppHeader from './components/AppHeader.vue'
import HeroSection from './components/HeroSection.vue'
import LearningPath from './components/LearningPath.vue'
import TopicCard from './components/TopicCard.vue'
import ResourcesSection from './components/ResourcesSection.vue'
import InterviewPrep from './components/InterviewPrep.vue'
import Footer from './components/Footer.vue'

const activeTab = ref('home')
</script>

<template>
  <div class="app">
    <AppHeader v-model:active-tab="activeTab" />
    
    <main class="main-content">
      <HeroSection v-if="activeTab === 'home'" />
      <LearningPath v-if="activeTab === 'learning-path'" />
      <TopicCard v-if="activeTab === 'topics'" />
      <ResourcesSection v-if="activeTab === 'resources'" />
      <InterviewPrep v-if="activeTab === 'interview'" />
    </main>

    <Footer />
  </div>
</template>

<style scoped>
.app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
}
</style>
