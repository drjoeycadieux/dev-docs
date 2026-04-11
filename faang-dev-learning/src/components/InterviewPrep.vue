<script setup>
import { ref } from 'vue'

const interviewTypes = [
  {
    type: 'Coding Interview',
    icon: '💻',
    duration: '45-60 minutes',
    description: 'Solve algorithmic problems on a whiteboard or coding platform',
    tips: [
      'Practice on LeetCode (focus on Medium/Hard)',
      'Master common patterns (Two Pointers, Sliding Window, DFS/BFS)',
      'Think out loud and communicate your approach',
      'Ask clarifying questions before coding',
      'Test your solution with edge cases'
    ],
    color: '#48bb78'
  },
  {
    type: 'System Design',
    icon: '🏗️',
    duration: '45-60 minutes',
    description: 'Design scalable systems for millions of users',
    tips: [
      'Understand requirements and constraints first',
      'Start with high-level architecture',
      'Discuss trade-offs (consistency vs availability)',
      'Consider scalability, reliability, and performance',
      'Practice designing real-world systems (Twitter, Uber, etc.)'
    ],
    color: '#4299e1'
  },
  {
    type: 'Behavioral Interview',
    icon: '🤝',
    duration: '30-45 minutes',
    description: 'Assess cultural fit and soft skills',
    tips: [
      'Use the STAR method (Situation, Task, Action, Result)',
      'Prepare stories for leadership principles',
      'Show enthusiasm and passion for technology',
      'Demonstrate teamwork and conflict resolution',
      'Research company values beforehand'
    ],
    color: '#ed8936'
  },
  {
    type: 'Technical Phone Screen',
    icon: '📞',
    duration: '30-45 minutes',
    description: 'Initial screening with coding questions',
    tips: [
      'Review basics of data structures and algorithms',
      'Be ready to code in your preferred language',
      'Practice explaining your thought process',
      'Have a quiet environment ready',
      'Keep solutions simple and optimal'
    ],
    color: '#9f7aea'
  }
]

const selectedType = ref(null)

const preparationSteps = [
  { step: 1, title: 'Build Foundation', weeks: '8-12 weeks', tasks: ['Learn DSA fundamentals', 'Practice easy problems', 'Understand time complexity'] },
  { step: 2, title: 'Intensive Practice', weeks: '8-12 weeks', tasks: ['Solve 200+ medium problems', 'Study system design basics', 'Do mock interviews'] },
  { step: 3, title: 'Final Prep', weeks: '4-6 weeks', tasks: ['Focus on weak areas', 'Company-specific prep', 'Rest and stay confident'] }
]
</script>

<template>
  <section class="interview-prep">
    <div class="container">
      <h2 class="section-title">Interview Preparation Guide</h2>
      <p class="section-subtitle">
        Everything you need to know to ace your FAANG technical interviews
      </p>

      <div class="interview-types">
        <div
          v-for="type in interviewTypes"
          :key="type.type"
          :class="['type-card', { active: selectedType === type }]"
          @click="selectedType = type"
        >
          <div class="type-icon">{{ type.icon }}</div>
          <h3>{{ type.type }}</h3>
          <p class="duration">⏱️ {{ type.duration }}</p>
          <p class="description">{{ type.description }}</p>
        </div>
      </div>

      <div v-if="selectedType" class="tips-section">
        <div class="tips-header" :style="{ borderColor: selectedType.color }">
          <span class="tips-icon">{{ selectedType.icon }}</span>
          <h3>Success Tips for {{ selectedType.type }}</h3>
        </div>
        
        <ul class="tips-list">
          <li v-for="(tip, index) in selectedType.tips" :key="index" class="tip-item">
            <span class="tip-number">{{ index + 1 }}</span>
            <span>{{ tip }}</span>
          </li>
        </ul>
      </div>

      <div class="preparation-timeline">
        <h3>Preparation Timeline</h3>
        <div class="timeline-grid">
          <div
            v-for="phase in preparationSteps"
            :key="phase.step"
            class="phase-card"
          >
            <div class="phase-number">{{ phase.step }}</div>
            <h4>{{ phase.title }}</h4>
            <p class="phase-weeks">{{ phase.weeks }}</p>
            <ul class="phase-tasks">
              <li v-for="task in phase.tasks" :key="task">✓ {{ task }}</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="mock-interview-cta">
        <h3>Ready to Practice?</h3>
        <p>Schedule a mock interview with our FAANG engineer network</p>
        <div class="cta-buttons">
          <button class="btn-primary">Book Mock Interview</button>
          <button class="btn-secondary">Join Study Group</button>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.interview-prep {
  padding: 4rem 2rem;
  background: #f7fafc;
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

.interview-types {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.type-card {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: center;
  border: 3px solid transparent;
}

.type-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.type-card.active {
  border-color: #667eea;
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
}

.type-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.type-card h3 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0 0 0.5rem 0;
}

.duration {
  color: #718096;
  font-size: 0.9rem;
  margin: 0 0 1rem 0;
}

.description {
  color: #4a5568;
  font-size: 0.95rem;
  line-height: 1.5;
  margin: 0;
}

.tips-section {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  margin-bottom: 3rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.tips-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-bottom: 1.5rem;
  border-bottom: 3px solid;
  margin-bottom: 2rem;
}

.tips-icon {
  font-size: 2.5rem;
}

.tips-header h3 {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0;
}

.tips-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.tip-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1rem 0;
  border-bottom: 1px solid #e2e8f0;
}

.tip-item:last-child {
  border-bottom: none;
}

.tip-number {
  width: 30px;
  height: 30px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 0.9rem;
  flex-shrink: 0;
}

.tip-item span:last-child {
  color: #2d3748;
  font-size: 1rem;
  line-height: 1.6;
}

.preparation-timeline {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  margin-bottom: 3rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.preparation-timeline h3 {
  font-size: 1.75rem;
  font-weight: 700;
  text-align: center;
  color: #1a202c;
  margin: 0 0 2rem 0;
}

.timeline-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}

.phase-card {
  background: #f7fafc;
  padding: 2rem;
  border-radius: 12px;
  position: relative;
}

.phase-number {
  position: absolute;
  top: -15px;
  left: 20px;
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 1.25rem;
}

.phase-card h4 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0.5rem 0 0.5rem 0;
}

.phase-weeks {
  color: #718096;
  font-size: 0.9rem;
  margin: 0 0 1rem 0;
}

.phase-tasks {
  list-style: none;
  padding: 0;
  margin: 0;
}

.phase-tasks li {
  padding: 0.5rem 0;
  color: #2d3748;
  font-size: 0.95rem;
}

.mock-interview-cta {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 3rem;
  border-radius: 16px;
  text-align: center;
}

.mock-interview-cta h3 {
  font-size: 2rem;
  margin: 0 0 1rem 0;
}

.mock-interview-cta p {
  font-size: 1.1rem;
  margin: 0 0 2rem 0;
  opacity: 0.9;
}

.cta-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-primary {
  padding: 1rem 2.5rem;
  background: white;
  color: #667eea;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.btn-secondary {
  padding: 1rem 2.5rem;
  background: transparent;
  color: white;
  border: 2px solid white;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: white;
  color: #667eea;
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .interview-types {
    grid-template-columns: 1fr;
  }
  
  .timeline-grid {
    grid-template-columns: 1fr;
  }
  
  .cta-buttons {
    flex-direction: column;
  }
  
  .btn-primary,
  .btn-secondary {
    width: 100%;
  }
}
</style>
