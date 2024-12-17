<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    @vite('resources/css/app.css')
    @livewireStyles

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .main-content {
        flex: 1; /* Mengisi ruang yang tersedia */
}
        .cart-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 12px;
            padding: 3rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
        }

        .cart-details {
            flex: 1;
            margin-left: 1rem;
        }

        .cart-details p {
            margin: 0.2rem 0;
        }

        .cart-actions {
            display: flex;
            align-items: center;
            gap: 10rem; /* Tambahkan jarak antar elemen */
        }

        .cart-actions button {
            background-color: red;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
        }

        .cart-quantity input {
            width: 50px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 0.25rem;
        }
        /* Tombol Lanjut */
.btn-lanjut {
    display: inline-block;
    width: 100%; /* Lebar penuh */
    max-width: 300px; /* Maksimal lebar tombol */
    padding: 1rem 2rem; /* Ukuran padding lebih besar */
    text-align: center;
    font-size: 1.1rem;
    font-weight: bold;
    color: white;
    background: linear-gradient(90deg, #4a90e2, #357ab7); /* Gradien warna biru */
    border: none;
    border-radius: 12px; /* Sudut membulat */
    cursor: pointer;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
    margin: 2rem auto; /* Jarak atas dan bawah yang lebih lapang */
}

/* Hover Effect */
.btn-lanjut:hover {
    background: linear-gradient(90deg, #5dade2, #2e6ea5); /* Gradien hover lebih terang */
    transform: translateY(-5px); /* Efek tombol melayang ke atas */
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3); /* Shadow lebih tebal */
}

    </style>
</head>

<body class="font-Inter bg-gray-50">
    @include('user.components.navbar')

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mt-12">Keranjang Belanja</h1>
        <div class="cart-container">
            @isset($carts)
                @foreach ($carts as $cart)
                <div class="cart-item">
                    <!-- Product Image -->
                    <img src="{{ file_exists(public_path('storage/gambar-obat/' . $cart->product_photo)) && $cart->product_photo !== NULL ? asset('storage/gambar-obat/' . $cart->product_photo) : asset('img/obat1.jpg/') }}" alt="{{ $cart->product_name }}">
                    
                    <!-- Product Details -->
                    <div class="cart-details">
                        <p class="text-lg font-semibold">{{ $cart->product_name }}</p>
                        <p class="text-gray-500 text-sm">Kategori Obat: {{ $cart->category }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="cart-actions">
                        <!-- Quantity Control -->
                        <div class="cart-quantity">
                            <livewire:count-product-cart :price="$cart->product_sell_price" :cart="$cart->cart_id" :stock="$cart->product_stock" :quantity="$cart->quantity" :keranjang="true"/>
                        </div>

                        <!-- Price -->
                        <p class="text-lg font-bold text-gray-700">Rp {{ number_format($cart->product_sell_price, 0, ',', '.') }}</p>

                        <!-- Delete Button -->
                        <form action="/keranjang/hapus" method="POST">
                            @csrf
                            <input type="hidden" name="hapus" value="satuan">
                            <input type="hidden" name="cart_id" value="{{ $cart->cart_id }}">
                            <button type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                @endforeach
            @else
                <p class="text-center text-gray-500">Keranjang Anda kosong.</p>
            @endisset
        </div>

        <!-- Proceed Button -->
        <!-- Proceed Button -->
@isset($cart)
<div class="flex justify-center mt-10 mb-10">
    <a href="/booking" 
       class="btn-lanjut">
       Lanjut
    </a>
</div>
@endisset

    </div>

    @include('user.components.footer')
    @livewireScripts
</body>

</html>
