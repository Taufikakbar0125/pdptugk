<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Konversi Nilai · PDPT UGK</title>
  <meta name="description" content="Halaman login sistem konversi nilai PDPT Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/konversi-nilai-login.css') }}">
</head>
<body>
  <canvas id="starfield"></canvas>

  <!-- Floating orbs background -->
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

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
          {{-- Logo akan dipanggil dari database nanti, untuk sementara dummy --}}
          <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK" class="logo-img" data-db-key="logo_konversi_nilai">
        </div>
        <div class="brand-text">
          <span class="brand-eyebrow">PDPT UGK</span>
          <h1 class="brand-title">Konversi Nilai</h1>
          <p class="brand-sub">Sistem Konversi Penilaian Akademik</p>
        </div>
      </div>

      <!-- Divider -->
      <div class="divider">
        <span class="divider-text">Masuk ke akun Anda</span>
      </div>

      <!-- Login Form -->
      <form id="loginForm" autocomplete="off">
        <div class="input-group" id="emailGroup">
          <label for="email" class="input-label">Email</label>
          <div class="input-wrap">
            <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            <input type="email" id="email" name="email" placeholder="nama@ugk.ac.id" required>
          </div>
        </div>

        <div class="input-group" id="passwordGroup">
          <label for="password" class="input-label">Password</label>
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

        <!-- Login Admin Button -->
        <button type="submit" class="btn btn-primary" id="btnLoginAdmin">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          <span>LOGIN ADMIN</span>
        </button>

        <!-- Login SSO Button -->
        <button type="button" class="btn btn-sso" id="btnLoginSSO">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          <span>LOGIN SSO MAHASISWA / PENILAI</span>
        </button>
      </form>

      <!-- Footer -->
      <div class="card-footer">
        <span>Lupa password?</span>
        <a href="#" id="forgotPwLink">Klik di sini</a>
      </div>
    </div>

    <!-- Bottom copyright -->
    <div class="copyright">
      &copy; 2025 Universitas Gunung Kidul &middot; PDPT
    </div>
  </div>

  <script src="{{ asset('js/konversi-nilai-login.js') }}"></script>
</body>
</html>
