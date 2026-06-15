<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akreditasi ASIC — PDPT UGK</title>
  <meta name="description" content="Data akreditasi ASIC Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pdpt-data.css') }}">
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'akreditasi-asic'])

  <!-- ── BREADCRUMB ── -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Data</h1>
      <span class="breadcrumb-sub">Data Akreditasi ASIC</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <a href="/pdpt/home">Home</a>
      <span>›</span>
      <span>Data Akreditasi ASIC</span>
    </div>
  </div>

  <!-- ── MAIN CONTENT ── -->
  <main class="main-content">
    <div class="table-section">
      <div class="table-header">
        <div class="table-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>
          </svg>
          Data Akreditasi ASIC
        </div>
        <span class="table-count" id="asicCount">0 Items</span>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Prodi</th>
              <th>Period of Accreditation</th>
              <th>Accreditation</th>
              <th>Date Accreditation</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="asicTableBody"></tbody>
        </table>
      </div>
    </div>
  </main>

  <footer class="page-footer">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</footer>
  <script>
    window.DB_AKRED_ASIC_DATA = @json($data);
  </script>
  <script src="{{ asset('js/pdpt-data.js') }}"></script>
</body>
</html>
