<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        /* Global styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #34495e;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background-color: #ffffff;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table th,
        table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        table th {
            background-color: #3498db;
            color: white;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e0e0e0;
        }

        /* Badge */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        /* Alert Styling */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-control {
                font-size: 14px;
            }

            table th, table td {
                font-size: 14px;
                padding: 12px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 8px 15px;
            }

            table {
                font-size: 12px;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    @include("pemilik.components.sidebar")

    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
            @include("pemilik.components.navbar")
        <div class="container">
            <h1>Buat Promo Diskon Baru</h1>

            <form action="{{ route('tambah-promo') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_promo">Nama Promo</label>
                    <input type="text" class="form-control" id="nama_promo" name="nama_promo" value="{{ old('nama_promo') }}" required>
                </div>

                <div class="form-group">
                    <label for="nilai_diskon">Nilai Diskon (%)</label>
                    <input type="number" class="form-control" id="nilai_diskon" name="nilai_diskon" value="{{ old('nilai_diskon') }}" required min="0" max="100">
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option selected value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Buat Promo</button>
            </form>

            <h1>Promo yang Tersedia</h1>

            <!-- Menampilkan pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Promo yang Tersedia -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Promo</th>
                        <th>Nilai Diskon (%)</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promoDiskon as $promo)
                    <tr>
                        <td>{{ $promo->nama_promo }}</td>
                        <td>{{ $promo->nilai_diskon }}%</td>
                        <td>{{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d/m/Y') }}</td>
                        <td>
                            @if($promo->status == 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('hapus-promo', $promo->id_promo) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus promo ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
</body>
</html>