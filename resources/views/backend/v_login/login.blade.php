<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===========================
           DARK NAVY OCEAN BACKGROUND
           =========================== */
        body {
            background: #001437;
            background: linear-gradient(150deg, #001437 0%, #00205A 40%, #001437 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CARD GLASS DARK */
        .login-card {
            width: 380px;
            padding: 32px;
            border-radius: 18px;
            background: rgba(0, 18, 48, 0.65);
            border: 1px solid rgba(255,255,255,0.06);
            backdrop-filter: blur(8px);
        }

        /* Judul */
        .login-title {
            font-weight: 700;
            text-align: center;
            color: #5CE5D5; /* Aqua highlight */
            letter-spacing: 1px;
            margin-bottom: 25px;
        }

        /* Label */
        label {
            font-weight: 500;
            color: #7898FB; /* Blue soft */
        }

        /* Icon */
        .input-group-text {
            background: #7898FB;
            color: white;
            border: none;
        }

        /* Input */
        .form-control {
            background: rgba(255,255,255,0.08);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: #c9c9c9;
        }

        /* Tombol Login */
        .btn-login {
            background: #0f6cb4e7;
            color: #001437;
            font-weight: 700;
            padding: 10px 0;
            border-radius: 10px;
            border: none;
            transition: 0.25s;
        }

        .btn-login:hover {
            background: #042a48ff;
        }

    </style>
</head>

<body>

<div class="login-card">

    <h3 class="login-title">LOGIN</h3>
        
    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('backend.login') }}" method="POST">
        @csrf

        <label>Email</label>
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="email" class="form-control" placeholder="Masukkan Email">
        </div>

        <label>Password</label>
        <div class="input-group mb-4">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
        </div>

        <button type="submit" class="btn btn-login w-100">
            Login
        </button>

    </form>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
