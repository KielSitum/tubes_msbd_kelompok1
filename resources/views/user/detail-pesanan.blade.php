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
</head>

<body class="font-Inter bg-semiWhite h-screen flex justify-center items-center">
    @include('user.components.navbar')

    <div class="flex justify-center py-10">
        <div class="w-full max-w-6xl flex gap-10 p-6">
            <!-- Form (Now on the left) -->
            <form action="/booking" method="post" enctype="multipart/form-data" 
            class="w-[40%] bg-white p-8 rounded-xl shadow-md flex flex-col gap-6 border border-gray-300">
            @csrf
                @php
                $jumlah = 0;
                @endphp

                @foreach($carts as $cart)
                @php
                    $jumlah += $cart->total_harga;
                @endphp
                @endforeach

                <h2 class="font-bold text-2xl text-black text-center">Isi Data Diri Untuk Pengambilan Obat</h2>
                
                <!-- Nama -->
                <div>
                    <input type="text" name="nama" placeholder="Nama Pengambil" 
                           value="{{ auth()->user()->username }}" required 
                           class="h-12 w-full px-4 rounded-2xl shadow-md" />
                    @error('nama')
                        <p class="text-sm text-red-200 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <input type="number" name="nomor_telepon" placeholder="No. Telp" 
                           value="{{ auth()->user()->customer->customer_phone }}" required 
                           class="h-12 w-full px-4 rounded-2xl shadow-md" />
                    @error('nomor_telepon')
                        <p class="text-sm text-red-200 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div>
                    <input type="text" name="catatan" autocomplete="off" placeholder="Catatan (Opsional)" 
                           class="h-12 w-full px-4 rounded-2xl shadow-md" />
                </div>

                <!-- Hidden Total -->
                
                <input type="hidden" name="total" value="{{ $jumlah }}" />

<!-- Submit Button -->
<button type="submit" 
        class="bg-[#3498db] h-12 w-full text-xl font-bold text-white rounded-2xl shadow-md 
               hover:bg-[#2e86c1] hover:shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
    Bayar
</button>

            </form>

            <!-- Cart Details (Now on the right) -->
            <div class="w-[60%] bg-white rounded-xl p-6 shadow-lg">
                <h2 class="text-lg font-bold text-black mb-4">Detail Keranjang</h2>
                @php
                    $jumlah = 0;
                @endphp



                @foreach($carts as $cart)
                    @php
                        $jumlah += $cart->total_harga;
                    @endphp
                    <!-- Example of a Cart Item -->
                    <div class="flex justify-between items-center p-4 mb-3 border rounded-lg">
                        <div>
                            <p class="font-bold">{{ $cart->product_name }}</p>
                            <p class="text-sm text-gray-500">Jumlah: {{ $cart->quantity }}</p>
                        </div>
                        <p class="font-bold text-black">Rp {{ number_format($cart->total_harga, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
