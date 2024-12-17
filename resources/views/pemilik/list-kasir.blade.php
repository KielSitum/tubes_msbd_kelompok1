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
                <h1 class="text-4xl font-bold text-mainColor">List Kasir</h1>
                <p class="text-gray-600">Kelola data kasir dengan mudah.</p>
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
                <button onclick="showPopUpTambah()" class="px-6 h-12 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                    <i class="fa-solid fa-plus pe-2"></i>
                    Tambah Kasir
                </button>
            </div>

            {{-- MODAL TAMBAH KASIR START --}}
            <div class="top-0 left-0 hidden flex justify-center items-center absolute z-10 backdrop-blur-sm backdrop-brightness-50 w-full h-full" id="popupTambah" style="position: fixed"  >
                <div class="w-full max-w-lg p-6 bg-gradient-to-tl from-indigo-600 to-blue-400 rounded-xl shadow-2xl">
                    <!-- Header -->
                    <div class="bg-white p-4 rounded-t-xl flex justify-between items-center text-gray-800 shadow-lg">
                        <span class="font-bold text-lg">Tambah Kasir</span>
                        <button onclick="showPopUpTambah()" class="text-gray-700 text-xl">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 space-y-6 bg-white rounded-b-xl shadow-lg">
                        <form action="{{ route('tambah-kasir') }}" method="post">
                            @csrf
                            <!-- Form Fields -->
                            <div class="space-y-5">
                                <div class="flex flex-col space-y-2">
                                    <label for="username" class="text-sm font-medium text-gray-600">Nama User</label>
                                    <input type="text" name="username" required value="{{ old('username') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('username') is-invalid @enderror">
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <label for="email" class="text-sm font-medium text-gray-600">Email</label>
                                    <input type="email" name="email" required value="{{ old('email') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <label for="password" class="text-sm font-medium text-gray-600">Password</label>
                                    <input type="password" name="password" required value="{{ old('password') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <label for="gender" class="text-sm font-medium text-gray-600">Gender</label>
                                    <select name="gender" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                                        <option value="pria">Pria</option>
                                        <option value="wanita">Wanita</option>
                                    </select>
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <label for="nohp" class="text-sm font-medium text-gray-600">No. Handphone</label>
                                    <input type="number" name="nohp" value="{{ old('nohp') }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('nohp') is-invalid @enderror">
                                    @error('nohp')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <label for="address" class="text-sm font-medium text-gray-600">Alamat</label>
                                    <textarea name="address" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
                                    Tambah Kasir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- MODAL TAMBAH KASIR END --}}


            <div class="bg-gray-50 rounded-lg shadow p-6">
                <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-mainColor text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama User</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Gender</th>
                            <th class="py-3 px-6 text-left">No. Handphone</th>
                            <th class="py-3 px-6 text-left">Alamat</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $i = 1;
                        $index = 1;
                        @endphp
                        @foreach ($cashiers as $cashier) 
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-6">{{$i}}</td>
                            <td class="py-3 px-6 font-bold">{{ $cashier->username }}</td>
                            <td class="py-3 px-6">{{ $cashier->email }}</td>
                            <td class="py-3 px-6">{{ $cashier->cashier->cashier_gender }}</td>
                            <td class="py-3 px-6">{{ $cashier->cashier->cashier_phone }}</td>
                            <td class="py-3 px-6">{{ $cashier->cashier->cashier_address }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex">
                                    <button onclick="showPopUpEdit({{ $index }})" class="p-2 bg-secondaryColor rounded mx-2 "><i class="fa-regular fa-pen-to-square" style="color: white;"></i></button>
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
                                            <p class="text-gray-600">Apakah Anda yakin ingin menghapus {{ $cashier->username }}?</p>
                                        </div>

                                        <div class="mt-6 flex justify-center gap-4">
                                            <button type="button" onclick="showPopUpDelete({{ $index }})" class="bg-gray-400 text-white py-2 px-6 rounded hover:bg-gray-500">Tidak</button>
                                            <form action="{{ route('delete-kasir') }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{ $cashier->cashier->user_id }}">
                                                <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded hover:bg-red-600">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Pop up konfirmasi hapus end --}}

                               {{-- MODAL EDIT KASIR START --}}
                        <div class="top-0 left-0 hidden flex justify-center items-center absolute z-10 backdrop-blur-sm backdrop-brightness-50 w-full h-full" id="popupEdit{{ $index }}" style="position: fixed">
                            <div class="w-full max-w-lg p-6 bg-gradient-to-tl from-indigo-600 to-blue-400 rounded-xl shadow-2xl">
                                <!-- Header -->
                                <div class="bg-white p-4 rounded-t-xl flex justify-between items-center text-gray-800 shadow-lg">
                                    <span class="font-bold text-lg">Edit Kasir</span>
                                    <button onclick="showPopUpEdit({{ $index }})" class="text-gray-700 text-xl">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <!-- Form Content -->
                                <div class="p-6 space-y-6 bg-white rounded-b-xl shadow-lg">
                                    <form action="{{ route('edit-kasir', ['id' => $cashier->cashier->cashier_id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <!-- Form Fields -->
                                        <div class="space-y-5">
                                            <div class="flex flex-col space-y-2">
                                                <label for="username" class="text-sm font-medium text-gray-600">Nama User</label>
                                                <input type="text" value="{{ $cashier->username }}" readonly class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm text-slate-400">
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <label for="email" class="text-sm font-medium text-gray-600">Email</label>
                                                <input type="email" name="email" value="{{ $cashier->email }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm text-slate-400 @error('email') is-invalid @enderror" readonly>
                                                @error('email')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <label for="gender" class="text-sm font-medium text-gray-600">Gender</label>
                                                <select class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" name="gender">
                                                    <option value="pria" {{ $cashier->cashier->cashier_gender == 'pria' ? 'selected' : '' }}>Pria</option>
                                                    <option value="wanita" {{ $cashier->cashier->cashier_gender == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                                </select>
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <label for="nohp" class="text-sm font-medium text-gray-600">No. Handphone</label>
                                                <input type="text" name="nohp" value="{{ $cashier->cashier->cashier_phone }}" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <label for="address" class="text-sm font-medium text-gray-600">Alamat</label>
                                                <textarea name="address" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm h-28 @error('address') is-invalid @enderror">{{ $cashier->cashier->cashier_address }}</textarea>
                                                @error('address')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mt-6 flex justify-end">
                                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
                                                Edit Kasir
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- MODAL EDIT KASIR END --}}
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
    </div>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const showPopUpDelete = (index) => {
            const popup = document.getElementById('popupHapus' + index);
            popup.classList.toggle('hidden');
        }

        const showPopUpEdit = (index) => {
            const popup = document.getElementById('popupEdit' + index);
            popup.classList.toggle('hidden');
        }

        const showPopUpTambah = () => {
            const popup = document.getElementById('popupTambah');
            popup.classList.toggle('hidden');
        }
    </script>
</body>

</html>