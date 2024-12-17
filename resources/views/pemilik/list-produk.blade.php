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
</head>

<body class="font-Inter bg-gray-100">
    <div class="flex">
        @include('pemilik.components.sidebar')

        <main class="flex-grow p-8 font-Inter bg-white shadow-lg rounded-lg m-4" id="mainContent">
            @include('pemilik.components.navbar')

            <div class="mb-6">
                <h1 class="text-4xl font-bold text-mainColor">List Produk</h1>
                <p class="text-gray-600">Kelola data produk dengan mudah.</p>
            </div>

            @if (session('add_status'))
                <div class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-500 text-white rounded-lg shadow-lg py-3 px-6 animate-bounce">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('add_status') }}
                </div>
            @elseif (session('error_status'))
                <div class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-red-500 text-white rounded-lg shadow-lg py-3 px-6 animate-bounce">
                    {{ session('error_status') }}
                </div>
            @endif

            <div class="flex justify-between mb-4">
                <a href="{{ route('add-product') }}" class="px-6 h-12 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                    <i class="fa-solid fa-plus pe-2"></i>
                    Tambah Produk
                </a>
            </div>

            <div class="bg-gray-50 rounded-lg shadow p-6">
                <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-mainColor text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Produk</th>
                            <th class="py-3 px-6 text-left">Stok</th>
                            <th class="py-3 px-6 text-left">Tanggal Expired</th>
                            <th class="py-3 px-6 text-left">Status Obat</th>
                            <th class="py-3 px-6 text-center">Detail Obat</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($product as $item)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $i++ }}</td>
                                <td class="py-3 px-6 font-bold">{{ $item->product_name }}</td>
                                @php
                                    $carbonDate = \Carbon\Carbon::parse($item->detail()->where('product_stock', '>', 0)->orderBy('product_expired')->first()->product_expired);
                                    $formattedDate = $carbonDate->format('j F Y');
                                @endphp
                                <td class="py-3 px-6">{{ $item->detail->sum('product_stock') }}</td>
                                <td class="py-3 px-6">{{ $formattedDate }}</td>
                                <td class="py-3 px-6">{{ $item->product_status }}</td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('product-detail',['id'=> $item->product_id]) }}"
                                       class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text -secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out">
                                        Lihat
                                    </a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('product-edit',['id'=> $item->product_id]) }}" class="p-2 bg-secondaryColor rounded mx-2"><i
                                        class="fa-regular fa-pen-to-square" style="color: white;"></i></a>
                                    <a href="{{ route('add-product-batch',['id'=> $item->product_id]) }}" class="p-2 bg-green-700 rounded mx-2"><i
                                        class="fa-solid fa-plus" style="color: white;"></i></a>
                                </td>
                            </tr>
                        @endforeach            
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const showPopUpDelete = () => {
            const popup = document.getElementById('popup');
            popup.classList.toggle('hidden');
        }

        const toggleDetail = () => {
            const modal = document.getElementById('detailModal');
            modal.classList.toggle('hidden');
            document.body.classList.toggle('h-[100vh]');
        }
    </script>
</body>
</html>