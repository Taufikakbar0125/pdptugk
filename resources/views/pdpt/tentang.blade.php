<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang PDPT — PDPT UGK</title>
  <meta name="description" content="Tentang Pangkalan Data Perguruan Tinggi Universitas Gunung Kidul (PDPT UGK)">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
  <style>
    /* ── Tentang Page Styles ── */
    .about-hero {
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(124, 58, 237, 0.04));
      border: 1px solid var(--surface-border);
      border-radius: var(--radius-lg);
      padding: 40px;
      margin-bottom: 32px;
      display: flex;
      align-items: center;
      gap: 32px;
      animation: fadeInUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .about-hero-icon {
      width: 80px;
      height: 80px;
      flex-shrink: 0;
      border-radius: 20px;
      background: linear-gradient(135deg, #2563eb, #7c3aed);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #white;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.25);
    }

    .about-hero-icon svg {
      color: #fff;
    }

    .about-hero-text h2 {
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--text-dark);
      margin-bottom: 10px;
    }

    .about-hero-text p {
      font-size: 0.95rem;
      color: var(--text-body);
      line-height: 1.6;
      max-width: 800px;
    }

    /* Grid Layout for content cards */
    .about-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 28px;
      margin-bottom: 32px;
    }

    .about-card {
      background: var(--bg-card);
      border: 1px solid var(--surface-border);
      border-radius: var(--radius-lg);
      padding: 32px;
      box-shadow: var(--shadow-sm);
      animation: fadeInUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
      display: flex;
      flex-direction: column;
      gap: 16px;
      transition: transform 0.25s, box-shadow 0.25s;
    }

    .about-card:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-lg);
    }

    .about-card-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: var(--text-dark);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .about-card-title-icon {
      width: 36px;
      height: 36px;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(37, 99, 235, 0.08);
      color: var(--primary);
    }

    .about-card-content p {
      font-size: 0.88rem;
      color: var(--text-body);
      line-height: 1.6;
    }

    .about-card-content ul {
      margin-top: 10px;
      padding-left: 20px;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .about-card-content li {
      font-size: 0.88rem;
      color: var(--text-body);
      line-height: 1.5;
    }

    /* Full-width Features Section */
    .features-section {
      background: var(--bg-card);
      border: 1px solid var(--surface-border);
      border-radius: var(--radius-lg);
      padding: 32px;
      box-shadow: var(--shadow-sm);
      animation: fadeInUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.2s both;
      margin-bottom: 12px;
    }

    .features-header {
      font-size: 1.15rem;
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
      border-bottom: 1px solid var(--surface-border);
      padding-bottom: 16px;
    }

    .features-header-icon {
      width: 36px;
      height: 36px;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(16, 185, 129, 0.08);
      color: var(--accent-emerald);
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .feature-item {
      display: flex;
      flex-direction: column;
      gap: 10px;
      padding: 16px;
      border-radius: var(--radius-md);
      background: rgba(241, 245, 249, 0.4);
      border: 1px solid transparent;
      transition: background 0.2s, border-color 0.2s;
    }

    .feature-item:hover {
      background: var(--white);
      border-color: var(--surface-border);
      box-shadow: var(--shadow-sm);
    }

    .feature-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--white);
      box-shadow: var(--shadow-sm);
      color: var(--primary);
    }

    .feature-title {
      font-size: 0.88rem;
      font-weight: 600;
      color: var(--text-dark);
    }

    .feature-desc {
      font-size: 0.78rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    /* Responsive styling */
    @media(max-width: 1024px) {
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media(max-width: 768px) {
      .about-hero {
        flex-direction: column;
        text-align: center;
        padding: 24px;
      }
      .about-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }
      .features-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'tentang'])

  <!-- ── BREADCRUMB ── -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Tentang</h1>
      <span class="breadcrumb-sub">Portal PDPT UGK</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <a href="/pdpt/home">Home</a>
      <span>›</span>
      <span>Tentang</span>
    </div>
  </div>

  <!-- ── MAIN CONTENT ── -->
  <main class="main-content">

    <!-- Hero Section -->
    <div class="about-hero" id="aboutHero">
      <div class="about-hero-icon">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="16" x2="12" y2="12"/>
          <line x1="12" y1="8" x2="12.01" y2="8"/>
        </svg>
      </div>
      <div class="about-hero-text">
        <h2>Tentang PDPT UGK</h2>
        <p>Pangkalan Data Perguruan Tinggi Universitas Gunung Kidul (PDPT UGK) merupakan portal informasi terintegrasi yang berfungsi sebagai wadah pengelolaan data, statistik, dan akreditasi universitas. Portal ini menyajikan data akademik yang akuntabel dan transparan guna mendukung pengambilan keputusan dan penjaminan mutu di lingkungan UGK.</p>
      </div>
    </div>

    <!-- Grid: Visi & Misi & Goals -->
    <div class="about-grid">
      <!-- Card: Visi & Misi -->
      <div class="about-card" id="cardVisiMisi">
        <div class="about-card-title">
          <div class="about-card-title-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg>
          </div>
          Visi & Misi PDPT UGK
        </div>
        <div class="about-card-content">
          <p><strong>Visi:</strong> Menjadi pusat integrasi data perguruan tinggi yang andal, transparan, dan berdaya guna tinggi dalam menunjang UGK menuju universitas unggul.</p>
          <p style="margin-top: 10px;"><strong>Misi:</strong></p>
          <ul>
            <li>Mengintegrasikan seluruh data administrasi akademik, kepegawaian, dan mutu program studi.</li>
            <li>Menyajikan informasi data yang mutakhir dan akurat untuk mempermudah akreditasi institusi maupun prodi.</li>
            <li>Menyediakan layanan akses informasi data universitas yang aman dan nyaman bagi seluruh sivitas akademika.</li>
          </ul>
        </div>
      </div>

      <!-- Card: Tujuan Portal -->
      <div class="about-card" id="cardTujuan">
        <div class="about-card-title">
          <div class="about-card-title-icon" style="background:rgba(124, 58, 237, 0.08);color:#7c3aed">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          Tujuan Utama Portal
        </div>
        <div class="about-card-content">
          <p>Portal PDPT UGK ini dirancang untuk menjawab kebutuhan digitalisasi data universitas dengan fokus pada aspek-aspect penjaminan mutu:</p>
          <ul>
            <li><strong>Satu Pintu Data:</strong> Menghilangkan redudansi data dengan sistem penyimpanan yang terstruktur dengan baik.</li>
            <li><strong>Mendukung Akreditasi:</strong> Menyediakan data akreditasi institusi, prodi, serta akreditasi internasional (ASIC, ASIIN) dalam satu tempat.</li>
            <li><strong>Pengelolaan SDM:</strong> Menyediakan rekapitulasi data dosen dan tenaga kependidikan secara transparan untuk mempermudah monitoring status kepegawaian.</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Features Section -->
    <div class="features-section" id="featuresSection">
      <div class="features-header">
        <div class="features-header-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
        </div>
        Layanan & Fitur Unggulan
      </div>
      <div class="features-grid">
        <!-- Feature 1 -->
        <div class="feature-item">
          <div class="feature-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/></svg>
          </div>
          <div class="feature-title">Data Akreditasi</div>
          <div class="feature-desc">Informasi lengkap peringkat akreditasi BAN-PT nasional dan sertifikasi internasional ASIC & ASIIN.</div>
        </div>

        <!-- Feature 2 -->
        <div class="feature-item">
          <div class="feature-icon" style="color:var(--accent-amber)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </div>
          <div class="feature-title">Statistik Dosen & Tendik</div>
          <div class="feature-desc">Menampilkan rincian data kepegawaian, jabatan fungsional, dan kualifikasi pendidikan.</div>
        </div>

        <!-- Feature 3 -->
        <div class="feature-item">
          <div class="feature-icon" style="color:var(--accent-rose)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          </div>
          <div class="feature-title">Rekapitulasi Grafis</div>
          <div class="feature-desc">Presentasi visual data dalam bentuk diagram batang dan lingkaran (Chart.js) yang interaktif.</div>
        </div>

        <!-- Feature 4 -->
        <div class="feature-item">
          <div class="feature-icon" style="color:var(--accent-teal)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
          </div>
          <div class="feature-title">Buku Info Akademik</div>
          <div class="feature-desc">Pusat unduhan berkas panduan kurikulum dan informasi studi semesteran berformat PDF.</div>
        </div>
      </div>
    </div>

  </main>

  <footer class="page-footer">
    &copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK
  </footer>

  <script>
    // Simple Navbar mobile toggle & dropdown handling
    (function() {
      const items = document.querySelectorAll('.nav-item:not(a)');
      items.forEach(item => {
        if (!item.querySelector('.nav-dropdown')) return;
        item.addEventListener('click', e => {
          if (e.target.closest('.nav-dropdown-item')) return;
          e.stopPropagation();
          const open = item.classList.contains('open');
          items.forEach(d => d.classList.remove('open'));
          if (!open) item.classList.add('open');
        });
      });
      document.addEventListener('click', () => items.forEach(d => d.classList.remove('open')));
      const tog = document.getElementById('navToggle'), nav = document.getElementById('navItems');
      if (tog && nav) tog.addEventListener('click', () => nav.classList.toggle('mobile-open'));
    })();
  </script>
</body>
</html>
