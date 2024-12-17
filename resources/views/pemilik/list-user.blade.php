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

            @if (session('add_status'))
                <div class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-500 text-white rounded-lg shadow-lg py-3 px-6 animate-bounce">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('add_status') }}
                </div>
            @elseif (session('error_status'))
                <div class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-red-500 text-white rounded-lg shadow-lg py-3 px-6 animate-bounce">
                    {{ session('error_status') }}
                </div>
            @endif

            <div class="mb-6">
                <h1 class="text-4xl font-bold text-mainColor">Daftar Pengguna</h1>
                <p class="text-gray-600">Kelola data pengguna dengan mudah.</p>
            </div>

            <div class="bg-gray-50 rounded-lg shadow p-6">
                <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-mainColor text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama User</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">No. Telepon</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $index = 1;
                        @endphp
                        @foreach ($user as $item)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">{{$i++}}</td>
                                <td class="py-3 px-6 font-bold">{{ $item->user->username }}</td>
                                <td class="py-3 px-6">{{ $item->user->email }}</td>
                                <td class="py-3 px-6">{{ $item->customer_phone }}</td>
                                <td class="py-3 px-6 text-center">
                                    <button onclick="showPopUpDelete({{ $index }})" class="bg-red-500 text-white py-2 px-4 rounded shadow hover:bg-red-600">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>

                                    {{-- Pop up konfirmasi hapus start --}}
                                    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="popup{{ $index }}">
                                        <div class="bg-white rounded-lg shadow-lg p-8 w-[400px]">
                                            <div class="text-center">
                                                <div class="bg-mainColor text-white rounded-full inline-block p-4">
                                                    <i class="fa-solid fa-question fa-2xl"></i>
                                                </div>
                                                <p class="text-xl font-bold text-gray-800 mt-4">Konfirmasi Hapus</p>
                                                <p class="text-gray-600">Apakah Anda yakin ingin menghapus {{ $item->user->username }}?</p>
                                            </div>

                                            <div class="mt-6 flex justify-center gap-4">
                                                <button type="button" onclick="showPopUpDelete({{ $index }})" class="bg-gray-400 text-white py-2 px-6 rounded hover:bg-gray-500">Tidak</button>
                                                <form action="{{ route('delete-user',['id'=> $item->customer_id]) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded hover:bg-red-600">Ya</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Pop up konfirmasi hapus end --}}
                                </td>
                            </tr>
                            @php
                                $index++;
                            @endphp
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
        const showPopUpDelete = (index) => {
            const popup = document.getElementById('popup' + index);
            popup.classList.toggle('hidden');
        }
    </script>
</body>

</html>
