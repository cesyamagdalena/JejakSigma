<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jejak Sehat</title>
    
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
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 100px;
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
            color: black;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            transition: 0.3s;
        }

        .navbar .menu a.active, .navbar .menu a:hover {
            border-bottom: 2px solid black;
        }

        /* --- STYLING MAIN CONTENT --- */
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
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .main-card p {
            font-size: 1.3rem;
            line-height: 1.6;
            font-weight: 300;
        }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 15px; border-radius: 20px; }
            .main-card h1 { font-size: 1.8rem; }
            .main-card p { font-size: 1.1rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Jejak Sehat">
        </div>
        
        <ul class="menu" style="display: flex; align-items: center; gap: 30px;">
            <li><a href="/dashboard" class="active">Dashboard</a></li>
            <li><a href="#">Catatan Perjalanan</a></li>
            
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
        </ul>
    </nav>

    <div class="main-card">
        <h1>Selamat Datang di Dashboard</h1>
        <p>Halo, {{ Auth::user()->name ?? 'Pengguna' }}! Anda berhasil masuk ke sistem Jejak Sehat. Gunakan menu di atas untuk mengelola catatan riwayat perjalanan kesehatan Anda.</p>
    </div>

</body>
</html>