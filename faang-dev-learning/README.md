# 🚀 FAANG Dev Learning

A comprehensive Vue.js web application designed to help aspiring software engineers prepare for technical interviews at FAANG (Facebook, Amazon, Apple, Netflix, Google) and other top tech companies.

## Features

### 🏠 Home Page
- Hero section with compelling statistics
- Feature cards highlighting key benefits
- Call-to-action buttons to get started

### 🗺️ Learning Path
- 5-stage structured learning journey:
  1. **Foundation** - Programming basics, data structures, algorithms
  2. **Core Competency** - Advanced DSA, OOP, databases
  3. **Advanced Topics** - Complex algorithms, system design basics
  4. **Interview Prep** - LeetCode practice, mock interviews
  5. **FAANG Ready** - Company-specific prep, negotiation skills

### 📚 Topics
- Interactive category tabs for different subject areas:
  - Data Structures (Arrays, Trees, Graphs, etc.)
  - Algorithms (Sorting, Searching, DP, etc.)
  - Dynamic Programming (1D, 2D, advanced patterns)
  - System Design (Load balancing, caching, microservices)
- Difficulty badges (Easy, Medium, Hard)
- Progress tracking

### 🔗 Resources
- Curated list of learning materials:
  - Online platforms (LeetCode, HackerRank, Codeforces)
  - Books (CTCI, CLRS, Clean Code)
  - Video courses (Coursera, CS50, YouTube)
  - Mock interview platforms
  - Communities and forums

### 💼 Interview Preparation
- Detailed guides for different interview types:
  - Coding Interviews
  - System Design
  - Behavioral Interviews
  - Technical Phone Screens
- Success tips for each interview type
- Preparation timeline with actionable tasks
- Mock interview booking CTA

## Tech Stack

- **Vue.js 3** - Progressive JavaScript framework with Composition API
- **Vite** - Next-generation frontend build tool
- **CSS3** - Modern styling with gradients, animations, and responsive design
- **JavaScript (ES6+)** - Modern JavaScript features

## Getting Started

### Prerequisites
- Node.js (v18 or higher recommended)
- npm or yarn

### Installation

```bash
# Navigate to the project directory
cd faang-dev-learning

# Install dependencies
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

### Development Server

The development server runs on `http://localhost:5173` by default. You can access it from any device on your network.

## Project Structure

```
faang-dev-learning/
├── src/
│   ├── components/
│   │   ├── AppHeader.vue       # Navigation header
│   │   ├── HeroSection.vue     # Landing page hero
│   │   ├── LearningPath.vue    # Learning stages timeline
│   │   ├── TopicCard.vue       # Topic categories grid
│   │   ├── ResourcesSection.vue # Resource links
│   │   ├── InterviewPrep.vue   # Interview preparation guide
│   │   └── Footer.vue          # Site footer
│   ├── assets/                  # Static assets
│   ├── App.vue                 # Main app component
│   ├── main.js                 # App entry point
│   └── style.css               # Global styles
├── index.html                   # HTML template
├── package.json                 # Project dependencies
└── vite.config.js              # Vite configuration
```

## Key Features

- ✅ **Responsive Design** - Works seamlessly on desktop, tablet, and mobile
- ✅ **Modern UI/UX** - Beautiful gradients, smooth animations, and intuitive navigation
- ✅ **Component-Based Architecture** - Reusable Vue components
- ✅ **Interactive Elements** - Tab switching, expandable sections, hover effects
- ✅ **Performance Optimized** - Fast loading with Vite's optimized build

## Customization

You can easily customize:
- Color schemes in component styles
- Content in each section
- Additional learning resources
- Interview tips and timelines

## License

MIT License - feel free to use this project for learning or commercial purposes.

## Contributing

Contributions are welcome! Feel free to submit issues or pull requests.

---

Built with ❤️ using Vue.js 3 and Vite
