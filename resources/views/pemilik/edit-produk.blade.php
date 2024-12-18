<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Edit Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Light grey background */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #5cdc00;
            padding-bottom: 10px;
        }

        .back-button {
            background-color: #5cdc00;
            color: white;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #5cdc00;
        }

        h1 {
            font-size: 28px;
            color: #343a40;
        }

        .form-container {
            padding: 20px;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #495057;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            transition: border-color 0.3s;
            margin-top: 5px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        button {
        background: linear-gradient(90deg, #28a745, #34d058); 
        color: #ffffff; 
        border: none;
        border-radius: 8px; 
        padding: 12px 24px; 
        font-size: 16px;
        font-weight: bold; 
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
        cursor: pointer;
        transition: all 0.3s ease-in-out; 
        }

        button:hover {
            background: linear-gradient(90deg, #14b236, #2db34a); 
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15); 
            transform: translateY(-3px);
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(34, 225, 79, 0.807); /* Efek fokus */
        }

        .text-mediumRed {
            color: #dc3545;
        }

        .text-mediumGrey {
            color: #6c757d;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        .grid-cols-2 {
            grid-template-columns: 1fr 1fr;
        }

        .grid-cols-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        .upload-container {
            text-align: center;
        }

        .upload-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .upload-container button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            padding: 8px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            color: #ffffff;
        }

        .upload-container button:hover {
            background-color: #e9ecef;
        }

        .error-text {
            font-size: 12px;
            color: #dc3545;
            margin-top: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="/owner/produk" class="back-button">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h1 style="margin-right:400px;">Edit Produk</h1>
        </div>

        <div class="form-container">
            <form action="{{ route('product-proccess-update',['id'=> $product->product_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col mb-5">
                    <label for="status">Status</label>
                    <select name="status" id="status">
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
                    @if ($product->product_status == 'exp')
                        <p class="text-xs text-red-500 mt-2">Tambahkan Batch Baru Dengan Exp > 3bulan untuk membuka status dari <a href="/owner/detail-produk/{{ $product->product_id }}" class="underline text-blue-700">detail produk</a></p>
                    @endif
                </div>

                <div class="flex flex-col mb-5">
                    <label for="harga_jual">Harga Jual Obat</label>
                    <input type="number" id="harga_jual" name="harga_jual" placeholder="Harga Jual Obat" value="{{ $product->product_sell_price }}">
                </div>

                <div class="grid grid-cols-4 mb-5">
                    <div class="flex flex-col">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" id="nama_obat" name="nama_obat" placeholder="Nama Obat" value="{{ $product->product_name }}">
                    </div>

                    <div class="flex flex-col">
                        <label for="kategori">Kategori Obat</label>
                        <select name="kategori" id="kategori">
                            @foreach ($categories as $item)
                                <option value="{{ $item->category_id }}" {{ $product->description->category->category == $item->category ? 'selected' : '' }}>
                                    {{ $item->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="golongan">Golongan Obat</label>
                        <select name="golongan" id="golongan">
                            @foreach ($groups as $item)
                                <option value="{{ $item->group_id }}" {{ $product->description->group->group == $item-> group ? 'selected' : '' }}>
                                    {{ $item->group }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="satuan_obat">Jenis Obat</label>
                        <select name="satuan_obat" id="satuan_obat">
                            @foreach ($units as $item)
                                <option value="{{ $item->unit_id }}" {{ $product->description->unit->unit == $item->unit ? 'selected' : '' }}>
                                    {{ $item->unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 mb-5">
                    <div class="flex flex-col">
                        <label for="NIE">NIE Obat</label>
                        <input type="text" id="NIE" name="NIE" placeholder="NIE Obat" value="{{ $product->description->product_DPN }}">
                    </div>

                    <div class="flex flex-col">
                        <label for="pemasok">Pemasok Obat</label>
                        <select name="pemasok" id="pemasok">
                            @foreach ($suppliers as $item)
                                <option value="{{ $item->supplier_id }}" {{ $product->description->supplier->supplier == $item->supplier ? 'selected' : '' }}>
                                    {{ $item->supplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col mb-5">
                    <label for="produksi">Produksi dari</label>
                    <input type="text" id="produksi" name="produksi" placeholder="Produksi dari" value="{{ $product->description->product_manufacture }}">
                </div>

                <div class="grid grid-cols-2 mb-5">
                    <div class="flex flex-col">
                        <label for="deskripsi">Deskripsi Obat</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Obat">{{ $product->description->product_description }}</textarea>
                    </div>

                    <div class="flex flex-col">
                        <label for="efek_samping">Efek Samping Obat</label>
                        <textarea id="efek_samping" name="efek_samping" placeholder="Efek Samping Obat">{{ $product->description->product_sideEffect }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-2 mb-5">
                    <div class="flex flex-col">
                        <label for="dosis">Dosis Obat</label>
                        <textarea id="dosis" name="dosis" placeholder="Dosis Obat">{{ $product->description->product_dosage }}</textarea>
                    </div>

                    @if ($product->description->product_indication != NULL)
                        <div class="flex flex-col">
                            <label for="indikasi">Indikasi Umum Obat</label>
                            <textarea id="indikasi" name="indikasi" placeholder="Indikasi Umum Obat">{{ $product->description->product_indication }}</textarea>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 mb-5">
                    @if ($product->description->product_notice != NULL)
                        <div class="flex flex-col">
                            <label for="peringatan">Peringatan Obat</label>
                            <textarea id="peringatan" name="peringatan" placeholder="Peringatan Obat">{{ $product->description->product_notice }}</textarea>
                        </div>
                    @endif

                    <div class="upload-container" style="margin-left:80px;" >
                        <label for="gambar_obat" style="margin-right:80px;">Gambar Produk</label>
                        <div class="image-preview">
                            @if (file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) && $product->description->product_photo !== NULL)
                                <img src="{{ asset('storage/gambar-obat/'.$product->description->product_photo) }}" id="uploadedFile" alt="Current Image">
                            @else
                                <img src="{{ asset('img/obat1.jpg')}}" id="uploadedFile" alt="Current Image">
                            @endif
                        </div>

                        <input type="file" id="file2" name="gambar_obat" class="invisible" accept="image/*" onchange="showFile(this)">
                        <button id="file" onclick="document.getElementById('file2').click(); return false;" style="margin-left:60px;">
                            <i class="fa-solid fa-arrow-up-from-bracket" ></i> Upload Gambar Produk
                        </button> 
                        <p class="text-xs text-mediumRed mt-2" style="margin-left:70px;">*Maks 2 MB</p>
                    </div>
                </div>

                <div class="flex justify-right mt-8" style="margin-top:20px; margin-left:850px;">
                    <button type="submit" style="background-color: rgb(0, 245, 0)">Edit</button>
                </div>
            </form>
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
