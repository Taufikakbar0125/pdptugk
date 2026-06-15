<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Informasi Akademik — PDPT UGK</title>
  <meta name="description" content="Kumpulan buku informasi akademik Universitas Gunung Kidul per semester">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
  <style>
    /* ── Page-specific styles ── */
    .bia-hero{
      background:linear-gradient(135deg,rgba(37,99,235,.04),rgba(124,58,237,.03));
      border:1px solid var(--surface-border);
      border-radius:var(--radius-lg);
      padding:32px;
      margin-bottom:28px;
      display:flex;
      align-items:center;
      gap:24px;
      animation:fadeInUp .5s cubic-bezier(.22,1,.36,1) both;
    }

    .bia-hero-icon{
      width:64px;height:64px;flex-shrink:0;
      border-radius:16px;
      background:linear-gradient(135deg,#2563eb,#7c3aed);
      display:flex;align-items:center;justify-content:center;
      color:#fff;
      box-shadow:0 4px 16px rgba(37,99,235,.2);
    }

    .bia-hero-text h2{
      font-size:1.15rem;font-weight:800;color:var(--text-dark);margin-bottom:4px;
    }
    .bia-hero-text p{
      font-size:.82rem;color:var(--text-muted);line-height:1.5;
    }
    .bia-hero-text .hero-stat{
      display:inline-flex;align-items:center;gap:5px;margin-top:8px;
      padding:5px 12px;border-radius:20px;
      background:rgba(37,99,235,.06);border:1px solid rgba(37,99,235,.1);
      font-size:.72rem;font-weight:600;color:#2563eb;
    }

    /* Search & Filter bar */
    .bia-toolbar{
      display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap;
      animation:fadeInUp .5s cubic-bezier(.22,1,.36,1) .1s both;
    }

    .bia-search{
      flex:1;min-width:200px;position:relative;
    }
    .bia-search input{
      width:100%;padding:11px 14px 11px 40px;
      border:1.5px solid var(--surface-border);border-radius:var(--radius-sm);
      font-family:inherit;font-size:.84rem;color:var(--text-dark);
      background:var(--bg-card);outline:none;
      transition:border-color .2s, box-shadow .2s;
    }
    .bia-search input::placeholder{color:var(--text-light)}
    .bia-search input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(37,99,235,.08)}
    .bia-search svg{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text-light)}

    .bia-filter-select{
      padding:11px 32px 11px 14px;
      border:1.5px solid var(--surface-border);border-radius:var(--radius-sm);
      font-family:inherit;font-size:.82rem;color:var(--text-dark);
      background:var(--bg-card);outline:none;cursor:pointer;
      appearance:none;
      background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat:no-repeat;background-position:right 10px center;background-size:14px;
      transition:border-color .2s;
    }
    .bia-filter-select:focus{border-color:var(--primary)}

    /* Document list */
    .bia-section{
      background:var(--bg-card);
      border:1px solid var(--surface-border);
      border-radius:var(--radius-lg);
      box-shadow:var(--shadow-sm);
      overflow:hidden;
      animation:fadeInUp .5s cubic-bezier(.22,1,.36,1) .15s both;
    }

    .bia-section-header{
      display:flex;align-items:center;justify-content:space-between;
      padding:18px 24px;
      border-bottom:1px solid var(--surface-border);
      background:rgba(241,245,249,.5);
    }

    .bia-section-title{
      display:flex;align-items:center;gap:10px;
      font-size:.88rem;font-weight:700;color:var(--text-dark);
    }

    .bia-count{
      font-size:.72rem;font-weight:600;color:var(--text-muted);
      padding:4px 10px;border-radius:20px;
      background:rgba(37,99,235,.06);color:#2563eb;
    }

    /* Document items */
    .bia-item{
      display:flex;align-items:center;
      padding:16px 24px;
      border-bottom:1px solid rgba(226,232,240,.4);
      transition:background .15s;
    }
    .bia-item:last-child{border-bottom:none}
    .bia-item:hover{background:rgba(37,99,235,.015)}

    .bia-item-num{
      width:32px;height:32px;flex-shrink:0;
      border-radius:8px;
      background:rgba(241,245,249,.8);
      display:flex;align-items:center;justify-content:center;
      font-size:.72rem;font-weight:700;color:var(--text-light);
      margin-right:16px;
    }

    .bia-item-icon{
      width:40px;height:40px;flex-shrink:0;
      border-radius:10px;
      display:flex;align-items:center;justify-content:center;
      margin-right:14px;
    }
    .bia-item-icon.gasal{background:rgba(37,99,235,.08);color:#2563eb}
    .bia-item-icon.genap{background:rgba(16,185,129,.08);color:#059669}

    .bia-item-info{flex:1;min-width:0}

    .bia-item-title{
      font-size:.84rem;font-weight:600;color:var(--text-dark);
      white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
    }

    .bia-item-meta{
      display:flex;align-items:center;gap:12px;margin-top:3px;
    }

    .bia-item-badge{
      display:inline-flex;align-items:center;gap:4px;
      padding:2px 8px;border-radius:6px;
      font-size:.66rem;font-weight:600;letter-spacing:.03em;
    }
    .bia-item-badge.gasal{background:rgba(37,99,235,.06);color:#2563eb}
    .bia-item-badge.genap{background:rgba(16,185,129,.06);color:#059669}

    .bia-item-year{
      font-size:.72rem;color:var(--text-light);font-weight:500;
    }

    .bia-item-size{
      font-size:.68rem;color:var(--text-light);font-weight:500;
    }

    .btn-download{
      display:inline-flex;align-items:center;gap:6px;
      padding:8px 16px;border:none;border-radius:var(--radius-sm);
      background:linear-gradient(135deg,#2563eb,#1d4ed8);
      color:#fff;font-family:inherit;font-size:.75rem;font-weight:600;
      cursor:pointer;box-shadow:0 2px 8px rgba(37,99,235,.18);
      transition:all .2s;white-space:nowrap;
    }
    .btn-download:hover{background:linear-gradient(135deg,#1d4ed8,#1e3a8a);transform:translateY(-1px);box-shadow:0 4px 14px rgba(37,99,235,.28)}
    .btn-download:active{transform:translateY(0)}

    /* Empty state */
    .bia-empty{
      padding:48px 24px;text-align:center;
    }
    .bia-empty svg{color:var(--text-light);margin-bottom:12px}
    .bia-empty p{font-size:.84rem;color:var(--text-muted)}

    /* Responsive */
    @media(max-width:768px){
      .bia-hero{flex-direction:column;text-align:center;padding:24px}
      .bia-item{flex-wrap:wrap;gap:10px}
      .bia-item-info{width:100%;order:1}
      .btn-download{order:2;width:100%;justify-content:center}
    }
  </style>
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'buku-info'])

  <!-- ── BREADCRUMB ── -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Data</h1>
      <span class="breadcrumb-sub">Buku Informasi Akademik</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <a href="/pdpt/home">Home</a>
      <span>›</span>
      <span>Buku Informasi Akademik</span>
    </div>
  </div>

  <!-- ── MAIN CONTENT ── -->
  <main class="main-content">

    <!-- Hero -->
    <div class="bia-hero">
      <div class="bia-hero-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
          <path d="M8 7h6M8 11h8"/>
        </svg>
      </div>
      <div class="bia-hero-text">
        <h2>Buku Informasi Akademik</h2>
        <p>Kumpulan buku panduan informasi akademik Universitas Gunung Kidul per semester. Dokumen berisi informasi kurikulum, kalender akademik, peraturan, dan panduan perkuliahan.</p>
        <div class="hero-stat">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          <span id="totalDocs">0</span> Dokumen Tersedia
        </div>
      </div>
    </div>

    <!-- Toolbar -->
    <div class="bia-toolbar">
      <div class="bia-search">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input type="text" id="biaSearch" placeholder="Cari dokumen...">
      </div>
      <select class="bia-filter-select" id="biaFilterSemester">
        <option value="">Semua Semester</option>
        <option value="Gasal">Gasal</option>
        <option value="Genap">Genap</option>
      </select>
      <select class="bia-filter-select" id="biaFilterYear">
        <option value="">Semua Tahun</option>
      </select>
    </div>

    <!-- Document List -->
    <div class="bia-section">
      <div class="bia-section-header">
        <div class="bia-section-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
          </svg>
          Informasi Akademik
        </div>
        <span class="bia-count" id="biaCount">0 dokumen</span>
      </div>
      <div id="biaList"></div>
    </div>

  </main>

  <footer class="page-footer">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</footer>

  <script>
    @php
        $mappedBia = $data->map(function($d) {
            return [
                'title' => $d->judul,
                'semester' => $d->semester,
                'year' => $d->tahun_akademik,
                'startYear' => $d->start_year,
                'size' => $d->file_size ?? '-',
                'path' => $d->file_path ? asset('storage/' . $d->file_path) : null
            ];
        });
    @endphp
    const BIA_DATA = @json($mappedBia);

    // Populate year filter
    const years = [...new Set(BIA_DATA.map(d => d.year))].reverse();
    const yearFilter = document.getElementById('biaFilterYear');
    years.forEach(y => { const o = document.createElement('option'); o.value = y; o.textContent = y; yearFilter.appendChild(o); });

    document.getElementById('totalDocs').textContent = BIA_DATA.length;

    function renderList(data) {
      const list = document.getElementById('biaList');
      const count = document.getElementById('biaCount');
      count.textContent = `${data.length} dokumen`;

      if (!data.length) {
        list.innerHTML = `<div class="bia-empty">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          <p>Tidak ada dokumen yang sesuai filter.</p>
        </div>`;
        return;
      }

      list.innerHTML = data.map((d, i) => {
        const cls = d.semester.toLowerCase();
        return `<div class="bia-item">
          <div class="bia-item-num">${i+1}</div>
          <div class="bia-item-icon ${cls}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div class="bia-item-info">
            <div class="bia-item-title">${d.title}</div>
            <div class="bia-item-meta">
              <span class="bia-item-badge ${cls}">${d.semester}</span>
              <span class="bia-item-year">T.A. ${d.year}</span>
              <span class="bia-item-size">${d.size}</span>
            </div>
          </div>
          <button class="btn-download" onclick="window.open('${d.path ? d.path : '#'}', '_blank')" ${!d.path ? 'disabled style="opacity:0.5"' : ''}>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download
          </button>
        </div>`;
      }).join('');
    }

    function applyFilters() {
      const q = document.getElementById('biaSearch').value.toLowerCase();
      const sem = document.getElementById('biaFilterSemester').value;
      const yr = document.getElementById('biaFilterYear').value;
      const filtered = BIA_DATA.filter(d => {
        if (q && !d.title.toLowerCase().includes(q)) return false;
        if (sem && d.semester !== sem) return false;
        if (yr && d.year !== yr) return false;
        return true;
      });
      renderList(filtered);
    }

    document.getElementById('biaSearch').addEventListener('input', applyFilters);
    document.getElementById('biaFilterSemester').addEventListener('change', applyFilters);
    document.getElementById('biaFilterYear').addEventListener('change', applyFilters);

    // Initial render (newest first)
    renderList([...BIA_DATA].reverse());

    // Navbar
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
