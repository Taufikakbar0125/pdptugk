<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDPT UGK — Universitas Gunung Kidul</title>
  <meta name="description" content="Portal Pangkalan Data Perguruan Tinggi Universitas Gunung Kidul. Layanan akademik terpadu untuk sivitas akademika UGK.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

  <!-- ══════════════════════════════════════════════
       NAVBAR
       ══════════════════════════════════════════════ -->
  <nav class="main-nav" id="mainNav">
    <a href="/" class="main-nav-brand">
      <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK">
      PDPT <span>UGK</span>
    </a>

    <button class="main-nav-toggle" id="navToggle" aria-label="Toggle menu">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>

    <div class="main-nav-links" id="navLinks">
      <a href="/pdpt/home" class="main-nav-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Web PDPT
      </a>
      <a href="/pdpt/buku-info-akademik" class="main-nav-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
        Panduan
      </a>
      <a href="/pdpt/tentang" class="main-nav-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        Tentang
      </a>
    </div>

  </nav>

  <!-- ══════════════════════════════════════════════
       HERO SECTION
       ══════════════════════════════════════════════ -->
  <section class="hero" id="hero">
    <!-- Hero Slider as Background -->
    <div class="hero-slider" id="heroSlider">
      @forelse($slides as $index => $slide)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
          <div class="hero-slide-skeleton"></div>
          <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->title ?: 'Hero Slide ' . ($index + 1) }}" class="hero-slide-img" loading="lazy">
          @if($slide->title)
            <div class="hero-slide-caption">
              <span>{{ $slide->title }}</span>
            </div>
          @endif
        </div>
      @empty
        <div class="hero-slide active" data-index="0">
          <div class="hero-slide-skeleton"></div>
          <img src="{{ asset('images/default_hero_slide.png') }}" alt="PDPT UGK" class="hero-slide-img" loading="lazy">
          <div class="hero-slide-caption">
            <span>Selamat Datang di PDPT UGK</span>
          </div>
        </div>
      @endforelse

      @if($slides->count() > 1)
        <div class="hero-slider-dots">
          @foreach($slides as $index => $slide)
            <button class="hero-slider-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
          @endforeach
        </div>
      @endif
    </div>

    <div class="hero-pattern"></div>
    <div class="hero-content">
      <div class="hero-text">
        <div class="hero-badge">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/></svg>
          Universitas Gunung Kidul
        </div>
        <h1 class="hero-title">
          Portal Layanan Satu Data<br><strong>Sistem Informasi Universitas Gunung Kidul</strong>
        </h1>
        <p class="hero-desc">
          PDPT UGK adalah portal layanan satu pintu untuk semua layanan akademik
          di Universitas Gunung Kidul yang bertujuan untuk memudahkan layanan dan
          mewujudkan satu data terintegrasi perguruan tinggi.
        </p>
        <a href="#layanan" class="hero-cta" id="heroCta">
          Lihat Layanan
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </a>
      </div>
    </div>

    <!-- Animated Wave divider -->
    <div class="hero-wave">
      {{-- Layer 1 (belakang, paling transparan) --}}
      <div class="hero-wave-layer hero-wave-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,60 C240,80 480,20 720,50 C960,80 1200,20 1440,60 L1440,100 L0,100 Z" fill="rgba(245,247,251,0.35)"/></svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,60 C240,80 480,20 720,50 C960,80 1200,20 1440,60 L1440,100 L0,100 Z" fill="rgba(245,247,251,0.35)"/></svg>
      </div>
      {{-- Layer 2 (tengah, semi transparan) --}}
      <div class="hero-wave-layer hero-wave-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,40 C240,10 480,70 720,40 C960,10 1200,70 1440,40 L1440,100 L0,100 Z" fill="rgba(245,247,251,0.55)"/></svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,40 C240,10 480,70 720,40 C960,10 1200,70 1440,40 L1440,100 L0,100 Z" fill="rgba(245,247,251,0.55)"/></svg>
      </div>
      {{-- Layer 3 (depan, solid — menyatu dengan background section bawah) --}}
      <div class="hero-wave-layer hero-wave-3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,50 C240,70 480,30 720,55 C960,75 1200,25 1440,50 L1440,100 L0,100 Z" fill="#f5f7fb"/></svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,50 C240,70 480,30 720,55 C960,75 1200,25 1440,50 L1440,100 L0,100 Z" fill="#f5f7fb"/></svg>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════════════
       LAYANAN SECTION
       ══════════════════════════════════════════════ -->
  <section class="layanan" id="layanan">
    <div class="layanan-header">
      <h2 class="layanan-title">Layanan</h2>
      <p class="layanan-subtitle">Silahkan pilih layanan yang anda butuhkan</p>
    </div>

    <div class="layanan-search">
      <input type="text" id="searchInput" placeholder="Cari layanan...">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    </div>

    <div class="layanan-grid" id="layananGrid">
      <!-- JavaScript will render the cards here -->
    </div>
  </section>

  <!-- ══════════════════════════════════════════════
       FOOTER
       ══════════════════════════════════════════════ -->
  <footer class="main-footer">
    <div class="footer-content">
      <div class="footer-brand">
        <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK" class="footer-brand-logo">
        <div>
          <div class="footer-brand-name">PDPT UGK</div>
          <div class="footer-brand-org">Universitas Gunung Kidul</div>
          <div class="footer-contact-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Jl. KH. Agus Salim No. 17, Gunung Kidul, DIY
          </div>
          <div class="footer-contact-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            (0274) 391110
          </div>
        </div>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">Tentang PDPT UGK</div>
        <p>Pangkalan Data Perguruan Tinggi (PDPT) Universitas Gunung Kidul adalah pusat data terintegrasi yang menyajikan informasi akademik dan kelembagaan secara real-time.</p>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">Bantuan & Tautan</div>
        <div class="footer-links">
          <a href="/pdpt/buku-info-akademik" class="footer-link">Panduan Pengguna</a>
          <a href="/pdpt/tentang" class="footer-link">Tentang Portal</a>
          <a href="https://ugk.ac.id" target="_blank" class="footer-link">Website UGK ↗</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div>&copy; {{ date('Y') }} Universitas Gunung Kidul. All rights reserved.</div>
      <div class="footer-values">PDPT UGK &middot; Satu Data Indonesia</div>
    </div>
  </footer>

  <script>
    window.DB_MENUS = @json($menus);
  </script>
  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>