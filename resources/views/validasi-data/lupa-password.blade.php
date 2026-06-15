<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Kata Sandi — Validasi Data · PDPT UGK</title>
  <meta name="description" content="Reset kata sandi akun mahasiswa untuk sistem validasi data PDPT Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

    :root{
      --bg:#f0f4f8;
      --card:#ffffff;
      --primary:#7c3aed;
      --primary-dark:#6d28d9;
      --primary-light:rgba(124,58,237,.08);
      --text:#0f172a;
      --text-muted:#64748b;
      --text-light:#94a3b8;
      --border:#e2e8f0;
      --success:#059669;
      --radius:16px;
      --shadow:0 4px 24px rgba(15,23,42,.06),0 1px 3px rgba(15,23,42,.04);
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

    body::before{
      content:'';
      position:fixed;
      inset:0;
      background:
        radial-gradient(ellipse 80% 60% at 10% 80%, rgba(124,58,237,.07), transparent 60%),
        radial-gradient(ellipse 60% 50% at 90% 20%, rgba(37,99,235,.06), transparent 60%),
        radial-gradient(ellipse 50% 40% at 40% 60%, rgba(245,158,11,.04), transparent 60%);
      z-index:0;
    }

    body::after{
      content:'';
      position:fixed;
      inset:0;
      background-image:
        linear-gradient(rgba(124,58,237,.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(124,58,237,.015) 1px, transparent 1px);
      background-size:32px 32px;
      z-index:0;
    }

    .shape{position:fixed;border-radius:50%;opacity:.35;filter:blur(60px);z-index:0;animation:float 20s ease-in-out infinite}
    .shape-1{width:280px;height:280px;top:-60px;left:-40px;background:rgba(124,58,237,.12)}
    .shape-2{width:220px;height:220px;bottom:-50px;right:-30px;background:rgba(37,99,235,.1);animation-delay:-8s}

    @keyframes float{
      0%,100%{transform:translate(0,0) scale(1)}
      33%{transform:translate(15px,-12px) scale(1.04)}
      66%{transform:translate(-12px,8px) scale(.96)}
    }

    .page-container{position:relative;z-index:1;width:100%;max-width:440px;padding:20px}

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
    .back-link:hover{color:var(--primary);background:var(--primary-light);border-color:rgba(124,58,237,.15)}

    /* Card */
    .form-card{
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

    /* Header */
    .card-header{
      padding:36px 32px 24px;
      text-align:center;
      background:linear-gradient(135deg, rgba(124,58,237,.04), rgba(37,99,235,.03));
      border-bottom:1px solid var(--border);
    }

    .header-icon{
      width:56px;height:56px;
      border-radius:14px;
      background:linear-gradient(135deg,rgba(124,58,237,.1),rgba(37,99,235,.08));
      display:flex;
      align-items:center;
      justify-content:center;
      margin:0 auto 16px;
      color:var(--primary);
    }

    .header-eyebrow{font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--primary);margin-bottom:4px}
    .header-title{font-size:1.2rem;font-weight:800;color:var(--text);letter-spacing:-.02em;margin-bottom:6px}
    .header-sub{font-size:.78rem;color:var(--text-muted);line-height:1.5}

    /* Body */
    .card-body{padding:28px 32px}

    /* Info alert */
    .info-alert{
      display:flex;
      gap:10px;
      padding:14px 16px;
      border-radius:12px;
      background:rgba(37,99,235,.04);
      border:1px solid rgba(37,99,235,.08);
      margin-bottom:22px;
    }

    .info-alert svg{flex-shrink:0;color:#2563eb;margin-top:1px}
    .info-alert p{font-size:.76rem;color:var(--text-muted);line-height:1.5}

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

    .input-wrap{position:relative;display:flex;align-items:center}

    .input-icon{position:absolute;left:14px;color:var(--text-light);pointer-events:none;transition:color .2s}

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
    .input-field:focus{border-color:var(--primary);background:white;box-shadow:0 0 0 3px rgba(124,58,237,.1)}

    /* Buttons */
    .btn-submit{
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
      box-shadow:0 2px 12px rgba(124,58,237,.25);
      transition:all .25s;
      margin-top:6px;
    }
    .btn-submit:hover{
      background:linear-gradient(135deg,var(--primary-dark),#5b21b6);
      box-shadow:0 4px 20px rgba(124,58,237,.35);
      transform:translateY(-1px);
    }
    .btn-submit:active{transform:translateY(0)}

    /* Footer */
    .card-footer{
      padding:16px 32px 24px;
      text-align:center;
    }

    .login-link{
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
    .login-link:hover{
      color:#2563eb;
      background:rgba(37,99,235,.04);
      border-color:rgba(37,99,235,.1);
    }

    .copyright{text-align:center;font-size:.7rem;color:var(--text-light);margin-top:20px}

    /* Success state */
    .success-state{display:none;text-align:center;padding:20px 0}
    .success-state.show{display:block}
    .success-state .check-circle{
      width:64px;height:64px;
      border-radius:50%;
      background:rgba(5,150,105,.08);
      display:flex;
      align-items:center;
      justify-content:center;
      margin:0 auto 16px;
      color:var(--success);
      animation:popIn .5s cubic-bezier(.22,1,.36,1);
    }
    @keyframes popIn{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}
    .success-state h3{font-size:1rem;font-weight:700;color:var(--text);margin-bottom:8px}
    .success-state p{font-size:.8rem;color:var(--text-muted);line-height:1.5}

    .form-state{transition:opacity .3s}
    .form-state.hide{opacity:0;pointer-events:none;height:0;overflow:hidden}

    /* Error state */
    .input-group.error .input-field{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.08)}
    .error-msg{display:none;font-size:.72rem;color:#ef4444;margin-top:5px;font-weight:500}
    .input-group.error .error-msg{display:block}

    @media(max-width:480px){
      .card-header{padding:28px 24px 20px}
      .card-body{padding:24px}
    }
  </style>
</head>
<body>

  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>

  <div class="page-container">
    <a href="/validasi-data/login" class="back-link" id="backLink">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Kembali ke Login
    </a>

    <div class="form-card" id="formCard">
      <!-- Header -->
      <div class="card-header">
        <div class="header-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        </div>
        <div class="header-eyebrow">PDPT UGK</div>
        <h1 class="header-title">Lupa Kata Sandi</h1>
        <p class="header-sub">Masukkan NIM dan email terdaftar Anda untuk menerima tautan reset kata sandi.</p>
      </div>

      <!-- Form -->
      <div class="card-body">
        <!-- Info alert -->
        <div class="info-alert">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
          <p>Tautan reset akan dikirim ke email yang terdaftar di sistem akademik. Pastikan email Anda aktif.</p>
        </div>

        <!-- Form state -->
        <div class="form-state" id="formState">
          <form id="resetForm" autocomplete="off">
            <div class="input-group" id="nimGroup">
              <label class="input-label">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                NIM
              </label>
              <div class="input-wrap">
                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                <input type="text" class="input-field" id="nim" name="nim" placeholder="Contoh: 21501244001" required>
              </div>
              <span class="error-msg">NIM wajib diisi.</span>
            </div>

            <div class="input-group" id="emailGroup">
              <label class="input-label">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Email Terdaftar
              </label>
              <div class="input-wrap">
                <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <input type="email" class="input-field" id="email" name="email" placeholder="nama@ugk.ac.id" required>
              </div>
              <span class="error-msg">Email wajib diisi dengan format yang benar.</span>
            </div>

            <button type="submit" class="btn-submit" id="btnSubmit">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              KIRIM TAUTAN RESET
            </button>
          </form>
        </div>

        <!-- Success state -->
        <div class="success-state" id="successState">
          <div class="check-circle">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <h3>Tautan Reset Terkirim!</h3>
          <p>Silakan cek email Anda untuk melanjutkan proses reset kata sandi. Tautan berlaku selama 30 menit.</p>
        </div>
      </div>

      <!-- Footer -->
      <div class="card-footer">
        <a href="/validasi-data/login" class="login-link" id="loginLink">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          Kembali ke halaman Login
        </a>
      </div>
    </div>

    <div class="copyright">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</div>
  </div>

  <script>
    document.getElementById('resetForm').addEventListener('submit', (e) => {
      e.preventDefault();
      let valid = true;

      const nim = document.getElementById('nim');
      const email = document.getElementById('email');
      const nimGroup = document.getElementById('nimGroup');
      const emailGroup = document.getElementById('emailGroup');

      nimGroup.classList.remove('error');
      emailGroup.classList.remove('error');

      if (!nim.value.trim()) { nimGroup.classList.add('error'); valid = false; }
      if (!email.value.trim() || !email.value.includes('@')) { emailGroup.classList.add('error'); valid = false; }

      if (valid) {
        // Show success state
        document.getElementById('formState').classList.add('hide');
        document.querySelector('.info-alert').style.display = 'none';
        document.getElementById('successState').classList.add('show');
      }
    });

    document.querySelectorAll('.input-field').forEach(input => {
      input.addEventListener('input', () => {
        input.closest('.input-group').classList.remove('error');
      });
    });
  </script>
</body>
</html>
