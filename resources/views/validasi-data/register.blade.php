<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Mahasiswa — Validasi Data · PDPT UGK</title>
  <meta name="description" content="Pendaftaran akun mahasiswa untuk validasi data akademik PDPT Universitas Gunung Kidul">
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

    html{height:100%}
    body{
      font-family:'Inter',system-ui,-apple-system,sans-serif;
      min-height:100%;display:flex;align-items:center;justify-content:center;
      background:var(--bg);position:relative;overflow-x:hidden;padding:40px 0;
    }

    body::before{
      content:'';position:fixed;inset:0;
      background:
        radial-gradient(ellipse 80% 60% at 10% 20%, rgba(37,99,235,.08), transparent 60%),
        radial-gradient(ellipse 60% 50% at 90% 80%, rgba(124,58,237,.06), transparent 60%),
        radial-gradient(ellipse 50% 40% at 50% 10%, rgba(16,185,129,.05), transparent 60%);
      z-index:0;
    }
    body::after{
      content:'';position:fixed;inset:0;
      background-image:linear-gradient(rgba(37,99,235,.02) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,.02) 1px,transparent 1px);
      background-size:32px 32px;z-index:0;
    }

    .shape{position:fixed;border-radius:50%;opacity:.4;filter:blur(60px);z-index:0;animation:float 20s ease-in-out infinite;}
    .shape-1{width:300px;height:300px;top:-80px;right:-60px;background:rgba(37,99,235,.12);animation-delay:0s}
    .shape-2{width:250px;height:250px;bottom:-60px;left:-40px;background:rgba(124,58,237,.1);animation-delay:-7s}
    .shape-3{width:200px;height:200px;top:40%;left:60%;background:rgba(16,185,129,.08);animation-delay:-14s}
    @keyframes float{
      0%,100%{transform:translate(0,0) scale(1)}
      33%{transform:translate(20px,-15px) scale(1.05)}
      66%{transform:translate(-15px,10px) scale(.95)}
    }

    .page-container{position:relative;z-index:1;width:100%;max-width:500px;padding:20px;}

    .back-link{
      display:inline-flex;align-items:center;gap:6px;color:var(--text-muted);text-decoration:none;
      font-size:.82rem;font-weight:500;margin-bottom:20px;padding:6px 12px 6px 8px;
      border-radius:10px;background:rgba(255,255,255,.6);backdrop-filter:blur(8px);
      border:1px solid rgba(226,232,240,.6);transition:all .2s;
    }
    .back-link:hover{color:var(--primary);background:var(--primary-light);border-color:rgba(37,99,235,.15)}

    .login-card{
      background:var(--card);border-radius:var(--radius);border:1px solid var(--border);
      box-shadow:var(--shadow);overflow:hidden;animation:cardIn .6s cubic-bezier(.22,1,.36,1) both;
    }
    @keyframes cardIn{from{opacity:0;transform:translateY(16px) scale(.98)}to{opacity:1;transform:translateY(0) scale(1)}}

    .card-header{
      padding:36px 32px 24px;text-align:center;
      background:linear-gradient(135deg,rgba(37,99,235,.03),rgba(124,58,237,.03));
      border-bottom:1px solid var(--border);
    }
    .logo-ring{
      width:60px;height:60px;border-radius:14px;background:white;
      box-shadow:0 2px 12px rgba(15,23,42,.08);display:flex;align-items:center;
      justify-content:center;margin:0 auto 16px;border:1px solid var(--border);
    }
    .logo-img{width:36px;height:36px;object-fit:contain}
    .header-eyebrow{font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--primary);margin-bottom:4px;}
    .header-title{font-size:1.3rem;font-weight:800;color:var(--text);letter-spacing:-.02em;margin-bottom:4px;}
    .header-sub{font-size:.78rem;color:var(--text-muted);line-height:1.4;}
    .role-badge{
      display:inline-flex;align-items:center;gap:5px;margin-top:12px;padding:5px 12px;
      border-radius:20px;background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.15);
      font-size:.7rem;font-weight:600;color:#059669;
    }

    .card-body{padding:28px 32px}

    /* Alert Messages */
    .alert{padding:12px 16px;border-radius:10px;font-size:.8rem;font-weight:500;margin-bottom:16px;display:flex;align-items:flex-start;gap:8px;}
    .alert-error{background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.15);color:#dc2626;}
    .alert-success{background:rgba(16,185,129,.06);border:1px solid rgba(16,185,129,.15);color:#059669;}
    .alert ul{margin:4px 0 0 16px;}

    /* Input group */
    .input-group{margin-bottom:18px}
    .input-label{
      display:flex;align-items:center;gap:6px;font-size:.75rem;font-weight:600;
      color:var(--text);margin-bottom:7px;letter-spacing:.02em;
    }
    .input-label svg{color:var(--text-muted)}
    .input-wrap{position:relative;display:flex;align-items:center;}
    .input-icon{position:absolute;left:14px;color:var(--text-light);pointer-events:none;transition:color .2s;}
    .input-field{
      width:100%;padding:12px 14px 12px 44px;border:1.5px solid var(--border);border-radius:12px;
      font-family:inherit;font-size:.88rem;color:var(--text);background:rgba(248,250,252,.6);transition:all .25s;outline:none;
    }
    .input-field::placeholder{color:var(--text-light)}
    .input-field:focus{border-color:var(--primary);background:white;box-shadow:0 0 0 3px rgba(37,99,235,.1);}
    .input-field.is-invalid{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.08);}
    .invalid-feedback{font-size:.72rem;color:#ef4444;margin-top:5px;font-weight:500;}
    .toggle-pw{position:absolute;right:12px;background:none;border:none;cursor:pointer;color:var(--text-light);padding:4px;border-radius:6px;transition:color .2s;}
    .toggle-pw:hover{color:var(--primary)}

    /* CAPTCHA section */
    .captcha-section{
      background:linear-gradient(135deg,rgba(37,99,235,.03),rgba(124,58,237,.02));
      border:1.5px solid rgba(37,99,235,.12);border-radius:12px;padding:16px;margin-bottom:18px;
    }
    .captcha-label{
      font-size:.75rem;font-weight:600;color:var(--text);margin-bottom:10px;
      display:flex;align-items:center;gap:6px;
    }
    .captcha-row{display:flex;align-items:center;gap:12px;}
    .captcha-image-wrap{
      position:relative;flex-shrink:0;border-radius:10px;overflow:hidden;
      box-shadow:0 2px 8px rgba(15,23,42,.08);border:1.5px solid var(--border);
      height:48px;
    }
    .captcha-image-wrap img{display:block;height:100%;width:auto;}
    .captcha-refresh{
      display:flex;align-items:center;justify-content:center;
      width:48px;height:48px;border-radius:10px;
      background:white;border:1.5px solid var(--border);
      cursor:pointer;transition:all .2s;color:var(--text-muted);
      flex-shrink:0;box-shadow:0 2px 8px rgba(15,23,42,.04);
    }
    .captcha-refresh:hover{color:var(--primary);border-color:rgba(37,99,235,.2);background:rgba(37,99,235,.04);}
    .captcha-refresh:active{transform:translateY(1px);}
    .captcha-input{
      width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:10px;
      font-family:inherit;font-size:.88rem;color:var(--text);background:rgba(248,250,252,.6);
      transition:all .25s;outline:none;letter-spacing:2px;box-sizing:border-box;
    }
    .captcha-input::placeholder{letter-spacing:0;color:var(--text-light)}
    .captcha-input:focus{border-color:var(--primary);background:white;box-shadow:0 0 0 3px rgba(37,99,235,.1);}
    .captcha-input.is-invalid{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.08);}
    .captcha-hint{font-size:.7rem;color:var(--text-muted);margin-top:8px;}

    /* Submit button */
    .btn-login{
      width:100%;padding:13px;border:none;border-radius:12px;
      background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;
      font-family:inherit;font-size:.88rem;font-weight:700;letter-spacing:.03em;cursor:pointer;
      display:flex;align-items:center;justify-content:center;gap:8px;
      box-shadow:0 2px 12px rgba(37,99,235,.25);transition:all .25s;margin-top:8px;
    }
    .btn-login:hover{background:linear-gradient(135deg,var(--primary-dark),#1e3a8a);box-shadow:0 4px 20px rgba(37,99,235,.35);transform:translateY(-1px);}
    .btn-login:active{transform:translateY(0);box-shadow:0 2px 8px rgba(37,99,235,.2)}
    .btn-login:disabled{opacity:.6;cursor:not-allowed;transform:none;}

    .card-footer{padding:16px 32px 24px;text-align:center;}
    .forgot-link{
      display:inline-flex;align-items:center;gap:5px;font-size:.78rem;color:var(--text-muted);
      text-decoration:none;font-weight:500;padding:8px 16px;border-radius:10px;
      border:1px solid transparent;transition:all .2s;
    }
    .forgot-link:hover{color:var(--primary);background:rgba(37,99,235,.04);border-color:rgba(37,99,235,.1);}

    .copyright{text-align:center;font-size:.7rem;color:var(--text-light);margin-top:20px;}

    @media(max-width:480px){
      .card-header{padding:28px 24px 20px}
      .card-body{padding:24px}
      .card-footer{padding:12px 24px 20px}
      .captcha-row{flex-direction:column;align-items:stretch;}
    }
  </style>
</head>
<body>

  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>
  <div class="shape shape-3"></div>

  <div class="page-container">
    <a href="/validasi-data/login" class="back-link" id="backLink">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Kembali ke Login
    </a>

    <div class="login-card" id="loginCard">
      <!-- Header -->
      <div class="card-header">
        <div class="logo-ring">
          <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK" class="logo-img">
        </div>
        <div class="header-eyebrow">PDPT UGK</div>
        <h1 class="header-title">Pendaftaran Akun</h1>
        <p class="header-sub">Daftarkan akun mahasiswa untuk layanan validasi data akademik</p>
        <div class="role-badge">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
          Registrasi Mahasiswa
        </div>
      </div>

      <!-- Form -->
      <div class="card-body">

        {{-- Server-side error display --}}
        @if ($errors->any())
          <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>
              Terdapat kesalahan pada form:
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        <form id="registerForm" method="POST" action="{{ route('validasi-data.register.post') }}" autocomplete="off">
          @csrf

          <div class="input-group">
            <label class="input-label" for="nim">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
              NIM (Nomor Induk Mahasiswa)
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
              <input type="text" class="input-field @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 21501244001" required>
            </div>
            @error('nim')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="input-group">
            <label class="input-label" for="name">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              Nama Lengkap
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <input type="text" class="input-field @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
            </div>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="input-group">
            <label class="input-label" for="email">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              Alamat Email Aktif
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <input type="email" class="input-field @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@mahasiswa.ugk.ac.id" required>
            </div>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="input-group">
            <label class="input-label" for="password">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Kata Sandi
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" class="input-field @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
              <button type="button" class="toggle-pw" id="togglePw" aria-label="Tampilkan password">
                <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg class="eye-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
              </button>
            </div>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="input-group">
            <label class="input-label" for="confirm_password">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Konfirmasi Kata Sandi
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" class="input-field @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
              <button type="button" class="toggle-pw" id="toggleConfirmPw" aria-label="Tampilkan konfirmasi password">
                <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg class="eye-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
              </button>
            </div>
            @error('confirm_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- CAPTCHA Section --}}
          <div class="captcha-section">
            <div class="captcha-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              Verifikasi Keamanan (CAPTCHA)
            </div>
            <div class="captcha-row">
              <div class="captcha-image-wrap" id="captchaWrap" title="Klik gambar untuk memuat ulang">
                {!! captcha_img('flat') !!}
              </div>
              <button type="button" class="captcha-refresh" id="refreshCaptcha" title="Muat ulang CAPTCHA">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
              </button>
              <div style="flex:1">
                <input type="text" name="captcha" id="captchaInput" class="captcha-input @error('captcha') is-invalid @enderror" placeholder="Ketik kode" autocomplete="off" required>
                @error('captcha')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
            <div class="captcha-hint">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
              Ketik karakter yang terlihat pada gambar. Klik gambar untuk memuat ulang.
            </div>
          </div>

          <button type="submit" class="btn-login" id="btnRegister">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            DAFTARKAN AKUN
          </button>
        </form>
      </div>

      <!-- Footer -->
      <div class="card-footer">
        <span style="font-size:.78rem; color:var(--text-muted);">Sudah punya akun? </span>
        <a href="/validasi-data/login" class="forgot-link" id="loginLink">
          Login di sini
        </a>
      </div>
    </div>

    <div class="copyright">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</div>
  </div>

  <script>
    // Toggle password visibility
    function setupTogglePw(toggleId, fieldId) {
      const btn = document.getElementById(toggleId);
      const field = document.getElementById(fieldId);
      if (btn && field) {
        btn.addEventListener('click', () => {
          const show = field.type === 'password';
          field.type = show ? 'text' : 'password';
          btn.querySelector('.eye-open').style.display = show ? 'none' : 'block';
          btn.querySelector('.eye-closed').style.display = show ? 'block' : 'none';
        });
      }
    }
    setupTogglePw('togglePw', 'password');
    setupTogglePw('toggleConfirmPw', 'confirm_password');

    // Refresh CAPTCHA
    function refreshCaptcha() {
      const btn = document.getElementById('refreshCaptcha');
      const wrap = document.getElementById('captchaWrap');
      const img = wrap ? wrap.querySelector('img') : null;
      const input = document.getElementById('captchaInput');

      if (!img) return;

      // Nonaktifkan tombol & animasi spin
      if (btn) {
        btn.disabled = true;
        btn.style.opacity = '0.6';
        const svg = btn.querySelector('svg');
        if (svg) svg.style.animation = 'captchaSpin 0.8s linear';
      }

      // Minta URL captcha baru dari server (supaya session captcha ikut di-update)
      fetch('{{ route("validasi-data.captcha-refresh") }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin'
      })
      .then(res => res.json())
      .then(data => {
        if (data.url) {
          img.src = data.url;
        }
      })
      .catch(() => {
        // Fallback: ganti src langsung dengan cache-busting
        img.src = '';
        img.src = '{{ url("/captcha/flat") }}?t=' + Date.now();
      })
      .finally(() => {
        if (btn) {
          btn.disabled = false;
          btn.style.opacity = '1';
          const svg = btn.querySelector('svg');
          if (svg) svg.style.animation = '';
        }
        if (input) {
          input.value = '';
          input.focus();
        }
      });
    }

    document.getElementById('refreshCaptcha').addEventListener('click', refreshCaptcha);
    document.getElementById('captchaWrap').querySelector('img')?.addEventListener('click', refreshCaptcha);

    // Button loading state on submit
    document.getElementById('registerForm').addEventListener('submit', function() {
      const btn = document.getElementById('btnRegister');
      btn.disabled = true;
      btn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite">
          <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
        </svg>
        Memproses...
      `;
    });
  </script>

  <style>
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes captchaSpin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
  </style>
</body>
</html>
