<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Tambah Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        .upload-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .upload-button:hover {
            background-color: #0056b3;
        }

        .upload-info {
            color: #6c757d;
            font-size: 0.8rem;
        }

        .image-preview {
            max-width: 200px;
            max-height: 170px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="/owner/produk" class="back-button">
                <i class=" fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h1 class="form-title" style="margin-right:400px;">Tambah Produk</h1>
        </div>

        <div class="form-container">
            <form action="{{ route('add-product-process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @php
                    $uuid = \Illuminate\Support\Str::uuid();
                    $desc_uuid = \Illuminate\Support\Str::uuid();
                    $detail_uuid = \Illuminate\Support\Str::uuid();
                @endphp

                <input type="hidden" name="id" value="{{ $uuid }}">
                <input type="hidden" name="desc_id" value="{{ $desc_uuid }}">
                <input type="hidden" name="detail_id" value="{{ $detail_uuid }}">
                <input type="hidden" name="status" value="aktif">

                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" id="nama_obat" name="nama_obat" placeholder="Nama Obat" required 
                        class="@error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat') }}">
                    @error('nama_obat')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori Obat</label>
                    <select name="kategori" id="kategori" required>
                        <option disabled selected>Kategori Obat</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->category_id }}">{{ $item->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli Obat</label>
                    <input type="text" id="harga_beli" name="harga_beli" placeholder="Harga Beli Obat" required 
                        class="@error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli') }}">
                    @error('harga_beli')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="expired_date">Expired Obat</label>
                    <input type="date" id="expired_date" name="expired_date" required 
                        class="@error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}">
                    @error('expired_date')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="golongan">Golongan Obat</label>
                    <select name="golongan" id="golongan" required>
                        <option disabled selected>Golongan Obat</option>
                        @foreach ($groups as $item)
                            <option value="{{ $item->group_id }}">{{ $item->group }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_jual">Harga Jual Obat</label>
                    <input type="text" id="harga_jual" name="harga_jual" placeholder="Harga Jual Obat" required 
                        class="@error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}">
                    @error('harga_jual')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stok Obat</label>
                    <input type="text" id="stock" name="stock" placeholder="Stok Obat" required 
                        class="@error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                    @error('stock')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan_obat">Satuan Obat</label>
                    <select name="satuan_obat" id="satuan_obat" required>
                        <option disabled selected>Satuan Obat</option>
                        @foreach ($units as $item)
                            <option value="{{ $item->unit_id }}">{{ $item->unit }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="NIE">NIE Obat</label>
                    <input type="text" id="NIE" name="NIE" placeholder="NIE Obat" required class="@error('NIE') is-invalid @enderror" value="{{ old('NIE') }}">
                    @error('NIE')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pemasok">Pemasok Obat</label>
                    <select name="pemasok" id="pemasok" required>
                        <option disabled selected>Pemasok Obat</option>
                        @foreach ($suppliers as $item)
                            <option value="{{ $item->supplier_id }}">{{ $item->supplier }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="produksi">Produksi dari</label>
                    <input type="text" id="produksi" name="produksi" placeholder="Produksi dari" required 
                        class="@error('produksi') is-invalid @enderror" value="{{ old('produksi') }}">
                    @error('produksi')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Obat</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Obat" required 
                        class="@error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="efek_samping">Efek Samping Obat</label>
                    <textarea id="efek_samping" name="efek_samping" placeholder="Efek Samping Obat" required 
                        class="@error('efek_samping') is-invalid @enderror">{{ old('efek_samping') }}</textarea>
                    @error('efek_samping')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dosis">Dosis Obat</label>
                    <textarea id="dosis" name="dosis" placeholder="Dosis Obat" required 
                        class="@error('dosis') is-invalid @enderror">{{ old('dosis') }}</textarea>
                    @error('dosis')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="indikasi">Indikasi Umum Obat</label>
                    <textarea id="indikasi" name="indikasi" placeholder="Indikasi Umum Obat" 
                        class="@error('indikasi') is-invalid @enderror">{{ old('indikasi') }}</textarea>
                    @error('indikasi')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="peringatan">Peringatan Obat</label>
                    <textarea id="peringatan" name="peringatan" placeholder="Peringatan Obat" 
                        class="@error('peringatan') is-invalid @enderror">{{ old('peringatan') }}</textarea>
                    @error('peringatan')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar_obat">Upload Gambar Produk</label>
                    <div class="upload-button" onclick="document.getElementById('file2').click(); return false;">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span>Upload Gambar Produk</span>
                    </div>
                    <input type="file" name="gambar_obat" id="file2" class="invisible @error('gambar_obat') is-invalid @enderror" accept="image/*" onchange="showFile(this)" required>
                    <p class="upload-info">*Maks 2MB</p>
                    <img src="" alt="" id="uploadedFile" class="image-preview">
                </div>

                <div class="flex justify-center mt-8">
                    <button type="submit" class="submit-button">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

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