<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PDPT UGK</title>
  <link rel="icon" href="{{ $global_site_logo ?? asset('images/logo-ugk-dummy.svg') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; color: #334155; }
        .login-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); width: 100%; max-width: 400px; }
        h1 { font-size: 1.5rem; color: #0f172a; margin-bottom: 8px; text-align: center; }
        p.subtitle { text-align: center; color: #64748b; font-size: 0.875rem; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #475569; }
        input { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.875rem; transition: border-color 0.2s; }
        input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .btn { width: 100%; padding: 12px; background-color: #2563eb; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: background-color 0.2s; }
        .btn:hover { background-color: #1d4ed8; }
        .error { color: #ef4444; font-size: 0.875rem; background: #fef2f2; padding: 10px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #fecaca; }
    </style>
</head>
<body>

<div class="login-box">
    <h1>PDPT Admin</h1>
    <p class="subtitle">Login untuk masuk ke dashboard admin</p>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Admin</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="btn">Login Dashboard</button>
    </form>
</div>

</body>
</html>
