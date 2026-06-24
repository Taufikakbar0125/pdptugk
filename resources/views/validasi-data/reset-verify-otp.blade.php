<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi OTP Reset — Validasi Data · PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    :root{
      --bg:#f0f4f8;--card:#ffffff;--primary:#dc2626;--primary-dark:#b91c1c;
      --primary-light:rgba(220,38,38,.08);--text:#0f172a;--text-muted:#64748b;
      --text-light:#94a3b8;--border:#e2e8f0;--radius:16px;
      --shadow:0 4px 24px rgba(15,23,42,.06),0 1px 3px rgba(15,23,42,.04);
    }
    html{height:100%}
    body{
      font-family:'Inter',system-ui,-apple-system,sans-serif;height:100%;
      display:flex;align-items:center;justify-content:center;
      background:var(--bg);position:relative;overflow:hidden;
    }
    body::before{
      content:'';position:fixed;inset:0;
      background:
        radial-gradient(ellipse 80% 60% at 10% 20%,rgba(220,38,38,.06),transparent 60%),
        radial-gradient(ellipse 60% 50% at 90% 80%,rgba(124,58,237,.05),transparent 60%),
        radial-gradient(ellipse 50% 40% at 50% 10%,rgba(245,158,11,.04),transparent 60%);
      z-index:0;
    }
    body::after{
      content:'';position:fixed;inset:0;
      background-image:linear-gradient(rgba(220,38,38,.012) 1px,transparent 1px),linear-gradient(90deg,rgba(220,38,38,.012) 1px,transparent 1px);
      background-size:32px 32px;z-index:0;
    }
    .shape{position:fixed;border-radius:50%;opacity:.4;filter:blur(60px);z-index:0;animation:float 20s ease-in-out infinite;}
    .shape-1{width:300px;height:300px;top:-80px;right:-60px;background:rgba(220,38,38,.1);animation-delay:0s}
    .shape-2{width:250px;height:250px;bottom:-60px;left:-40px;background:rgba(124,58,237,.08);animation-delay:-7s}
    @keyframes float{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(20px,-15px) scale(1.05)}66%{transform:translate(-15px,10px) scale(.95)}}

    .page-container{position:relative;z-index:1;width:100%;max-width:440px;padding:20px;}

    .card{
      background:var(--card);border-radius:var(--radius);border:1px solid var(--border);
      box-shadow:var(--shadow);overflow:hidden;animation:cardIn .6s cubic-bezier(.22,1,.36,1) both;
    }
    @keyframes cardIn{from{opacity:0;transform:translateY(16px) scale(.98)}to{opacity:1;transform:translateY(0) scale(1)}}

    .card-header{
      padding:40px 32px 28px;text-align:center;
      background:linear-gradient(135deg,rgba(220,38,38,.04),rgba(245,158,11,.03));
      border-bottom:1px solid var(--border);
    }
    .header-icon{
      width:72px;height:72px;border-radius:20px;
      background:linear-gradient(135deg,#dc2626,#b91c1c);
      display:flex;align-items:center;justify-content:center;
      margin:0 auto 20px;box-shadow:0 8px 24px rgba(220,38,38,.3);
      animation:iconPulse 2.5s ease-in-out infinite;
    }
    @keyframes iconPulse{0%,100%{box-shadow:0 8px 24px rgba(220,38,38,.3)}50%{box-shadow:0 8px 32px rgba(220,38,38,.5)}}
    .header-eyebrow{font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--primary);margin-bottom:6px;}
    .header-title{font-size:1.3rem;font-weight:800;color:var(--text);letter-spacing:-.02em;margin-bottom:8px;}
    .header-desc{font-size:.82rem;color:var(--text-muted);line-height:1.6;}
    .email-highlight{
      display:inline-block;background:var(--primary-light);color:var(--primary);
      font-weight:600;padding:2px 8px;border-radius:6px;font-size:.82rem;margin-top:4px;
    }

    .card-body{padding:32px}

    .alert{padding:12px 16px;border-radius:10px;font-size:.8rem;font-weight:500;margin-bottom:20px;display:flex;align-items:flex-start;gap:8px;}
    .alert-error{background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.15);color:#dc2626;}
    .alert-success{background:rgba(16,185,129,.06);border:1px solid rgba(16,185,129,.15);color:#059669;}

    .otp-label{font-size:.75rem;font-weight:600;color:var(--text);margin-bottom:12px;letter-spacing:.02em;}
    .otp-inputs{display:flex;gap:10px;justify-content:center;margin-bottom:6px;}
    .otp-digit{
      width:48px;height:58px;border:1.5px solid var(--border);border-radius:12px;
      background:rgba(248,250,252,.6);font-family:'Inter',monospace;font-size:1.4rem;
      font-weight:700;color:var(--text);text-align:center;outline:none;transition:all .2s;
      caret-color:var(--primary);
    }
    .otp-digit:focus{border-color:var(--primary);background:white;box-shadow:0 0 0 3px rgba(220,38,38,.1);transform:translateY(-2px);}
    .otp-digit.filled{border-color:var(--primary);background:var(--primary-light);}
    .otp-digit.error{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.08);animation:shake .3s ease;}
    @keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-4px)}75%{transform:translateX(4px)}}
    .otp-error-msg{font-size:.72rem;color:#ef4444;font-weight:500;text-align:center;min-height:1.2em;margin-bottom:8px;}

    #otpHidden{display:none}

    .timer-wrap{text-align:center;margin-bottom:20px;}
    .timer-badge{
      display:inline-flex;align-items:center;gap:6px;padding:6px 14px;
      border-radius:20px;background:rgba(220,38,38,.06);border:1px solid rgba(220,38,38,.1);
      font-size:.75rem;font-weight:600;color:var(--primary);
    }
    .timer-badge.expired{background:rgba(239,68,68,.06);border-color:rgba(239,68,68,.15);color:#dc2626;}

    .btn-verify{
      width:100%;padding:13px;border:none;border-radius:12px;
      background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;
      font-family:inherit;font-size:.88rem;font-weight:700;letter-spacing:.03em;cursor:pointer;
      display:flex;align-items:center;justify-content:center;gap:8px;
      box-shadow:0 2px 12px rgba(220,38,38,.25);transition:all .25s;
    }
    .btn-verify:hover{background:linear-gradient(135deg,var(--primary-dark),#991b1b);box-shadow:0 4px 20px rgba(220,38,38,.35);transform:translateY(-1px);}
    .btn-verify:active{transform:translateY(0);}
    .btn-verify:disabled{opacity:.55;cursor:not-allowed;transform:none;}

    .card-footer{padding:16px 32px 24px;text-align:center;border-top:1px solid var(--border);}
    .back-text{font-size:.78rem;color:var(--text-muted);margin-bottom:4px;}
    .btn-back{
      display:inline-flex;align-items:center;gap:6px;font-size:.78rem;font-weight:600;
      color:var(--text-muted);background:none;border:1px solid var(--border);border-radius:10px;
      padding:7px 16px;cursor:pointer;font-family:inherit;transition:all .2s;text-decoration:none;
    }
    .btn-back:hover{background:rgba(37,99,235,.04);color:#2563eb;border-color:rgba(37,99,235,.15);}

    .copyright{text-align:center;font-size:.7rem;color:var(--text-light);margin-top:20px;}
    @media(max-width:480px){.card-header{padding:28px 24px 20px}.card-body{padding:24px}.card-footer{padding:12px 24px 20px}.otp-digit{width:42px;height:52px;font-size:1.2rem;}}
  </style>
</head>
<body>

  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>

  <div class="page-container">
    <div class="card">
      <!-- Header -->
      <div class="card-header">
        <div class="header-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>
        <div class="header-eyebrow">Reset Kata Sandi</div>
        <h1 class="header-title">Verifikasi Kode OTP</h1>
        <p class="header-desc">
          @if($email)
            Kode OTP 6-digit telah dikirim ke:<br>
            <span class="email-highlight">{{ $email }}</span>
          @else
            Masukkan kode OTP yang dikirim ke email Anda.
          @endif
        </p>
      </div>

      <!-- Body -->
      <div class="card-body">

        @if(session('success'))
          <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>
              @foreach ($errors->all() as $error)
                {{ $error }}
              @endforeach
            </div>
          </div>
        @endif

        <form id="otpForm" method="POST" action="{{ route('validasi-data.reset-verify-otp.post') }}">
          @csrf

          <div class="otp-label">Masukkan kode 6 digit:</div>
          <div class="otp-inputs" id="otpInputs">
            <input class="otp-digit" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="d1" autocomplete="one-time-code">
            <input class="otp-digit" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="d2">
            <input class="otp-digit" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="d3">
            <input class="otp-digit" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="d4">
            <input class="otp-digit" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="d5">
            <input class="otp-digit" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="d6">
          </div>
          <input type="hidden" name="otp" id="otpHidden">
          <div class="otp-error-msg" id="otpErrorMsg"></div>

          <!-- Countdown Timer -->
          <div class="timer-wrap">
            <div class="timer-badge" id="timerBadge">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span id="timerText">Berlaku: <strong id="timerCount">10:00</strong></span>
            </div>
          </div>

          <button type="submit" class="btn-verify" id="btnVerify">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            VERIFIKASI KODE OTP
          </button>
        </form>
      </div>

      <!-- Footer -->
      <div class="card-footer">
        <a href="{{ route('validasi-data.forgot-password') }}" class="btn-back">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
          Ulangi Proses Reset
        </a>
      </div>
    </div>

    <div class="copyright">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</div>
  </div>

  <script>
    const digits = Array.from(document.querySelectorAll('.otp-digit'));
    const hidden = document.getElementById('otpHidden');
    const errorMsg = document.getElementById('otpErrorMsg');

    digits.forEach((input, i) => {
      input.addEventListener('input', () => {
        input.value = input.value.replace(/\D/g, '').slice(-1);
        if (input.value) {
          input.classList.add('filled');
          if (i < digits.length - 1) digits[i + 1].focus();
        } else {
          input.classList.remove('filled');
        }
        syncHidden();
      });

      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && i > 0) {
          digits[i - 1].focus();
          digits[i - 1].value = '';
          digits[i - 1].classList.remove('filled');
          syncHidden();
        }
      });

      input.addEventListener('paste', (e) => {
        e.preventDefault();
        const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
        pasted.split('').forEach((char, j) => {
          if (digits[j]) {
            digits[j].value = char;
            digits[j].classList.add('filled');
          }
        });
        const nextEmpty = digits.findIndex(d => !d.value);
        (nextEmpty >= 0 ? digits[nextEmpty] : digits[5]).focus();
        syncHidden();
      });
    });

    function syncHidden() {
      hidden.value = digits.map(d => d.value).join('');
    }

    document.getElementById('otpForm').addEventListener('submit', function(e) {
      const otp = hidden.value;
      if (otp.length < 6) {
        e.preventDefault();
        digits.forEach(d => d.classList.add('error'));
        errorMsg.textContent = 'Lengkapi semua 6 digit kode OTP.';
        setTimeout(() => digits.forEach(d => d.classList.remove('error')), 600);
        return;
      }
      const btn = document.getElementById('btnVerify');
      btn.disabled = true;
      btn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
        Memverifikasi...
      `;
    });

    // Countdown Timer (10 minutes)
    let seconds = 10 * 60;
    const timerCount = document.getElementById('timerCount');
    const timerBadge = document.getElementById('timerBadge');
    const btnVerify  = document.getElementById('btnVerify');

    function updateTimer() {
      if (seconds <= 0) {
        timerBadge.classList.add('expired');
        document.getElementById('timerText').innerHTML = 'Kode OTP sudah <strong>kadaluarsa</strong>';
        btnVerify.disabled = true;
        return;
      }
      const m = Math.floor(seconds / 60).toString().padStart(2, '0');
      const s = (seconds % 60).toString().padStart(2, '0');
      timerCount.textContent = `${m}:${s}`;
      if (seconds <= 60) timerBadge.classList.add('expired');
      seconds--;
    }

    updateTimer();
    setInterval(updateTimer, 1000);
    digits[0].focus();
  </script>
  <style>@keyframes spin{to{transform:rotate(360deg)}}</style>
</body>
</html>
