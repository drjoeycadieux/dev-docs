<script setup>
import { ref } from 'vue'

const learningStages = [
  {
    stage: 1,
    title: 'Foundation',
    duration: '2-3 months',
    topics: [
      'Programming Basics (Python/Java)',
      'Data Structures (Arrays, Lists, Stacks, Queues)',
      'Basic Algorithms (Sorting, Searching)',
      'Time & Space Complexity (Big O)',
      'Version Control (Git)'
    ],
    color: '#48bb78'
  },
  {
    stage: 2,
    title: 'Core Competency',
    duration: '3-4 months',
    topics: [
      'Advanced Data Structures (Trees, Graphs, Hash Tables)',
      'Algorithm Patterns (Two Pointers, Sliding Window)',
      'Dynamic Programming Basics',
      'Object-Oriented Design',
      'Database Fundamentals (SQL)'
    ],
    color: '#4299e1'
  },
  {
    stage: 3,
    title: 'Advanced Topics',
    duration: '3-4 months',
    topics: [
      'Advanced Dynamic Programming',
      'Graph Algorithms (DFS, BFS, Dijkstra)',
      'System Design Basics',
      'Concurrency & Multithreading',
      'Networking Fundamentals'
    ],
    color: '#ed8936'
  },
  {
    stage: 4,
    title: 'Interview Prep',
    duration: '2-3 months',
    topics: [
      'LeetCode Medium/Hard Problems',
      'Mock Interviews',
      'System Design Deep Dive',
      'Behavioral Questions',
      'Resume & Portfolio Building'
    ],
    color: '#9f7aea'
  },
  {
    stage: 5,
    title: 'FAANG Ready',
    duration: 'Ongoing',
    topics: [
      'Company-Specific Prep',
      'Advanced System Design',
      'Leadership Principles',
      'Negotiation Skills',
      'Continuous Learning'
    ],
    color: '#f56565'
  }
]

const expandedStage = ref(null)

const toggleStage = (stageId) => {
  expandedStage.value = expandedStage.value === stageId ? null : stageId
}
</script>

<template>
  <section class="learning-path">
    <div class="container">
      <h2 class="section-title">Your Path to FAANG</h2>
      <p class="section-subtitle">
        Follow this structured learning path designed by FAANG engineers to help you 
        go from beginner to job-ready software engineer.
      </p>

      <div class="timeline">
        <div
          v-for="stage in learningStages"
          :key="stage.stage"
          :class="['stage-card', { expanded: expandedStage === stage.stage }]"
        >
          <div 
            class="stage-header"
            @click="toggleStage(stage.stage)"
          >
            <div class="stage-number" :style="{ backgroundColor: stage.color }">
              {{ stage.stage }}
            </div>
            <div class="stage-info">
              <h3 class="stage-title">{{ stage.title }}</h3>
              <p class="stage-duration">⏱️ {{ stage.duration }}</p>
            </div>
            <div class="expand-icon" :class="{ rotated: expandedStage === stage.stage }">
              ▼
            </div>
          </div>

          <div class="stage-content" v-show="expandedStage === stage.stage">
            <ul class="topics-list">
              <li v-for="(topic, index) in stage.topics" :key="index">
                <span class="checkmark">✓</span>
                {{ topic }}
              </li>
            </ul>
            <button class="btn-start">Start This Stage</button>
          </div>
        </div>
      </div>

      <div class="path-cta">
        <h3>Ready to Start Your Journey?</h3>
        <p>Join thousands of developers who have successfully landed FAANG jobs</p>
        <button class="btn-primary">Begin Your Free Trial</button>
      </div>
    </div>
  </section>
</template>

<style scoped>
.learning-path {
  padding: 4rem 2rem;
  background: #f7fafc;
}

.container {
  max-width: 1000px;
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

.timeline {
  position: relative;
  padding-left: 2rem;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
  background: linear-gradient(180deg, #48bb78, #4299e1, #ed8936, #9f7aea, #f56565);
  border-radius: 2px;
}

.stage-card {
  background: white;
  border-radius: 12px;
  margin-bottom: 1.5rem;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: all 0.3s ease;
}

.stage-card:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
  transform: translateX(5px);
}

.stage-header {
  display: flex;
  align-items: center;
  padding: 1.5rem;
  cursor: pointer;
  gap: 1.5rem;
}

.stage-number {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  font-size: 1.25rem;
  flex-shrink: 0;
}

.stage-info {
  flex: 1;
}

.stage-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0 0 0.5rem 0;
}

.stage-duration {
  color: #718096;
  margin: 0;
  font-size: 0.95rem;
}

.expand-icon {
  color: #a0aec0;
  transition: transform 0.3s ease;
  font-size: 0.8rem;
}

.expand-icon.rotated {
  transform: rotate(180deg);
}

.stage-content {
  padding: 0 1.5rem 1.5rem;
  padding-left: 6.5rem;
}

.topics-list {
  list-style: none;
  padding: 0;
  margin: 0 0 1.5rem 0;
}

.topics-list li {
  padding: 0.75rem 0;
  color: #2d3748;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  border-bottom: 1px solid #e2e8f0;
}

.topics-list li:last-child {
  border-bottom: none;
}

.checkmark {
  color: #48bb78;
  font-weight: 700;
  font-size: 1.2rem;
}

.btn-start {
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-start:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.path-cta {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 3rem;
  border-radius: 12px;
  text-align: center;
  margin-top: 3rem;
}

.path-cta h3 {
  font-size: 2rem;
  margin: 0 0 1rem 0;
}

.path-cta p {
  font-size: 1.1rem;
  margin: 0 0 2rem 0;
  opacity: 0.9;
}

.path-cta .btn-primary {
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

.path-cta .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .timeline {
    padding-left: 1rem;
  }
  
  .stage-header {
    flex-wrap: wrap;
    gap: 1rem;
  }
  
  .stage-number {
    width: 40px;
    height: 40px;
    font-size: 1rem;
  }
  
  .stage-content {
    padding-left: 1.5rem;
  }
}
</style>
