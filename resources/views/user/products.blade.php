<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    @vite('resources/css/app.css')
    @livewireStyles

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f7f9fc, #eaf0f9);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            min-height: 100vh;
        }
        .main-container {
            flex: 1;
        }

        h1 {
            font-family: 'Open Sans', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #000000;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            justify-content: center;
        }

        /* Card Style for Product */
        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Tambahkan ini */
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
            max-width: 350px;
            width: 100%;
            box-sizing: border-box;
            margin: 0;
            padding: 10px;
        }

        .product-card:hover {
            transform: translateY(-3px); /* Naik sedikit */
            box-shadow: 0 12px 15px -5px rgba(0, 0, 0, 0.3);
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 10px 0;
            text-align: center;
            padding: 5px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            text-align: center;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #e74c3c;
        }

        .product-stock {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin: 5px 0;
        }

        .product-description {
            font-size: 0.9rem;
            color: #95a5a6;
            text-align: center;
            margin: 10px 15px;
            line-height: 1.5;
        }

        .btn {
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            border-radius: 8px;
            margin: 10px 0 20px 0;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s ease;
            margin-top: auto; /* Pastikan tombol tetap berada di bagian bawah jika konten lebih pendek */
        }

        .btn:hover {
            background: linear-gradient(45deg, #5dade2, #3498db);
            transform: scale(1.1);
        }

        /* Responsiveness for Small Devices */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        /* Styling untuk Search Bar */
        .search-bar-container {
        display: flex;
        align-items: center;
        background-color: #d7ebff; /* Warna biru muda */
        border: 2px solid #87cfff; /* Biru lebih terang */
        border-radius: 15px; /* Membuat sudut membulat */
        padding: 5px; /* Jarak dari dalam */
        width: 100%;
        max-width: 600px; /* Sesuaikan lebar maksimal */
        margin: 0 auto 20px; /* Tengah dan beri margin bawah */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek shadow */
    }


        .search-input {
            width: calc(100% - 60px); /* Menyisakan ruang untuk tombol */
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 15px 15px 15px 15px;
            border: 2px solid #3498db;
            outline: none;
            transition: border-color 0.3s ease;
            flex: 1;
        }

        .search-input:focus {
            border-color: #2980b9;
        }

        .search-btn {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border-radius: 15px 15px 15px 15px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    @include('user.components.navbar')

    <div class="main-container">
        <h1 >Produk Tersedia</h1>

        <!-- Search Bar -->
        <div class="search-bar-container">
            <form action="/produk" method="GET" class="w-full">
                <input
                    autocomplete="off"
                    type="text"
                    id="cari"
                    name="cari"
                    value="{{ request()->cari }}"
                    placeholder="Cari produk disini"
                    class="search-input"
                >
                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            @if (request()->filter)
            <p class="font-semibold text-mediumGrey">Filter: {{ request()->filter }}</p>
            @endif
        </div>

        <!-- Product Grid -->
        <div class="product-grid">
            @if ($products != NULL)
            @foreach ($products as $product)
            <div class="product-card">
                <a href="/deskripsi/{{ Str::slug($product->product_name) }}">
                    <img src="{{ file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) ? asset('storage/gambar-obat/' . $product->description->product_photo) : asset('img/obat1.jpg') }}" class="product-img" alt="product image">
                    <div class="product-name">{{ Str::limit($product->product_name, 20) }}</div>
                    <div class="product-price">
                        @if ($product->discounted_price)
                        <span class="text-success">Rp{{ number_format($product->discounted_price, 0, ',', '.') }}</span>
                        <small class="text-muted" style="text-decoration: line-through;">Rp{{ number_format($product->product_sell_price, 0, ',', '.') }}</small>
                        @else
                        Rp{{ number_format($product->product_sell_price, 0, ',', '.') }}
                    @endif
                </td>
                    </div>
                    <div class="product-stock">Stok: {{ $product->detail()->orderBy('product_expired')->first()->product_stock }}</div>
                    <div class="product-description">{{ Str::limit($product->description->product_desc, 120) }}</div>
                    <button class="btn">Lihat Detail</button>
                </a>
            </div>
            @endforeach
            @else
            <p class="text-center text-lg">Produk tidak ditemukan</p>
            @endif
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>

    @livewireScripts

</body>

</html>
