<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akreditasi Institusi — PDPT UGK</title>
  <meta name="description" content="Data akreditasi institusi Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdpt-home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pdpt-data.css') }}">
</head>
<body>

  @include('pdpt.partials.navbar', ['activePage' => 'akreditasi-institusi'])

  <!-- ── BREADCRUMB ── -->
  <div class="breadcrumb-bar">
    <div class="breadcrumb-left">
      <h1 class="breadcrumb-title">Akreditasi Institusi</h1>
      <span class="breadcrumb-sub">Universitas Gunung Kidul</span>
    </div>
    <div class="breadcrumb-nav">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <a href="/pdpt/home">Home</a>
      <span>›</span>
      <span>Akreditasi Institusi</span>
    </div>
  </div>

  <!-- ── MAIN CONTENT ── -->
  <main class="main-content">

    <!-- Summary Cards -->
    <div class="institusi-summary">
      @php
        $current = $data->where('status', 'Aktif')->first() ?? $data->first();
      @endphp

      <!-- Current Accreditation -->
      <div class="institusi-card primary">
        <div class="institusi-card-header">
          <div class="institusi-card-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="8" r="6"/>
              <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>
            </svg>
          </div>
          <div>
            <div class="institusi-card-title">Akreditasi Saat Ini</div>
            <div class="institusi-card-value">{{ $current ? $current->peringkat : 'Belum Ada' }}</div>
          </div>
        </div>
        <div class="institusi-details">
          @if($current)
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Lembaga Akreditasi</span>
            <span class="institusi-detail-value">{{ $current->lembaga ?? 'BAN-PT' }}</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">No. Sertifikat</span>
            <span class="institusi-detail-value" style="font-size:.75rem">{{ $current->no_sk }}</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Tanggal Akreditasi</span>
            <span class="institusi-detail-value">{{ \Carbon\Carbon::parse($current->tanggal_sk)->format('d F Y') }}</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Masa Berlaku Sampai</span>
            <span class="institusi-detail-value">{{ \Carbon\Carbon::parse($current->tanggal_kadaluarsa)->format('d F Y') }}</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Status</span>
            <span class="akred-badge {{ $current->status == 'Aktif' ? 'unggul' : 'proses' }}">{{ $current->status == 'Aktif' ? '✓ Aktif' : $current->status }}</span>
          </div>
          @else
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Data akreditasi belum tersedia.</span>
          </div>
          @endif
        </div>
      </div>

      <!-- Accreditation Summary Stats -->
      <div class="institusi-card gold">
        <div class="institusi-card-header">
          <div class="institusi-card-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 10 3 12 0v-5"/>
            </svg>
          </div>
          <div>
            <div class="institusi-card-title">Ringkasan Akreditasi Prodi</div>
            <div class="institusi-card-value">{{ $prodiStats['total'] }} Program Studi</div>
          </div>
        </div>
        <div class="institusi-details">
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Peringkat Unggul</span>
            <span class="akred-badge unggul">{{ $prodiStats['unggul'] }} Prodi</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Peringkat A</span>
            <span class="akred-badge a">{{ $prodiStats['a'] }} Prodi</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Peringkat B</span>
            <span class="akred-badge b">{{ $prodiStats['b'] }} Prodi</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">Dalam Proses</span>
            <span class="akred-badge proses">{{ $prodiStats['proses'] }} Prodi</span>
          </div>
          <div class="institusi-detail-row">
            <span class="institusi-detail-label">% Unggul/A</span>
            <span class="institusi-detail-value" style="color:#059669;font-weight:800">
                {{ $prodiStats['total'] > 0 ? number_format((($prodiStats['unggul'] + $prodiStats['a']) / $prodiStats['total']) * 100, 1) : 0 }}%
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- History Table -->
    <div class="table-section">
      <div class="table-header">
        <div class="table-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
          Riwayat Akreditasi Institusi
        </div>
        <span class="table-count">{{ count($data) }} Records</span>
      </div>

      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Peringkat</th>
              <th>No SK</th>
              <th>Tahun SK</th>
              <th>Kadaluarsa</th>
              <th>Status</th>
              <th>Sertifikat</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td><span class="akred-badge {{ strtolower(str_replace(' ', '', $item->peringkat)) }}">{{ $item->peringkat }}</span></td>
              <td style="font-size: 0.8rem">{{ $item->no_sk }}</td>
              <td>{{ $item->tahun_sk }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('d M Y') }}</td>
              <td><span class="akred-badge {{ $item->status == 'Aktif' ? 'unggul' : 'proses' }}">{{ $item->status }}</span></td>
              <td>
                @if($item->file_pdf)
                  <a href="{{ Storage::url($item->file_pdf) }}" target="_blank" style="display: inline-block; padding: 6px 12px; background: #f1f5f9; color: #334155; border-radius: 4px; text-decoration: none; font-size: 0.75rem; font-weight: 500; border: 1px solid #e2e8f0; transition: all 0.2s;">Lihat PDF</a>
                @else
                  <span style="color: #94a3b8; font-size: 0.75rem;">-</span>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 20px;">Belum ada riwayat akreditasi institusi.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <!-- ── FOOTER ── -->
  <footer class="page-footer">
    &copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK
  </footer>

  <script src="{{ asset('js/pdpt-data.js') }}"></script>
</body>
</html>
