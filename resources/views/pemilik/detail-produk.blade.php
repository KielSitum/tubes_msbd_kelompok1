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

    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .back-button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .back-button i {
            margin-right: 8px;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .notification {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            animation: fadeIn 3s forwards;
        }

        .notification.error {
            background-color: #f44336;
        }

        .notification i {
            margin-right: 10px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .product-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .product-container img {
            max-width: 100%;
            border-radius: 10px;
        }

        .product-details-table td {
            padding: 8px 12px;
            text-align: left;
            font-size: 1rem;
        }

        .product-details-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-description {
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .product-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .section-content {
            font-size: 1.1rem;
            color: #555;
        }

        .remove-expired-btn {
            background-color: #e53935;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            display: block;
            width: 100%;
            margin-top: 30px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .remove-expired-btn:hover {
            background-color: #c62828;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .product-details-table td {
                display: block;
                width: 100%;
                padding: 10px 0;
            }

            .product-details-table td:first-child {
                font-weight: bold;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="notification">
                <i class="fa-solid fa-circle-check"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="notification error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Tombol kembali --}}
        <a href="/owner/produk" class="back-button">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        <p class="product-title">{{ $product->product_name }}</p>

        {{-- Detail Produk --}}
        @foreach ($product->detail as $detail)
            <div class="product-container">
                <div class="sm:flex sm:grid-cols-3 md:gap-20 gap-3">
                    {{-- Gambar Obat --}}
                    <div class="sm:w-1/3 mb-7">
                        @if (file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) && $product->description->product_photo !== NULL)
                            <img src="{{ asset('storage/gambar-obat/' . $product->description->product_photo) }}" alt="">
                        @else
                            <img src="{{ asset('img/Pencernaan.png') }}" alt="">
                        @endif
                    </div>

                    {{-- Detail Obat --}}
                    <div class="sm:w-2/3">
                        <table class="product-details-table">
                            <tr>
                                <td>Status Obat</td>
                                <td>{{ $product->product_status }}</td>
                            </tr>
                            @php
                                $carbonDate = \Carbon\Carbon::parse($detail->product_expired);
                                $formattedDate = $carbonDate->format('j F Y');
                            @endphp
                            <tr>
                                <td>Expired Obat</td>
                                <td>{{ $formattedDate }}</td>
                            </tr>
                            <tr>
                                <td>Stok Obat</td>
                                <td>{{ $detail->product_stock }}</td>
                            </tr>
                            <tr>
                                <td>Tipe Obat</td>
                                <td>{{ $product->description->product_type }}</td>
                            </tr>
                            <tr>
                                <td>Harga Beli Obat</td>
                                <td>{{ number_format($detail->product_buy_price,0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Harga Jual Obat</td>
                                <td>{{ number_format($product->product_sell_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Kategori Obat</td>
                                <td>{{ $product->description->category->category }}</td>
                            </tr>
                            <tr>
                                <td>Golongan Obat</td>
                                <td>{{ $product->description->group->group }}</td>
                            </tr>
                            <tr>
                                <td>Satuan Obat</td>
                                <td>{{ $product->description->unit->unit }}</td>
                            </tr>
                            <tr>
                                <td>NIE Obat</td>
                                <td>{{ $product->description->product_DPN }}</td>
                            </tr>
                            <tr>
                                <td>Pemasok Obat</td>
                                <td>{{ $product->description->supplier->supplier }}</td>
                            </tr>
                            <tr>
                                <td>Produksi Dari</td>
                                <td>{{ $product->description->product_manufacture }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Deskripsi Obat --}}
                <div class="product-description">
                    <p class="section-title">Deskripsi Obat:</p>
                    <p class="section-content">{{ $product->description->product_description }}</p>
                </div>

                {{-- Dosis Obat --}}
                <div class="product-description">
                    <p class="section-title">Dosis Obat:</p>
                    <p class="section-content">{{ $product->description->product_dosage }}</p>
                </div>

                {{-- Peringatan Obat --}}
                @if ($product->description->product_notice != NULL)
                    <div class="product-description">
                        <p class="section-title">Peringatan Obat:</p>
                        <p class="section-content">{{ $product->description->product_notice }}</p>
                    </div>
                @endif

                {{-- Efek Samping Obat --}}
                <div class="product-description">
                    <p class="section-title">Efek Samping Obat:</p>
                    <p class="section-content">{{ $product->description->product_sideEffect }}</p>
                </div>

                {{-- Indikasi Umum Obat --}}
                @if ($product->description->product_indication != NULL)
                    <div class="product-description">
                        <p class="section-title">Indikasi Umum Obat:</p>
                        <p class="section-content">{{ $product->description->product_indication }}</p>
                    </div>
                @endif

                {{-- Tombol Hapus Produk Expired --}}
                @if (\Carbon\Carbon::parse($detail->product_expired)->lte(\Carbon\Carbon::now()->addMonths(3)))
                    @if ($detail->where('product_id', $detail->product_id)->count() > 1)
                        <form action="{{ route('hapus-expired') }}" method="POST">
                            @csrf
                            <input type="hidden" name="detail_id" value="{{ $detail->detail_id }}">
                            <button type="submit" class="remove-expired-btn">Hapus Produk Expired</button>
                        </form>
                    @elseif ($product->product_status == 'tidak aktif')
                        <div class="flex mt-10">
                            <p class="bg-red-500 ms-auto rounded-md px-5 py-2 font-bold text-white" style="margin-right:300px;">
                                Silahkan Beli Obat Baru Untuk Membuka Status Obat Menjadi Aktif!
                            </p>
                        </div>
                    @endif
                @endif
            </div>
        @endforeach
    </div>
</body>

</html>
