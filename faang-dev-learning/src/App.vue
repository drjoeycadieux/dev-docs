<script setup>
import { computed, onBeforeUnmount, ref } from 'vue'

const loadStoredUser = () => {
  try {
    const storedUser = JSON.parse(localStorage.getItem('learnloop-user') || 'null')
    return storedUser?.email && storedUser?.name ? storedUser : null
  } catch {
    localStorage.removeItem('learnloop-user')
    return null
  }
}

const currentUser = ref(loadStoredUser())
const videos = ref(JSON.parse(localStorage.getItem('learnloop-videos') || '[]'))
const activeView = ref('library')
const authMode = ref('login')
const authOpen = ref(!currentUser.value)
const authError = ref('')
const authLoading = ref(false)
const authForm = ref({ name: '', email: '', password: '' })
const uploadForm = ref({ title: '', description: '', category: 'Frontend', file: null })
const uploadError = ref('')
const selectedVideo = ref(null)
const search = ref('')
const fileInput = ref(null)
const objectUrls = []
const maxVideoSize = 4 * 1024 * 1024 * 1024

const demoVideos = [
  { id: 'demo-1', title: 'Build your first React component', description: 'A calm walkthrough of props, state, and composition.', category: 'Frontend', author: 'Maya Chen', duration: '18 min', accent: 'coral' },
  { id: 'demo-2', title: 'The system design interview map', description: 'A practical framework for thinking through architecture under pressure.', category: 'System design', author: 'Jordan Lee', duration: '32 min', accent: 'blue' },
  { id: 'demo-3', title: 'SQL joins without the headache', description: 'Make relational data feel visual with three useful mental models.', category: 'Data', author: 'Sam Rivera', duration: '12 min', accent: 'yellow' }
]

const allVideos = computed(() => [...videos.value, ...demoVideos])
const filteredVideos = computed(() => allVideos.value.filter((video) => {
  const query = search.value.toLowerCase()
  return !query || `${video.title} ${video.description} ${video.category} ${video.author}`.toLowerCase().includes(query)
}))
const myVideos = computed(() => videos.value.filter((video) => video.owner === currentUser.value?.email))

const persist = () => {
  localStorage.setItem('learnloop-videos', JSON.stringify(videos.value))
  if (currentUser.value) {
    localStorage.setItem('learnloop-user', JSON.stringify(currentUser.value))
  }
}

const submitAuth = async () => {
  authError.value = ''
  authLoading.value = true
  const email = authForm.value.email.trim().toLowerCase()
  if (!email || !authForm.value.password || (authMode.value === 'signup' && !authForm.value.name.trim())) {
    authError.value = 'Please complete every required field.'
    authLoading.value = false
    return
  }
  const endpoint = authMode.value === 'login' ? '/api/auth-login.php' : '/api/auth-register.php'
  try {
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name: authForm.value.name.trim(), email, password: authForm.value.password })
    })
    const responseText = await response.text()
    let data
    try {
      data = JSON.parse(responseText)
    } catch {
      throw new Error(`Authentication endpoint returned an invalid response (HTTP ${response.status})`)
    }
    if (!response.ok || !data.success) throw new Error(data.message || 'Authentication failed')
    currentUser.value = data.user
    authOpen.value = false
    authForm.value = { name: '', email: '', password: '' }
    persist()
  } catch (error) {
    authError.value = error instanceof TypeError
      ? 'Unable to reach the authentication service.'
      : error.message
  } finally {
    authLoading.value = false
  }
}

const signOut = () => {
  currentUser.value = null
  authOpen.value = true
  authMode.value = 'login'
  localStorage.removeItem('learnloop-user')
}

const selectFile = (event) => {
  const file = event.target.files[0]
  uploadError.value = ''
  if (file && !file.type.startsWith('video/')) {
    uploadError.value = 'Please choose a video file.'
    return
  }
  if (file && file.size > maxVideoSize) {
    uploadError.value = 'Videos must be 4 GB or smaller.'
    return
  }
  uploadForm.value.file = file || null
}

