<script setup>
</script>

<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h3>🚀 FAANG Dev Learning</h3>
          <p>Your comprehensive platform to master coding and land your dream job at top tech companies.</p>
          <div class="social-links">
            <a href="#" class="social-link">GitHub</a>
            <a href="#" class="social-link">Twitter</a>
            <a href="#" class="social-link">LinkedIn</a>
            <a href="#" class="social-link">Discord</a>
          </div>
        </div>

        <div class="footer-section">
          <h4>Learning Paths</h4>
          <ul>
            <li><a href="#">Beginner Track</a></li>
            <li><a href="#">Intermediate Track</a></li>
            <li><a href="#">Advanced Track</a></li>
            <li><a href="#">System Design</a></li>
            <li><a href="#">Interview Prep</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h4>Resources</h4>
          <ul>
            <li><a href="#">Coding Problems</a></li>
            <li><a href="#">Mock Interviews</a></li>
            <li><a href="#">Study Guides</a></li>
            <li><a href="#">Video Tutorials</a></li>
            <li><a href="#">Books & Articles</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h4>Company</h4>
          <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Success Stories</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2024 FAANG Dev Learning. All rights reserved.</p>
        <div class="footer-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Cookie Policy</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: #1a202c;
  color: #e2e8f0;
  padding: 4rem 2rem 2rem;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

.footer-content {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 3rem;
  margin-bottom: 3rem;
}

.footer-section h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: white;
  margin: 0 0 1rem 0;
}

.footer-section h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: white;
  margin: 0 0 1rem 0;
}

.footer-section p {
  color: #a0aec0;
  line-height: 1.6;
  margin: 0 0 1.5rem 0;
}

.footer-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-section li {
  margin-bottom: 0.75rem;
}

.footer-section a {
  color: #a0aec0;
  text-decoration: none;
  transition: color 0.3s ease;
  font-size: 0.95rem;
}

.footer-section a:hover {
  color: #667eea;
}

.social-links {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.social-link {
  padding: 0.5rem 1rem;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 6px;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.social-link:hover {
  background: #667eea;
  color: white;
}

.footer-bottom {
  border-top: 1px solid #2d3748;
  padding-top: 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.footer-bottom p {
  color: #718096;
  margin: 0;
  font-size: 0.9rem;
}

.footer-links {
  display: flex;
  gap: 2rem;
}

.footer-links a {
  color: #718096;
  text-decoration: none;
  font-size: 0.9rem;
  transition: color 0.3s ease;
}

.footer-links a:hover {
  color: #667eea;
}

@media (max-width: 768px) {
  .footer-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .footer-bottom {
    flex-direction: column;
    text-align: center;
  }
  
  .footer-links {
    gap: 1rem;
  }
}
</style>
