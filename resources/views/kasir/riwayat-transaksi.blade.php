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

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Riwayat Transaksi</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                <span class="text-center"> No. </span>
                            </th>
                            <th>Nomor Invoice</th>
                            <th>Nama Penerima</th>
                            <th>Waktu Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;  @endphp
                        @php $index = 1;  @endphp
                        @foreach ($histories as $history)               
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <span class="font-bold">{{ $history->invoice_code }}</span>
                            </td>
                            <td>{{$history->recipient_name}}</td>
                            <td>{{ date('d M Y',strtotime($history->order_complete)) }}</td>
                                @php
                                    $totalPrice = 0; // Initialize the variable to store the total price
                                @endphp
                                @foreach ($history->invoiceSellingDetail as $invoice)
                                    @php
                                    $totalPrice = $totalPrice + ($invoice->product_sell_price * $invoice->quantity); // Accumulate the price
                                    @endphp
                                @endforeach
                            <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            <td>
                                <div class="w-full flex gap-2 items-center">
                                    {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                    @if ( $history->order_status == 'Berhasil' || $history->order_status == 'Offline')
                                        <i class="text-green-600 fa-solid fa-circle"></i>
                                    @elseif ($history->order_status == 'Refund')
                                        <i class="text-yellow-600 fa-solid fa-circle"></i>
                                    @elseif ($history->order_status == 'Gagal')
                                        <i class="text-red-600 fa-solid fa-circle"></i>
                                    @endif
                                    <p class="font-bold">
                                        {{ $history->order_status }}
                                        {{-- @if ($history->order_status == 'Berhasil')
                                            {{ 'Online' }}
                                        @else {{ $history->order_status }}
                                        @endif --}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out"
                                    type="button" onclick="toggleDetail({{ $index }})" data-index="{{ $index }}">Lihat</button>
                                </div>
                             @php $i++; @endphp

                               {{-- MODAL DETAIL RIWAYAT TRANSAKSI START --}}
                               <div class="fixed inset-0 flex justify-center items-center backdrop-blur-md z-10 hidden" id="detailModal{{ $index }}" style="margin-left:180px;">
                                <div class="w-[90%] md:w-[75%] lg:w-[60%] h-fit max-h-full bg-gradient-to-t from-indigo-900 to-indigo-800 rounded-3xl shadow-2xl p-8 flex flex-col gap-6 overflow-auto">
                                    <div class="flex justify-between items-center mb-6">
                                        <button onclick="toggleDetail({{ $index }})" type="button" class="bg-indigo-600 hover:bg-indigo-500 py-2 px-6 text-white font-semibold rounded-full shadow-xl transition-all duration-300 hover:scale-105 transform">
                                            <i class="fa-solid fa-arrow-left"></i> Kembali
                                        </button>
                                        <p class="font-bold text-2xl text-white">{{ $history->invoice_code }}</p>
                                        <div class="flex gap-2 items-center">
                                            {{-- Status Indicator --}}
                                            @if ($history->order_status == 'Berhasil' || $history->order_status == 'Offline')
                                                <i class="text-green-400 fa-solid fa-circle"></i>
                                            @elseif ($history->order_status == 'Refund')
                                                <i class="text-yellow-400 fa-solid fa-circle"></i>
                                            @elseif ($history->order_status == 'Gagal')
                                                <i class="text-red-400 fa-solid fa-circle"></i>
                                            @endif
                                            <p class="font-bold text-lg text-white">{{ $history->order_status }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                        <div class="w-full bg-white rounded-2xl shadow-lg p-6 overflow-hidden">
                                            <div class="overflow-x-auto">
                                                <table class="w-full text-sm text-gray-900">
                                                    <thead>
                                                        <tr class="border-b-2 border-indigo-600 text-indigo-600">
                                                            <th class="py-2 text-center font-semibold">No</th>
                                                            <th class="py-2 text-left font-semibold">Nama</th>
                                                            <th class="py-2 text-center font-semibold">Jumlah</th>
                                                            <th class="py-2 text-center font-semibold">Harga</th>
                                                            <th class="py-2 text-left font-semibold">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $j = 1; @endphp
                                                        @foreach($history->invoiceSellingDetail as $invoice)
                                                        <tr class="border-b border-gray-200">
                                                            <td class="py-2 text-center">{{ $j }}</td>
                                                            <td class="py-2">{{ $invoice->product_name }}</td>
                                                            <td class="py-2 text-center">{{ $invoice->quantity }}</td>
                                                            <td class="py-2 text-center">Rp {{ number_format($invoice->product_sell_price, 0, ',', '.') }}</td>
                                                            <td class="py-2">Rp {{ number_format($invoice->quantity * $invoice->product_sell_price, 0, ',', '.') }}</td>
                                                        </tr>
                                                        @php $j++ @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-4">
                                                <hr class="border-t-2 border-indigo-500 mb-4">
                                                <div class="flex justify-between font-semibold text-indigo-600">
                                                    <span>Total Harga</span>
                                                    <span class="text-indigo-500">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between font-semibold text-indigo-600">
                                                    <span>Kasir</span>
                                                    <span class="text-indigo-500">{{ $history->cashier_name }}</span>
                                                </div>
                                                @if($history->order_status == 'Gagal')
                                                <div class="flex justify-between font-semibold text-indigo-600 mt-4">
                                                    <span>Alasan Gagal</span>
                                                    <span class="text-indigo-500">{{ $history->reject_comment }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="w-full bg-gradient-to-b from-indigo-600 to-indigo-700 text-white rounded-2xl shadow-lg p-6">
                                            <p class="text-center font-bold text-2xl pb-4">Keterangan</p>
                                            <hr class="border-2 border-transparent border-b-mainColor mb-4">
                                            <div class="space-y-3">
                                                <div>
                                                    <p class="font-semibold">Pelanggan:</p>
                                                    <p>{{ $history->recipient_name }}</p>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">Nomor HP:</p>
                                                    <p>{{ $history->recipient_phone }}</p>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">Tanggal Selesai:</p>
                                                    <p>{{ date('d M Y', strtotime($history->order_complete)) }}</p>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">Metode Pembayaran:</p>
                                                    <p>{{ $history->recipient_bank }}</p>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">Bukti Pembayaran:</p>
                                                    <a href="/cashier/informasi_pembayaran/{{ $history->recipient_payment }}" target="_blank" class="text-indigo-200 underline">{{ $history->recipient_payment }}</a>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">Catatan:</p>
                                                    <p>{{ $history->recipient_request }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- MODAL DETAIL RIWAYAT TRANSAKSI END --}}
                            </td>
                        </tr>
                        @php $index++ @endphp
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
            } else {
                modal.classList.add('hidden');
            }
        };
    </script>
</body>
</html>