<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Perjalanan - Jejak Sehat</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght=400;600;700&family=Playfair+Display:ital,wght=0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Playfair Display', serif; 
            background-image: url("{{ asset('images/bg-dashboard.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 80px;
        }

        /* --- NOTIFICATION STYLE --- */
        .alert-error {
            width: 80%;
            max-width: 800px;
            background: rgba(224, 82, 82, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid #e05252;
            padding: 15px 25px;
            border-radius: 15px;
            color: #5c1a1a;
            margin-top: 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
        }

        /* --- NAVBAR STYLE --- */
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
            z-index: 10;
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
            align-items: center;
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

        /* --- CONTENT WRAPPER --- */
        .content-container {
            width: 85%;
            max-width: 900px;
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        /* --- CARD INPUT STYLE --- */
        .input-card {
            display: flex;
            width: 100%;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .input-form-side {
            flex: 1.2;
            background-color: rgba(235, 238, 237, 0.85); 
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .input-form-side form {
            width: 100%;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .input-field {
            width: 100%;
            padding: 14px 24px;
            border-radius: 30px;
            border: 1px solid rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.5);
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: #333;
            text-align: center;
            outline: none;
            transition: 0.3s;
        }

        .input-field::placeholder {
            color: #666;
            font-style: italic;
        }

        .input-field:focus {
            border-color: #4b6651;
            background: white;
            box-shadow: 0 0 8px rgba(75, 102, 81, 0.2);
        }

        .btn-submit-form {
            margin-top: 10px;
            padding: 14px 20px;
            border-radius: 30px;
            border: none;
            background-color: #556e5a; 
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-submit-form:hover {
            background-color: #3f5443;
            transform: translateY(-1px);
        }

        .input-graphic-side {
            flex: 1;
            background-color: rgba(132, 179, 157, 0.85); 
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .input-graphic-side h2 {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 2.8rem;
            line-height: 1.2;
            letter-spacing: 2px;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .navbar { width: 90%; flex-direction: column; padding: 20px; }
            .navbar .menu { flex-direction: column; gap: 15px; }
            .content-container { width: 90%; margin-top: 30px; }
            .input-card { flex-direction: column-reverse; }
            .input-form-side, .input-graphic-side { padding: 40px 20px; }
            .input-graphic-side h2 { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Jejak Sehat">
        </div>
        
        <ul class="menu">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/catat-perjalanan" class="active">Catat Perjalanan</a></li>
            
            <li style="display: flex; align-items: center; gap: 15px; margin-left: 10px;">
                <div style="width: 32px; height: 32px; background-color: rgba(255, 255, 255, 0.25); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255, 255, 255, 0.4);">
                    <i class="fa-solid fa-user" style="color: black; font-size: 0.9rem;"></i>
                </div>
                
                <form action="/logout" method="POST" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" style="background: #e05252; color: white; border: none; padding: 6px 16px; border-radius: 20px; font-weight: 600; cursor: pointer; font-size: 0.85rem; transition: 0.3s; font-family: 'Montserrat', sans-serif;">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    @if($errors->any())
        <div class="alert-error">
            <strong>Gagal menyimpan!</strong> Harap periksa kembali inputan Anda. (Pastikan kolom Jarak hanya diisi angka).
        </div>
    @endif

    <div class="content-container">
        <div class="input-card">
            
            <div class="input-form-side">
                <form action="/travel" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 15px;">
                        <input type="date" name="tanggal" class="form-control" style="width: 100%; padding: 12px 20px; border: 1px solid #ccc; border-radius: 50px; background-color: #f1f3f5; text-align: center;" required>
                    </div>
                    <div>
                        <input type="text" name="lokasi" class="input-field" placeholder="Lokasi" required>
                    </div>
                    <div>
                        <input type="number" name="jarak" class="input-field" placeholder="Jarak (Angka Saja)" required>
                    </div>
                    <div>
                        <input type="text" name="waktu" class="input-field" placeholder="Waktu (e.g. 2 Jam)" required>
                    </div>
                    
                    <button type="submit" class="btn-submit-form">Tambah Perjalanan</button>
                </form>
            </div>

            <div class="input-graphic-side">
                <h2>Input<br>Perjalanan</h2>
                <div style="margin-top: 10px;">
                    <i class="fa-solid fa-seedling" style="font-size: 7rem; color: rgba(255,255,255,0.85);"></i>
                </div>
            </div>

        </div>
    </div>

</body>
</html>