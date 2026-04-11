<script setup>
import { ref } from 'vue'

const categories = [
  {
    name: 'Data Structures',
    icon: '🗂️',
    color: '#48bb78',
    topics: [
      { name: 'Arrays & Strings', difficulty: 'Easy', problems: 45 },
      { name: 'Linked Lists', difficulty: 'Medium', problems: 32 },
      { name: 'Stacks & Queues', difficulty: 'Medium', problems: 28 },
      { name: 'Hash Tables', difficulty: 'Medium', problems: 38 },
      { name: 'Trees & BST', difficulty: 'Hard', problems: 52 },
      { name: 'Graphs', difficulty: 'Hard', problems: 41 },
      { name: 'Heaps', difficulty: 'Hard', problems: 25 }
    ]
  },
  {
    name: 'Algorithms',
    icon: '⚡',
    color: '#4299e1',
    topics: [
      { name: 'Sorting Algorithms', difficulty: 'Easy', problems: 18 },
      { name: 'Searching Algorithms', difficulty: 'Easy', problems: 15 },
      { name: 'Two Pointers', difficulty: 'Medium', problems: 34 },
      { name: 'Sliding Window', difficulty: 'Medium', problems: 29 },
      { name: 'Binary Search', difficulty: 'Medium', problems: 26 },
      { name: 'Backtracking', difficulty: 'Hard', problems: 31 },
      { name: 'Divide & Conquer', difficulty: 'Hard', problems: 22 }
    ]
  },
  {
    name: 'Dynamic Programming',
    icon: '🧠',
    color: '#ed8936',
    topics: [
      { name: '1D DP', difficulty: 'Medium', problems: 28 },
      { name: '2D DP', difficulty: 'Hard', problems: 35 },
      { name: 'Knapsack Problems', difficulty: 'Hard', problems: 19 },
      { name: 'Longest Common Subsequence', difficulty: 'Hard', problems: 15 },
      { name: 'Matrix Chain Multiplication', difficulty: 'Hard', problems: 12 },
      { name: 'DP on Trees', difficulty: 'Hard', problems: 18 },
      { name: 'Bitmask DP', difficulty: 'Hard', problems: 14 }
    ]
  },
  {
    name: 'System Design',
    icon: '🏗️',
    color: '#9f7aea',
    topics: [
      { name: 'Load Balancing', difficulty: 'Medium', problems: 8 },
      { name: 'Caching Strategies', difficulty: 'Medium', problems: 12 },
      { name: 'Database Sharding', difficulty: 'Hard', problems: 10 },
      { name: 'Message Queues', difficulty: 'Medium', problems: 9 },
      { name: 'API Design', difficulty: 'Medium', problems: 15 },
      { name: 'Microservices', difficulty: 'Hard', problems: 11 },
      { name: 'Distributed Systems', difficulty: 'Hard', problems: 14 }
    ]
  }
]

const selectedCategory = ref(categories[0])
const getDifficultyClass = (difficulty) => {
  return `difficulty-${difficulty.toLowerCase()}`
}
</script>

<template>
  <section class="topics">
    <div class="container">
      <h2 class="section-title">Master Essential Topics</h2>
      <p class="section-subtitle">
        Deep dive into each topic with curated problems, explanations, and practice exercises
      </p>

      <div class="category-tabs">
        <button
          v-for="category in categories"
          :key="category.name"
          :class="['tab-btn', { active: selectedCategory === category }]"
          @click="selectedCategory = category"
        >
          <span class="tab-icon">{{ category.icon }}</span>
          <span>{{ category.name }}</span>
        </button>
      </div>

      <div class="category-content">
        <div class="category-header" :style="{ borderColor: selectedCategory.color }">
          <span class="category-icon">{{ selectedCategory.icon }}</span>
          <h3>{{ selectedCategory.name }}</h3>
        </div>

        <div class="topics-grid">
          <div
            v-for="topic in selectedCategory.topics"
            :key="topic.name"
            class="topic-card"
          >
            <div class="topic-header">
              <h4>{{ topic.name }}</h4>
              <span :class="['difficulty-badge', getDifficultyClass(topic.difficulty)]">
                {{ topic.difficulty }}
              </span>
            </div>
            <div class="topic-stats">
              <span class="problems-count">{{ topic.problems }} problems</span>
            </div>
            <button class="btn-practice">Practice Now</button>
          </div>
        </div>
      </div>

      <div class="topics-cta">
        <div class="progress-tracker">
          <h3>Track Your Progress</h3>
          <p>Complete topics to unlock achievements and monitor your growth</p>
          <div class="progress-bar">
            <div class="progress-fill" style="width: 35%"></div>
          </div>
          <p class="progress-text">35% Complete - Keep Going! 🚀</p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.topics {
  padding: 4rem 2rem;
  background: white;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 800;
  text-align: center;
  color: #1a202c;
  margin-bottom: 1rem;
}

.section-subtitle {
  text-align: center;
  color: #4a5568;
  font-size: 1.1rem;
  max-width: 700px;
  margin: 0 auto 3rem;
  line-height: 1.6;
}

.category-tabs {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
  margin-bottom: 2rem;
}

.tab-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 1rem 1.5rem;
  border: 2px solid #e2e8f0;
  background: white;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 1rem;
  font-weight: 600;
  color: #4a5568;
}

.tab-btn:hover {
  border-color: #667eea;
  color: #667eea;
  transform: translateY(-2px);
}

.tab-btn.active {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-color: transparent;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.tab-icon {
  font-size: 1.3rem;
}

.category-content {
  background: #f7fafc;
  border-radius: 16px;
  padding: 2rem;
  margin-bottom: 3rem;
}

.category-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-bottom: 1.5rem;
  border-bottom: 3px solid;
  margin-bottom: 2rem;
}

.category-icon {
  font-size: 3rem;
}

.category-header h3 {
  font-size: 2rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0;
}

.topics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.topic-card {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

.topic-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.topic-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.topic-header h4 {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0;
}

.difficulty-badge {
  padding: 0.35rem 0.75rem;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
}

.difficulty-easy {
  background: #c6f6d5;
  color: #276749;
}

.difficulty-medium {
  background: #feebc8;
  color: #c05621;
}

.difficulty-hard {
  background: #fed7d7;
  color: #c53030;
}

.topic-stats {
  margin-bottom: 1rem;
}

.problems-count {
  color: #718096;
  font-size: 0.9rem;
}

.btn-practice {
  width: 100%;
  padding: 0.75rem;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-practice:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.topics-cta {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 3rem;
  border-radius: 16px;
  text-align: center;
}

.progress-tracker h3 {
  font-size: 1.75rem;
  margin: 0 0 0.5rem 0;
}

.progress-tracker p {
  font-size: 1rem;
  margin: 0 0 2rem 0;
  opacity: 0.9;
}

.progress-bar {
  height: 12px;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 6px;
  overflow: hidden;
  max-width: 500px;
  margin: 0 auto 1rem;
}

.progress-fill {
  height: 100%;
  background: white;
  border-radius: 6px;
  transition: width 0.5s ease;
}

.progress-text {
  font-weight: 600;
  margin: 0;
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .category-tabs {
    flex-direction: column;
  }
  
  .tab-btn {
    width: 100%;
    justify-content: center;
  }
  
  .topics-grid {
    grid-template-columns: 1fr;
  }
}
</style>
