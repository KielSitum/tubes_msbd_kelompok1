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

<body class="font-Trip bg-gray-100">
    
    <div class="container mx-auto p-6">
        <div class="flex flex-col mb-8">
            <div class="p-6 flex flex-col bg-white rounded-lg shadow-lg">
                {{-- back button --}}
                <a href="/owner/produk" class="p-3 rounded-full bg-mainColor text-white w-fit mb-4">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                
                <h1 class="text-4xl font-bold text-center mb-6">Edit Produk</h1>

                {{-- container --}}
                <form action="{{ route('product-proccess-update',['id'=> $product->product_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-lg font-semibold">Status</label>
                        <select name="status" class="mt-2 w-full p-2 border rounded-lg shadow">
                            @if ($product->product_status != 'exp')
                                @foreach ($status as $item)
                                    <option value="{{ $item }}" {{ $product->product_status == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            @else
                                <option value="{{ $product->product_status }}">Expired</option>
                            @endif
                        </select>
                        @error('harga_jual')
                        <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                        @if ($product->product_status == 'exp')
                            <p class="text-sm text-red-500 mt-2">Tambahkan Batch Baru Dengan Exp > 3bulan untuk membuka status dari <a href="/owner/detail-produk/{{ $product->product_id }}" class="underline text-blue-700">detail produk</a></p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold">Harga Jual Obat</label>
                        <input type="number" name="harga_jual" placeholder="Harga Jual Obat" class="mt-2 w-full p-2 border rounded-lg shadow @error('harga_jual') is-invalid @enderror" value="{{ $product->product_sell_price }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-semibold">Nama Obat</label>
                            <input type="text" name="nama_obat" placeholder="Nama Obat" class="mt-2 w-full p-2 border rounded-lg shadow @error('nama_obat') is-invalid @enderror" value="{{ $product->product_name }}">
                            @error('nama_obat')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-lg font-semibold">Kategori Obat</label>
                            <select name="kategori" class="mt-2 w-full p-2 border rounded-lg shadow">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->category_id }}" {{ $product->description->category->category == $item->category ? 'selected' : '' }}>
                                        {{ $item->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-lg font-semibold">Golongan Obat</label>
                            <select name="golongan" class="mt-2 w-full p-2 border rounded-lg shadow">
                                @foreach ($groups as $item)
                                    <option value="{{ $item->group_id }}" {{ $product->description->group->group == $item->group ? 'selected' : '' }}>
                                        {{ $item->group }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-lg font-semibold">Jenis Obat</label>
                            <select name="satuan_obat" class="mt-2 w-full p-2 border rounded-lg shadow">
                                @foreach ($units as $item)
                                    <option value="{{ $item->unit_id }}" {{ $product->description->unit->unit == $item->unit ? 'selected' : '' }}>
                                        {{ $item->unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-lg font-semibold">NIE Obat</label>
                            <input type="text" name="NIE" placeholder="NIE Obat" class="mt-2 w-full p-2 border rounded-lg shadow @error('NIE') is-invalid @enderror" value="{{ $product->description->product_DPN }}">
                            @error('NIE')
                            <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-lg font-semibold">Pemasok Obat</label>
                            <select name="pemasok" class="mt-2 w-full p-2 border rounded-lg shadow">
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->supplier_id }}" {{ $product->description->supplier->supplier == $item->supplier ? 'selected' : '' }}>
                                        {{ $item->supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-lg font-semibold">Deskripsi Obat</label>
                        <textarea name="deskripsi" placeholder="Deskripsi Obat" class="mt-2 w-full p-2 border rounded-lg shadow h-28">{{ $product->description->product_description }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label class="block text-lg font-semibold">Efek Samping Obat</label>
                        <textarea name="efek_samping" placeholder="Efek Samping Obat" class="mt-2 w-full p-2 border rounded-lg shadow h-28">{{ $product->description->product_sideEffect }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label class="block text-lg font-semibold">Dosis Obat</label>
                        <textarea name="dosis" placeholder="Dosis Obat" class="mt-2 w-full p-2 border rounded-lg shadow h-28 @error('dosis') is-invalid @enderror">{{ $product->description->product_dosage }}</textarea>
                        @error('dosis')
                        <div class="text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-center mt-8">
                        <button type="submit" class="w-48 bg-mainColor px-4 py-2 font-semibold text-lg text-white rounded-lg shadow">Edit</button>
                    </div>
                </form>
            </div>

            @php
                $i=1;
            @endphp
        </div>
    </div>

    <script>
        function showFile(input) {
            const getFile = document.getElementById('uploadedFile');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    getFile.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>