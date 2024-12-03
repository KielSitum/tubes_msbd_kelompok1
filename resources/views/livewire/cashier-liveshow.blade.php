<div class="flex flex-col gap-8 w-full md:w-[67%] p-10">
    <div class="flex gap-4 items-center">
        <input type="text" wire:model="search" wire:keyup="search_product"
            class="h-12 w-full md:w-[50%] rounded-full border border-gray-300 px-6 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cari">
    </div>


{{-- PRODUCT START --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
    @foreach ($products as $item)
    <div class="bg-white border rounded-lg shadow hover:shadow-lg transition-all">
        <div class="relative">
            <div class="h-32 overflow-hidden rounded-t-lg bg-gray-100 flex items-center justify-center">
                @if (file_exists(public_path('storage/gambar-obat/' . $item->description->product_photo)) && $item->description->product_photo !== NULL)
                    <img src="{{ asset('storage/gambar-obat/' . $item->description->product_photo) }}" alt="" class="object-cover w-full h-full">
                @else
                    <img src="{{ asset('img/obat1.jpg') }}" alt="Default Image" class="object-cover w-full h-full">
                @endif
            </div>
            @if ($item->description->product_type == "resep dokter")
            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-bold">Resep</span>
            @endif
        </div>

        <div class="p-3 flex flex-col gap-2">
            <h3 class="font-bold text-sm text-gray-800 truncate">{{ $item->product_name }}</h3>
            <div>
                <p class="text-orange-500 font-semibold text-sm">Rp {{ number_format($item->product_sell_price, 0, ',', '.') }}</p>

                <p class="text-xs font-semibold text-gray-600">Stok: {{ $item->detail->sum('product_stock') }}</p>
            </div>
            <div>
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



    {{-- PAGINATION START --}}
    <div class="flex justify-center items-center py-8">
        <div class="flex gap-4">
            @if ($products->currentPage() > 1)
                <button wire:click="previousPage" class="text-gray-600 hover:text-blue-500 transition-all">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            @else
                <span class="text-gray-300 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
            @endif
    
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <button wire:click="gotoPage({{ $i }})"
                    class="px-4 py-2 {{ $products->currentPage() == $i ? 'bg-blue-500 text-white' : 'text-gray-600' }} rounded-full font-medium hover:bg-blue-600 hover:text-white transition-all">
                    {{ $i }}
                </button>
            @endfor
    
            @if ($products->hasMorePages())
                <button wire:click="nextPage" class="text-gray-600 hover:text-blue-500 transition-all">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @else
                <span class="text-gray-300 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>
    
    {{-- PAGINATION END --}}
</div>
