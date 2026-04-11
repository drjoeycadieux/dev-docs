<script setup>
const resources = [
  {
    category: 'Online Platforms',
    icon: '🌐',
    items: [
      { name: 'LeetCode', description: '1500+ coding problems for FAANG prep', url: '#' },
      { name: 'HackerRank', description: 'Practice coding challenges', url: '#' },
      { name: 'Codeforces', description: 'Competitive programming platform', url: '#' },
      { name: 'GeeksforGeeks', description: 'Comprehensive CS tutorials', url: '#' }
    ]
  },
  {
    category: 'Books',
    icon: '📖',
    items: [
      { name: 'Cracking the Coding Interview', description: 'Essential interview prep book', url: '#' },
      { name: 'Introduction to Algorithms (CLRS)', description: 'Algorithm bible', url: '#' },
      { name: 'Designing Data-Intensive Applications', description: 'System design mastery', url: '#' },
      { name: 'Clean Code', description: 'Write better code', url: '#' }
    ]
  },
  {
    category: 'Video Courses',
    icon: '🎥',
    items: [
      { name: 'Algorithms Specialization (Coursera)', description: 'Stanford algorithms course', url: '#' },
      { name: 'Grokking the System Design', description: 'System design interview prep', url: '#' },
      { name: 'CS50 (Harvard)', description: 'Introduction to Computer Science', url: '#' },
      { name: 'Abdul Bari Algorithms', description: 'Popular YouTube algorithms course', url: '#' }
    ]
  },
  {
    category: 'Mock Interviews',
    icon: '🎯',
    items: [
      { name: 'Pramp', description: 'Free peer mock interviews', url: '#' },
      { name: 'Interviewing.io', description: 'Anonymous practice interviews', url: '#' },
      { name: 'Gainlo', description: 'Mock interviews with FAANG engineers', url: '#' },
      { name: 'Refdash', description: 'Technical interview practice', url: '#' }
    ]
  },
  {
    category: 'Communities',
    icon: '👥',
    items: [
      { name: 'r/cscareerquestions', description: 'Reddit career advice community', url: '#' },
      { name: 'Blind', description: 'Anonymous tech community', url: '#' },
      { name: 'Tech Twitter', description: 'Follow industry leaders', url: '#' },
      { name: 'Discord Study Groups', description: 'Join coding study groups', url: '#' }
    ]
  }
]

const externalLinks = [
  { name: 'GitHub', icon: '💻', description: 'Build your portfolio' },
  { name: 'LinkedIn', icon: '💼', description: 'Network with professionals' },
  { name: 'Medium', icon: '📝', description: 'Read tech articles' },
  { name: 'Stack Overflow', icon: '❓', description: 'Ask coding questions' }
]
</script>

<template>
  <section class="resources">
    <div class="container">
      <h2 class="section-title">Curated Resources</h2>
      <p class="section-subtitle">
        Hand-picked resources to accelerate your journey to becoming a FAANG engineer
      </p>

      <div class="resources-grid">
        <div
          v-for="resource in resources"
          :key="resource.category"
          class="resource-card"
        >
          <div class="resource-header">
            <span class="resource-icon">{{ resource.icon }}</span>
            <h3>{{ resource.category }}</h3>
          </div>
          
          <ul class="resource-list">
            <li v-for="item in resource.items" :key="item.name" class="resource-item">
              <div class="item-info">
                <h4>{{ item.name }}</h4>
                <p>{{ item.description }}</p>
              </div>
              <button class="btn-link">Visit →</button>
            </li>
          </ul>
        </div>
      </div>

      <div class="external-links">
        <h3>Stay Connected</h3>
        <div class="links-grid">
          <div
            v-for="link in externalLinks"
            :key="link.name"
            class="link-card"
          >
            <span class="link-icon">{{ link.icon }}</span>
            <h4>{{ link.name }}</h4>
            <p>{{ link.description }}</p>
          </div>
        </div>
      </div>

      <div class="resources-tip">
        <div class="tip-content">
          <span class="tip-icon">💡</span>
          <div>
            <h4>Pro Tip</h4>
            <p>Consistency is key! Dedicate at least 2-3 hours daily to practice. Focus on quality over quantity, and make sure to understand the underlying concepts rather than just memorizing solutions.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.resources {
  padding: 4rem 2rem;
  background: linear-gradient(180deg, #f7fafc 0%, #ffffff 100%);
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

.resources-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 2rem;
  margin-bottom: 4rem;
}

.resource-card {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

.resource-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.resource-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #e2e8f0;
}

.resource-icon {
  font-size: 2.5rem;
}

.resource-header h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0;
}

.resource-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.resource-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
  border-bottom: 1px solid #f0f0f0;
  transition: all 0.3s ease;
}

.resource-item:last-child {
  border-bottom: none;
}

.resource-item:hover {
  padding-left: 0.5rem;
  background: #f7fafc;
  border-radius: 8px;
  padding-right: 0.5rem;
}

.item-info h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #1a202c;
  margin: 0 0 0.25rem 0;
}

.item-info p {
  font-size: 0.9rem;
  color: #718096;
  margin: 0;
}

.btn-link {
  padding: 0.5rem 1rem;
  background: transparent;
  color: #667eea;
  border: 2px solid #667eea;
  border-radius: 8px;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.btn-link:hover {
  background: #667eea;
  color: white;
  transform: translateX(3px);
}

.external-links {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 3rem;
  border-radius: 16px;
  margin-bottom: 3rem;
}

.external-links h3 {
  font-size: 1.75rem;
  text-align: center;
  margin: 0 0 2rem 0;
}

.links-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.link-card {
  background: rgba(255, 255, 255, 0.1);
  padding: 1.5rem;
  border-radius: 12px;
  text-align: center;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.link-card:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-5px);
}

.link-icon {
  font-size: 2.5rem;
  display: block;
  margin-bottom: 0.75rem;
}

.link-card h4 {
  font-size: 1.2rem;
  font-weight: 700;
  margin: 0 0 0.5rem 0;
}

.link-card p {
  font-size: 0.9rem;
  opacity: 0.9;
  margin: 0;
}

.resources-tip {
  background: #fffaf0;
  border-left: 5px solid #ed8936;
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.tip-content {
  display: flex;
  gap: 1.5rem;
  align-items: flex-start;
}

.tip-icon {
  font-size: 3rem;
  flex-shrink: 0;
}

.tip-content h4 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1a202c;
  margin: 0 0 0.5rem 0;
}

.tip-content p {
  color: #4a5568;
  line-height: 1.6;
  margin: 0;
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .resources-grid {
    grid-template-columns: 1fr;
  }
  
  .links-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .tip-content {
    flex-direction: column;
    text-align: center;
  }
}
</style>
