<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Kata Sandi Baru — Validasi Data · PDPT UGK</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

    :root{
      --bg:#f0f4f8;
      --card:#ffffff;
      --primary:#059669;
      --primary-dark:#047857;
      --primary-light:rgba(5,150,105,.08);
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
        radial-gradient(ellipse 80% 60% at 10% 80%, rgba(5,150,105,.07), transparent 60%),
        radial-gradient(ellipse 60% 50% at 90% 20%, rgba(37,99,235,.05), transparent 60%),
        radial-gradient(ellipse 50% 40% at 40% 60%, rgba(245,158,11,.04), transparent 60%);
      z-index:0;
    }

    body::after{
      content:'';
      position:fixed;
      inset:0;
      background-image:
        linear-gradient(rgba(5,150,105,.012) 1px, transparent 1px),
        linear-gradient(90deg, rgba(5,150,105,.012) 1px, transparent 1px);
      background-size:32px 32px;
      z-index:0;
    }

    .shape{position:fixed;border-radius:50%;opacity:.35;filter:blur(60px);z-index:0;animation:float 20s ease-in-out infinite}
    .shape-1{width:280px;height:280px;top:-60px;left:-40px;background:rgba(5,150,105,.12)}
    .shape-2{width:220px;height:220px;bottom:-50px;right:-30px;background:rgba(37,99,235,.08);animation-delay:-8s}

    @keyframes float{
      0%,100%{transform:translate(0,0) scale(1)}
      33%{transform:translate(15px,-12px) scale(1.04)}
      66%{transform:translate(-12px,8px) scale(.96)}
    }

    .page-container{position:relative;z-index:1;width:100%;max-width:440px;padding:20px}

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

    .card-header{
      padding:36px 32px 24px;
      text-align:center;
      background:linear-gradient(135deg, rgba(5,150,105,.04), rgba(16,185,129,.03));
      border-bottom:1px solid var(--border);
    }

    .header-icon{
      width:56px;height:56px;
      border-radius:14px;
      background:linear-gradient(135deg,rgba(5,150,105,.1),rgba(16,185,129,.08));
      display:flex;
      align-items:center;
      justify-content:center;
      margin:0 auto 16px;
      color:var(--primary);
    }

    .header-eyebrow{font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--primary);margin-bottom:4px}
    .header-title{font-size:1.2rem;font-weight:800;color:var(--text);letter-spacing:-.02em;margin-bottom:6px}
    .header-sub{font-size:.78rem;color:var(--text-muted);line-height:1.5}

    .card-body{padding:28px 32px}

    .info-alert{
      display:flex;
      gap:10px;
      padding:14px 16px;
      border-radius:12px;
      background:rgba(5,150,105,.04);
      border:1px solid rgba(5,150,105,.1);
      margin-bottom:22px;
    }
    .info-alert svg{flex-shrink:0;color:var(--primary);margin-top:1px}
    .info-alert p{font-size:.76rem;color:var(--text-muted);line-height:1.5}

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
      padding:12px 14px 12px 44px !important;
      border:1.5px solid var(--border) !important;
      border-radius:12px !important;
      font-family:inherit;
      font-size:.88rem;
      color:var(--text);
      background:rgba(248,250,252,.6) !important;
      transition:all .25s;
      outline:none;
    }

    .input-field::placeholder{color:var(--text-light)}
    .input-field:focus{border-color:var(--primary) !important;background:white !important;box-shadow:0 0 0 3px rgba(5,150,105,.1)}

    .toggle-pw{
      position:absolute;right:14px;
      background:none;border:none;cursor:pointer;
      color:var(--text-light);transition:color .2s;padding:4px;
    }
    .toggle-pw:hover{color:var(--primary)}

    .pw-strength{margin-top:8px;display:flex;gap:4px;align-items:center}
    .pw-bar{height:3px;flex:1;border-radius:2px;background:#e2e8f0;transition:background .3s}
    .pw-bar.weak{background:#ef4444}
    .pw-bar.medium{background:#f59e0b}
    .pw-bar.strong{background:#10b981}
    .pw-text{font-size:.65rem;font-weight:600;margin-left:8px;color:var(--text-light);min-width:50px}

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
      box-shadow:0 2px 12px rgba(5,150,105,.25);
      transition:all .25s;
      margin-top:6px;
    }
    .btn-submit:hover{
      background:linear-gradient(135deg,var(--primary-dark),#065f46);
      box-shadow:0 4px 20px rgba(5,150,105,.35);
      transform:translateY(-1px);
    }
    .btn-submit:active{transform:translateY(0)}

    .error-msg{font-size:.72rem;color:#ef4444;margin-top:5px;font-weight:500}

    .copyright{text-align:center;font-size:.7rem;color:var(--text-light);margin-top:20px}

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
    <div class="form-card">
      <!-- Header -->
      <div class="card-header">
        <div class="header-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <div class="header-eyebrow">Langkah Terakhir</div>
        <h1 class="header-title">Buat Kata Sandi Baru</h1>
        <p class="header-sub">Masukkan kata sandi baru Anda. Pastikan menggunakan kombinasi yang kuat dan mudah diingat.</p>
      </div>

      <!-- Body -->
      <div class="card-body">
        <!-- Info -->
        <div class="info-alert">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <p>Kata sandi minimal 8 karakter. Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol untuk keamanan optimal.</p>
        </div>

        @if ($errors->any())
          <div style="display:flex;gap:10px;padding:14px 16px;border-radius:12px;background:rgba(239,68,68,.04);border:1px solid rgba(239,68,68,.12);margin-bottom:18px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div style="font-size:.78rem;color:#b91c1c;font-weight:500;line-height:1.5;">
              @foreach ($errors->all() as $error)
                {{ $error }}<br>
              @endforeach
            </div>
          </div>
        @endif

        <form action="{{ route('validasi-data.reset-password.post') }}" method="POST" autocomplete="off">
          @csrf

          <div class="input-group">
            <label class="input-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Kata Sandi Baru
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" class="input-field" id="password" name="password" placeholder="Minimal 8 karakter" required minlength="8">
              <button type="button" class="toggle-pw" onclick="togglePassword('password', this)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            <div class="pw-strength" id="pwStrength" style="display:none">
              <div class="pw-bar" id="bar1"></div>
              <div class="pw-bar" id="bar2"></div>
              <div class="pw-bar" id="bar3"></div>
              <div class="pw-bar" id="bar4"></div>
              <span class="pw-text" id="pwText"></span>
            </div>
            @error('password')
              <span class="error-msg">{{ $message }}</span>
            @enderror
          </div>

          <div class="input-group">
            <label class="input-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
              Konfirmasi Kata Sandi
            </label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="20 6 9 17 4 12"/></svg>
              <input type="password" class="input-field" id="confirm_password" name="confirm_password" placeholder="Ulangi kata sandi baru" required minlength="8">
              <button type="button" class="toggle-pw" onclick="togglePassword('confirm_password', this)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            @error('confirm_password')
              <span class="error-msg">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            SIMPAN KATA SANDI BARU
          </button>
        </form>
      </div>
    </div>

    <div class="copyright">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</div>
  </div>

  <script>
    function togglePassword(id, btn) {
      const input = document.getElementById(id);
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      btn.innerHTML = isPassword
        ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>'
        : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
    }

    // Password strength meter
    document.getElementById('password').addEventListener('input', function() {
      const pw = this.value;
      const meter = document.getElementById('pwStrength');
      const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
      const text = document.getElementById('pwText');

      if (!pw) { meter.style.display = 'none'; return; }
      meter.style.display = 'flex';

      let score = 0;
      if (pw.length >= 8) score++;
      if (/[a-z]/.test(pw) && /[A-Z]/.test(pw)) score++;
      if (/\d/.test(pw)) score++;
      if (/[^a-zA-Z0-9]/.test(pw)) score++;

      const levels = ['', 'Lemah', 'Cukup', 'Baik', 'Kuat'];
      const classes = ['', 'weak', 'medium', 'strong', 'strong'];

      bars.forEach((bar, i) => {
        bar.className = 'pw-bar';
        if (i < score) bar.classList.add(classes[score]);
      });

      text.textContent = levels[score] || '';
      text.style.color = score <= 1 ? '#ef4444' : score === 2 ? '#f59e0b' : '#10b981';
    });
  </script>
</body>
</html>
