<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jejak Sehat</title>
    
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
        }

        /* Container Utama */
        .register-container {
            display: flex;
            width: 900px;
            height: 550px;
            border-radius: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden; 
        }

        /* --- Sisi Kiri (Visual) --- */
        .register-left {
            flex: 1;
            background-color: #8bb1a4; /* Warna hijau pucat */
            padding: 60px 50px;
            position: relative;
        }

        .register-left h2 {
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
            bottom: -20px;
            left: 20px;
            width: 90%; 
            opacity: 0.9;
            z-index: 1;
        }

        /* --- Sisi Kanan (Form Register) --- */
        .register-right {
            flex: 1.2; /* Dibuat sedikit lebih lebar dari sisi kiri */
            background-color: #dfdfdf; /* Warna abu-abu terang */
            padding: 50px 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-right h1 {
            font-size: 2.2rem;
            color: #000;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }

        /* Input Grup & Label */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 10px 15px;
            background-color: transparent;
            border: 1px solid #a6a6a6;
            border-radius: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            color: #333;
            outline: none;
        }

        .input-wrapper input::placeholder {
            color: #999;
        }

        .input-wrapper input:focus {
            border-color: #64c5c2;
        }

        /* Ikon Mata pada Password */
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
        }

        /* Checkbox Terms */
        .terms-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        .terms-group input {
            cursor: pointer;
        }

        .terms-group label {
            font-size: 0.75rem;
            color: #1e5c46; /* Warna hijau gelap seperti desain */
            cursor: pointer;
        }

        /* Tombol Register */
        .btn-register {
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

        .btn-register:hover {
            background-color: #53a8a5;
        }

        /* Responsif Layar Kecil */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            .register-left {
                display: none; 
            }
            .register-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <div class="register-container">
        
        <div class="register-left">
            <h2>LET'S GET<br>STARTED!</h2>
            <img src="{{ asset('images/tanaman-register.png') }}" alt="Hiasan" class="decoration-img">
        </div>

        <div class="register-right">
            <h1>Create Account</h1>

            <form action="/proses-register" method="POST">
                @csrf 
                
                <div class="form-group">
                    <label>No NIK</label>
                    <div class="input-wrapper">
                        <input type="text" name="nik" placeholder="Enter your number NIK" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="reg-password" placeholder="Create Password" required>
                        <i class="fa-solid fa-eye-slash toggle-password" onclick="toggleRegPassword()"></i>
                    </div>
                </div>

                <div class="terms-group">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree with Terms and Privacy Policy</label>
                </div>

                <button type="submit" class="btn-register">Create Account</button>
            </form>
        </div>

    </div>

    <script>
        function toggleRegPassword() {
            const passwordInput = document.getElementById('reg-password');
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