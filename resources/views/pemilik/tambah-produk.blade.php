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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.2rem;
            border-radius: 50px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 1.2rem;
            text-decoration: none;
        }

        .back-button i {
            margin-right: 8px;
        }

        .heading {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 1rem;
            color: #555;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-group .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
        }

        .submit-button {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: #4CAF50;
            color: #fff;
            font-size: 1.2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        .image-preview {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }

        .upload-button {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #007BFF;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-button i {
            font-size: 1.5rem;
        }

        .upload-button span {
            font-size: 1rem;
        }

        .input-file {
            display: none;
        }

    </style>
</head>

<body>

    <div class="container" style="margin-top:30px; margin-bottom:30px;">

        {{-- Back Button --}}
        <a href="/owner/produk" class="back-button" style="width: 12%; margin-bottom: 20px;">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

        {{-- Title --}}
        <p class="heading">Tambah Produk</p>

        {{-- Form --}}
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Column 1 --}}
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" id="nama_obat" placeholder="Nama Obat" name="nama_obat" required class="form-control @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat') }}">
                    @error('nama_obat')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori Obat</label>
                    <select name="kategori" id="kategori" required class="form-control">
                        <option disabled selected>Kategori Obat</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->category_id }}">{{ $item->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli Obat</label>
                    <input type="text" id="harga_beli" placeholder="Harga Beli Obat" name="harga_beli" required class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli') }}">
                    @error('harga_beli')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Column 2 --}}
                <div class="form-group">
                    <label for="expired_date">Expired Obat</label>
                    <input type="date" id="expired_date" placeholder="Expired Obat" name="expired_date" required class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}">
                    @error('expired_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="golongan">Golongan Obat</label>
                    <select name="golongan" id="golongan" required class="form-control">
                        <option disabled selected>Golongan Obat</option>
                        @foreach ($groups as $item)
                            <option value="{{ $item->group_id }}">{{ $item->group }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_jual">Harga Jual Obat</label>
                    <input type="text" id="harga_jual" placeholder="Harga Jual Obat" name="harga_jual" required class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}">
                    @error('harga_jual')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Description and Additional Details --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Obat</label>
                    <textarea id="deskripsi" placeholder="Deskripsi Obat" name="deskripsi" required class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="efek_samping">Efek Samping Obat</label>
                    <textarea id="efek_samping" placeholder="Efek Samping Obat" name="efek_samping" required class="form-control @error('efek_samping') is-invalid @enderror">{{ old('efek_samping') }}</textarea>
                    @error('efek_samping')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Additional Details --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="form-group">
                    <label for="dosis">Dosis Obat</label>
                    <textarea id="dosis" placeholder="Dosis Obat" name="dosis" required class="form-control @error('dosis') is-invalid @enderror">{{ old('dosis') }}</textarea>
                    @error('dosis')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="indikasi">Indikasi Umum Obat</label>
                    <textarea id="indikasi" placeholder="Indikasi Umum Obat" name="indikasi" class="form-control">{{ old('indikasi') }}</textarea>
                    @error('indikasi')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Image Upload --}}
            <div class="form-group">
                <label for="gambar_obat">Upload Gambar Obat</label>
                <div class="upload-button" onclick="document.getElementById('file2').click(); return false;">
                    <i class="fa-solid fa-upload"></i>
                    <span>Upload</span>
                </div>
                <input type="file" name="gambar_obat" id="file2" class="input-file" accept="image/*" onchange="showFile(this)" required>
                <img id="uploadedFile" class="image-preview mt-4" src="" alt="Preview" />
                <p class="text-xs text-mediumRed mt-2">* Maks 2MB</p>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="submit-button">Tambah</button>
        </form>

    </div>

    {{-- Image Preview --}}
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

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

</body>
</html>
