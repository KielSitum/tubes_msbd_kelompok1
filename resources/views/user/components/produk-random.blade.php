<div class="flex flex-col items-center mb-8">
    <div class="w-[80vw] mt-8 flex flex-col gap-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @if ($products_random->count() > 0)
                @foreach ($products_random as $product)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col p-4 hover:shadow-2xl transition-shadow duration-300">
                        <a href="/deskripsi/{{ Str::slug($product->first()->product_name) }}" class="flex flex-col items-center">
                            <img src="{{ file_exists(public_path('storage/gambar-obat/' . $product->first()->product_photo)) 
                                ? asset('storage/gambar-obat/' . $product->first()->product_photo) 
                                : asset('img/obat1.jpg') }}" 
                                alt="{{ $product->first()->product_name }}" 
                                class="w-full h-36 object-cover rounded-md mb-4">
                            
                            <h2 class="text-lg font-semibold text-gray-700">{{ Str::limit($product->first()->product_name, 20) }}</h2>
                        </a>

                        <p class="text-orange-500 text-lg font-bold mt-2">
                            Rp. {{ number_format($product->first()->product_sell_price, 0, ',', '.') }}
                        </p>

                        <p class="text-gray-600 text-sm mt-1">Stok: {{ $product->detail()->orderBy('product_expired')->first()->product_stock }}</p>

                        <!-- Tombol Lihat Detail -->

                    </div>
                @endforeach
            @else
                <p class="text-center text-lg font-medium text-gray-500">Produk tidak ditemukan.</p>
            @endif
        </div>

        <div class="text-center mt-6">
            <a href="/produk" class="text-blue-500 text-lg underline">Lihat Semua Produk</a>
        </div>
    </div>
</div>
