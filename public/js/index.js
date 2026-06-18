/* ===== PDPT UGK — Portal Layanan (Clean Modern) ===== */


// ══════════════════════════════════════════════
// ICON MAP — SVG icons per theme/menu
// ══════════════════════════════════════════════

const ICON_MAP = {
  'Web PDPT': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/></svg>',
  'Konversi Nilai': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>',
  'Validasi Data': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="m9 15 2 2 4-4"/></svg>',
  'Akreditasi Nasional': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>',
  'Akreditasi Internasional': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg>',
};

// Default icon if no match
const DEFAULT_ICON = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>';


// ══════════════════════════════════════════════
// RENDER LAYANAN CARDS
// ══════════════════════════════════════════════

const MENUS = window.DB_MENUS || [];
const grid = document.getElementById('layananGrid');

function renderCards(data) {
  if (!data.length) {
    grid.innerHTML = `
      <div class="layanan-empty">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <p>Tidak ada layanan yang ditemukan.</p>
      </div>`;
    return;
  }

  grid.innerHTML = data.map(m => {
    const icon = ICON_MAP[m.name] || DEFAULT_ICON;
    const theme = m.theme || 'blue';
    return `
      <a href="${m.url}" class="layanan-card" id="card-${m.id}">
        <div class="layanan-card-icon theme-${theme}">
          ${icon}
        </div>
        <div class="layanan-card-name">${m.name}</div>
        <div class="layanan-card-desc">${m.desc}</div>
      </a>`;
  }).join('');
}

renderCards(MENUS);



// ══════════════════════════════════════════════
// SEARCH FILTER
// ══════════════════════════════════════════════

const searchInput = document.getElementById('searchInput');
if (searchInput) {
  searchInput.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase().trim();
    if (!q) {
      renderCards(MENUS);
      return;
    }
    const filtered = MENUS.filter(m =>
      m.name.toLowerCase().includes(q) ||
      m.desc.toLowerCase().includes(q)
    );
    renderCards(filtered);
  });
}


// ══════════════════════════════════════════════
// NAVBAR MOBILE TOGGLE
// ══════════════════════════════════════════════

const navToggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');

if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('mobile-open');
  });

  // Close on outside click
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.main-nav')) {
      navLinks.classList.remove('mobile-open');
    }
  });
}


// ══════════════════════════════════════════════
// SMOOTH SCROLL for CTA
// ══════════════════════════════════════════════

const heroCta = document.getElementById('heroCta');
if (heroCta) {
  heroCta.addEventListener('click', (e) => {
    e.preventDefault();
    const target = document.getElementById('layanan');
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
}


// ══════════════════════════════════════════════
// HERO SLIDESHOW LOGIC
// ══════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', () => {
  const slider = document.getElementById('heroSlider');
  if (!slider) return;

  const slides = slider.querySelectorAll('.hero-slide');
  const dots = slider.querySelectorAll('.hero-slider-dot');
  let currentIdx = 0;
  let slideInterval;

  // Handle lazy loading of images
  slides.forEach(slide => {
    const img = slide.querySelector('.hero-slide-img');
    const skeleton = slide.querySelector('.hero-slide-skeleton');
    if (img) {
      if (img.complete) {
        onImageLoad(img, skeleton);
      } else {
        img.addEventListener('load', () => onImageLoad(img, skeleton));
        img.addEventListener('error', () => {
          if (skeleton) skeleton.style.display = 'none';
          img.style.opacity = '1'; // Show fallback/error image
        });
      }
    }
  });

  function onImageLoad(img, skeleton) {
    if (skeleton) {
      skeleton.style.opacity = '0';
      setTimeout(() => {
        skeleton.style.display = 'none';
      }, 500); // Wait for fade out
    }
    img.classList.add('loaded');
  }

  function goToSlide(index) {
    if (slides.length <= 1) return;
    
    // Remove active class from previous
    slides[currentIdx].classList.remove('active');
    if (dots.length > currentIdx) dots[currentIdx].classList.remove('active');

    // Update index
    currentIdx = (index + slides.length) % slides.length;

    // Add active class to current
    slides[currentIdx].classList.add('active');
    if (dots.length > currentIdx) dots[currentIdx].classList.add('active');
  }

  function startAutoplay() {
    if (slides.length <= 1) return;
    stopAutoplay();
    slideInterval = setInterval(() => {
      goToSlide(currentIdx + 1);
    }, 5000); // 5 seconds
  }

  function stopAutoplay() {
    if (slideInterval) {
      clearInterval(slideInterval);
    }
  }

  // Dots click navigation
  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      const idx = parseInt(dot.getAttribute('data-slide'));
      goToSlide(idx);
      startAutoplay(); // Reset timer
    });
  });

  // Start autoplay
  startAutoplay();

  // Pause on hover
  slider.addEventListener('mouseenter', stopAutoplay);
  slider.addEventListener('mouseleave', startAutoplay);
});