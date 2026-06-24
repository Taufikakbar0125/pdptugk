<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login SSO Mahasiswa — Konversi Nilai · PDPT UGK</title>
  <meta name="description" content="Halaman login SSO mahasiswa untuk sistem konversi nilai PDPT Universitas Gunung Kidul">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/konversi-nilai-sso.css') }}">
</head>
<body>
  <!-- Animated Background Elements (Matches lab.iainsasbabel.ac.id exactly) -->
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

  <!-- Scrolling Status Bar -->
  <div class="status-bar-bg">
    <div class="status-scroll">
      <div class="status-item"><div class="status-dot"></div>SISTEM INFORMASI TERINTEGRASI</div>
      <div class="status-item cy"><div class="status-dot"></div>UPTIME: 99.9%</div>
      <div class="status-item gd"><div class="status-dot"></div>SECURE CONNECTION SSO UGK</div>
      <div class="status-item"><div class="status-dot"></div>SISTEM KONVERSI NILAI MAHASISWA</div>
      <div class="status-item cy"><div class="status-dot"></div>SERVER RESPONSIVE</div>
      <!-- Duplicate for infinite scroll effect -->
      <div class="status-item"><div class="status-dot"></div>SISTEM INFORMASI TERINTEGRASI</div>
      <div class="status-item cy"><div class="status-dot"></div>UPTIME: 99.9%</div>
      <div class="status-item gd"><div class="status-dot"></div>SECURE CONNECTION SSO UGK</div>
      <div class="status-item"><div class="status-dot"></div>SISTEM KONVERSI NILAI MAHASISWA</div>
      <div class="status-item cy"><div class="status-dot"></div>SERVER RESPONSIVE</div>
    </div>
  </div>

  <div class="sso-page">
    <div class="sso-wrapper" id="ssoWrapper">

      <!-- Left: Info Panel -->
      <div class="sso-info">
        <div class="info-header">
          <div class="info-badge">
            <span class="info-badge-dot"></span>
            <span>Secure SSO Connection</span>
          </div>
          <h1 class="info-title">Petunjuk Login SSO</h1>
          <p class="info-desc">
            SSO (Single Sign-On) menggunakan akun email UGK Anda untuk mengakses berbagai layanan sistem informasi di Universitas Gunung Kidul.
          </p>
        </div>

        <div class="info-items">
          <div class="info-item">
            <div class="info-item-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
            <div class="info-item-text">
              <span class="info-item-label">Untuk Staff</span>
              <span class="info-item-value">username@ugk.ac.id</span>
            </div>
          </div>

          <div class="info-item">
            <div class="info-item-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 10 3 12 0v-5"/>
              </svg>
            </div>
            <div class="info-item-text">
              <span class="info-item-label">Untuk Mahasiswa</span>
              <span class="info-item-value">username@student.ugk.ac.id</span>
            </div>
          </div>

          <div class="info-item">
            <div class="info-item-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              </svg>
            </div>
            <div class="info-item-text">
              <span class="info-item-label">Keamanan</span>
              <span class="info-item-value">Jangan berikan informasi akun kepada siapapun</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Form Panel -->
      <div class="sso-form-panel">
        <!-- Back link -->
        <a href="/konversi-nilai/login" class="back-link" id="ssoBackLink">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
          </svg>
          <span>Kembali ke Login Admin</span>
        </a>

        <!-- Form header -->
        <div class="form-header">
          <div class="form-header-row">
            <div class="form-logo">
              {{-- Logo dari database, sementara dummy --}}
              <img src="{{ $global_site_logo }}" alt="Logo UGK" data-db-key="logo_sso">
            </div>
            <h2 class="form-title">Login SSO</h2>
          </div>
          <p class="form-subtitle">Masuk menggunakan akun SSO mahasiswa atau penilai Anda untuk mengakses sistem konversi nilai.</p>
        </div>

        <!-- Divider -->
        <div class="form-divider">
          <span>Masukkan Kredensial SSO</span>
        </div>

        <!-- Login Form -->
        <form id="ssoLoginForm" autocomplete="off">
          <div class="input-group" id="ssoUnyIdGroup">
            <label for="ssoUnyId" class="input-label">UGK ID / Email</label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
              </svg>
              <input type="text" id="ssoUnyId" name="ugk_id" placeholder="username@student.ugk.ac.id" required>
            </div>
          </div>

          <div class="input-group" id="ssoPasswordGroup">
            <label for="ssoPassword" class="input-label">Password</label>
            <div class="input-wrap">
              <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
              <input type="password" id="ssoPassword" name="password" placeholder="••••••••" required>
              <button type="button" class="toggle-pw" id="ssoTogglePw" aria-label="Tampilkan password">
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

          <!-- Login Button -->
          <button type="submit" class="btn btn-login" id="btnSSOLogin">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
              <polyline points="10 17 15 12 10 7"/>
              <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            <span>LOGIN</span>
          </button>

          <!-- Clear Button -->
          <button type="button" class="btn btn-clear" id="btnSSOClear">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 6h18"/>
              <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
              <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
            </svg>
            <span>CLEAR</span>
          </button>
        </form>

        <!-- Forgot password -->
        <div class="forgot-row">
          <span>Lupa Password SSO?</span>
          <a href="#" id="ssoForgotPwLink">Klik Reset</a>
        </div>

        <!-- Security notice -->
        <div class="security-box">
          <div class="security-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
              <line x1="12" y1="9" x2="12" y2="13"/>
              <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            Demi Keamanan
          </div>
          <ul class="security-list">
            <li>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
              <span>Logout dan tutup browser setelah selesai mengakses layanan.</span>
            </li>
            <li>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
              <span>Jangan menyimpan password pada browser.</span>
            </li>
            <li>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
              <span>Aktifkan Multi-Factor Authentication (MFA) melalui password.ugk.ac.id.</span>
            </li>
          </ul>
        </div>
      </div>

    </div>

    <!-- Copyright -->
    <div class="copyright">
      &copy; 2025 Universitas Gunung Kidul &middot; PDPT
    </div>
  </div>

  <script src="{{ asset('js/konversi-nilai-sso.js') }}"></script>
</body>
</html>
