<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jejak Sehat</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght=400;600;700&family=Playfair+Display:ital,wght=0,400..900;1,400..900&display=swap" rel="stylesheet">
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

        /* --- NOTIFICATION STYLE --- */
        .alert-success {
            width: 80%;
            max-width: 1000px;
            background: rgba(92, 184, 143, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid #5cb88f;
            padding: 15px 25px;
            border-radius: 15px;
            color: #1e4d37;
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

        /* --- HEADER SECTION --- */
        .header-section {
            width: 85%;
            max-width: 1000px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
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
        }

        .btn-add-note:hover {
            background-color: rgb(60, 105, 96);
            transform: translateY(-2px);
        }

        /* --- CONTAINER TABEL KACA --- */
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

        /* --- SECTION GRAFIK --- */
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

        /* --- MODAL EDIT --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            width: 90%;
            max-width: 750px;
            background: linear-gradient(135deg, #70a99e 0%, #3a685e 100%);
            border-radius: 30px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 20px 45px rgba(0,0,0,0.3);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }

        .modal-overlay.active .modal-card {
            transform: scale(1);
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            color: #555;
            cursor: pointer;
            z-index: 10;
            transition: 0.2s;
        }
        .modal-close:hover { color: #000; }

        .modal-left {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
        }

        .modal-left h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 400;
            line-height: 1.2;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .modal-left .illustration {
            align-self: flex-start;
            margin-top: 40px;
            opacity: 0.9;
            position: relative;
        }

        .modal-right {
            flex: 1.2;
            background: #e1e3e2;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-group { margin-bottom: 15px; }

        .form-control {
            width: 100%;
            padding: 10px 20px;
            border: 1px solid #7a7a7a;
            background-color: transparent;
            border-radius: 25px;
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: #333;
            outline: none;
            transition: 0.3s;
        }

        .btn-submit-edit {
            width: 100%;
            padding: 12px;
            background-color: #4d695e;
            color: white;
            border: none;
            border-radius: 25px;
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-submit-edit:hover { background-color: #384e46; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

        @media (max-width: 768px) {
            .navbar { width: 90%; flex-direction: column; gap: 20px; padding: 20px; }
            .navbar .menu { flex-direction: column; gap: 15px; }
            .header-section { flex-direction: column; gap: 15px; text-align: center; }
            .dashboard-title { font-size: 2rem; }
            .table-card, .chart-container { width: 90%; }
            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }
            tr.data-row { margin-bottom: 15px; padding: 12px 8px; }
            td { border: none; padding-left: 45% !important; text-align: left !important; }
            td:last-child { padding-left: 15px !important; text-align: center !important; }
            td::before { position: absolute; top: 14px; left: 15px; width: 35%; font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 0.8rem; content: attr(data-label); text-transform: uppercase; }
            .modal-card { flex-direction: column; }
            .modal-left .illustration { display: none; }
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
            <li><a href="/catat-perjalanan">Catat Perjalanan</a></li>
            
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

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="header-section">
        <h1 class="dashboard-title">DASHBOARD</h1>
        <a href="/catat-perjalanan" class="btn-add-note">Tambahkan Catatan ++</a>
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
            <tbody>
                @forelse($catatanPerjalanan ?? [] as $item)
                    <tr class="data-row">
                        <td data-label="Tanggal">{{ $item->tanggal }}</td>
                        <td data-label="Lokasi" class="font-semibold">{{ $item->lokasi }}</td>
                        <td data-label="Jarak" class="text-center">{{ $item->jarak }} KM</td>
                        <td data-label="Waktu" class="text-center">{{ $item->waktu }}</td>
                        <td data-label="Aksi" class="text-center">
                            <button type="button" class="btn-action btn-edit" 
                                onclick="openEditModal('{{ $item->id }}', '{{ $item->tanggal }}', '{{ $item->lokasi }}', '{{ $item->jarak }}', '{{ $item->waktu }}')">
                                EDIT
                            </button>
                            <form action="/travel/{{ $item->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data ini?')" class="btn-action btn-delete">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    @php
                        $sampleData = [
                            ['id' => 1, 'tanggal' => '2 April 2026', 'lokasi' => 'Bogor', 'jarak' => '12', 'waktu' => '2 Jam'],
                            ['id' => 2, 'tanggal' => '15 April 2026', 'lokasi' => 'Yogyakarta', 'jarak' => '450', 'waktu' => '1 Hari'],
                            ['id' => 3, 'tanggal' => '26 April 2026', 'lokasi' => 'Bali', 'jarak' => '900', 'waktu' => '2 Hari'],
                            ['id' => 4, 'tanggal' => '10 Mei 2026', 'lokasi' => 'Malioboro', 'jarak' => '5', 'waktu' => '1 Jam'],
                            ['id' => 5, 'tanggal' => '22 Mei 2026', 'lokasi' => 'Candi Prambanan', 'jarak' => '18', 'waktu' => '3 Jam'],
                        ];
                    @endphp

                    @foreach($sampleData as $data)
                    <tr class="data-row">
                        <td data-label="Tanggal">{{ $data['tanggal'] }}</td>
                        <td data-label="Lokasi" class="font-semibold">{{ $data['lokasi'] }}</td>
                        <td data-label="Jarak" class="text-center">{{ $data['jarak'] }} KM</td>
                        <td data-label="Waktu" class="text-center">{{ $data['waktu'] }}</td>
                        <td data-label="Aksi" class="text-center">
                            <button type="button" class="btn-action btn-edit" 
                                onclick="alert('Ini adalah data contoh. Silakan tambahkan catatan baru terlebih dahulu untuk mencoba fitur EDIT asli.')">
                                EDIT
                            </button>
                            <button type="button" class="btn-action btn-delete" onclick="this.closest('tr').remove();">DELETE</button>
                        </td>
                    </tr>
                    @endforeach
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="chart-container">
        <div class="chart-header">
            <h3>Total Perjalanan (KM)</h3>
            <a href="#" class="btn-more">More</a>
        </div>
        <div class="chart-wrapper">
            <canvas id="travelChart"></canvas>
        </div>
    </div>

    <div class="modal-overlay" id="editModalOverlay">
        <div class="modal-card">
            <div class="modal-close" onclick="closeEditModal()">&times;</div>
            
            <div class="modal-left">
                <h2>Edit<br>Perjalanan</h2>
                <div class="illustration">
                    <i class="fa-solid fa-leaf" style="font-size: 5rem; color: rgba(255,255,255,0.7);"></i>
                </div>
            </div>
            
            <div class="modal-right">
                <form id="editTravelForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <input type="text" name="tanggal" id="modal-tanggal" class="form-control" placeholder="Tanggal" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lokasi" id="modal-lokasi" class="form-control" placeholder="Lokasi" required>
                    </div>
                    <div class="form-group">
                        <input type="number" step="any" name="jarak" id="modal-jarak" class="form-control" placeholder="Jarak (Angka Saja)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="waktu" id="modal-waktu" class="form-control" placeholder="Waktu" required>
                    </div>
                    
                    <button type="submit" class="btn-submit-edit">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modalOverlay = document.getElementById('editModalOverlay');
        const editForm = document.getElementById('editTravelForm');

        function openEditModal(id, tanggal, lokasi, jarak, waktu) {
            const cleanJarak = jarak.replace(' KM', '').trim();

            document.getElementById('modal-tanggal').value = tanggal;
            document.getElementById('modal-lokasi').value = lokasi;
            document.getElementById('modal-jarak').value = cleanJarak;
            document.getElementById('modal-waktu').value = waktu;
            
            editForm.action = `/travel/${id}`;
            modalOverlay.classList.add('active');
        }

        function closeEditModal() {
            modalOverlay.classList.remove('active');
        }

        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) closeEditModal();
        });

        // --- DINAMISASI DATA CHART ---
        const labels = [];
        const dataJarak = [];

        const rows = document.querySelectorAll('table tbody tr.data-row');
        rows.forEach(row => {
            const tglEl = row.querySelector('td[data-label="Tanggal"]');
            const jrkEl = row.querySelector('td[data-label="Jarak"]');
            if(tglEl && jrkEl){
                const tgl = tglEl.innerText;
                const jrkText = jrkEl.innerText;
                const jrkVal = parseFloat(jrkText.replace(' KM', '')) || 0;
                
                labels.push(tgl);
                dataJarak.push(jrkVal);
            }
        });

        labels.reverse();
        dataJarak.reverse();

        const ctx = document.getElementById('travelChart').getContext('2d');
        const greenGradient = ctx.createLinearGradient(0, 0, 0, 300);
        greenGradient.addColorStop(0, 'rgba(92, 184, 143, 0.6)');
        greenGradient.addColorStop(1, 'rgba(92, 184, 143, 0.05)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['Belum Ada Data'],
                datasets: [{
                    label: 'Jarak Tempuh (KM)',
                    data: dataJarak.length ? dataJarak : [0],
                    backgroundColor: greenGradient,
                    borderColor: '#4da37d',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#3a685e',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>