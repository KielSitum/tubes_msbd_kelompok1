<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')
    @livewireStyles

    {{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lora:wght@400;500&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-50 font-['Roboto']">
    @include('user.components.navbar')

    <div class="container mx-auto px-4 py-6">
        {{-- Back Button --}}
        <div class="mb-4">
            <a href="/produk" class="flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2 shadow transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white shadow-lg rounded-lg overflow-hidden p-6">
            {{-- Product Image --}}
            <div class="flex justify-center items-center">
                <img src="{{ asset('img/obat1.jpg/') }}" alt="Produk"
                    class="rounded-md shadow-md max-h-96 object-contain">
            </div>

            {{-- Product Details --}}
            <div>
                {{-- Tag for Prescription --}}
                

                {{-- Product Name --}}
                <h1 class="text-2xl font-bold text-gray-800 mb-2 font-['Playfair Display']">
                    {{ $description_product->product_name }}
                </h1>

                {{-- Product Price --}}
                <p class="text-xl font-semibold text-orange-500 mb-4">
                    Rp {{ number_format($description_product->product_sell_price, 0, ',', '.') }}
                    <span class="text-gray-500 text-sm font-normal">/ {{ $description_product->unit }}</span>
                </p>

                {{-- Stock Information --}}
                <p class="text-gray-700 text-base mb-2">
                    Stok: <span class="font-medium">{{ $description_product->product_stock }}</span>
                </p>

                {{-- User Authentication & Action --}}
                @auth
                <livewire:counter-product :stock="$description_product->product_stock" :user="auth()->user()->user_id"
                    :product="$description_product->product_id" :status="$description_product->product_status" />
                @if (session('error'))
                <p class="text-red-500 text-sm mt-2">{{ session('error') }}</p>
                @endif
                @else
                <div class="mt-6 flex items-center gap-4 bg-yellow-50 border border-yellow-400 rounded-lg p-4">
                    <i class="fa-solid fa-triangle-exclamation text-yellow-400 text-2xl"></i>
                    <p class="text-gray-700">
                        Mohon untuk <a href="/login" class="text-blue-500 underline">login</a> terlebih dahulu sebelum
                        melakukan pemesanan.
                    </p>
                </div>
                @endauth
            </div>
        </div>

        {{-- Product Description --}}
        <div class="bg-white shadow-lg rounded-lg mt-8 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 font-['Playfair Display']">Detail Produk</h2>
            <table class="w-full text-left text-gray-700">
                <tr>
                    <td class="py-2 font-medium">Deskripsi Obat</td>
                    <td>:</td>
                    <td class="py-2">{{ $description_product->product_description }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">Manufaktur</td>
                    <td>:</td>
                    <td class="py-2">{{ $description_product->product_manufacture }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">Golongan Obat</td>
                    <td>:</td>
                    <td class="py-2">{{ $description_product->group }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">Kategori Obat</td>
                    <td>:</td>
                    <td class="py-2">{{ $description_product->category }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">Tanggal Kadaluwarsa</td>
                    <td>:</td>
                    <td class="py-2">{{ date('d F Y', strtotime($description_product->product_expired)) }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">No. Izin Edar (BPOM)</td>
                    <td>:</td>
                    <td class="py-2">{{ $description_product->product_DPN }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">Efek Samping</td>
                    <td>:</td>
                    <td class="py-2">{{ $description_product->product_sideEffect }}</td>
                </tr>
            </table>
        </div>
    </div>

    @include('user.components.footer')
    @livewireScripts
</body>

</html>
