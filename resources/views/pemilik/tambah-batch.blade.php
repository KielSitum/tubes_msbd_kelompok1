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

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        textarea {
            min-height: 300px;
            resize: vertical;
        }

        .main-container {
            background-color: #f3f4f6;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            font-size: 1rem;
            color: #4b5563;
        }

        .input-field:focus {
            outline: none;
            border-color: #60a5fa;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: #4b5563;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #374151;
        }
    </style>
</head>

<body class="font-Trip bg-gray-100">
    <div class="main-container py-6">
        <div class="container mx-auto p-6">
            <div class="card p-8">
                {{-- Back Button --}}
                <a href="{{ url()->previous() }}" class="btn-back mb-4" style="background-color: rgb(0, 209, 0)">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Tambah Batch</h1>

                {{-- Form --}}
                <form action="{{ route('add-batch-process') }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                        $uuid = $product->product_id;
                        $detail_uuid = \Illuminate\Support\Str::uuid();
                    @endphp

                    <input type="hidden" name="id" value="{{ $uuid }}">
                    <input type="hidden" name="detail_id" value="{{ $detail_uuid }}">

                    <div class="flex flex-col justify-center items-center mb-4">
                        <h2 class="text-2xl font-semibold text-gray-700">{{ $product->product_name }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex-col w-full">
                            <label class="block text-lg font-semibold text-gray-700 mt-3">Nama Obat</label>
                            <input type="text" placeholder="Nama Obat" name="nama_obat" required 
                                class="input-field" value="{{ $product->product_name }}" readonly>

                            <label class="block text-lg font-semibold text-gray-700 mt-5">Harga Beli Obat</label>
                            <input type="text" placeholder="Harga Beli Obat" name="harga_beli" required
                                class="input-field" value="{{ old('harga_beli') }}">
                            @error('harga_beli')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex-col w-full">
                            <label class="block text-lg font-semibold text-gray-700 mt-3">Expired Obat</label>
                            <input type="date" placeholder="Expired Obat" name="expired_date" required
                                class="input-field" value="{{ old('expired_date') }}">
                            @error('expired_date')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror

                            <label class="block text-lg font-semibold text-gray-700 mt-5">Harga Jual Obat</label>
                            <input type="text" placeholder="Harga Jual Obat" name="harga_jual" required
                                class="input-field" value="{{ number_format($product->product_sell_price, 0, ',', '.') }}" readonly>
                            @error('harga_jual')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-col w-full">
                            <label class="block text-lg font-semibold text-gray-700 mt-5">Stok Obat</label>
                            <input type="text" placeholder="Stok Obat" name="stock" required
                                class="input-field" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-center mt-8">
                        <button type="submit" class="btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DATATABLES SCRIPT --}}
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