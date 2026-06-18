<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekapitulasi Tenaga Kependidikan — PDPT UGK</title>
  <meta name="description" content="Rekapitulasi data tenaga kependidikan Universitas Gunung Kidul berdasarkan status kepegawaian">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pdpt-rekap.css') }}">
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'rekap-tendik'])

  <!-- ── BREADCRUMB ── -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Rekapitulasi</h1>
      <span class="breadcrumb-sub">Rekapitulasi Tenaga Kependidikan</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <a href="/pdpt/home">Home</a>
      <span>›</span>
      <span>Rekapitulasi Tenaga Kependidikan</span>
    </div>
  </div>

  <!-- ── MAIN CONTENT ── -->
  <main class="main-content">

    <!-- Stat Overview -->
    <div class="rekap-stats">
      <div class="rekap-stat blue">
        <div class="rekap-stat-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="rekap-stat-info">
          <span class="rekap-stat-label">PNS</span>
          <span class="rekap-stat-value" id="rtStatPns">0</span>
        </div>
      </div>
      <div class="rekap-stat amber">
        <div class="rekap-stat-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <div class="rekap-stat-info">
          <span class="rekap-stat-label">CPNS</span>
          <span class="rekap-stat-value" id="rtStatCpns">0</span>
        </div>
      </div>
      <div class="rekap-stat red">
        <div class="rekap-stat-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <div class="rekap-stat-info">
          <span class="rekap-stat-label">Kontrak</span>
          <span class="rekap-stat-value" id="rtStatKontrak">0</span>
        </div>
      </div>
      <div class="rekap-stat purple">
        <div class="rekap-stat-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="rekap-stat-info">
          <span class="rekap-stat-label">Total Tendik</span>
          <span class="rekap-stat-value" id="rtStatTotal">0</span>
        </div>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="rekap-charts">
      <!-- Bar Chart -->
      <div class="rekap-chart-card">
        <div class="rekap-chart-header">
          <div class="rekap-chart-title">
            <div class="rekap-chart-title-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
            </div>
            Berdasarkan Status Kerja
          </div>
        </div>
        <div class="rekap-chart-body bar-wrap">
          <canvas id="chartRekapTendik"></canvas>
        </div>
      </div>

      <!-- Doughnut Chart -->
      <div class="rekap-chart-card">
        <div class="rekap-chart-header">
          <div class="rekap-chart-title">
            <div class="rekap-chart-title-icon" style="background:rgba(124,58,237,.1);color:#7c3aed">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
            </div>
            Komposisi
          </div>
        </div>
        <div class="rekap-chart-body">
          <canvas id="chartRekapTendikPie"></canvas>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="rekap-table-section">
      <div class="rekap-table-header">
        <div class="rekap-table-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg>
          Rekapitulasi Tenaga Kependidikan per Unit Kerja
        </div>
      </div>
      <div class="rekap-table-wrap">
        <table class="rekap-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Unit Kerja</th>
              <th>PNS</th>
              <th>CPNS</th>
              <th>Kontrak</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="rekapTendikTableBody"></tbody>
        </table>
      </div>
    </div>

  </main>

  <footer class="page-footer">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</footer>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
  <script>
    window.DB_REKAP_TENDIK = @json($data);
  </script>
  <script src="{{ asset('js/pdpt-rekap.js') }}"></script>
</body>
</html>
