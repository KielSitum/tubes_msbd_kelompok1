<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    @vite('resources/css/app.css')

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
    <style>
         table {
        width: 100%; /* Menggunakan seluruh lebar kontainer */
        max-width: 100%; /* Pastikan tidak melebihi viewport */
        border-collapse: collapse;
        margin: 0 auto; /* Tengah secara horizontal */
        font-size: 1rem; /* Ukuran font lebih besar */
    }

    th, td {
        padding: 1rem 1.5rem; /* Menambah padding lebih besar */
        text-align: left;
        border-bottom: 1px solid #e0e0e0; /* Menambahkan garis bawah lembut */
    }

    th {
        background-color: #f3f4f6; /* Warna abu-abu untuk header */
        font-weight: bold;
        color: #333; /* Warna teks lebih gelap */
    }

    tr:hover {
        background-color: #f8fafc; /* Efek hover lembut */
        transition: background 0.3s ease-in-out;
    }

    /* Membuat tabel lebih responsif */
    .table-container {
        overflow-x: auto; /* Tambahkan scroll horizontal jika layar kecil */
        margin-top: 1.5rem;
    }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
        }

        main {
            flex-grow: 1;
        }

        footer {
            margin-top: auto;
            background-color: #2d98da;
            color: #ffeaa3;
            text-align: center;
            padding: 1rem 0;
        }
    </style>
</head>

<body>
    @include('user.components.navbar')

    <main>
        <div class="flex flex-col items-center mb-8">
            <div class="w-[70vw] mt-8 flex flex-col">
                <div class="flex gap-4">
                    <!-- Back button -->
                    <a href="/" class="flex items-center justify-center rounded-xl bg-blue-500 hover:bg-blue-600 shadow-lg h-12 px-4 text-white text-lg font-medium transition duration-300 ease-in-out transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 14l-4 -4l4 -4"></path>
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                        </svg>
                        <span class="ml-2">Kembali</span>
                    </a>
                </div>

                <div class="my-7">
                    <p class="text-3xl font-semibold">Riwayat Pesanan</p>

                    <!-- Table -->
                    <div class="table-container bg-opacity-50 bg-white rounded-lg shadow-2xl">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th>No. Invoice</th>
                                    <th>Tanggal Belanja</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Total Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products_purcase as $product_purcase)
                                <tr>
                                    <td>{{ $product_purcase->invoice_code }}</td>
                                    <td>{{ date('d M Y', strtotime($product_purcase->order_date)) }}</td>
                                    <td>
                                        <a href="/detail-riwayat-pesanan?pesanan={{ $product_purcase->selling_invoice_id }}" class="text-blue-600 underline font-semibold">Lihat Detail</a>
                                    </td>
                                    <td>
                                        <p class="@if($product_purcase->order_status == 'Berhasil') bg-green-700 
                                            @elseif ($product_purcase->order_status == 'Menunggu Konfirmasi') bg-yellow-500
                                            @elseif ($product_purcase->order_status == 'Gagal') bg-red-500
                                            @endif w-56 py-1 px-4 rounded-lg text-white font-semibold">
                                            {{ $product_purcase->order_status }}
                                        </p>
                                    </td>
                                    @php
                                        $totalBelanja = 0;
                                        $product = $product_purcase->invoiceSellingDetail;
                                        foreach ($product as $p) {
                                            $totalBelanja += $p->product_sell_price * $p->quantity;
                                        }
                                    @endphp
                                    <td>Rp {{ number_format($totalBelanja, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                        {{ $products_purcase->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('user.components.footer')
</body>

</html>
