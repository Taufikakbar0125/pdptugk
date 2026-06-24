<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home — PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
  <meta name="description" content="Dashboard utama Pangkalan Data Perguruan Tinggi Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'home'])

  <!-- ============================================
       BREADCRUMB
       ============================================ -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Home</h1>
      <span class="breadcrumb-sub">Dashboard Utama</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
      <a href="/pdpt/home">Home</a>
    </div>
  </div>

  <!-- ============================================
       MAIN CONTENT
       ============================================ -->
  <main class="main-content">

    <!-- ── Stat Cards ── -->
    <div class="stats-grid" id="statsGrid">
      <!-- Stat: Akreditasi Institusi -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="2" width="16" height="20" rx="2"/>
            <path d="M9 22v-4h6v4"/>
          </svg>
        </div>
        <div class="stat-info">
          <span class="stat-label">Akreditasi Institusi</span>
          <span class="stat-value">{{ number_format($stats['akreditasi_institusi']) }}</span>
          <span class="stat-trend up">
            Aktif
          </span>
        </div>
      </div>

      <!-- Stat: Prodi -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 10 3 12 0v-5"/>
          </svg>
        </div>
        <div class="stat-info">
          <span class="stat-label">Total Prodi</span>
          <span class="stat-value" id="statProdi">{{ number_format($stats['akreditasi_prodi']) }}</span>
          <span class="stat-trend up">
            Terakreditasi
          </span>
        </div>
      </div>

      <!-- Stat: Dosen -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </div>
        <div class="stat-info">
          <span class="stat-label">Total Dosen</span>
          <span class="stat-value" id="statDosen">{{ number_format($stats['dosen']) }}</span>
          <span class="stat-trend up">
            Dosen Aktif
          </span>
        </div>
      </div>

      <!-- Stat: Tendik -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <div class="stat-info">
          <span class="stat-label">Total Tendik</span>
          <span class="stat-value" id="statTendik">{{ number_format($stats['tendik']) }}</span>
          <span class="stat-trend up">
            Tenaga Kependidikan
          </span>
        </div>
      </div>
    </div>

    <!-- ── Charts Row 1: Akreditasi & Prodi ── -->
    <div class="charts-grid" id="chartsRow1">
      <!-- Chart: Akreditasi -->
      <div class="chart-card akreditasi">
        <div class="chart-header">
          <div class="chart-title">
            <div class="chart-title-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="6"/>
                <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>
              </svg>
            </div>
            Akreditasi Institusi
          </div>
          <span class="chart-badge">{{ $stats['akreditasi_institusi'] }} Total</span>
        </div>
        <div class="chart-body">
          <canvas id="chartAkreditasi"></canvas>
        </div>
      </div>

      <!-- Chart: Prodi -->
      <div class="chart-card prodi">
        <div class="chart-header">
          <div class="chart-title">
            <div class="chart-title-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 10 3 12 0v-5"/>
              </svg>
            </div>
            Prodi
          </div>
          <span class="chart-badge">{{ $stats['akreditasi_prodi'] }} Total</span>
        </div>
        <div class="chart-body">
          <canvas id="chartProdi"></canvas>
        </div>
      </div>
    </div>

    <!-- ── Charts Row 2: Dosen & Tendik ── -->
    <div class="charts-grid" id="chartsRow2">
      <!-- Chart: Dosen -->
      <div class="chart-card dosen">
        <div class="chart-header">
          <div class="chart-title">
            <div class="chart-title-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
            Dosen
          </div>
          <span class="chart-badge">{{ $stats['dosen'] }} Total</span>
        </div>
        <div class="chart-body">
          <canvas id="chartDosen"></canvas>
        </div>
      </div>

      <!-- Chart: Tendik -->
      <div class="chart-card tendik">
        <div class="chart-header">
          <div class="chart-title">
            <div class="chart-title-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            Tenaga Kependidikan
          </div>
          <span class="chart-badge">{{ $stats['tendik'] }} Total</span>
        </div>
        <div class="chart-body">
          <canvas id="chartTendik"></canvas>
        </div>
      </div>
    </div>

  </main>

  <!-- ============================================
       FOOTER
       ============================================ -->
  <footer class="page-footer">
    &copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK
  </footer>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
  <script>
      // Inject DB values into JS variables for chart rendering
      window.dbStats = {
          akreditasi_institusi: {{ $stats['akreditasi_institusi'] }},
          akreditasi_prodi: {{ $stats['akreditasi_prodi'] }},
          dosen: {{ $stats['dosen'] }},
          tendik: {{ $stats['tendik'] }}
      };
      window.dbChartData = @json($chartData);
  </script>
  <script src="{{ asset('js/pdpt-home.js') }}"></script>
</body>
</html>
