<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Tenaga Kependidikan — PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
  <meta name="description" content="Data tenaga kependidikan Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pdpt-data.css') }}">
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'data-tendik'])

  <!-- ── BREADCRUMB ── -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Data</h1>
      <span class="breadcrumb-sub">Data Tenaga Kependidikan</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <a href="/pdpt/home">Home</a>
      <span>›</span>
      <span>Data Tenaga Kependidikan</span>
    </div>
  </div>

  <!-- ── MAIN CONTENT ── -->
  <main class="main-content">

    <!-- Filter Section -->
    <div class="filter-section">
      <div class="filter-header">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
        </svg>
        Pencarian Tenaga Kependidikan
      </div>
      <div class="filter-body">
        <div class="filter-grid" style="grid-template-columns:1fr 1fr">
          <div class="filter-group">
            <label class="filter-label">Unit Kerja</label>
            <select class="filter-select" id="filterTendikUnit">
              <option value="">Semua Unit Kerja</option>
            </select>
          </div>
          <div class="filter-group">
            <label class="filter-label">Nama</label>
            <input type="text" class="filter-select" id="filterTendikNama" placeholder="Cari nama tendik..." style="padding-right:14px">
          </div>
        </div>
        <div class="filter-actions">
          <button class="btn-filter btn-filter-primary" onclick="applyTendikFilter()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
            Filter Data
          </button>
          <button class="btn-filter btn-filter-reset" onclick="resetTendikFilter()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
            Reset
          </button>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="table-section">
      <div class="table-header">
        <div class="table-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
          Data Tenaga Kependidikan
        </div>
        <span class="table-count" id="tendikCount">0 Items</span>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>NIP</th>
              <th>Golongan</th>
              <th>Pangkat</th>
              <th>Unit Kerja</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tendikTableBody"></tbody>
        </table>
      </div>
      <div class="pagination-bar">
        <span class="pagination-info" id="tendikPagInfo">Menampilkan 0 data</span>
        <div class="pagination" id="tendikPagination"></div>
      </div>
    </div>

  </main>

  <footer class="page-footer">
    &copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK
  </footer>

  <script>
    window.DB_TENDIK_DATA = @json($data);
  </script>
  <script src="{{ asset('js/pdpt-data.js') }}"></script>
</body>
</html>
