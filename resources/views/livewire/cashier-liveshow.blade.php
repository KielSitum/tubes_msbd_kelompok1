<div class="flex flex-col gap-8 w-full md:w-[67%] p-10">
    <div class="flex gap-4 items-center">
        <input type="text" wire:model="search" wire:keyup="search_product"
            class="h-12 w-full md:w-[70%] lg:w-[80%] rounded-full border border-blue-200 px-6 placeholder:text-gray-400 bg-[#FFF8E1] focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-md"
            placeholder="Cari">
    </div>
    
{{-- PRODUCT START --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
    @foreach ($products as $item)
    <div class="bg-white border rounded-lg shadow hover:shadow-xl transition-all h-96 flex flex-col">
        <div class="relative">
            <div class="h-52 bg-gray-100 flex items-center justify-center">
                @if (file_exists(public_path('storage/gambar-obat/' . $item->description->product_photo)) && $item->description->product_photo !== NULL)
                    <img src="{{ asset('storage/gambar-obat/' . $item->description->product_photo) }}" alt="" class="w-full h-full object-contain">
                @else
                    <img src="{{ asset('img/obat1.jpg') }}" alt="Default Image" class="w-full h-full object-contain">
                @endif
            </div>
        </div>

        <div class="p-5 flex flex-col gap-3 flex-grow">
            <h3 class="font-bold text-lg text-gray-800 truncate">{{ $item->product_name }}</h3>
            <div>
                <p class="text-orange-500 font-semibold text-sm">Rp {{ number_format($item->product_sell_price, 0, ',', '.') }}</p>
                <p class="text-xs font-semibold text-gray-600">Stok: {{ $item->detail->sum('product_stock') }}</p>
            </div>
            <div class="mt-auto">
                @auth
                    @if ($item->product_status == 'aktif')
                        <button wire:click="AddedToCart({{ $item }})"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg font-medium hover:bg-blue-600 transition-all">
                            Tambahkan ke Keranjang
                        </button>
                    @else
                        <button type="button" disabled
                            class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg font-medium cursor-not-allowed">
                            Obat Tidak Tersedia
                        </button>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>
{{-- PRODUCT END --}}

<!-- PAGINATION START -->
<div class="flex justify-center items-center py-8">
    <div class="flex gap-3 items-center bg-blue-300 px-6 py-3 rounded-full shadow-lg">
        @if ($products->currentPage() > 1)
            <button wire:click="previousPage" class="w-10 h-10 flex items-center justify-center text-white bg-blue-200 rounded-full hover:bg-blue-400 transition-all">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </button>
        @else
            <span class="w-10 h-10 flex items-center justify-center text-blue-300 bg-blue-200 rounded-full cursor-not-allowed">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </span>
        @endif

        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <button wire:click="gotoPage({{ $i }})"
                class="w-10 h-10 flex items-center justify-center rounded-full text-blue text-lg transition-all {{ $products->currentPage() == $i ? 'bg-white text-blue-500 ring-2 ring-blue-400' : 'bg-blue-200 hover:bg-blue-400' }}">
                {{ $i }}
            </button>
        @endfor

        @if ($products->hasMorePages())
            <button wire:click="nextPage" class="w-10 h-10 flex items-center justify-center text-white bg-blue-200 rounded-full hover:bg-blue-400 transition-all">
                <i class="fa-solid fa-chevron-right text-lg"></i>
            </button>
        @else
            <span class="w-10 h-10 flex items-center justify-center text-blue-300 bg-blue-200 rounded-full cursor-not-allowed">
                <i class="fa-solid fa-chevron-right text-lg"></i>
            </span>
        @endif
    </div>
</div>
<!-- PAGINATION END -->

</div>
