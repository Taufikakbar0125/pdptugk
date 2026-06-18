<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Mahasiswa — Validasi Data · PDPT UGK</title>
  <meta name="description" content="Login mahasiswa untuk validasi data akademik PDPT Universitas Gunung Kidul">
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
      --shadow-lg:0 12px 40px rgba(15,23,42,.1);
    }

    html{height:100%}

    body{
      font-family:'Inter',system-ui,-apple-system,sans-serif;
      height:100%;
      display:flex;
      align-items:center;
      justify-content:center;
      background:var(--bg);
      position:relative;
      overflow:hidden;
    }

    /* Mesh gradient background */
    body::before{
      content:'';
      position:fixed;
      inset:0;
      background:
        radial-gradient(ellipse 80% 60% at 10% 20%, rgba(37,99,235,.08), transparent 60%),
        radial-gradient(ellipse 60% 50% at 90% 80%, rgba(124,58,237,.06), transparent 60%),
        radial-gradient(ellipse 50% 40% at 50% 10%, rgba(16,185,129,.05), transparent 60%);
      z-index:0;
    }

    /* Subtle grid pattern */
    body::after{
      content:'';
      position:fixed;
      inset:0;
      background-image:
        linear-gradient(rgba(37,99,235,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37,99,235,.02) 1px, transparent 1px);
      background-size:32px 32px;
      z-index:0;
    }

    /* Floating shapes */
    .shape{
      position:fixed;
      border-radius:50%;
      opacity:.4;
      filter:blur(60px);
      z-index:0;
      animation:float 20s ease-in-out infinite;
    }

    .shape-1{width:300px;height:300px;top:-80px;right:-60px;background:rgba(37,99,235,.12);animation-delay:0s}
    .shape-2{width:250px;height:250px;bottom:-60px;left:-40px;background:rgba(124,58,237,.1);animation-delay:-7s}
    .shape-3{width:200px;height:200px;top:40%;left:60%;background:rgba(16,185,129,.08);animation-delay:-14s}

    @keyframes float{
      0%,100%{transform:translate(0,0) scale(1)}
      33%{transform:translate(20px,-15px) scale(1.05)}
      66%{transform:translate(-15px,10px) scale(.95)}
    }

    /* Container */
    .page-container{
      position:relative;
      z-index:1;
      width:100%;
      max-width:440px;
      padding:20px;
    }

    /* Back link */
    .back-link{
      display:inline-flex;
      align-items:center;
      gap:6px;
      color:var(--text-muted);
      text-decoration:none;
      font-size:.82rem;
      font-weight:500;
      margin-bottom:20px;
      padding:6px 12px 6px 8px;
      border-radius:10px;
      background:rgba(255,255,255,.6);
      backdrop-filter:blur(8px);
      border:1px solid rgba(226,232,240,.6);
      transition:all .2s;
    }
    .back-link:hover{color:var(--primary);background:var(--primary-light);border-color:rgba(37,99,235,.15)}

    /* Card */
    .login-card{
      background:var(--card);
      border-radius:var(--radius);
      border:1px solid var(--border);
      box-shadow:var(--shadow);
      overflow:hidden;
      animation:cardIn .6s cubic-bezier(.22,1,.36,1) both;
    }

    @keyframes cardIn{
      from{opacity:0;transform:translateY(16px) scale(.98)}
      to{opacity:1;transform:translateY(0) scale(1)}
    }

    /* Card header */
    .card-header{
      padding:36px 32px 24px;
      text-align:center;
      background:linear-gradient(135deg, rgba(37,99,235,.03), rgba(124,58,237,.03));
      border-bottom:1px solid var(--border);
    }

    .logo-ring{
      width:60px;height:60px;
      border-radius:14px;
      background:white;
      box-shadow:0 2px 12px rgba(15,23,42,.08);
      display:flex;
      align-items:center;
      justify-content:center;
      margin:0 auto 16px;
      border:1px solid var(--border);
    }

    .logo-img{width:36px;height:36px;object-fit:contain}

    .header-eyebrow{
      font-size:.65rem;
      font-weight:700;
      letter-spacing:.1em;
      text-transform:uppercase;
      color:var(--primary);
      margin-bottom:4px;
    }

    .header-title{
      font-size:1.3rem;
      font-weight:800;
      color:var(--text);
      letter-spacing:-.02em;
      margin-bottom:4px;
    }

    .header-sub{
      font-size:.78rem;
      color:var(--text-muted);
      line-height:1.4;
    }

    /* Badge */
    .role-badge{
      display:inline-flex;
      align-items:center;
      gap:5px;
      margin-top:12px;
      padding:5px 12px;
      border-radius:20px;
      background:rgba(37,99,235,.06);
      border:1px solid rgba(37,99,235,.1);
      font-size:.7rem;
      font-weight:600;
      color:var(--primary);
    }

    /* Form body */
    .card-body{padding:28px 32px}

    /* Input group */
    .input-group{margin-bottom:18px}

    .input-label{
      display:flex;
      align-items:center;
      gap:6px;
      font-size:.75rem;
      font-weight:600;
      color:var(--text);
      margin-bottom:7px;
      letter-spacing:.02em;
    }

    .input-label svg{color:var(--text-muted)}

    .input-wrap{
      position:relative;
      display:flex;
      align-items:center;
    }

    .input-icon{
      position:absolute;
      left:14px;
      color:var(--text-light);
      pointer-events:none;
      transition:color .2s;
    }

    .input-field{
      width:100%;
      padding:12px 14px 12px 44px;
      border:1.5px solid var(--border);
      border-radius:12px;
      font-family:inherit;
      font-size:.88rem;
      color:var(--text);
      background:rgba(248,250,252,.6);
      transition:all .25s;
      outline:none;
    }

    .input-field::placeholder{color:var(--text-light)}

    .input-field:focus{
      border-color:var(--primary);
      background:white;
      box-shadow:0 0 0 3px rgba(37,99,235,.1);
    }

    .input-field:focus ~ .input-icon,
    .input-field:focus + .input-icon{color:var(--primary)}

    /* Password toggle */
    .toggle-pw{
      position:absolute;
      right:12px;
      background:none;
      border:none;
      cursor:pointer;
      color:var(--text-light);
      padding:4px;
      border-radius:6px;
      transition:color .2s;
    }
    .toggle-pw:hover{color:var(--primary)}

    /* Login button */
    .btn-login{
      width:100%;
      padding:13px;
      border:none;
      border-radius:12px;
      background:linear-gradient(135deg,var(--primary),var(--primary-dark));
      color:white;
      font-family:inherit;
      font-size:.88rem;
      font-weight:700;
      letter-spacing:.03em;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      box-shadow:0 2px 12px rgba(37,99,235,.25);
      transition:all .25s;
      margin-top:6px;
    }
    .btn-login:hover{
      background:linear-gradient(135deg,var(--primary-dark),#1e3a8a);
      box-shadow:0 4px 20px rgba(37,99,235,.35);
      transform:translateY(-1px);
    }
    .btn-login:active{transform:translateY(0);box-shadow:0 2px 8px rgba(37,99,235,.2)}

    /* Register button */
    .btn-register{
      width:100%;
      padding:13px;
      border:1.5px solid var(--primary);
      border-radius:12px;
      background:transparent;
      color:var(--primary);
      font-family:inherit;
      font-size:.88rem;
      font-weight:700;
      letter-spacing:.03em;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      transition:all .25s;
      margin-top:12px;
      text-decoration:none;
    }
    .btn-register:hover{
      background:var(--primary-light);
      transform:translateY(-1px);
    }

    /* Card footer */
    .card-footer{
      padding:16px 32px 24px;
      text-align:center;
    }

    .forgot-link{
      display:inline-flex;
      align-items:center;
      gap:5px;
      font-size:.78rem;
      color:var(--text-muted);
      text-decoration:none;
      font-weight:500;
      padding:8px 16px;
      border-radius:10px;
      border:1px solid transparent;
      transition:all .2s;
    }
    .forgot-link:hover{
      color:var(--accent);
      background:rgba(124,58,237,.04);
      border-color:rgba(124,58,237,.1);
    }

    /* Copyright */
    .copyright{
      text-align:center;
      font-size:.7rem;
      color:var(--text-light);
      margin-top:20px;
    }

    /* Error state */
    .input-group.error .input-field{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.08)}
    .input-group.error .input-icon{color:#ef4444}
    .error-msg{display:none;font-size:.72rem;color:#ef4444;margin-top:5px;font-weight:500}
    .input-group.error .error-msg{display:block}

    /* Responsive */
    @media(max-width:480px){
      .card-header{padding:28px 24px 20px}
      .card-body{padding:24px}
      .card-footer{padding:12px 24px 20px}
    }
  </style>
</head>
<body>

  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>
  <div class="shape shape-3"></div>

  <div class="page-container">
    <a href="/" class="back-link" id="backLink">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Kembali
    </a>

    <div class="login-card" id="loginCard">
      <!-- Header -->
      <div class="card-header">
        <div class="logo-ring">
          <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK" class="logo-img">
        </div>
        <div class="header-eyebrow">PDPT UGK</div>
        <h1 class="header-title">Validasi Data</h1>
        <p class="header-sub">Verifikasi dan validasi rekam data akademik</p>
        <div class="role-badge">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 10 3 12 0v-5"/></svg>
          Login Mahasiswa
        </div>
      </div>

      <!-- Form -->
      <div class="card-body">
        {{-- Server-side errors or success --}}
        @if ($errors->any())
          <div style="background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.15);color:#dc2626;padding:12px 16px;border-radius:10px;font-size:.8rem;font-weight:500;margin-bottom:16px;">
            {{ $errors->first() }}
          </div>
        @endif
        @if (session('success'))
          <div style="background:rgba(16,185,129,.06);border:1px solid rgba(16,185,129,.15);color:#059669;padding:12px 16px;border-radius:10px;font-size:.8rem;font-weight:500;margin-bottom:16px;">
            {{ session('success') }}
          </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('validasi-data.login.post') }}" autocomplete="off">
          @csrf
          <div class="input-group" id="loginKeyGroup">
            <label class="input-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              NIM atau Alamat Email
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
              <input type="text" class="input-field" id="login_key" name="login_key" value="{{ old('login_key') }}" placeholder="Contoh: 21501244001 atau nama@email.com" required>
            </div>
            <span class="error-msg">NIM atau Email wajib diisi.</span>
          </div>

          <div class="input-group" id="passwordGroup">
            <label class="input-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Kata Sandi
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" class="input-field" id="password" name="password" placeholder="••••••••" required>
              <button type="button" class="toggle-pw" id="togglePw" aria-label="Tampilkan password">
                <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg class="eye-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
              </button>
            </div>
            <span class="error-msg">Kata sandi wajib diisi.</span>
          </div>

          <button type="submit" class="btn-login" id="btnLogin">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
            MASUK
          </button>
          
          <a href="/validasi-data/register" class="btn-register">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            DAFTARKAN AKUN
          </a>
        </form>
      </div>

      <!-- Footer -->
      <div class="card-footer">
        <a href="/validasi-data/lupa-password" class="forgot-link" id="forgotLink">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          Lupa Kata Sandi?
        </a>
      </div>
    </div>

    <div class="copyright">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</div>
  </div>

  <script>
    // Toggle password visibility
    const togglePw = document.getElementById('togglePw');
    const pwField = document.getElementById('password');
    if (togglePw && pwField) {
      togglePw.addEventListener('click', () => {
        const show = pwField.type === 'password';
        pwField.type = show ? 'text' : 'password';
        togglePw.querySelector('.eye-open').style.display = show ? 'none' : 'block';
        togglePw.querySelector('.eye-closed').style.display = show ? 'block' : 'none';
      });
    }

    // Form validation
    document.getElementById('loginForm').addEventListener('submit', (e) => {
      let valid = true;

      const loginKey = document.getElementById('login_key');
      const pw = document.getElementById('password');
      const loginKeyGroup = document.getElementById('loginKeyGroup');
      const pwGroup = document.getElementById('passwordGroup');

      loginKeyGroup.classList.remove('error');
      pwGroup.classList.remove('error');

      if (!loginKey.value.trim()) { loginKeyGroup.classList.add('error'); valid = false; }
      if (!pw.value.trim()) { pwGroup.classList.add('error'); valid = false; }

      if (!valid) {
        e.preventDefault();
      }
    });

    // Clear error on input
    document.querySelectorAll('.input-field').forEach(input => {
      input.addEventListener('input', () => {
        input.closest('.input-group').classList.remove('error');
      });
    });
  </script>
</body>
</html>
