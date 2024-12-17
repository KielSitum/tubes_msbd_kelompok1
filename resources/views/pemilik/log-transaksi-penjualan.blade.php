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
            <h1 class="text-4xl font-bold text-mainColor">Log Transaksi Penjualan</h1>
            <p class="text-gray-600">Kelola data transaksi penjualan dengan mudah.</p>
        </div>

        <div class="bg-gray-50 rounded-lg shadow p-6">
            <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-mainColor text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Pembeli</th>
                        <th class="py-3 px-6 text-left">Tanggal Transaksi</th>
                        <th class="py-3 px-6 text-left">Nomor Invoice</th>
                        <th class="py-3 px-6 text-left">Status Transaksi</th>
                        <th class="py-3 px-6 text-center">Detail Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($sellings as $index => $item)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-6">{{$i++}}</td>
                        <td class="py-3 px-6 font-bold">{{ $item->recipient_name }}</td>
                        @php
                            $carbonDate = \Carbon\Carbon::parse($item->order_complete);
                            $formattedDate = $carbonDate->format('j F Y');
                        @endphp
                        <td class="py-3 px-6">{{ $formattedDate }}</td>
                        <td class="py-3 px-6">{{ $item->invoice_code }}</td>
                        <td class="py-3 px-6">
                            <div class="w-full flex gap-2 items-center">
                                @if ($item->order_status == "Offline")
                                    <i class="text-green-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Offline</p>
                                @elseif($item->order_status == "Berhasil")
                                    <i class="text-green-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Berhasil</p>
                                @elseif($item->order_status == "Gagal")
                                    <i class="text-red-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Gagal</p>
                                @else
                                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">{{ $item->order_status }}</p>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <button class="p-2 bg-secondaryColor rounded mx-2" onclick="toggleDetail({{ $index }})">
                                <i class="fa-regular fa-eye" style="color: white;"></i>
                            </button>
 </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

            {{-- MODAL DETAIL TRANSAKSI PENJUALAN START --}}
@foreach ($sellings as $index => $item)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="detailModal{{ $index }}">
    <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto p-6 bg-white rounded-xl shadow-lg transition-transform transform scale-95 hover:scale-100">
        <div class="bg-gradient-to-tl from-indigo-600 to-blue-400 p-4 rounded-t-xl flex justify-between items-center text-white shadow-lg">
            <span class="font-bold text-lg">Detail Transaksi - {{ $item->invoice_code }}</span>
            <button onclick="toggleDetail({{ $index }})" class="text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div class="flex flex-col gap-2">
                <p class="font-bold">Nama Pembeli: <span class="font-normal">{{ $item->recipient_name }}</span></p>
                <p class="font-bold">Tanggal Transaksi: <span class="font-normal">{{ $item->order_complete }}</span></p>
                <p class="font-bold">Nomor Pembeli: <span class="font-normal">{{ $item->recipient_phone }}</span></p>
                <p class="font-bold">Nomor Invoice: <span class="font-normal">{{ $item->invoice_code }}</span></p>
            </div>

            <p class="font-bold">Status:</p>
            <div class="w-full flex gap-2 items-center">
                @if ($item->order_status == "Offline")
                    <i class="text-green-600 fa-solid fa-circle"></i>
                    <p class="font-bold">Offline</p>
                @elseif($item->order_status == "Berhasil")
                    <i class="text-green-600 fa-solid fa-circle"></i>
                    <p class="font-bold">Berhasil</p>
                @elseif($item->order_status == "Gagal")
                    <i class="text-red-600 fa-solid fa-circle"></i>
                    <p class="font-bold">Gagal</p>
                @else
                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                    <p class="font-bold">{{ $item->order_status }}</p>
                @endif
            </div>

            <p class="font-bold">Detail Pesanan:</p>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="text-left py-2 px-4">Nama Produk</th>
                        <th class="text-center py-2 px-4">Jumlah</th>
                        <th class="text-center py-2 px-4">Harga</th>
                        <th class="text-center py-2 px-4">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalHarga = 0;
                    @endphp
                    @foreach ($item->invoiceSellingDetail as $detail)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $detail->product_name }}</td>
                        <td class="text-center py-2 px-4">{{ $detail->quantity }}</td>
                        <td class="text-center py-2 px-4">Rp {{ number_format($detail->product_sell_price, 0, ',', '.') }}</td>
                        <td class="text-center py-2 px-4">Rp {{ number_format($detail->quantity * $detail->product_sell_price, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $totalHarga += $detail->quantity * $detail->product_sell_price;
                    @endphp
                    @endforeach
                </tbody>
            </table>

            {{-- Tampilkan Total Harga --}}
            <div class="mt-4 flex justify-end font-bold">
                <p>Total: <span class="text-xl">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span></p>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- MODAL DETAIL TRANSAKSI PENJUALAN END --}}


    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);
            modal.classList.toggle('hidden');
        }
    </script>
</body>

</html>