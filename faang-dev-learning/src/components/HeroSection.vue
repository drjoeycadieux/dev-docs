<script setup>
</script>

<template>
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">
        Become a <span class="highlight">FAANG</span> Software Engineer
      </h1>
      <p class="hero-subtitle">
        Your comprehensive learning platform to master coding, algorithms, 
        system design, and ace your technical interviews at top tech companies.
      </p>
      
      <div class="hero-stats">
        <div class="stat-card">
          <div class="stat-number">500+</div>
          <div class="stat-label">Coding Problems</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">50+</div>
          <div class="stat-label">System Design Topics</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">100+</div>
          <div class="stat-label">Interview Questions</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">24/7</div>
          <div class="stat-label">Learning Access</div>
        </div>
      </div>

      <div class="hero-cta">
        <button class="btn-primary">Start Learning Now</button>
        <button class="btn-secondary">View Learning Path</button>
      </div>
    </div>

    <div class="hero-features">
      <div class="feature-card">
        <div class="feature-icon">🎯</div>
        <h3>Structured Learning</h3>
        <p>Follow a curated path from basics to advanced topics</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">💻</div>
        <h3>Hands-on Practice</h3>
        <p>Solve real coding problems with instant feedback</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">📊</div>
        <h3>Track Progress</h3>
        <p>Monitor your improvement with detailed analytics</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🎓</div>
        <h3>Expert Guidance</h3>
        <p>Learn from FAANG engineers and industry experts</p>
      </div>
    </div>
  </section>
</template>

<style scoped>
.hero {
  padding: 4rem 2rem;
  background: linear-gradient(180deg, #f8f9ff 0%, #ffffff 100%);
}

.hero-content {
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  color: #1a202c;
  margin-bottom: 1.5rem;
  line-height: 1.2;
}

.highlight {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-subtitle {
  font-size: 1.25rem;
  color: #4a5568;
  max-width: 700px;
  margin: 0 auto 3rem;
  line-height: 1.6;
}

.hero-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
  margin: 3rem 0;
}

.stat-card {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px);
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  color: #667eea;
  margin-bottom: 0.5rem;
}

.stat-label {
  font-size: 1rem;
  color: #718096;
  font-weight: 500;
}

.hero-cta {
  display: flex;
  gap: 1rem;
  justify-content: center;
  margin-top: 3rem;
}

.btn-primary {
  padding: 1rem 2.5rem;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.btn-secondary {
  padding: 1rem 2.5rem;
  background: white;
  color: #667eea;
  border: 2px solid #667eea;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: #667eea;
  color: white;
  transform: translateY(-2px);
}

.hero-features {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  max-width: 1200px;
  margin: 4rem auto 0;
}

.feature-card {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  text-align: center;
  transition: all 0.3s ease;
}

.feature-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.feature-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.feature-card h3 {
  font-size: 1.25rem;
  color: #1a202c;
  margin-bottom: 0.75rem;
}

.feature-card p {
  color: #718096;
  line-height: 1.5;
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-subtitle {
    font-size: 1.1rem;
  }
  
  .hero-cta {
    flex-direction: column;
  }
  
  .btn-primary,
  .btn-secondary {
    width: 100%;
  }
}
</style>
