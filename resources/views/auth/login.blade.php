<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Kos & Properti</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            -webkit-font-smoothing: antialiased;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }
        .login-header {
            background-color: #1e293b;
            color: #ffffff;
            padding: 28px 24px;
            text-align: center;
            border-bottom: 3px solid #c2410c;
        }
        .login-header h1 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }
        .login-header p {
            font-size: 0.875rem;
            color: #94a3b8;
        }
        .login-body {
            padding: 28px 24px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }
        label {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
        }
        input[type="email"],
        input[type="password"] {
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.925rem;
            color: #0f172a;
            font-family: inherit;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #c2410c;
            box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.15);
        }
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 0.85rem;
            color: #475569;
        }
        .remember-row input {
            cursor: pointer;
        }
        .btn-submit {
            width: 100%;
            padding: 11px 18px;
            background-color: #c2410c;
            color: #ffffff;
            border: 1px solid #c2410c;
            border-radius: 6px;
            font-size: 0.925rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }
        .btn-submit:hover {
            background-color: #9a3412;
            border-color: #9a3412;
        }
        .alert {
            padding: 11px 14px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 0.875rem;
        }
        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        /* Demo Credentials Helper Box (Khusus Keperluan Uji Praktikum) */
        .demo-box {
            margin-top: 24px;
            padding: 14px;
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            font-size: 0.8rem;
            color: #475569;
        }
        .demo-box h3 {
            font-size: 0.825rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .demo-item {
            margin-bottom: 6px;
            line-height: 1.4;
        }
        .demo-item code {
            background-color: #e2e8f0;
            padding: 2px 5px;
            border-radius: 3px;
            color: #0f172a;
            font-family: Consolas, monospace;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <h1>🏠 Sistem Manajemen Kos</h1>
        <p>Kontrol Akses Pengguna & Manajemen Hunian</p>
    </div>

    <div class="login-body">
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" style="font-weight: normal; cursor: pointer; margin: 0;">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="btn-submit">Masuk ke Sistem</button>
        </form>

        <!-- Akun Demo untuk Pengujian Praktikum / Aslab -->
        <div class="demo-box">
            <h3>Akun Demo (Role Access Control):</h3>
            <div class="demo-item">
                <strong>1. Role Admin (Full Akses):</strong><br>
                Email: <code>admin@kos.com</code> | Sandi: <code>admin123</code>
            </div>
            <div class="demo-item">
                <strong>2. Role Staff / Housekeeper:</strong><br>
                Email: <code>staff@kos.com</code> | Sandi: <code>staff123</code>
            </div>
            <div class="demo-item" style="margin-bottom: 0;">
                <strong>3. Role Penghuni (Lihat Saja):</strong><br>
                Email: <code>penghuni@kos.com</code> | Sandi: <code>penghuni123</code>
            </div>
        </div>
    </div>
</div>

</body>
</html>
