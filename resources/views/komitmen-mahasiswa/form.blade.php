<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komitmen Mahasiswa Limit Masa Studi — PDPT UGK</title>
    <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --surface: #ffffff;
            --background: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --input-bg: #f1f5f9;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Header Gradient ───────────────────── */
        .header-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
            padding: 2rem 1.5rem 8rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        /* Subtle background decoration */
        .header-bg::before {
            content: '';
            position: absolute;
            top: -50%; right: -10%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
            border-radius: 50%;
        }

        .header-top {
            max-width: 680px;
            margin: 0 auto 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }

        .brand img {
            width: 44px; height: 44px;
            border-radius: 50%;
            object-fit: cover;
            background: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .brand-info {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .brand-sub {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .header-content {
            max-width: 680px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .page-title {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
            line-height: 1.2;
            color: white;
        }

        .page-description {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ── Main Content ──────────────────────── */
        .main-container {
            max-width: 680px;
            margin: -4rem auto 5rem;
            padding: 0 1.5rem;
            position: relative;
            z-index: 3;
        }

        /* ── Alert ─────────────────────────────── */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* ── Form Card ─────────────────────────── */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }

        /* ── Download Section ──────────────────── */
        .section-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .download-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 3rem;
            background: var(--background);
            padding: 1.25rem;
            border-radius: 16px;
            border: 1px solid var(--border);
        }

        .download-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .download-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.08);
            transform: translateY(-2px);
        }

        .dl-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 0.75rem;
        }

        .dl-icon.green { background: #ecfdf5; color: #10b981; }
        .dl-icon.blue { background: #eff6ff; color: #3b82f6; }
        .dl-icon.red { background: #fef2f2; color: #ef4444; }

        .dl-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }

        /* ── Form Layout ───────────────────────── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-row .form-group { margin-bottom: 0; }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #334155;
        }

        .form-label .req { color: #ef4444; }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            background-color: var(--input-bg);
            border: 1.5px solid transparent;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: all 0.2s;
            outline: none;
        }

        .form-control::placeholder { color: #94a3b8; }

        .form-control:focus {
            background-color: var(--surface);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2rem;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        .form-error {
            font-size: 0.8rem;
            color: #ef4444;
            font-weight: 500;
        }

        /* ── File Upload ───────────────────────── */
        .upload-area {
            position: relative;
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            background: var(--surface);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .upload-area:hover, .upload-area.dragover {
            border-color: var(--primary);
            background: #eff6ff;
        }

        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            width: 48px; height: 48px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            color: #64748b;
        }

        .upload-area:hover .upload-icon {
            background: white;
            color: var(--primary);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .upload-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }

        .upload-subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .file-selected {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: #eff6ff;
            color: var(--primary-dark);
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* ── Submit Button ─────────────────────── */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 1rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }

        /* ── Footer ────────────────────────────── */
        .footer {
            text-align: center;
            padding: 0 1.5rem 3rem;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* ── Responsive ────────────────────────── */
        @media (max-width: 640px) {
            .header-bg { padding: 1.5rem 1.5rem 6rem; }
            .form-row { grid-template-columns: 1fr; gap: 1.5rem; }
            .download-grid { grid-template-columns: 1fr; gap: 0.75rem; padding: 1rem; }
            .download-card { flex-direction: row; justify-content: flex-start; text-align: left; padding: 0.75rem 1rem; gap: 1rem; }
            .dl-icon { margin-bottom: 0; width: 36px; height: 36px; }
            .form-card { padding: 1.5rem; border-radius: 16px; }
            .page-title { font-size: 1.75rem; }
        }
    </style>
</head>
<body>

    <!-- Header Gradient Background -->
    <div class="header-bg">
        <div class="header-top">
            <a href="/" class="brand">
                <img src="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK">
                <div class="brand-info">
                    <span class="brand-name">PDPT UGK</span>
                    <span class="brand-sub">Universitas Gunung Kidul</span>
                </div>
            </a>
            <a href="/" style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.8); text-decoration: none;">Kembali</a>
        </div>
        
        <div class="header-content">
            <h1 class="page-title">Komitmen Mahasiswa<br>Limit Masa Studi</h1>
            <p class="page-description">Berdasarkan surat edaran Wakil Rektor Bidang Akademik dan Sistem Informasi terkait evaluasi Mahasiswa yang memasuki limit masa studi pada semester Ganjil 2025/2026.</p>
        </div>
    </div>

    <!-- Main Container overlapping the header -->
    <main class="main-container">

        @if(session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="form-card">
            
            <!-- Download Section -->
            <div class="section-label">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                1. Download & Cetak Formulir
            </div>

            <div class="download-grid">
                <a href="https://s.id/FORM-MELANJUTKAN-STUDI" target="_blank" rel="noopener" class="download-card">
                    <div class="dl-icon green">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="dl-title">Melanjutkan Studi</div>
                </a>
                <a href="https://s.id/FORM-PINDAH-PT" target="_blank" rel="noopener" class="download-card">
                    <div class="dl-icon blue">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <div class="dl-title">Pindah PT</div>
                </a>
                <a href="https://s.id/FORM-PENGUNDURAN-DIRI" target="_blank" rel="noopener" class="download-card">
                    <div class="dl-icon red">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="dl-title">Pengunduran Diri</div>
                </a>
            </div>

            <!-- Form Section -->
            <div class="section-label" style="margin-bottom: 1.5rem;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                2. Isi Data & Upload
            </div>

            <form action="{{ route('komitmen-mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama sesuai KTP/KTM" value="{{ old('nama') }}" required>
                        @error('nama') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">NIM <span class="req">*</span></label>
                        <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" required>
                        @error('nim') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Program Studi <span class="req">*</span></label>
                        <select name="program_studi" class="form-control" required>
                            <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Pilih Program Studi</option>
                            <option value="Administrasi Publik" {{ old('program_studi') == 'Administrasi Publik' ? 'selected' : '' }}>Administrasi Publik</option>
                            <option value="Agroteknologi" {{ old('program_studi') == 'Agroteknologi' ? 'selected' : '' }}>Agroteknologi</option>
                            <option value="Teknik Sipil" {{ old('program_studi') == 'Teknik Sipil' ? 'selected' : '' }}>Teknik Sipil</option>
                            <option value="Pembangunan Sosial" {{ old('program_studi') == 'Pembangunan Sosial' ? 'selected' : '' }}>Pembangunan Sosial</option>
                            <option value="Ekonomi Pembangunan" {{ old('program_studi') == 'Ekonomi Pembangunan' ? 'selected' : '' }}>Ekonomi Pembangunan</option>
                        </select>
                        @error('program_studi') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp <span class="req">*</span></label>
                        <input type="tel" name="nomor_wa" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('nomor_wa') }}" required>
                        @error('nomor_wa') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tindak Lanjut Anda <span class="req">*</span></label>
                    <select name="tindak_lanjut" class="form-control" required>
                        <option value="" disabled {{ old('tindak_lanjut') ? '' : 'selected' }}>Pilih komitmen</option>
                        <option value="Melanjutkan Studi" {{ old('tindak_lanjut') == 'Melanjutkan Studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                        <option value="Pindah PT" {{ old('tindak_lanjut') == 'Pindah PT' ? 'selected' : '' }}>Pindah PT</option>
                        <option value="Pengunduran Diri" {{ old('tindak_lanjut') == 'Pengunduran Diri' ? 'selected' : '' }}>Pengunduran Diri</option>
                    </select>
                    @error('tindak_lanjut') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-top: 2rem;">
                    <label class="form-label">Upload Formulir Komitmen (PDF/Image) <span class="req">*</span></label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" name="file_berkas" id="fileInput" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                        <div class="upload-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        </div>
                        <div class="upload-title">Pilih File atau Drag & Drop</div>
                        <div class="upload-subtitle">PDF, JPG, PNG, DOCX (Maksimal 10MB)</div>
                        <div class="file-selected" id="fileSelected">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span id="fileName"></span>
                        </div>
                    </div>
                    @error('file_berkas') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Form Komitmen
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} <a href="/" style="color: #64748b; text-decoration: none; font-weight: 600;">PDPT Universitas Gunung Kidul</a>. All rights reserved.</p>
    </footer>

    <script>
        const fileInput = document.getElementById('fileInput');
        const uploadArea = document.getElementById('uploadArea');
        const fileSelected = document.getElementById('fileSelected');
        const fileName = document.getElementById('fileName');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileSelected.style.display = 'flex';
                uploadArea.style.borderColor = 'var(--primary)';
                uploadArea.style.background = '#eff6ff';
            } else {
                fileSelected.style.display = 'none';
                uploadArea.style.borderColor = '';
                uploadArea.style.background = '';
            }
        });

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
            uploadArea.addEventListener(evt, e => { e.preventDefault(); e.stopPropagation(); }, false);
        });

        ['dragenter', 'dragover'].forEach(evt => {
            uploadArea.addEventListener(evt, () => uploadArea.classList.add('dragover'), false);
        });

        ['dragleave', 'drop'].forEach(evt => {
            uploadArea.addEventListener(evt, () => uploadArea.classList.remove('dragover'), false);
        });

        uploadArea.addEventListener('drop', e => {
            if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>
</html>
