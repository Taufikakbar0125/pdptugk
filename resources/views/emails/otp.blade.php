<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kode Verifikasi — PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body{margin:0;padding:0;background:#f0f4f8;font-family:'Inter',Arial,sans-serif;}
    .wrapper{max-width:600px;margin:40px auto;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 8px 40px rgba(15,23,42,.08);}
    .header{background:linear-gradient(135deg,#2563eb,#1d4ed8);padding:48px 48px 40px;text-align:center;}
    .header-logo{width:64px;height:64px;border-radius:16px;background:rgba(255,255,255,.15);display:inline-flex;align-items:center;justify-content:center;margin-bottom:20px;border:2px solid rgba(255,255,255,.25);}
    .header-logo span{font-size:28px;}
    .header h1{color:#fff;font-size:22px;font-weight:800;letter-spacing:-.02em;margin:0 0 8px;}
    .header p{color:rgba(255,255,255,.8);font-size:14px;margin:0;}
    .body{padding:48px;}
    .greeting{font-size:16px;color:#0f172a;font-weight:600;margin-bottom:8px;}
    .desc{font-size:14px;color:#64748b;line-height:1.7;margin-bottom:32px;}
    .otp-box{background:linear-gradient(135deg,rgba(37,99,235,.04),rgba(124,58,237,.04));border:2px dashed rgba(37,99,235,.2);border-radius:16px;padding:28px;text-align:center;margin-bottom:32px;}
    .otp-label{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#2563eb;margin-bottom:12px;}
    .otp-code{font-size:44px;font-weight:800;letter-spacing:12px;color:#0f172a;font-family:'Courier New',monospace;}
    .otp-expire{font-size:12px;color:#ef4444;margin-top:10px;font-weight:500;}
    .info-box{background:#f8fafc;border-left:3px solid #2563eb;border-radius:0 8px 8px 0;padding:16px 20px;margin-bottom:32px;}
    .info-box p{font-size:13px;color:#475569;margin:0;line-height:1.6;}
    .footer{background:#f8fafc;border-top:1px solid #e2e8f0;padding:24px 48px;text-align:center;}
    .footer p{font-size:12px;color:#94a3b8;margin:0;line-height:1.6;}
    .footer strong{color:#64748b;}
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Header -->
    <div class="header">
      <div class="header-logo">
        <span>🎓</span>
      </div>
      <h1>Verifikasi Email Anda</h1>
      <p>PDPT — Universitas Gunung Kidul</p>
    </div>

    <!-- Body -->
    <div class="body">
      <p class="greeting">Halo, {{ $name }}!</p>
      <p class="desc">
        Terima kasih telah mendaftar di sistem Validasi Data Mahasiswa PDPT UGK.<br>
        Gunakan kode OTP berikut untuk menyelesaikan proses pendaftaran akun Anda.
      </p>

      <div class="otp-box">
        <div class="otp-label">Kode Verifikasi OTP</div>
        <div class="otp-code">{{ $otp }}</div>
        <div class="otp-expire">⏱ Kode ini berlaku selama 10 menit</div>
      </div>

      <div class="info-box">
        <p>
          <strong>🔒 Keamanan:</strong> Jangan bagikan kode ini kepada siapapun.
          PDPT UGK tidak pernah meminta kode OTP Anda melalui telepon atau pesan.
          Jika Anda tidak merasa mendaftar, abaikan email ini.
        </p>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>
        Email ini dikirim otomatis oleh sistem PDPT UGK.<br>
        <strong>© {{ date('Y') }} Universitas Gunung Kidul</strong> · Semua hak dilindungi
      </p>
    </div>
  </div>
</body>
</html>
