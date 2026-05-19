<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jejak Sehat</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* --- STYLING NAVBAR RESPONSIVE --- */
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

        /* --- HEADER SECTION --- */
        .header-section {
            width: 85%;
            max-width: 1000px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: white;
            letter-spacing: 5px;
            text-transform: uppercase;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
            font-weight: normal;
        }

        .btn-add-note {
            font-family: 'Montserrat', sans-serif;
            background-color: rgba(75, 128, 117, 0.85);
            color: white;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .btn-add-note:hover {
            background-color: rgb(60, 105, 96);
            transform: translateY(-2px);
        }

        /* --- FORM INPUT PERJALANAN SECTION --- */
        .input-section {
            width: 85%;
            max-width: 900px;
            background: transparent;
            margin-bottom: 40px;
            display: none; 
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .input-section.show {
            display: flex;
            opacity: 1;
        }

        .input-card {
            display: flex;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .input-form-side {
            flex: 1;
            background-color: #e2e5e4; 
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .input-form-side form {
            width: 100%;
            max-width: 300px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-field {
            width: 100%;
            padding: 12px 20px;
            border-radius: 25px;
            border: 1px solid #7a7a7a;
            background: transparent;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            color: #333;
            text-align: center;
            outline: none;
            transition: 0.3s;
        }
        
        .input-field::placeholder {
            color: #555;
        }

        .input-field:focus {
            border-color: #517156;
            background: rgba(255,255,255,0.3);
        }

        .btn-submit-form {
            margin-top: 10px;
            padding: 15px 20px;
            border-radius: 25px;
            border: none;
            background-color: #517156; 
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-submit-form:hover {
            background-color: #3e5842;
        }

        .input-graphic-side {
            flex: 1;
            background-color: #88baa3; 
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .input-graphic-side h2 {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 2.5rem;
            line-height: 1.2;
            text-align: left;
            width: 100%;
            margin-bottom: 20px;
            font-weight: normal;
        }

        .input-graphic-side img {
            width: 180px; 
            height: auto;
            margin-top: 20px;
        }

        /* --- CONTAINER TABEL KACA TRANSLUSEN --- */
        .table-card {
            width: 85%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 35px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            text-align: left;
        }

        th {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #1a1a1a;
            padding: 10px 15px;
            border-bottom: 2px solid rgba(0,0,0,0.1);
        }

        .text-center { text-align: center; }

        tr.data-row {
            background: rgba(255, 255, 255, 0.4);
            transition: 0.2s ease-in-out;
        }

        tr.data-row:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        td {
            padding: 14px 15px;
            font-size: 1.05rem;
            color: #111;
            font-family: 'Playfair Display', serif;
        }

        td:first-child { border-top-left-radius: 15px; border-bottom-left-radius: 15px; }
        td:last-child { border-top-right-radius: 15px; border-bottom-right-radius: 15px; }

        .font-semibold {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        /* --- BUTTONS ACTION STYLE --- */
        .btn-action {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            letter-spacing: 1px;
            transition: 0.2s;
            display: inline-block;
        }

        .btn-edit { background-color: #5cb88f; color: white; margin-right: 5px; }
        .btn-edit:hover { background-color: #4da37d; }
        .btn-delete { background-color: #e14d4d; color: white; }
        .btn-delete:hover { background-color: #c93c3c; }


        /* --- SECTION GRAFIK (TOTAL PERJALANAN) --- */
        .chart-container {
            width: 85%;
            max-width: 1000px;
            background: #ffffff;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
        }

        .chart-header .btn-more {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            color: #888;
            text-decoration: none;
            text-transform: uppercase;
        }

        .chart-wrapper {
            position: relative;
            width: 100%;
            height: 350px; 
        }

        /* ===================================================
           MODE RESPONSIVE (OPTIMASI HP & TABLET MAKS 768px)
           =================================================== */
        @media (max-width: 768px) {
            .navbar {
                width: 90%;
                flex-direction: column;
                gap: 20px;
                border-radius: 25px;
                padding: 20px;
                margin-top: 20px;
            }

            .navbar .menu {
                flex-direction: column;
                gap: 15px;
                width: 100%;
                text-align: center;
            }

            .navbar .menu li form {
                display: flex;
                justify-content: center;
            }

            .header-section {
                flex-direction: column;
                gap: 15px;
                text-align: center;
                margin-top: 40px;
                margin-bottom: 20px;
            }

            .dashboard-title { font-size: 2rem; }

            .btn-add-note {
                width: 100%;
                max-width: 280px;
                text-align: center;
            }

            .table-card, .chart-container, .input-section {
                width: 90%;
            }

            .input-card {
                flex-direction: column;
            }
            .input-form-side, .input-graphic-side {
                padding: 30px 20px;
            }
            .input-graphic-side h2 {
                text-align: center;
                font-size: 2rem;
            }

            .table-card {
                padding: 15px;
                border-radius: 25px;
                margin-bottom: 25px;
            }

            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }

            tr.data-row {
                margin-bottom: 15px;
                border-radius: 20px !important;
                padding: 12px 8px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.03);
                border: 1px solid rgba(255,255,255,0.2);
            }

            td {
                border: none;
                position: relative;
                padding-left: 45% !important; 
                text-align: left !important;
                margin-bottom: 8px;
                font-size: 0.95rem;
            }

            td:first-child { border-radius: 0; }
            td:last-child { 
                border-radius: 0;
                margin-bottom: 0;
                padding-left: 15px !important;
                text-align: center !important;
                border-top: 1px solid rgba(0, 0, 0, 0.08);
                padding-top: 15px;
                margin-top: 10px;
            }

            td::before {
                position: absolute;
                top: 14px;
                left: 15px;
                width: 35%;
                font-family: 'Montserrat', sans-serif;
                font-weight: 700;
                font-size: 0.8rem;
                color: #333;
                content: attr(data-label);
                text-transform: uppercase;
            }
            
            .btn-action { padding: 8px 20px; font-size: 0.8rem; }
            .chart-container { padding: 20px 15px; border-radius: 20px; }
            .chart-wrapper { height: 260px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Jejak Sehat">
        </div>
        
        <ul class="menu">
            <li><a href="/dashboard" class="active">Dashboard</a></li>
            <li><a href="/catatan-perjalanan">Catat Perjalanan</a></li>
            
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

    <div class="header-section">
        <h1 class="dashboard-title">DASHBOARD</h1>
        <a href="javascript:void(0)" id="btnToggleInput" class="btn-add-note">Tambahkan Catatan ++</a>
    </div>

    <div class="input-section" id="inputSectionForm">
        <div class="input-card">
            <div class="input-form-side">
                <form id="travelForm">
                    <input type="text" id="inTanggal" placeholder="Tanggal (e.g. 5 Juni 2026)" class="input-field" required>
                    <input type="text" id="inLokasi" placeholder="Lokasi" class="input-field" required>
                    <input type="text" id="inJarak" placeholder="Jarak (KM)" class="input-field" required>
                    <input type="text" id="inWaktu" placeholder="Waktu (e.g. 2 Jam)" class="input-field" required>
                    <button type="submit" class="btn-submit-form">Tambah Perjalanan</button>
                </form>
            </div>
            <div class="input-graphic-side">
                <h2>INPUT<br>PERJALANAN</h2>
                <img src="{{ asset('images/plant.png') }}" alt="Ilustrasi Tanaman"> 
            </div>
        </div>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th class="text-center">Jarak</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($catatanPerjalanan ?? [] as $item)
                    <tr class="data-row">
                        <td data-label="Tanggal">{{ $item['tanggal'] }}</td>
                        <td data-label="Lokasi" class="font-semibold">{{ $item['lokasi'] }}</td>
                        <td data-label="Jarak" class="text-center">{{ $item['jarak'] }} KM</td>
                        <td data-label="Waktu" class="text-center">{{ $item['waktu'] }}</td>
                        <td data-label="Aksi" class="text-center">
                            <a href="/travel/{{ $item['id'] }}/edit" class="btn-action btn-edit">EDIT</a>
                            <form action="/travel/{{ $item['id'] }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data ini?')" class="btn-action btn-delete">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    @php
                        $sampleData = [
                            ['tgl' => '2 April 2026', 'tempat' => 'Bogor', 'jarak' => 'xx', 'waktu' => 'xx Jam'],
                            ['tgl' => '15 April 2026', 'tempat' => 'Yogyakarta', 'jarak' => 'xx', 'waktu' => 'xx Hari'],
                            ['tgl' => '26 April 2026', 'tempat' => 'Bali', 'jarak' => 'xx', 'waktu' => 'xx Hari'],
                            ['tgl' => '10 Mei 2026', 'tempat' => 'Malioboro', 'jarak' => 'xx', 'waktu' => 'xx Hari'],
                            ['tgl' => '22 Mei 2026', 'tempat' => 'Candi Prambanan', 'jarak' => 'xx', 'waktu' => 'xx Hari'],
                            ['tgl' => '15 Juni 2026', 'tempat' => 'ITB', 'jarak' => 'xx', 'waktu' => 'xx Jam'],
                            ['tgl' => '30 Juni 2026', 'tempat' => 'Curug Bogor', 'jarak' => 'xx', 'waktu' => 'xx Jam'],
                            ['tgl' => '22 Juli 2026', 'tempat' => 'Gunung Rinjani', 'jarak' => 'xx', 'waktu' => 'xx Hari'],
                        ];
                    @endphp

                    @foreach($sampleData as $data)
                    <tr class="data-row">
                        <td data-label="Tanggal">{{ $data['tgl'] }}</td>
                        <td data-label="Lokasi" class="font-semibold">{{ $data['tempat'] }}</td>
                        <td data-label="Jarak" class="text-center">{{ $data['jarak'] }} KM</td>
                        <td data-label="Waktu" class="text-center">{{ $data['waktu'] }}</td>
                        <td data-label="Aksi" class="text-center">
                            <button type="button" class="btn-action btn-edit">EDIT</button>
                            <button type="button" class="btn-action btn-delete" onclick="handleDelete(this)">DELETE</button>
                        </td>
                    </tr>
                    @endforeach
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="chart-container">
        <div class="chart-header">
            <h3>Total Perjalanan</h3>
            <a href="#" class="btn-more">More</a>
        </div>
        <div class="chart-wrapper">
            <canvas id="travelChart"></canvas>
        </div>
    </div>

    <script>
        // --- TOGGLE SHOW/HIDE FORM INPUT ---
        const btnToggleInput = document.getElementById('btnToggleInput');
        const inputSectionForm = document.getElementById('inputSectionForm');

        btnToggleInput.addEventListener('click', function() {
            if (inputSectionForm.classList.contains('show')) {
                inputSectionForm.classList.remove('show');
                setTimeout(() => { inputSectionForm.style.display = 'none'; }, 400);
                btnToggleInput.innerText = 'Tambahkan Catatan ++';
            } else {
                inputSectionForm.style.display = 'flex';
                setTimeout(() => { inputSectionForm.classList.add('show'); }, 10);
                btnToggleInput.innerText = 'Tutup Form --';
            }
        });

        // --- PENG DUPLIKASIAN DATA LANGSUNG KE TABEL VIA JAVASCRIPT ---
        const travelForm = document.getElementById('travelForm');
        const tableBody = document.getElementById('tableBody');

        travelForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah reload halaman

            // Ambil data dari input field
            const tanggal = document.getElementById('inTanggal').value;
            const lokasi = document.getElementById('inLokasi').value;
            const jarak = document.getElementById('inJarak').value;
            const waktu = document.getElementById('inWaktu').value;

            // Buat baris (row) baru untuk tabel
            const newRow = document.createElement('tr');
            newRow.classList.add('data-row');

            newRow.innerHTML = `
                <td data-label="Tanggal">${tanggal}</td>
                <td data-label="Lokasi" class="font-semibold">${lokasi}</td>
                <td data-label="Jarak" class="text-center">${jarak} KM</td>
                <td data-label="Waktu" class="text-center">${waktu}</td>
                <td data-label="Aksi" class="text-center">
                    <button type="button" class="btn-action btn-edit">EDIT</button>
                    <button type="button" class="btn-action btn-delete" onclick="handleDelete(this)">DELETE</button>
                </td>
            `;

            // Masukkan data baru ke baris paling atas tabel
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Reset Form & Sembunyikan Form Kembali
            travelForm.reset();
            inputSectionForm.classList.remove('show');
            setTimeout(() => { inputSectionForm.style.display = 'none'; }, 400);
            btnToggleInput.innerText = 'Tambahkan Catatan ++';
        });

        // Fungsi untuk menghapus baris data secara langsung di mockup
        function handleDelete(buttonElement) {
            if (confirm('Hapus data ini?')) {
                const row = buttonElement.closest('tr');
                row.remove();
            }
        }

        // --- CHART.JS ---
        const ctx = document.getElementById('travelChart').getContext('2d');
        const purpleGradient = ctx.createLinearGradient(0, 0, 0, 300);
        purpleGradient.addColorStop(0, 'rgba(186, 172, 245, 0.6)');
        purpleGradient.addColorStop(1, 'rgba(186, 172, 245, 0.05)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                datasets: [{
                    label: '2026',
                    data: [56, 64, 76, 78, 70, 37],
                    borderColor: '#9a8cf2',
                    borderWidth: 2,
                    backgroundColor: purpleGradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#9a8cf2',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { family: 'Montserrat', size: 10 } }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        ticks: { stepSize: 20, font: { family: 'Montserrat' } },
                        grid: { color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        ticks: { font: { family: 'Montserrat' } },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>