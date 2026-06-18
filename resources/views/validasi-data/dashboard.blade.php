<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mahasiswa — Validasi Data · PDPT UGK</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

    :root{
      --bg:#f0f4f8;
      --card:#ffffff;
      --primary:#2563eb;
      --primary-dark:#1d4ed8;
      --primary-light:rgba(37,99,235,.08);
      --accent:#7c3aed;
      --text:#0f172a;
      --text-muted:#64748b;
      --text-light:#94a3b8;
      --border:#e2e8f0;
      --radius:16px;
      --shadow:0 4px 24px rgba(15,23,42,.06),0 1px 3px rgba(15,23,42,.04);
    }

    body{
      font-family:'Inter',system-ui,-apple-system,sans-serif;
      background:var(--bg);
      color:var(--text);
      min-height:100vh;
      position:relative;
      overflow-x:hidden;
      padding-bottom:60px;
    }

    /* Gradient mesh background */
    body::before{
      content:'';position:fixed;inset:0;
      background:
        radial-gradient(ellipse 80% 60% at 10% 20%, rgba(37,99,235,.06), transparent 60%),
        radial-gradient(ellipse 60% 50% at 90% 80%, rgba(124,58,237,.05), transparent 60%);
      z-index:-2;
    }
    body::after{
      content:'';position:fixed;inset:0;
      background-image:linear-gradient(rgba(37,99,235,.01) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,.01) 1px,transparent 1px);
      background-size:32px 32px;z-index:-1;
    }

    /* Navbar */
    .navbar{
      background:rgba(255,255,255,.7);
      backdrop-filter:blur(12px);
      border-bottom:1px solid var(--border);
      position:sticky;
      top:0;
      z-index:100;
      padding:16px 40px;
      display:flex;
      align-items:center;
      justify-content:between;
      box-shadow:0 2px 12px rgba(15,23,42,.03);
    }
    .nav-container{
      width:100%;
      max-width:1200px;
      margin:0 auto;
      display:flex;
      align-items:center;
      justify-content:space-between;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:12px;
      text-decoration:none;
    }
    .brand-logo{
      width:32px;height:32px;object-fit:contain;
    }
    .brand-title{
      font-size:1.1rem;
      font-weight:800;
      color:var(--text);
      letter-spacing:-.02em;
    }
    .brand-title span{
      color:var(--primary);
    }
    .user-menu{
      display:flex;
      align-items:center;
      gap:16px;
    }
    .user-info{
      text-align:right;
    }
    .user-name{
      font-size:.88rem;
      font-weight:600;
      color:var(--text);
    }
    .user-role{
      font-size:.7rem;
      font-weight:700;
      color:var(--primary);
      text-transform:uppercase;
      letter-spacing:.05em;
    }
    .btn-logout{
      background:rgba(239,68,68,.08);
      color:#ef4444;
      border:1px solid rgba(239,68,68,.15);
      padding:8px 16px;
      border-radius:10px;
      font-family:inherit;
      font-size:.8rem;
      font-weight:600;
      cursor:pointer;
      display:inline-flex;
      align-items:center;
      gap:6px;
      transition:all .2s;
    }
    .btn-logout:hover{
      background:#ef4444;
      color:white;
      box-shadow:0 4px 12px rgba(239,68,68,.2);
    }

    /* Container layout */
    .dashboard-container{
      max-width:1200px;
      margin:40px auto;
      padding:0 20px;
      display:grid;
      grid-template-columns: 1.2fr 1.8fr;
      gap:30px;
    }

    /* Card styling */
    .card{
      background:var(--card);
      border-radius:var(--radius);
      border:1px solid var(--border);
      box-shadow:var(--shadow);
      overflow:hidden;
    }
    .card-header{
      padding:20px 24px;
      border-bottom:1px solid var(--border);
      background:linear-gradient(135deg,rgba(37,99,235,.02),rgba(124,58,237,.01));
    }
    .card-title{
      font-size:1.05rem;
      font-weight:700;
      color:var(--text);
      display:flex;
      align-items:center;
      gap:8px;
    }
    .card-title svg{
      color:var(--primary);
    }
    .card-body{
      padding:24px;
    }

    /* Alerts */
    .alert{
      padding:12px 16px;
      border-radius:10px;
      font-size:.8rem;
      font-weight:500;
      margin-bottom:20px;
      display:flex;
      align-items:flex-start;
      gap:8px;
    }
    .alert-success{
      background:rgba(16,185,129,.06);
      border:1px solid rgba(16,185,129,.15);
      color:#059669;
    }
    .alert-error{
      background:rgba(239,68,68,.06);
      border:1px solid rgba(239,68,68,.15);
      color:#dc2626;
    }

    /* Form control */
    .form-group{
      margin-bottom:16px;
    }
    .form-row{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:12px;
    }
    .form-label{
      display:block;
      font-size:.78rem;
      font-weight:600;
      color:var(--text);
      margin-bottom:6px;
    }
    .form-control{
      width:100%;
      padding:10px 14px;
      border:1.5px solid var(--border);
      border-radius:10px;
      font-family:inherit;
      font-size:.85rem;
      color:var(--text);
      background:rgba(248,250,252,.6);
      transition:all .2s;
      outline:none;
    }
    .form-control:focus{
      border-color:var(--primary);
      background:white;
      box-shadow:0 0 0 3px rgba(37,99,235,.1);
    }
    textarea.form-control{
      resize:vertical;
      min-height:80px;
    }
    .form-hint{
      font-size:.7rem;
      color:var(--text-muted);
      margin-top:4px;
    }

    .btn-submit{
      width:100%;
      padding:12px;
      background:linear-gradient(135deg,var(--primary),var(--primary-dark));
      color:white;
      border:none;
      border-radius:10px;
      font-family:inherit;
      font-size:.88rem;
      font-weight:700;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      box-shadow:0 2px 10px rgba(37,99,235,.2);
      transition:all .25s;
      margin-top:24px;
    }
    .btn-submit:hover{
      background:linear-gradient(135deg,var(--primary-dark),#1e3a8a);
      box-shadow:0 4px 16px rgba(37,99,235,.3);
      transform:translateY(-1px);
    }

    /* Request list and table */
    .table-container{
      width:100%;
      overflow-x:auto;
    }
    .table{
      width:100%;
      border-collapse:collapse;
      text-align:left;
    }
    .table th{
      background:#f8fafc;
      padding:14px 18px;
      font-size:.78rem;
      font-weight:600;
      color:var(--text-muted);
      border-bottom:1px solid var(--border);
    }
    .table td{
      padding:16px 18px;
      font-size:.82rem;
      border-bottom:1px solid var(--border);
      vertical-align:top;
    }
    .table tr:last-child td{
      border-bottom:none;
    }

    /* Badge */
    .badge{
      display:inline-flex;
      align-items:center;
      padding:4px 8px;
      border-radius:20px;
      font-size:.7rem;
      font-weight:600;
      text-transform:uppercase;
      letter-spacing:.02em;
    }
    .badge-pending{
      background:rgba(245,158,11,.08);
      border:1px solid rgba(245,158,11,.15);
      color:#d97706;
    }
    .badge-process{
      background:rgba(37,99,235,.08);
      border:1px solid rgba(37,99,235,.15);
      color:#2563eb;
    }
    .badge-success{
      background:rgba(16,185,129,.08);
      border:1px solid rgba(16,185,129,.15);
      color:#059669;
    }

    /* Empty state */
    .empty-state{
      padding:40px;
      text-align:center;
      color:var(--text-muted);
    }
    .empty-icon{
      font-size:2.5rem;
      margin-bottom:12px;
      color:var(--text-light);
    }

    .form-section-title{
      font-size:0.8rem;
      font-weight:700;
      text-transform:uppercase;
      color:var(--primary);
      margin:20px 0 10px;
      letter-spacing:0.03em;
      border-bottom:1px dashed var(--border);
      padding-bottom:4px;
    }

    @media(max-width:992px){
      .dashboard-container{
        grid-template-columns: 1fr;
      }
    }
    @media(max-width:600px){
      .navbar{
        padding:16px 20px;
      }
      .brand-title span{
        display:none;
      }
      .user-info{
        display:none;
      }
      .form-row{
        grid-template-columns:1fr;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="nav-container">
      <a href="/" class="brand">
        <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK" class="brand-logo">
        <span class="brand-title">PDPT <span>UGK</span></span>
      </a>
      <div class="user-menu">
        <div class="user-info">
          <div class="user-name">{{ $user->name }}</div>
          <div class="user-role">NIM: {{ $user->identifier }} &middot; Mahasiswa</div>
        </div>
        <form action="{{ route('validasi-data.logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn-logout">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Keluar
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Dashboard Container -->
  <main class="dashboard-container">
    
    <!-- Left Column: Form Pengajuan -->
    <section class="card">
      <div class="card-header">
        <h2 class="card-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4z"/></svg>
          Form Pengajuan Validasi
        </h2>
      </div>
      <div class="card-body">
        
        @if (session('success'))
          <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <div>{{ session('success') }}</div>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <form method="POST" action="{{ route('validasi-data.pengajuan.post') }}" enctype="multipart/form-data">
          @csrf

          <!-- Section: Identitas Mahasiswa -->
          <div class="form-section-title" style="margin-top:0;">1. Identitas Mahasiswa</div>

          <div class="form-group">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $user->name) }}" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="nim">NIM</label>
            <input type="text" id="nim" name="nim" class="form-control" value="{{ old('nim', $user->identifier) }}" required>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="prodi">Program Studi</label>
              <input type="text" id="prodi" name="prodi" class="form-control" value="{{ old('prodi') }}" placeholder="Contoh: Informatika" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="fakultas">Fakultas</label>
              <input type="text" id="fakultas" name="fakultas" class="form-control" value="{{ old('fakultas') }}" placeholder="Contoh: Teknik" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="angkatan">Angkatan</label>
              <input type="text" id="angkatan" name="angkatan" class="form-control" value="{{ old('angkatan') }}" placeholder="Contoh: 2021" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="no_hp">No. Handphone</label>
              <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="email">Alamat Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          </div>

          <!-- Section: Masalah & Bukti -->
          <div class="form-section-title">2. Detail Masalah & Dokumen</div>

          <div class="form-group">
            <label class="form-label" for="jenis_masalah_id">Kategori Masalah Perbaikan</label>
            <select id="jenis_masalah_id" name="jenis_masalah_id" class="form-control" required>
              <option value="">-- Pilih Jenis Masalah --</option>
              @foreach($jenisMasalah as $masalah)
                <option value="{{ $masalah->id }}" data-bukti="{{ $masalah->deskripsi_bukti }}" {{ old('jenis_masalah_id') == $masalah->id ? 'selected' : '' }}>
                  {{ $masalah->nama_masalah }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" style="margin-bottom: 8px; font-weight: 700;">Dokumen Bukti Pendukung (PDF/JPG/PNG)</label>
            <div id="dynamic-upload-container" style="display: flex; flex-direction: column; gap: 16px;">
              @if(old('jenis_masalah_id'))
                @php
                  $selectedCategory = $jenisMasalah->firstWhere('id', old('jenis_masalah_id'));
                @endphp
                @if($selectedCategory)
                  @foreach($selectedCategory->dokumenPersyaratans as $doc)
                    <div class="form-group" style="margin-bottom: 0;">
                      <label class="form-label" style="display: block; margin-bottom: 6px;">
                        {{ $doc->nama_dokumen }}
                        @if($doc->is_wajib)
                          <span style="color: #ef4444; font-weight: bold;">*</span>
                        @endif
                      </label>
                      <input type="file" name="bukti_files[{{ $doc->id }}]" class="form-control" accept=".pdf,.png,.jpg,.jpeg" style="padding:6px 10px;" {{ $doc->is_wajib ? 'required' : '' }}>
                      @error('bukti_files.'.$doc->id)
                        <span style="color: #dc2626; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span>
                      @enderror
                    </div>
                  @endforeach
                @endif
              @else
                <p style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">Pilih kategori masalah terlebih dahulu untuk menampilkan form upload berkas pendukung.</p>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="keterangan">Keterangan / Alasan Lebih Detail</label>
            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Tuliskan keterangan pendukung atau detail penjelasan mengenai data yang ingin Anda perbaiki...">{{ old('keterangan') }}</textarea>
          </div>

          <button type="submit" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            KIRIM PENGAJUAN
          </button>
        </form>
      </div>
    </section>

    <!-- Right Column: Riwayat Pengajuan -->
    <section class="card">
      <div class="card-header">
        <h2 class="card-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
          Riwayat Pengajuan Validasi
        </h2>
      </div>
      <div class="card-body" style="padding:0;">
        <div class="table-container">
          @if ($requests->isEmpty())
            <div class="empty-state">
              <div class="empty-icon">📁</div>
              <p style="font-weight:600; margin-bottom:4px;">Belum Ada Pengajuan</p>
              <p style="font-size:.78rem;">Anda belum pernah mengirimkan formulir pengajuan validasi data.</p>
            </div>
          @else
            <table class="table">
              <thead>
                <tr>
                  <th style="width:50px; text-align:center;">No</th>
                  <th style="width:120px;">Tanggal</th>
                  <th>Rincian Pengajuan</th>
                  <th style="width:110px; text-align:center;">Berkas</th>
                  <th style="width:110px; text-align:center;">Status</th>
                  <th>Catatan Admin</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($requests as $index => $req)
                  <tr>
                    <td style="text-align:center; font-weight:600; color:var(--text-muted);">
                      {{ $index + 1 }}
                    </td>
                    <td>
                      <div style="font-weight:600;">{{ $req->created_at->format('d M Y') }}</div>
                      <div style="font-size:.7rem; color:var(--text-light);">{{ $req->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td>
                      <div style="font-weight:700; color:var(--primary); font-size:0.82rem; margin-bottom:4px;">
                        {{ $req->jenisMasalah->nama_masalah ?? 'Kategori Dihapus' }}
                      </div>
                      <div style="font-size:0.75rem; color:var(--text-muted); line-height:1.4;">
                        <strong>Pengaju:</strong> {{ $req->nama }} (NIM: {{ $req->nim }})<br>
                        <strong>Prodi:</strong> {{ $req->prodi }} &middot; Angkatan {{ $req->angkatan }}
                      </div>
                      @if ($req->keterangan)
                        <div style="margin-top:6px; font-size:.75rem; color:var(--text-muted); background:#f8fafc; padding:6px 8px; border-radius:6px; border:1px solid var(--border); line-height:1.3;">
                          {{ $req->keterangan }}
                        </div>
                      @endif
                    </td>
                    <td style="vertical-align:middle;">
                      <div style="display: flex; flex-direction: column; gap: 6px; align-items: center;">
                        @forelse($req->pengajuanDokumens as $doc)
                          @if($doc->gdrive_file_url)
                            <a href="{{ $doc->gdrive_file_url }}" target="_blank" title="{{ $doc->nama_dokumen }} (Google Drive)" style="text-decoration:none; display:inline-flex; align-items:center; gap:4px; font-size:0.7rem; font-weight:600; color:#059669; background:rgba(16,185,129,.08); padding:4px 8px; border-radius:6px; white-space: nowrap; max-width: 120px; overflow: hidden; text-overflow: ellipsis;">
                              <span>{{ $doc->nama_dokumen }}</span>
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                          @else
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" title="{{ $doc->nama_dokumen }}" style="text-decoration:none; display:inline-flex; align-items:center; gap:4px; font-size:0.7rem; font-weight:600; color:var(--primary); background:var(--primary-light); padding:4px 8px; border-radius:6px; white-space: nowrap; max-width: 120px; overflow: hidden; text-overflow: ellipsis;">
                              <span>{{ $doc->nama_dokumen }}</span>
                              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                          @endif
                        @empty
                          <span style="color:var(--text-light); font-size:0.72rem; font-style:italic;">Tidak ada berkas</span>
                        @endforelse
                      </div>
                    </td>
                    <td style="text-align:center; vertical-align:middle;">
                      @if ($req->status === 'pengajuan')
                        <span class="badge badge-pending">Pengajuan</span>
                      @elseif ($req->status === 'proses')
                        <span class="badge badge-process">Proses</span>
                      @elseif ($req->status === 'selesai')
                        <span class="badge badge-success">Selesai</span>
                      @endif
                    </td>
                    <td style="font-size:.78rem; line-height:1.4;">
                      @if ($req->catatan_admin)
                        <div style="color:var(--text); font-weight:500;">
                          {{ $req->catatan_admin }}
                        </div>
                      @else
                        <span style="color:var(--text-light); font-style:italic;">Belum ada catatan</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </section>

  </main>

  <script>
    const requirementsData = @json($jenisMasalah);
    const selectMasalah = document.getElementById('jenis_masalah_id');
    const uploadContainer = document.getElementById('dynamic-upload-container');

    function renderUploadFields() {
      const selectedId = selectMasalah.value;
      if (!selectedId) {
        uploadContainer.innerHTML = '<p style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">Pilih kategori masalah terlebih dahulu untuk menampilkan form upload berkas pendukung.</p>';
        return;
      }

      const category = requirementsData.find(item => item.id == selectedId);
      if (!category || !category.dokumen_persyaratans || category.dokumen_persyaratans.length === 0) {
        uploadContainer.innerHTML = '<p style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">Tidak ada dokumen pendukung yang wajib diunggah untuk kategori ini.</p>';
        return;
      }

      // Render new input fields
      let html = '';
      category.dokumen_persyaratans.forEach(doc => {
        const requiredAsterisk = doc.is_wajib ? ' <span style="color: #ef4444; font-weight: bold;">*</span>' : '';
        const requiredAttr = doc.is_wajib ? 'required' : '';
        html += `
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" style="display: block; margin-bottom: 6px;">
              ${doc.nama_dokumen}${requiredAsterisk}
            </label>
            <input type="file" name="bukti_files[${doc.id}]" class="form-control" accept=".pdf,.png,.jpg,.jpeg" ${requiredAttr} style="padding:6px 10px;">
            <span class="form-hint" style="margin-top: 4px; display: block;">Format: PDF/JPG/PNG. Maksimal 2MB.</span>
          </div>
        `;
      });
      uploadContainer.innerHTML = html;
    }

    if (selectMasalah) {
      selectMasalah.addEventListener('change', renderUploadFields);
      
      // Only run on page load if the container has no pre-rendered files or just the default paragraph
      if (uploadContainer.children.length === 0 || uploadContainer.querySelector('p')) {
        renderUploadFields();
      }
    }
  </script>
</body>
</html>
