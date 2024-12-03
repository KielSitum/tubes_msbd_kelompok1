{{-- Cart Start --}}
<div class="w-full md:w-[30%] bg-white py-10 px-6 flex flex-col gap-8 shadow-lg fixed right-0 top-0 h-screen overflow-y-auto z-10">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <p class="font-bold text-2xl text-black">Keranjang Pesanan</p>
        <button onclick="toggleCartDisplay()" class="text-gray-600 hover:text-black">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <hr class="border border-mediumGrey opacity-20">

    <!-- Keranjang Kosong -->
    @if ($cartItems->isEmpty())
    <div class="flex flex-col items-center justify-center h-[60vh] text-center gap-4">
        <p class="font-medium text-xl text-gray-600">Keranjang Kosong</p>
    </div>
    @else
    <!-- Keranjang Ada Item -->
    <div class="flex-1 overflow-y-auto flex flex-col gap-6">
        @php $jumlah = 0; @endphp
        @foreach ($cartItems as $item)
        <div class="flex gap-4 p-4 border rounded-lg shadow-sm">
            <img src="{{ asset('img/obat1.jpg') }}" alt="{{ $item->product->product_name }}" class="w-24 h-24 object-cover rounded-md">
            <div class="flex flex-col justify-between flex-1">
                <p class="font-semibold text-lg text-black break-words">{{ $item->product->product_name }}</p>
                @if ($item->product->description->product_type == "resep dokter")
                <span class="bg-red-500 text-white text-xs py-1 px-3 rounded-full w-max font-medium">Resep</span>
                @endif
                <div class="flex justify-between items-center mt-3">
                    <div>
                        <p class="font-bold text-orange-500">Rp {{ number_format($item->product->product_sell_price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button wire:click="decrementButton({{ $item }}, {{ $item->product->detail()->orderBy('product_expired')->first() }})" class="p-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" min="1" class="w-12 text-center font-semibold border border-gray-300 rounded-md" value="{{ $item->quantity }}" readonly>
                        <button wire:click="incrementButton({{ $item }}, {{ $item->product->detail()->sum('product_stock') }})" class="p-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md">
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
    <div class="flex flex-col gap-6">
        <div>
            <p class="font-bold text-xl">Total Pesanan</p>
            <hr class="border border-mediumGrey opacity-20">
        </div>
        <div class="flex justify-between text-lg">
            <p class="font-semibold text-gray-600">Total Barang</p>
            <p class="font-semibold text-black">{{ $cartItems->count() }} Barang</p>
        </div>
        <div class="flex justify-between text-lg">
            <p class="font-semibold text-gray-600">Total Harga</p>
            <p class="font-semibold text-[#3498db]">Rp {{ number_format($jumlah ?? 0, 0, ',', '.') }}</p>
        </div>
        <a href="{{ route('bayar_offline') }}" class="w-full py-3 bg-[#3498db] text-white text-center font-bold text-lg rounded-lg hover:bg-[#2978b5] transition-all">
            Bayar
        </a>
    </div>
</div>
{{-- Cart End --}}
