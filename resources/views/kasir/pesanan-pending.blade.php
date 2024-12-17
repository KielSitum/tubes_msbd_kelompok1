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
                #mainContent {
            margin-left: 14%; /* Memberi ruang agar tidak tertimpa sidebar */
        }
    </style>
</head>
<body class="font-Inter relative">
    @include("kasir.components.sidebar")
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include("kasir.components.navbar")

        @if (session('success'))
            <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-circle-check"></i>
                <p class="text-lg text-white font-semibold"> {{ __('Status Berhasil Diperbaharui') }} </p>
            </div>
        @endif
        @if (session('error'))
            <div class="absolute top-4 left-[42.5vw] bg-red-600 shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-triangle-exclamation"></i>
                <p class="text-lg text-white font-semibold"> {{ __('Terjadi Kesalahan') }} </p>
            </div>
        @endif

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Pesanan Pending</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Nama Pengambil</th>
                            <th>Metode Pembayaran</th>
                            <th>Infomasi Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;  @endphp
                        @php $index = 1;  @endphp
                        @foreach ($pendingOrders as $pendingOrder)    
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                <span class="font-bold">{{$pendingOrder->invoice_code}}</span>
                            </td>
                            <td>{{ $pendingOrder->recipient_name }}</td>
                            <td>{{ $pendingOrder->recipient_bank }}</td>
                            <td>
                                <a href="/cashier/informasi_pembayaran/{{ $pendingOrder->recipient_payment }}" target="_blank" class="underline">{{ $pendingOrder->recipient_payment }}</a>
                            </td>
                            <td>
                                {{-- stored function?? --}}
                                @php
                                // Konversi order_date menjadi objek Carbon
                                    $orderDate = \Carbon\Carbon::parse($pendingOrder->order_date);
                                // Mendapatkan waktu sekarang dan order_date + 3 hari
                                    $now = now();
                                    $deadline = $orderDate->addDays(3);
                                    // @dd($now->diffAsCarbonInterval($deadline));
                            
                                // Menghitung selisih waktu dalam bentuk CarbonInterval
                                    $difference = $now->diffAsCarbonInterval($deadline);
                            
                                // Mengambil informasi selisih waktu dalam bentuk hari, jam, dan menit
                                    $days = max($difference->format('%d'), 0); // Menggunakan fungsi max untuk memastikan nilai minimal adalah 0
                                    $hours = $difference->format('%h');
                                    $minutes = $difference->format('%i');
                                @endphp
                                @if($now->gt($deadline))
                                    <p>Masa Pengambilan Telah Lewat</p>
                                @else
                                    <p>Sisa {{ $days }} hari, {{ $hours }} jam, {{ $minutes }} menit</p>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" 
                                    type="button" onclick="toggleDetail({{ $index }})" data-index="{{ $index }}">Lihat</button>
                                </div>

                                {{-- MODAL DETAIL PESANAN PENDING START --}}
<div class="absolute  top-0 left-0 flex justify-center items-center  z-10 hidden" id="detailModal{{ $index }}" style="margin-left:550px; margin-top:150px;" >
    <div class="w-[100%] md:w-[100%] lg:w-[100%] h-fit max-h-full bg-gradient-to-t from-indigo-900 to-indigo-800 rounded-3xl shadow-2xl p-8 flex flex-col gap-6 overflow-auto">
        
        <!-- Kembali Button -->
        <div class="mb-6 flex justify-between items-center">
            <button onclick="toggleDetail({{ $index }})" type="button" class="bg-indigo-600 hover:bg-indigo-500 py-2 px-6 text-white font-semibold rounded-full shadow-xl transition-all duration-300 hover:scale-105 transform">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </button>
            <p class="font-bold text-2xl text-white">{{ $pendingOrder->invoice_code }}</p>
            <div class="flex gap-2 items-center">
                {{-- Status Indicator --}}
                @if ($pendingOrder->order_status == 'Pending')
                    <i class="text-yellow-400 fa-solid fa-circle"></i>
                @endif
                <p class="font-bold text-lg text-white">{{ $pendingOrder->order_status }}</p>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="w-full bg-white rounded-2xl shadow-lg p-6 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-900">
                        <thead>
                            <tr class="border-b-2 border-indigo-600 text-indigo-600">
                                <th class="py-2 text-center font-semibold">No</th>
                                <th class="py-2 text-left font-semibold">Nama</th>
                                <th class="py-2 text-center font-semibold">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $j = 1; @endphp
                            @foreach($pendingOrder->invoiceSellingDetail as $detail)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 text-center">{{ $j }}</td>
                                <td class="py-2">{{ $detail->product_name }}</td>
                                <td class="py-2 text-center">{{ $detail->quantity }}</td>
                                
                            </tr>
                            @php $j++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Keterangan & Catatan -->
            <div class="w-full bg-gradient-to-b from-indigo-600 to-indigo-700 text-white rounded-2xl shadow-lg p-6">
                <p class="text-center font-bold text-2xl pb-4">Keterangan</p>
                <hr class="border-2 border-transparent border-b-mainColor mb-4">
                <div class="space-y-3">
                    <div>
                        <p class="font-semibold">Pelanggan:</p>
                        <p>{{ $pendingOrder->recipient_name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Nomor HP:</p>
                        <p>{{ $pendingOrder->recipient_phone }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Catatan:</p>
                        <p>{{ $pendingOrder->recipient_request }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi: Tandai Selesai / Tandai Gagal -->
        <div class="flex justify-end mt-6">
            @if($now->gt($deadline))
                <form action="{{ route('failOrder', $pendingOrder->selling_invoice_id) }}" method="get">
                    <button class="bg-red-600 text-white font-bold py-2 px-6 rounded-md shadow-md">Tandai Gagal</button>
                </form>
            @else
                <form action="{{ route('successOrder', $pendingOrder->selling_invoice_id) }}" method="get">
                    <button class="bg-green-600 text-white font-bold py-2 px-6 rounded-md shadow-md">Tandai Selesai</button>
                </form>
            @endif
        </div>
    </div>
</div>
{{-- MODAL DETAIL PESANAN PENDING END --}}

                            </td>
                        </tr>
                        @php  $i++   @endphp
                        @php  $index++   @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.classList.add('h-[100vh]');
            } else {
                modal.classList.add('hidden');
                document.body.classList.remove('h-[100vh]');
            }
        };
    </script>
</body>
</html>