<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Revisi Pengajuan — Validasi Data · PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
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
      max-width:800px;
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

    .edit-container{
      max-width:800px;
      margin:40px auto;
      padding:0 20px;
    }

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
      display:flex;
      align-items:center;
      justify-content:space-between;
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
    .alert-error{
      background:rgba(239,68,68,.06);
      border:1px solid rgba(239,68,68,.15);
      color:#dc2626;
    }
    .alert-info{
      background:rgba(37,99,235,.06);
      border:1px solid rgba(37,99,235,.15);
      color:#1d4ed8;
      line-height:1.5;
    }

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

    .btn-back{
      display:inline-flex;
      align-items:center;
      gap:6px;
      font-size:0.8rem;
      font-weight:600;
      color:var(--text-muted);
      text-decoration:none;
      padding:8px 12px;
      border:1px solid var(--border);
      border-radius:8px;
      background:white;
      transition:all 0.2s;
    }
    .btn-back:hover{
      background:#f8fafc;
      color:var(--text);
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
  </style>
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="nav-container">
      <a href="/" class="brand">
        <img src="{{ $global_site_logo }}" alt="Logo UGK" class="brand-logo">
        <span class="brand-title">PDPT <span>UGK</span></span>
      </a>
      <div class="user-menu">
        <div class="user-info">
          <div class="user-name">{{ $user->name }}</div>
          <div class="user-role">Mahasiswa</div>
        </div>
      </div>
    </div>
  </header>

  <div class="edit-container">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('validasi-data.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Dashboard
        </a>
    </div>

    <section class="card">
      <div class="card-header">
        <h2 class="card-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4z"/></svg>
          Revisi Pengajuan Validasi
        </h2>
      </div>
      <div class="card-body">

        @if ($pengajuan->catatan_admin)
          <div class="alert alert-info">
            <div style="font-weight:700; margin-bottom:4px;">Catatan Admin / Revisi:</div>
            <div>"{{ $pengajuan->catatan_admin }}"</div>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <form method="POST" action="{{ route('validasi-data.pengajuan.update', $pengajuan->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-section-title" style="margin-top:0;">1. Identitas Mahasiswa</div>

          <div class="form-group">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $pengajuan->nama) }}" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="nim">NIM</label>
            <input type="text" id="nim" name="nim" class="form-control" value="{{ old('nim', $pengajuan->nim) }}" required>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="prodi">Program Studi</label>
              <input type="text" id="prodi" name="prodi" class="form-control" value="{{ old('prodi', $pengajuan->prodi) }}" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="fakultas">Fakultas</label>
              <input type="text" id="fakultas" name="fakultas" class="form-control" value="{{ old('fakultas', $pengajuan->fakultas) }}" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="angkatan">Angkatan</label>
              <input type="text" id="angkatan" name="angkatan" class="form-control" value="{{ old('angkatan', $pengajuan->angkatan) }}" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="no_hp">No. Handphone</label>
              <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $pengajuan->no_hp) }}" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="email">Alamat Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $pengajuan->email) }}" required>
          </div>

          <div class="form-section-title">2. Detail Masalah & Dokumen</div>

          <div class="form-group">
            <label class="form-label" for="jenis_masalah_id">Kategori Masalah Perbaikan</label>
            <select id="jenis_masalah_id" name="jenis_masalah_id" class="form-control" required>
              <option value="">-- Pilih Jenis Masalah --</option>
              @foreach($jenisMasalah as $masalah)
                <option value="{{ $masalah->id }}" {{ old('jenis_masalah_id', $pengajuan->jenis_masalah_id) == $masalah->id ? 'selected' : '' }}>
                  {{ $masalah->nama_masalah }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" style="margin-bottom: 8px; font-weight: 700;">Dokumen Bukti Pendukung (PDF/JPG/PNG)</label>
            <div id="dynamic-upload-container" style="display: flex; flex-direction: column; gap: 16px;">
               <!-- JavaScript will render the upload fields and existing file status here -->
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="keterangan">Keterangan / Alasan Lebih Detail</label>
            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Tuliskan keterangan pendukung...">{{ old('keterangan', $pengajuan->keterangan) }}</textarea>
          </div>

          <button type="submit" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 4 12 14.01 9 11.01"/><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg>
            KIRIM PERBAIKAN REVISI
          </button>
        </form>
      </div>
    </section>
  </div>

  <script>
    const requirementsData = @json($jenisMasalah);
    const selectMasalah = document.getElementById('jenis_masalah_id');
    const uploadContainer = document.getElementById('dynamic-upload-container');
    
    // Existing documents mapping (nama_dokumen -> file_path)
    const existingDocs = @json($pengajuan->pengajuanDokumens->mapWithKeys(function($d) {
        return [$d->nama_dokumen => asset('storage/' . $d->file_path)];
    }));

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

      // Check if categories are the same
      const isOriginalCategory = (selectedId == "{{ $pengajuan->jenis_masalah_id }}");

      let html = '';
      category.dokumen_persyaratans.forEach(doc => {
        // If it is the original category and the document has already been uploaded, it doesn't need to be required again.
        const existingUrl = isOriginalCategory ? existingDocs[doc.nama_dokumen] : null;
        const requiredAsterisk = (doc.is_wajib && !existingUrl) ? ' <span style="color: #ef4444; font-weight: bold;">*</span>' : '';
        const requiredAttr = (doc.is_wajib && !existingUrl) ? 'required' : '';
        
        let statusText = '';
        if (existingUrl) {
          statusText = ` <span style="color: #059669; font-size: 0.72rem; font-weight: 600;">(Sudah terunggah: <a href="${existingUrl}" target="_blank" style="color: #2563eb; text-decoration: underline;">Lihat Berkas</a>, abaikan jika tidak ingin diubah)</span>`;
        }

        html += `
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" style="display: block; margin-bottom: 6px;">
              ${doc.nama_dokumen}${requiredAsterisk}${statusText}
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
      renderUploadFields();
    }
  </script>
</body>
</html>
