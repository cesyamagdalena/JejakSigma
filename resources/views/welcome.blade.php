<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Sehat</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Playfair+Display&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Playfair Display', serif; 
            background-image: url("{{ asset('images/bg-alam.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Agar background tidak ikut tergulung saat di-scroll */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 100px; /* Jarak ruang bawah */
        }

        /* --- STYLING NAVBAR --- */
        .navbar {
            width: 80%;
            max-width: 800px;
            margin-top: 50px;
            padding: 15px 40px;
            border-radius: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo img {
            height: 40px; 
            width: auto;
            border-radius: 30px;
            object-fit: cover;
        }

        .navbar .menu {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .navbar .menu a {
            text-decoration: none;
            color: black; /* Diubah ke hitam agar kontras dengan navbar putih transparan */
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            transition: 0.3s;
        }

        .navbar .menu a.active, .navbar .menu a:hover {
            border-bottom: 2px solid black;
        }

        /* --- STYLING MAIN CONTENT (Kotak Hijau) --- */
        .main-card {
            background-color: #4b8075; 
            color: white;
            width: 85%;
            max-width: 1000px;
            margin-top: 60px;
            padding: 60px 40px;
            border-radius: 50px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .main-card h1 {
            font-family: 'Montserrat', sans-serif; 
            font-size: 2.5rem;
            letter-spacing: 2px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .main-card p {
            font-size: 1.3rem;
            line-height: 1.6;
            margin-bottom: 50px;
            font-weight: 300;
        }

        .btn-perjalananmu {
            background-color: #82b6aa; 
            color: white;
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            padding: 12px 35px;
            border-radius: 30px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-perjalananmu:hover {
            background-color: #6a9c91;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* =========================================
           STYLING SECTION BARU (FITUR & CARA KERJA) 
           ========================================= */
        
        .section-wrapper {
            margin-top: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .section-title {
            font-family: 'Montserrat', sans-serif;
            color: white;
            font-size: 2rem;
            letter-spacing: 2px;
            margin-bottom: 40px;
            text-transform: uppercase;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3); /* Agar teks terbaca di background gambar */
        }

        /* Container untuk jajar kartu */
        .card-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Container khusus grid 2x2 untuk Cara Kerja */
        .grid-2x2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        /* Desain Kotak Ikon (Card) */
        .feature-card {
            background-color: #daebe6; /* Warna hijau pucat/abu seperti desain */
            width: 140px;
            height: 140px;
            border-radius: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            cursor: pointer;
            text-decoration: none; /* Tambahan: agar link tidak bergaris bawah */
        }

        .feature-card:hover {
            transform: translateY(-8px); /* Efek melayang saat di-hover */
        }

        .feature-card i {
            font-size: 2.5rem;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .feature-card span {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.3;
        }

        /* Responsif Layar HP */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                border-radius: 20px;
            }
            .main-card h1 { font-size: 1.8rem; }
            .main-card p { font-size: 1.1rem; }
            
            .card-container { flex-direction: column; align-items: center; }
            .grid-2x2 { grid-template-columns: repeat(1, 1fr); }
        }
    </style>
</head>
<body>

<nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Jejak Sehat">
        </div>
        
        <ul class="menu" style="display: flex; align-items: center; gap: 30px;">
            @auth
                <li><a href="/dashboard" class="active">Dashboard</a></li>
                <li><a href="/catatan-perjalanan">Catatan Perjalanan</a></li>
                
                <li style="display: flex; align-items: center; gap: 15px; margin-left: 10px;">
                    <div style="width: 32px; height: 32px; background-color: rgba(255, 255, 255, 0.25); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255, 255, 255, 0.4); box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <i class="fa-solid fa-user" style="color: black; font-size: 0.9rem;"></i>
                    </div>
                    
                    <form action="/logout" method="POST" style="display: inline; margin: 0;">
                        @csrf
                        <button type="submit" style="background: #e05252; color: white; border: none; padding: 6px 16px; border-radius: 20px; font-weight: 600; cursor: pointer; font-size: 0.85rem; transition: 0.3s; font-family: 'Montserrat', sans-serif;" onmouseover="this.style.background='#c93b3b'" onmouseout="this.style.background='#e05252'">
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li><a href="/" class="active">Home</a></li>
                <li><a href="#">Fitur</a></li>
                <li><a href="/login">Log/Register</a></li>
            @endauth
        </ul>
    </nav>

    <div class="main-card">
        <h1>Awasi Langkah Sehatmu, Setiap Hari</h1>
        <p>Platform digital praktis untuk mencatat riwayat kesehatan, memantau perkembangan tubuh, dan memastikan jejak medis Anda tersimpan dengan aman.</p>
        <a href="#" class="btn-perjalananmu">Perjalananmu</a>
    </div>

    <div class="section-wrapper">
        <h2 class="section-title">FITUR UTAMA</h2>
        <div class="card-container">
            <div class="feature-card">
                <i class="fa-solid fa-location-dot"></i>
                <span>CATAT<br>PERJALANAN</span>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-chart-line"></i>
                <span>LAPORAN<br>PERJALANAN</span>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-lock"></i>
                <span>AKUN<br>AMAN</span>
            </div>
        </div>
    </div>

    <div class="section-wrapper">
        <h2 class="section-title">CARA KERJA</h2>
        <div class="grid-2x2">
            <a href="/register" class="feature-card">
                <i class="fa-solid fa-user-plus"></i>
                <span>REGISTER</span>
            </a>

            <a href="/login" class="feature-card">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <span>LOGIN</span>
            </a>

            <div class="feature-card">
                <i class="fa-solid fa-location-dot"></i>
                <span>INPUT<br>(CRUD)</span>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-chart-line"></i>
                <span>LIHAT<br>LAPORAN</span>
            </div>
        </div>
    </div>

</body>
</html>