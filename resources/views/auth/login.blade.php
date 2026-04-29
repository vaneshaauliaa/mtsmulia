<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MTs Mulia Insani</title>

    <link rel="icon" href="{{ asset('images/logo/logo_sekolah.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #F5F5F5;
        }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* LEFT SIDE - BRANDING */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #CD853F 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -300px;
            left: -300px;
            animation: float 20s infinite;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -250px;
            right: -250px;
            animation: float 15s infinite reverse;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
            }
            50% {
                transform: translateY(50px) translateX(50px);
            }
        }

        .branding-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .logo-large {
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 50%;
            padding: 25px;
            margin: 0 auto 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .logo-large img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .branding-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .branding-content p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* RIGHT SIDE - FORM */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background: white;
        }

        .login-form-container {
            width: 100%;
            max-width: 450px;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #5D4037;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #9E9E9E;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #5D4037;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: #8B4513;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #8B4513;
            font-size: 1.1rem;
        }

        .form-control-custom {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 3rem;
            border: 2px solid #E0D5C7;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #FDFBF7;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #8B4513;
            background: white;
            box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
        }

        .form-control-custom::placeholder {
            color: #BDBDBD;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8B4513;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: #D2691E;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #8B4513;
        }

        .form-check label {
            color: #6D4C41;
            cursor: pointer;
            margin: 0;
        }

        .forgot-link {
            color: #8B4513;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: #D2691E;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-custom {
            border: none;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #E0D5C7 50%, transparent 100%);
        }

        .divider-text {
            position: relative;
            background: white;
            padding: 0 1rem;
            color: #9E9E9E;
            font-size: 0.85rem;
        }

        .help-text {
            text-align: center;
            color: #9E9E9E;
            font-size: 0.9rem;
            margin-top: 1.5rem;
        }

        .help-text a {
            color: #8B4513;
            font-weight: 600;
            text-decoration: none;
        }

        .help-text a:hover {
            color: #D2691E;
        }

        /* Loading State */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-login .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .btn-login.loading .spinner {
            display: inline-block;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-left {
                min-height: 40vh;
                padding: 2rem;
            }

            .branding-content h1 {
                font-size: 2rem;
            }

            .logo-large {
                width: 100px;
                height: 100px;
            }

            .features {
                flex-direction: column;
                gap: 1rem;
                margin-top: 1.5rem;
            }

            .login-right {
                padding: 2rem 1.5rem;
            }

            .form-header h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .login-left {
                padding: 1.5rem;
            }

            .login-right {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    {{-- LEFT SIDE - BRANDING --}}
    <div class="login-left">
        <div class="branding-content">
            <div class="logo-large">
                <img src="{{ asset('images/logo/logo_sekolah.png') }}" alt="Logo MTs Mulia Insani">
            </div>
            <h1>MTs Mulia Insani</h1>
            <p>Sistem Pencatatan Kas Masuk dan Kas Keluar</p>
        </div>
    </div>

    {{-- RIGHT SIDE - FORM --}}
    <div class="login-right">
        <div class="login-form-container">
            <div class="form-header">
                <h2>Selamat Datang! 👋</h2>
                <p>Silakan masuk dengan akun Anda untuk melanjutkan</p>
            </div>

            {{-- ALERT ERROR --}}
            @if(session('error'))
            <div class="alert-custom alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
            <div class="alert-custom alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            {{-- FORM LOGIN --}}
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                {{-- EMAIL --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-envelope-fill"></i>
                        Email
                    </label>
                    <div class="input-wrapper">
                        <i class="input-icon bi bi-envelope"></i>
                        <input type="email" 
                               name="email" 
                               class="form-control-custom" 
                               placeholder="Masukkan email Anda"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-lock-fill"></i>
                        Password
                    </label>
                    <div class="input-wrapper">
                        <i class="input-icon bi bi-key-fill"></i>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-control-custom" 
                               placeholder="Masukkan password Anda"
                               required>
                        <button type="button" 
                                class="password-toggle" 
                                onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- REMEMBER & FORGOT --}}
                <div class="remember-forgot">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>

                {{-- SUBMIT BUTTON --}}
                <button type="submit" class="btn-login" id="btnLogin">
                    <span class="spinner"></span>
                    <span class="btn-text">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk
                    </span>
                </button>
            </form>

            {{-- DIVIDER --}}
            <div class="divider">
                <span class="divider-text">Butuh bantuan?</span>
            </div>

            {{-- HELP TEXT --}}
            <div class="help-text">
                <p>
                    Belum punya akun atau lupa password? 
                    <a href="#">Hubungi Administrator</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle Password Visibility
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }

    // Form Submit Loading State
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btnLogin = document.getElementById('btnLogin');
        btnLogin.classList.add('loading');
        btnLogin.querySelector('.btn-text').innerHTML = '<span>Memproses...</span>';
    });

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-custom');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.animation = 'slideDown 0.4s ease-out reverse';
                setTimeout(() => alert.remove(), 400);
            }, 5000);
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>