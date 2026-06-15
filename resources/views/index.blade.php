<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDPT UGK — Universitas Gunung Kidul</title>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
  <canvas id="space"></canvas>
  <div class="page">
    <header class="header">
      <div class="eyebrow">Universitas Gunung Kidul</div>
      <div class="site-title">PDPT UGK</div>
      <div class="site-sub">Pangkalan Data Perguruan Tinggi — Portal Layanan Akademik</div>
    </header>
    <div class="orbit-wrap" id="orbitWrap" role="region" aria-label="Menu planet, geser kiri kanan">
      <div class="orbit-ring"></div>
      <div class="planets" id="planets"></div>
    </div>
    <div class="dots" id="dots" role="tablist"></div>
    <div class="nav-row">
      <button class="nav-btn" id="btnPrev" aria-label="Sebelumnya">&#8592;</button>
      <span class="nav-hint" id="navHint">GESER &nbsp;/&nbsp; KLIK PLANET</span>
      <button class="nav-btn" id="btnNext" aria-label="Berikutnya">&#8594;</button>
    </div>
    <div class="detail" id="detail">
      <div class="detail-icon" id="dIcon"></div>
      <div class="detail-text">
        <div class="dt" id="dName"></div>
        <div class="dd" id="dDesc"></div>
        <div class="detail-link" id="dLink">↗ Buka halaman ini</div>
      </div>
      <button class="resume-btn" id="resumeBtn">▶ Lanjutkan</button>
    </div>
    <div class="footer">&copy; 2025 Universitas Gunung Kidul &middot; PDPT</div>
  </div>
  <script>
    window.DB_MENUS = @json($menus);
  </script>
  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>