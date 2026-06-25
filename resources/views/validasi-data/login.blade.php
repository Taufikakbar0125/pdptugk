<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Mahasiswa — Validasi Data · PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
  <meta name="description" content="Login mahasiswa untuk validasi data akademik PDPT Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;700&display=swap" rel="stylesheet">
  <!-- Menggunakan CSS yang sama persis dengan Konversi Nilai -->
  <link rel="stylesheet" href="{{ asset('css/konversi-nilai-login.css') . '?v=' . time() }}">
</head>
<body>
  <!-- Animated Background Elements -->
  <div class="ilk-bg-wrapper">
      <canvas id="ilk-rain"></canvas>
      <div class="ilk-vignette"></div>
      <div class="ilk-geo"></div>
      <div class="ilk-scanline"></div>
      <div class="ilk-bracket ilk-br-tl"></div>
      <div class="ilk-bracket ilk-br-tr"></div>
      <div class="ilk-bracket ilk-br-bl"></div>
      <div class="ilk-bracket ilk-br-br"></div>
  </div>

  <div class="login-container">
    <!-- Back button -->
    <a href="/" class="back-link" id="backLink">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 12H5M12 19l-7-7 7-7"/>
      </svg>
      <span>Kembali</span>
    </a>

    <!-- Login Card -->
    <div class="login-card" id="loginCard">
      <!-- Header -->
      <div class="card-header">
        <div class="logo-ring">
          <img src="{{ $global_site_logo }}" alt="Logo UGK" class="logo-img">
        </div>
        <div class="brand-text">
          <span class="brand-eyebrow">PDPT UGK</span>
          <h1 class="brand-title">Validasi Data</h1>
          <p class="brand-sub">Verifikasi dan validasi rekam data akademik</p>
        </div>
      </div>

      <!-- Divider -->
      <div class="divider">
        <span class="divider-text">Masuk ke akun Anda</span>
      </div>

      <!-- Server-side alerts -->
      @if ($errors->any())
        <div style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#ef4444;padding:12px 16px;border-radius:8px;font-size:0.85rem;margin: 0 32px 16px;">
          {{ $errors->first() }}
        </div>
      @endif
      @if (session('success'))
        <div style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.2);color:#10b981;padding:12px 16px;border-radius:8px;font-size:0.85rem;margin: 0 32px 16px;">
          {{ session('success') }}
        </div>
      @endif

      <!-- Form -->
      <form id="loginForm" method="POST" action="{{ route('validasi-data.login.post') }}" autocomplete="off">
        @csrf
        <div class="input-group">
          <label for="login_key" class="input-label">NIM atau Alamat Email</label>
          <div class="input-wrap">
            <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            <input type="text" id="login_key" name="login_key" value="{{ old('login_key') }}" placeholder="Contoh: 21501244001 atau nama@email.com" required>
          </div>
        </div>

        <div class="input-group">
          <label for="password" class="input-label">Kata Sandi</label>
          <div class="input-wrap">
            <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
            <button type="button" class="toggle-pw" id="togglePw" aria-label="Tampilkan password">
              <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              <svg class="eye-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <polyline points="10 17 15 12 10 7"/>
            <line x1="15" y1="12" x2="3" y2="12"/>
          </svg>
          <span>MASUK</span>
        </button>

        <!-- Register Link -->
        <a href="{{ route('validasi-data.register.view') }}" class="btn btn-sso" style="text-decoration:none; text-align:center; display:flex; justify-content:center;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="8.5" cy="7" r="4"/>
            <line x1="20" y1="8" x2="20" y2="14"/>
            <line x1="23" y1="11" x2="17" y2="11"/>
          </svg>
          <span>DAFTARKAN AKUN</span>
        </a>
      </form>

      <!-- Footer -->
      <div class="card-footer">
        <span>Lupa password?</span>
        <a href="{{ route('validasi-data.forgot-password') }}">Klik di sini</a>
      </div>
    </div>

    <!-- Bottom copyright -->
    <div class="copyright">
      &copy; {{ date('Y') }} Universitas Gunung Kidul &middot; PDPT
    </div>
  </div>

  <!-- Menggunakan JS animasi yang sama persis dengan Konversi Nilai -->
  <script src="{{ asset('js/konversi-nilai-login.js') . '?v=' . time() }}"></script>
  <script>
    // Toggle Password tambahan (jika file JS external hanya handle ID spesifik tertentu, kita pasang ulang di sini untuk jaga-jaga)
    const pwField = document.getElementById('password');
    const togglePwBtn = document.getElementById('togglePw');
    if (togglePwBtn && pwField) {
      togglePwBtn.addEventListener('click', () => {
        const isPassword = pwField.type === 'password';
        pwField.type = isPassword ? 'text' : 'password';
        togglePwBtn.querySelector('.eye-open').style.display = isPassword ? 'none' : 'block';
        togglePwBtn.querySelector('.eye-closed').style.display = isPassword ? 'block' : 'none';
      });
    }
  </script>
</body>
</html>
