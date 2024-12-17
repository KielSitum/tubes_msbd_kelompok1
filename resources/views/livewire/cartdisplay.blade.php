{{-- Cart Start --}}
<div> <!-- Root Element untuk Livewire -->

    <div class="w-full md:w-[30%] bg-[#FFF8E1] py-8 px-6 flex flex-col gap-8 shadow-2xl fixed right-0 top-0 h-screen overflow-y-auto z-20 rounded-l-xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <p class="font-bold text-3xl text-[#2c3e50]" style="font-family: 'Playfair Display', serif; letter-spacing: 1.5px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
                Keranjang Pesanan
            </p>
        </div>
        <hr class="border border-black-500 opacity-100">

        <!-- Keranjang Kosong -->
        @if ($cartItems->isEmpty())
        <div class="flex flex-col items-center justify-center h-[60vh] text-center gap-4">
            <p class="font-medium text-xl text-gray-500">Keranjang Kosong</p>
        </div>
        @else
        <!-- Keranjang Ada Item -->
        <div class="flex-1 overflow-y-auto flex flex-col gap-6 pr-2">
            @php $jumlah = 0; @endphp
            @foreach ($cartItems as $item)
            <div class="flex gap-4 p-4 border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-all">
                <img src="{{ asset('img/obat1.jpg') }}" alt="{{ $item->product->product_name }}" class="w-20 h-20 object-cover rounded-lg">
                <div class="flex flex-col justify-between flex-1">
                    <p class="font-semibold text-lg text-[#2c3e50] break-words">{{ $item->product->product_name }}</p>
                    @if ($item->product->description->product_type == "resep dokter")
                    <span class="bg-red-500 text-white text-xs py-1 px-3 rounded-full w-max font-medium shadow">Resep Dokter</span>
                    @endif
                    <div class="flex justify-between items-center mt-3">
                        <p class="font-bold text-[#e67e22] text-lg">Rp {{ number_format($item->product->product_sell_price, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2">
                            <button wire:click="decrementButton({{ $item }}, {{ $item->product->detail()->orderBy('product_expired')->first() }})" class="p-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md transition-all">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="number" min="1" class="w-12 text-center font-semibold border border-gray-300 rounded-md text-black" value="{{ $item->quantity }}" readonly>
                            <button wire:click="incrementButton({{ $item }}, {{ $item->product->detail()->sum('product_stock') }})" class="p-2 bg-[#3498db] hover:bg-[#2980b9] text-white rounded-md transition-all">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @php $jumlah += $item->product->product_sell_price * $item->quantity; @endphp
            @endforeach
        </div>
        @endif

        <!-- Total -->
        <div class="flex flex-col gap-6 bg-gray-100 rounded-lg p-4 shadow-inner">
            <p class="font-bold text-xl text-[#2c3e50]">Rincian Pesanan</p>
            <hr class="border border-gray-500 opacity-100">
            <div class="flex justify-between text-lg">
                <p class="font-medium text-gray-600">Total Barang</p>
                <p class="font-semibold text-black">{{ $cartItems->count() }} Barang</p>
            </div>
            <div class="flex justify-between text-lg">
                <p class="font-medium text-gray-600">Total Harga</p>
                <p class="font-semibold text-[#3498db]">Rp {{ number_format($jumlah ?? 0, 0, ',', '.') }}</p>
            </div>
            <a href="{{ route('bayar_offline') }}" 
            class="w-full py-3 text-white text-center font-bold text-lg rounded-lg shadow-md relative overflow-hidden group"
            style="position: relative; background-color: #005dfe;">
                <span class="relative z-10">Bayar Sekarang</span>
                <div class="absolute inset-0 bg-gradient-to-r from-[#005dfe] via-[#00ff2f] to-[#005dfe] opacity-0 group-hover:opacity-100 animate-gradient"></div>
            </a>

            <style>
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');
            /* Gradient Animation */
            @keyframes gradient-hover {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(100%); }
            }

            .animate-gradient {
                animation: gradient-hover 3s ease-in-out infinite; /* Durasi lebih lama dan smooth */
                background: linear-gradient(90deg, #005dfe, #00ff2f, #005dfe);
                opacity: 0.5; /* Lebih smooth dengan opacity lebih rendah */
                position: absolute;
                top: 0;
                left: 0;
                width: 300%; /* Lebar gradient lebih besar agar tidak patah */
                height: 100%;
                transform: translateX(-100%);
                transition: opacity 0.5s ease-in-out; /* Smooth hover transition */
            }
            </style>
        </div>
    </div>

</div> <!-- Root Element Ditutup -->
{{-- Cart End --}}