const publishVideo = () => {
  uploadError.value = ''
  if (!uploadForm.value.title.trim() || !uploadForm.value.file) {
    uploadError.value = 'Add a title and choose a video before publishing.'
    return
  }
  const video = {
    id: `video-${Date.now()}`,
    title: uploadForm.value.title.trim(),
    description: uploadForm.value.description.trim() || 'A new lesson from the LearnLoop community.',
    category: uploadForm.value.category,
    author: currentUser.value.name,
    owner: currentUser.value.email,
    duration: 'New lesson',
    accent: 'green',
    fileName: uploadForm.value.file.name,
    url: URL.createObjectURL(uploadForm.value.file)
  }
  objectUrls.push(video.url)
  videos.value.unshift(video)
  persist()
  uploadForm.value = { title: '', description: '', category: 'Frontend', file: null }
  if (fileInput.value) fileInput.value.value = ''
  activeView.value = 'library'
}

const deleteVideo = (video) => {
  videos.value = videos.value.filter((item) => item.id !== video.id)
  if (video.url) URL.revokeObjectURL(video.url)
  persist()
}

const openVideo = (video) => { selectedVideo.value = video }

onBeforeUnmount(() => objectUrls.forEach((url) => URL.revokeObjectURL(url)))
</script>

<template>
  <div class="platform-shell">
    <header class="platform-header">
      <a class="brand" href="#" @click.prevent="activeView = 'library'"><span class="brand-mark">◒</span> learnloop</a>
      <nav class="main-nav" aria-label="Main navigation">
        <button :class="{ active: activeView === 'library' }" @click="activeView = 'library'">Explore</button>
        <button :class="{ active: activeView === 'my-videos' }" @click="activeView = 'my-videos'">My videos <span v-if="myVideos.length" class="nav-count">{{ myVideos.length }}</span></button>
      </nav>
      <div class="header-actions">
        <button class="upload-button" @click="activeView = 'upload'"><span>＋</span> Upload lesson</button>
        <button class="avatar" :aria-label="`Account for ${currentUser?.name}`" @click="signOut">{{ currentUser?.name?.charAt(0).toUpperCase() }}</button>
      </div>
    </header>

    <main class="content-wrap">
      <section v-if="activeView === 'library'" class="library-view">
        <div class="intro-row">
          <div><p class="eyebrow">THE COMMUNITY CLASSROOM</p><h1>Learn out loud.</h1><p class="intro-copy">Short, honest lessons from people building things. Watch a new point of view, then share what you know.</p></div>
          <div class="member-note"><span class="live-dot"></span><strong>{{ allVideos.length }} lessons</strong><small>shared by members</small></div>
        </div>
        <div class="toolbar"><div class="search-box"><span>⌕</span><input v-model="search" type="search" placeholder="Search lessons, topics, people" /></div><div class="filter-pills"><button class="filter active">All lessons</button><button class="filter">Following</button><button class="filter">Newest</button></div></div>
        <div class="video-grid"><article v-for="video in filteredVideos" :key="video.id" class="video-card" @click="openVideo(video)"><div :class="['thumbnail', video.accent]"><span class="play-button">▶</span><span class="duration">{{ video.duration }}</span><span class="topic-label">{{ video.category }}</span></div><div class="video-info"><div class="video-author"><span class="mini-avatar">{{ video.author.charAt(0) }}</span><span>{{ video.author }}</span></div><h2>{{ video.title }}</h2><p>{{ video.description }}</p><div class="video-meta"><span>Today</span><span>♡</span></div></div></article></div>
        <p v-if="!filteredVideos.length" class="empty-state">No lessons match “{{ search }}”. Try another search.</p>
      </section>

      <section v-else-if="activeView === 'upload'" class="upload-view"><button class="back-link" @click="activeView = 'library'">← Back to lessons</button><div class="upload-heading"><p class="eyebrow">SHARE YOUR KNOWLEDGE</p><h1>Publish a lesson.</h1><p>Give someone a clearer path through the thing you just figured out.</p></div><div class="upload-layout"><form class="upload-form" @submit.prevent="publishVideo"><label>Lesson title<input v-model="uploadForm.title" type="text" placeholder="e.g. Build your first API" maxlength="80" /></label><label>Description<textarea v-model="uploadForm.description" rows="4" placeholder="What will people take away?"></textarea></label><label>Topic<select v-model="uploadForm.category"><option>Frontend</option><option>Backend</option><option>Data</option><option>System design</option><option>Career</option></select></label><label class="file-picker"><span class="upload-icon">↑</span><strong>{{ uploadForm.file ? uploadForm.file.name : 'Choose a video file' }}</strong><small>MP4, WebM or MOV · up to 4 GB</small><input ref="fileInput" type="file" accept="video/*" @change="selectFile" /></label><p v-if="uploadError" class="form-error">{{ uploadError }}</p><button class="publish-button" type="submit">Publish lesson <span>→</span></button></form><aside class="upload-aside"><span class="aside-number">01</span><h2>Make it useful.</h2><p>Show the real process. A focused 10-minute lesson beats an hour of polished slides.</p><span class="aside-number">02</span><h2>Keep it human.</h2><p>Share the decisions, mistakes, and shortcuts you wish you had at the start.</p></aside></div></section>

      <section v-else class="my-videos-view"><div class="intro-row"><div><p class="eyebrow">YOUR LIBRARY</p><h1>Your lessons.</h1><p class="intro-copy">Keep building your teaching practice.</p></div><button class="upload-button large" @click="activeView = 'upload'">＋ Upload lesson</button></div><div v-if="myVideos.length" class="video-grid"><article v-for="video in myVideos" :key="video.id" class="video-card"><div :class="['thumbnail', video.accent]" @click="openVideo(video)"><span class="play-button">▶</span><span class="duration">{{ video.duration }}</span></div><div class="video-info"><div class="video-author"><span class="mini-avatar">{{ video.author.charAt(0) }}</span><span>Published by you</span></div><h2>{{ video.title }}</h2><p>{{ video.description }}</p><button class="delete-link" @click.stop="deleteVideo(video)">Remove lesson</button></div></article></div><div v-else class="empty-panel"><span>◌</span><h2>Your first lesson is waiting.</h2><p>Share a useful idea with the community and it will appear here.</p><button class="publish-button" @click="activeView = 'upload'">Upload your first lesson <span>→</span></button></div></section>
    </main>

    <div v-if="authOpen" class="modal-backdrop"><section class="auth-modal"><div class="auth-copy"><span class="brand-mark">◒</span><p class="eyebrow">WELCOME TO LEARNLOOP</p><h1>Make learning a shared practice.</h1><p>Watch honest lessons from your peers, then pass the insight along.</p></div><form class="auth-form" @submit.prevent="submitAuth"><div class="auth-tabs"><button type="button" :class="{ active: authMode === 'login' }" @click="authMode = 'login'">Sign in</button><button type="button" :class="{ active: authMode === 'signup' }" @click="authMode = 'signup'">Create account</button></div><label v-if="authMode === 'signup'">Your name<input v-model="authForm.name" type="text" placeholder="Alex Morgan" /></label><label>Email address<input v-model="authForm.email" type="email" placeholder="you@example.com" /></label><label>Password<input v-model="authForm.password" type="password" placeholder="••••••••" /></label><p v-if="authError" class="form-error">{{ authError }}</p><button class="publish-button" type="submit" :disabled="authLoading">{{ authLoading ? 'Connecting...' : (authMode === 'login' ? 'Enter LearnLoop' : 'Create my account') }} <span>→</span></button><small class="prototype-note">Your account is securely stored in MySQL. Video file storage will be connected separately.</small></form></section></div>
    <div v-if="selectedVideo" class="modal-backdrop" @click.self="selectedVideo = null"><section class="video-modal"><button class="close-button" aria-label="Close video" @click="selectedVideo = null">×</button><video v-if="selectedVideo.url" :src="selectedVideo.url" controls autoplay></video><div v-else class="video-placeholder"><span class="play-button">▶</span><p>Demo preview</p></div><div class="modal-video-info"><p class="eyebrow">{{ selectedVideo.category }} · {{ selectedVideo.duration }}</p><h2>{{ selectedVideo.title }}</h2><p>{{ selectedVideo.description }}</p><div class="video-author"><span class="mini-avatar">{{ selectedVideo.author.charAt(0) }}</span><span>Shared by {{ selectedVideo.author }}</span></div></div></section></div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap');

