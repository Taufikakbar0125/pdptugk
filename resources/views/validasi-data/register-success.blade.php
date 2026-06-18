<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Berhasil — PDPT UGK</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    :root{--bg:#f0f4f8;--primary:#2563eb;--primary-dark:#1d4ed8;--text:#0f172a;--text-muted:#64748b;--text-light:#94a3b8;--border:#e2e8f0;--radius:16px;}
    html,body{height:100%}
    body{font-family:'Inter',sans-serif;display:flex;align-items:center;justify-content:center;background:var(--bg);position:relative;overflow:hidden;}
    body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 80% 60% at 10% 20%,rgba(37,99,235,.08),transparent 60%),radial-gradient(ellipse 60% 50% at 90% 80%,rgba(16,185,129,.08),transparent 60%);z-index:0;}
    .shape{position:fixed;border-radius:50%;opacity:.35;filter:blur(60px);z-index:0;animation:float 18s ease-in-out infinite;}
    .shape-1{width:280px;height:280px;top:-70px;right:-50px;background:rgba(37,99,235,.12);}
    .shape-2{width:220px;height:220px;bottom:-50px;left:-30px;background:rgba(16,185,129,.1);animation-delay:-8s;}
    @keyframes float{0%,100%{transform:translate(0,0)}50%{transform:translate(15px,-12px)}}
    .container{position:relative;z-index:1;width:100%;max-width:420px;padding:20px;}
    .card{background:#fff;border-radius:var(--radius);border:1px solid var(--border);box-shadow:0 4px 24px rgba(15,23,42,.07);overflow:hidden;animation:cardIn .7s cubic-bezier(.22,1,.36,1) both;}
    @keyframes cardIn{from{opacity:0;transform:translateY(20px) scale(.97)}to{opacity:1;transform:translateY(0) scale(1)}}
    .card-body{padding:48px 40px;text-align:center;}
    .success-icon{
      width:80px;height:80px;border-radius:50%;
      background:linear-gradient(135deg,#10b981,#059669);
      display:flex;align-items:center;justify-content:center;
      margin:0 auto 24px;
      box-shadow:0 8px 32px rgba(16,185,129,.35);
      animation:iconBounce .7s .2s cubic-bezier(.22,1,.36,1) both;
    }
    @keyframes iconBounce{from{opacity:0;transform:scale(.5)}to{opacity:1;transform:scale(1)}}
    .card-body h1{font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.02em;margin-bottom:8px;}
    .card-body p{font-size:.88rem;color:var(--text-muted);line-height:1.6;margin-bottom:28px;}
    .btn-login{
      display:inline-flex;align-items:center;gap:8px;padding:13px 28px;
      border-radius:12px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));
      color:white;text-decoration:none;font-family:inherit;font-size:.88rem;font-weight:700;
      letter-spacing:.03em;box-shadow:0 2px 12px rgba(37,99,235,.25);transition:all .25s;
    }
    .btn-login:hover{box-shadow:0 4px 20px rgba(37,99,235,.35);transform:translateY(-2px);}
    .copyright{text-align:center;font-size:.7rem;color:var(--text-light);margin-top:20px;}
  </style>
</head>
<body>
  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="success-icon">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h1>Pendaftaran Berhasil! 🎉</h1>
        <p>
          Selamat, <strong>{{ $name }}</strong>!<br>
          Akun Anda telah berhasil diverifikasi dan siap digunakan untuk mengakses layanan Validasi Data Mahasiswa PDPT UGK.
        </p>
        <a href="/validasi-data/login" class="btn-login">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          Masuk ke Akun Saya
        </a>
      </div>
    </div>
    <div class="copyright">&copy; 2025 Universitas Gunung Kidul &middot; PDPT UGK</div>
  </div>
</body>
</html>
