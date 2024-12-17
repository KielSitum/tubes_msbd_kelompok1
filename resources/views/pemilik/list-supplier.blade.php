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
    @include('pemilik.components.sidebar')

    <main class="flex-grow p-8 font-Inter bg-white shadow-lg rounded-lg m-4" id="mainContent">
        @include('pemilik.components.navbar')

        <div class="mb-6">
            <h1 class="text-4xl font-bold text-mainColor">List Supplier</h1>
            <p class="text-gray-600">Kelola data supplier dengan mudah.</p>
        </div>

        @if (session('error'))
            @foreach (session('error') as $error)
                <div class="text-md text-mediumRed">{{ $error[0] }}</div>
            @endforeach
        @endif

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
            <button onclick="showTambahData()" class="px-6 h-12 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                <i class="fa-solid fa-plus pe-2"></i>
                Tambah Supplier
            </button>
        </div>

        {{-- MODAL TAMBAH SUPPLIER START --}}
        <div class="top-0 left-0 hidden flex justify-center items-center absolute z-10 backdrop-blur-sm backdrop-brightness-50 w-full h-full" id="tambahDataSupplier" style="position: fixed">
            <div class="w-full max-w-lg p-6 bg-gradient-to-tl from-indigo-600 to-blue-400 rounded-xl shadow-2xl">
                <div class="bg-white p-4 rounded-t-xl flex justify-between items-center text-gray-800 shadow-lg">
                    <span class="font-bold text-lg">Tambah Supplier</span>
                    <button onclick="showTambahData()" class="text-gray-700 text-xl">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-6 space-y-6 bg-white rounded-b-xl shadow-lg">
                    <form action="{{ route('add-supplier') }}" method="post">
                        @csrf
                        <div class="flex flex-col space-y-5">
                            <div class="flex flex-col space-y-2">
                                <label for="namaSupplier" class="text-sm font-medium text-gray-600">Nama Supplier</label>
                                <input type="text" name="nama_supplier" required value="{{ old('nama_supplier') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('nama_supplier') is-invalid @enderror">
                                @error(' nama_supplier')
                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="noTelpSupplier" class="text-sm font-medium text-gray-600">No Telp Supplier</label>
                                <input type="number" name="no_telp" required value="{{ old('no_telp') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('no_telp') is-invalid @enderror">
                                @error('no_telp')
                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="alamatSupplier" class="text-sm font-medium text-gray-600">Alamat Supplier</label>
                                <input type="text" name="alamat" required value="{{ old('alamat') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('alamat') is-invalid @enderror">
                                @error('alamat')
                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
                                Tambah Supplier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- MODAL TAMBAH SUPPLIER END --}}

        <div class="bg-gray-50 rounded-lg shadow p-6">
            <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-mainColor text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Supplier</th>
                        <th class="py-3 px-6 text-left">Nomor Telepon</th>
                        <th class="py-3 px-6 text-left">Alamat Supplier</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $i = 1;
                    $index = 1;
                    @endphp
                    @foreach ($suppliers as $item) 
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-6">{{$i}}</td>
                        <td class="py-3 px-6 font-bold">{{ $item->supplier }}</td>
                        <td class="py-3 px-6">{{ $item->supplier_phone }}</td>
                        <td class="py-3 px-6">{{ $item->supplier_address }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex">
                                <button onclick="showPopUpEdit({{ $index }})" class="p-2 bg-secondaryColor rounded mx-2"><i class="fa-regular fa-pen-to-square" style="color: white;"></i></button>
                                <button onclick="showPopUpDelete({{ $index }})" class="p-2 bg-mediumRed rounded mx-2"><i class="fa-regular fa-trash-can" style="color: white;"></i></button>
                            </div>

                            {{-- Pop up konfirmasi hapus start --}}
                            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="popupHapus{{ $index }}">
                                <div class="bg-white rounded-lg shadow-lg p-8 w-[400px]">
                                    <div class="text-center">
                                        <div class="bg-mainColor text-white rounded-full inline-block p-4">
                                            <i class="fa-solid fa-question fa-2xl"></i>
                                        </div>
                                        <p class="text-xl font-bold text-gray-800 mt-4">Konfirmasi Hapus</p>
                                        <p class="text-gray-600">Apakah Anda yakin ingin menghapus {{ $item->supplier }}?</p>
                                    </div>

                                    <div class="mt-6 flex justify-center gap-4">
                                        <button type="button" onclick="showPopUpDelete({{ $index }})" class="bg-gray-400 text-white py-2 px-6 rounded hover:bg-gray-500">Tidak</button>
                                        <form action="{{ route('delete-supplier', ['id' => $item->supplier_id]) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded hover:bg-red-600">Ya</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- Pop up konfirmasi hapus end --}}

                            {{-- MODAL EDIT SUPPLIER START --}}
                        <div class="top-0 left-0 hidden flex justify-center items-center absolute z-10 backdrop-blur-sm backdrop-brightness-50 w-full h-full" id="popupEdit{{ $index }}" style="position: fixed">
                            <div class="w-full max-w-lg p-6 bg-gradient-to-tl from-indigo-600 to-blue-400 rounded-xl shadow-2xl">
                                <div class="bg-white p-4 rounded-t-xl flex justify-between items-center text-gray-800 shadow-lg">
                                    <span class="font-bold text-lg">Edit Supplier</span>
                                    <button onclick="showPopUpEdit({{ $index }})" class="text-gray-700 text-xl">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <div class="p-6 space-y-6 bg-white rounded-b-xl shadow-lg">
                                    <form action="{{ route('edit-supplier', ['id' => $item->supplier_id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="flex flex-col space-y-5">
                                            <div class="flex flex-col space-y-2">
                                                <label for="namaSupplier" class="text-sm font-medium text-gray-600">Nama Supplier</label>
                                                <input type="text" name="nama_supplier" required value="{{ $item->supplier }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('nama_supplier') is-invalid @enderror" style="color: gray" readonly>
                                                @error('nama_supplier')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <label for="noTelpSupplier" class="text-sm font-medium text-gray-600">No Telp Supplier</label>
                                                <input type="number" name="no_telp" required value="{{ $item->supplier_phone }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('no_telp') is-invalid @enderror">
                                                @error('no_telp')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <label for="alamatSupplier" class="text-sm font-medium text-gray-600">Alamat Supplier</label>
                                                <input type="text" name="alamat" required value="{{ $item->supplier_address }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('alamat') is-invalid @enderror">
                                                @error('alamat')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
                                                Edit Supplier
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- MODAL EDIT SUPPLIER END --}}

                        </td>
                    </tr>
                    @php 
                    $i++;
                    $index++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

{{-- DATATABLES SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables.js') }}"></script>

<script>
    const showPopUpDelete = (index) => {
        const popup = document.getElementById('popupHapus' + index);
        popup.classList.toggle('hidden');
    }

    const showPopUpEdit = (index) => {
    const popup = document.getElementById('popupEdit' + index);  // Hilangkan spasi ekstra
    popup.classList.toggle('hidden');
}


    const showTambahData = () => {
        const tambahData = document.getElementById('tambahDataSupplier');
        tambahData.classList.toggle('hidden');
    }
</script>
</html>