.platform-shell { min-height: 100vh; color: #202321; background: #f7f6f2; font-family: 'DM Sans', sans-serif; }
.platform-header { height: 76px; padding: 0 5vw; display: flex; align-items: center; gap: 4rem; border-bottom: 1px solid #dfded8; background: rgba(247,246,242,.94); position: sticky; top: 0; z-index: 10; backdrop-filter: blur(14px); }
.brand { color: #202321; display: flex; align-items: center; gap: .55rem; font: 700 1.35rem 'Space Grotesk', sans-serif; letter-spacing: -.05em; }
.brand-mark { color: #ef634f; font-size: 2rem; line-height: 1; }
.main-nav { display: flex; gap: 1.8rem; height: 100%; }
.main-nav button, .filter, .auth-tabs button { color: #777a75; border: 0; background: transparent; cursor: pointer; font: 600 .88rem 'DM Sans', sans-serif; }
.main-nav button { padding: 2px 0; position: relative; }
.main-nav button.active { color: #202321; }
.main-nav button.active::after { content: ''; height: 2px; background: #ef634f; position: absolute; bottom: -1px; left: 0; right: 0; }
.nav-count { color: #ef634f; margin-left: .3rem; }
.header-actions { margin-left: auto; display: flex; align-items: center; gap: 1rem; }
.upload-button, .publish-button { border: 0; cursor: pointer; color: #fff; background: #202321; border-radius: 4px; padding: .75rem 1.1rem; font: 600 .84rem 'DM Sans', sans-serif; transition: transform .2s, background .2s; }
.upload-button:hover, .publish-button:hover { background: #ef634f; transform: translateY(-2px); }
.upload-button span { color: #ef634f; font-size: 1.1rem; margin-right: .25rem; }
.avatar, .mini-avatar { display: grid; place-items: center; border: 0; border-radius: 50%; color: #202321; background: #f1c45b; font-weight: 700; cursor: pointer; }
.avatar { width: 36px; height: 36px; }
.content-wrap { max-width: 1280px; margin: 0 auto; padding: 5.5rem 5vw 8rem; }
.intro-row { display: flex; justify-content: space-between; align-items: end; gap: 3rem; }
.eyebrow { color: #ef634f; font: 700 .7rem 'DM Sans', sans-serif; letter-spacing: .13em; margin: 0 0 1rem; }
h1, h2 { font-family: 'Space Grotesk', sans-serif; color: #202321; letter-spacing: -.06em; }
h1 { max-width: 620px; margin: 0 0 1rem; font-size: clamp(3rem, 6vw, 5.7rem); line-height: .94; }
.intro-copy { color: #777a75; max-width: 490px; font-size: 1.05rem; line-height: 1.65; }
.member-note { min-width: 120px; border-left: 1px solid #c9c8c1; padding-left: 1.1rem; display: grid; gap: .2rem; }
.member-note strong { font: 600 1.15rem 'Space Grotesk', sans-serif; }.member-note small { color: #898b86; }.live-dot { width: 7px; height: 7px; border-radius: 50%; background: #5da77c; margin-bottom: .25rem; }
.toolbar { display: flex; align-items: center; justify-content: space-between; gap: 2rem; margin: 4.5rem 0 2rem; padding-bottom: 1rem; border-bottom: 1px solid #dfded8; }
.search-box { display: flex; gap: .75rem; align-items: center; color: #898b86; width: min(360px, 100%); border-bottom: 1px solid #c9c8c1; padding: .55rem 0; }.search-box span { font-size: 1.6rem; line-height: 1; }.search-box input { width: 100%; border: 0; outline: 0; color: #202321; background: transparent; font: .9rem 'DM Sans', sans-serif; }
.filter-pills { display: flex; gap: 1.4rem; }.filter.active { color: #ef634f; }
.video-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.7rem 1.5rem; }.video-card { cursor: pointer; min-width: 0; }.thumbnail { aspect-ratio: 1.6; position: relative; display: grid; place-items: center; overflow: hidden; transition: transform .25s; }.video-card:hover .thumbnail { transform: translateY(-4px); }.thumbnail::after { content: ''; position: absolute; inset: 0; opacity: .16; background: repeating-linear-gradient(120deg, transparent 0 19px, rgba(255,255,255,.7) 20px 21px); }.thumbnail.coral { background: #ee947d; }.thumbnail.blue { background: #91b8c3; }.thumbnail.yellow { background: #e8c45d; }.thumbnail.green { background: #8db99b; }.play-button { width: 45px; height: 45px; display: grid; place-items: center; padding-left: 2px; border-radius: 50%; color: #fff; background: rgba(32,35,33,.86); font-size: .9rem; position: relative; z-index: 1; }.duration, .topic-label { position: absolute; z-index: 1; bottom: .8rem; padding: .25rem .45rem; color: #fff; background: rgba(32,35,33,.78); font-size: .68rem; }.duration { left: .8rem; }.topic-label { right: .8rem; }
.video-info { padding-top: 1rem; }.video-author { display: flex; gap: .55rem; align-items: center; color: #777a75; font-size: .78rem; }.mini-avatar { width: 24px; height: 24px; font-size: .7rem; }.video-info h2 { font-size: 1.3rem; line-height: 1.1; margin: .8rem 0 .55rem; }.video-info p { color: #777a75; font-size: .84rem; line-height: 1.5; margin: 0; }.video-meta { color: #9a9b96; display: flex; justify-content: space-between; font-size: .75rem; padding-top: .9rem; margin-top: .9rem; border-top: 1px solid #dfded8; }.empty-state { color: #777a75; padding: 3rem 0; }
.upload-view { max-width: 1000px; margin: 0 auto; }.back-link { border: 0; background: transparent; color: #777a75; cursor: pointer; padding: 0; font: .85rem 'DM Sans', sans-serif; }.upload-heading { margin: 4rem 0 3rem; }.upload-heading > p:last-child { color: #777a75; }.upload-layout { display: grid; grid-template-columns: minmax(0, 1.25fr) .75fr; gap: 6rem; }.upload-form { display: grid; gap: 1.4rem; }.upload-form label, .auth-form label { display: grid; gap: .45rem; color: #777a75; font-size: .78rem; font-weight: 600; }.upload-form input, .upload-form textarea, .upload-form select, .auth-form input { box-sizing: border-box; width: 100%; border: 1px solid #cfcec7; border-radius: 3px; padding: .9rem; color: #202321; background: #fff; outline: 0; font: .9rem 'DM Sans', sans-serif; }.upload-form textarea { resize: vertical; }.upload-form input:focus, .upload-form textarea:focus, .upload-form select:focus, .auth-form input:focus { border-color: #ef634f; }.file-picker { min-height: 150px; place-items: center; align-content: center; border: 1px dashed #c2c1bb; background: #f0efe9; text-align: center; cursor: pointer; }.file-picker strong { color: #202321; }.file-picker small { color: #9a9b96; font-weight: 400; }.file-picker input { display: none; }.upload-icon { color: #ef634f; font-size: 2rem; }.publish-button { justify-self: start; }.publish-button span { margin-left: 1rem; color: #f1c45b; }.upload-aside { border-top: 2px solid #202321; padding-top: 1.3rem; }.aside-number { color: #ef634f; font: 600 .75rem 'Space Grotesk', sans-serif; }.upload-aside h2 { font-size: 1.5rem; margin: .45rem 0 .45rem; }.upload-aside p { color: #777a75; font-size: .9rem; line-height: 1.6; margin: 0 0 3.5rem; }
.large { padding: .9rem 1.3rem; }.empty-panel { max-width: 520px; padding: 4rem 0; }.empty-panel > span { color: #ef634f; font-size: 3rem; }.empty-panel h2 { font-size: 2rem; margin: .5rem 0; }.empty-panel p { color: #777a75; margin-bottom: 2rem; }.delete-link { color: #ef634f; border: 0; background: transparent; padding: .7rem 0 0; cursor: pointer; font: 600 .78rem 'DM Sans', sans-serif; }
.modal-backdrop { position: fixed; inset: 0; display: grid; place-items: center; padding: 1.5rem; z-index: 20; background: rgba(32,35,33,.68); }.auth-modal { width: min(880px, 100%); display: grid; grid-template-columns: 1fr 1fr; background: #f7f6f2; }.auth-copy { min-height: 470px; padding: 3rem; display: flex; flex-direction: column; justify-content: end; background: #e8c45d; }.auth-copy .brand-mark { position: absolute; align-self: start; }.auth-copy h1 { font-size: clamp(2.4rem, 5vw, 4rem); margin-bottom: 1rem; }.auth-copy p:last-child { max-width: 300px; line-height: 1.6; }.auth-form { padding: 3rem; display: grid; align-content: center; gap: 1.2rem; }.auth-tabs { display: flex; gap: 1.5rem; border-bottom: 1px solid #cfcec7; margin-bottom: .8rem; }.auth-tabs button { padding: .7rem 0; }.auth-tabs button.active { color: #202321; border-bottom: 2px solid #ef634f; }.form-error { color: #b84435; background: #fae5e0; padding: .6rem .75rem; margin: 0; font-size: .8rem; }.prototype-note { color: #9a9b96; line-height: 1.5; font-size: .7rem; }.video-modal { width: min(850px, 100%); position: relative; background: #f7f6f2; }.video-modal video, .video-placeholder { display: block; width: 100%; aspect-ratio: 16 / 9; background: #202321; }.video-placeholder { color: #fff; display: grid; place-items: center; align-content: center; gap: .5rem; }.video-placeholder p { margin: 0; }.close-button { position: absolute; right: .7rem; top: .4rem; z-index: 1; border: 0; background: transparent; color: #fff; font-size: 2rem; cursor: pointer; }.modal-video-info { padding: 1.5rem 2rem 2rem; }.modal-video-info h2 { margin: 0 0 .6rem; font-size: 1.8rem; }.modal-video-info > p:not(.eyebrow) { color: #777a75; }
@media (max-width: 760px) { .platform-header { gap: 1.5rem; padding: 0 1.2rem; }.main-nav { gap: 1rem; }.header-actions .upload-button { font-size: 0; padding: .75rem; }.header-actions .upload-button span { font-size: 1.3rem; margin: 0; }.content-wrap { padding: 3.5rem 1.2rem 5rem; }.intro-row, .toolbar { align-items: start; flex-direction: column; gap: 1.5rem; }.toolbar { margin-top: 2rem; width: 100%; }.search-box { width: 100%; }.video-grid { grid-template-columns: 1fr; gap: 2.5rem; }.upload-layout, .auth-modal { grid-template-columns: 1fr; }.upload-aside { display: none; }.auth-copy { min-height: auto; padding: 2rem; }.auth-copy h1 { margin-top: 4rem; }.auth-form { padding: 2rem; }.filter-pills { gap: .8rem; }.member-note { border-left: 0; padding-left: 0; } }
</style>

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
