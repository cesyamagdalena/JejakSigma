<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jejak Sehat</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #4bc2c3 0%, #1e5c46 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; /* Mencegah card menempel ke tepi layar di HP */
        }

        /* Container Utama (Dibuat Fleksibel) */
        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 550px; /* Menggunakan min-height agar tinggi fleksibel */
            border-radius: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden; 
        }

        /* --- Sisi Kiri (Form Login) --- */
        .login-left {
            flex: 1;
            background-color: #dfdfdf; 
            padding: 60px 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-size: 2.5rem;
            color: #000;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .login-left .subtitle {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 40px;
            font-family: 'Playfair Display', serif;
        }

        /* Input Grup */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            background-color: transparent;
            border: 1px solid #b3b3b3;
            border-radius: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            color: #333;
            outline: none;
        }

        .input-group input::placeholder {
            color: #999;
        }

        .input-group input:focus {
            border-color: #64c5c2;
        }

        /* Ikon Mata pada Password */
        .input-group .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
        }

        /* Baris Checkbox dan Lupa Password */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 0.8rem;
            flex-wrap: wrap; /* Agar tulisan turun rapi jika layar kekecilan */
            gap: 10px;
        }

        .form-actions label {
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .form-actions a {
            color: #333;
            text-decoration: none;
        }

        .form-actions a:hover {
            text-decoration: underline;
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #64c5c2; 
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #53a8a5;
        }

        /* Teks Register di Bawah */
        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 0.8rem;
            color: #555;
        }

        .register-link a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* --- Sisi Kanan (Welcome Back) --- */
        .login-right {
            flex: 1;
            background-color: #8bb1a4; 
            padding: 60px 50px;
            position: relative;
        }

        .login-right h2 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: white;
            line-height: 1.2;
            letter-spacing: 2px;
            position: relative;
            z-index: 2; 
        }

        .decoration-img {
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 120%; 
            opacity: 0.9;
            z-index: 1;
        }

        /* ===================================================
           MODE RESPONSIVE (OPTIMASI TABLET & HP)
           =================================================== */
        @media (max-width: 900px) {
            .login-container {
                max-width: 700px; /* Penyesuaian ukuran saat di layar tablet */
            }
            .login-left {
                padding: 40px 50px; /* Sedikit mengurangi padding */
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 450px; /* Lebar maksimal form saat mode vertikal di HP */
                min-height: auto;
            }
            .login-left {
                padding: 40px 30px; /* Padding dikecilkan agar input area tetap luas */
            }
            .login-left h1 {
                font-size: 2rem; /* Ukuran teks disesuaikan */
            }
            .login-left .subtitle {
                margin-bottom: 25px;
            }
            .login-right {
                display: none; /* Sembunyikan hiasan kanan di HP sesuai desain awal */
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="login-left">
            <h1>Login</h1>
            <p class="subtitle">Please enter your login details to log in</p>

            <form action="/proses-login" method="POST">
                @csrf 
                
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword()"></i>
                </div>

                <div class="form-actions">
                    <label>
                        <input type="checkbox"> Keep me logged in
                    </label>
                    <a href="#">Forgot password?</a> 
                </div>

                @if($errors->any())
                    <div style="color: red; font-size: 0.8rem; margin-bottom: 10px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="btn-login">Log in</button>
            </form>

            <div class="register-link">
                Don't have an account? <a href="/register">Create account</a>
            </div>
        </div>

        <div class="login-right">
            <h2>WELCOME<br>BACK!</h2>
            <img src="{{ asset('images/tanaman-login.png') }}" alt="Hiasan" class="decoration-img">
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>
</html>