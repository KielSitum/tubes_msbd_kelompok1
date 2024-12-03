<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    @vite('resources/css/app.css')

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        /* Custom Styling for the Table */
        table {
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background: linear-gradient(to right, #4e73df, #1cc88a);
            color: white;
            text-align: center;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
        }

        th {
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }

        tbody tr {
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        tbody tr:hover {
            background-color: hsl(210, 40%, 96%);
        }

        tfoot {
            background-color: #4e73df;
            color: white;
        }

        .table-header {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
        }

        .total-price {
            font-weight: bold;
            font-size: 18px;
            color: #4e73df;
            text-align: center;
        }

        /* Styling for table rows */
        tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }

        tbody tr:nth-child(even) {
            background-color: #f1f5f9;
        }

        /* Styling for hover effect */
        tbody tr:hover {
            background-color: #6b6b6b;
            transform: scale(1.02);
        }

        /* Custom container styles */
        .info-container {
            background-color: #86868645;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 32px;
        }

        .info-container h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 16px;
        }

        .info-container p {
            font-size: 1rem;
            color: #4a5568;
        }

        .info-container .additional-notes {
            background-color: #f7fafc;
            padding: 6px;
            border-radius: 8px;
            margin-top: 16px;
            color: #2d3748;
        }
        
        .table-container {
            background-color: #74747476;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-top: 32px;
        }

        .table-container table th, 
        .table-container table td {
        width: 5%; /* Equal width for all columns */
        text-align: center; /* Center the content for alignment */
    }

    /* Status badge styling */
    .status-badge {
            padding: 8px 16px;
            border-radius: 24px;
            font-weight: 600;
            color: white;
            text-align: center;
        }

        .status-success {
            background-color: #38a169;
        }

        .status-warning {
            background-color: #f59e0b;
        }

        .status-danger {
            background-color: #e53e3e;
        }

        .status-info {
            background-color: #3182ce;
        }

        .status-link {
            text-decoration: none;
            color: #3182ce;
            font-weight: 600;
            display: inline-block;
            margin-left: 10px;
            transition: color 0.3s ease;
        }

        .status-link:hover {
            color: #2b6cb0;
        }


    </style>
</head>

<body class="bg-gray-50 font-Inter text-gray-800">
    
    @include('user.components.navbar')

    <div class="container mx-auto py-8 px-4" style="margin-top:60px;">
        <div class="flex justify-between items-center mb-8">
            <a href="/riwayat-pesanan" class="flex items-center text-lg font-semibold text-blue-600 hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 14l-4 -4l4 -4"></path>
                    <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                </svg>
                Kembali
            </a>
            <p class="text-2xl font-semibold">Detail Pesanan - {{ $purcase->invoice_code }}</p>
        </div>       
        <div class="info-container" style="background-color: #f9fafb; border-radius: 12px; padding: 24px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); margin-bottom: 32px; border-left: 6px solid #4e73df;">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #2d3748; margin-bottom: 16px; text-align: center; border-bottom: 2px solid #4e73df; padding-bottom: 8px;">Informasi Pesanan</h3>
            <div class="grid" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 16px;">
                <div style="background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <p style="font-size: 1rem; color: #4a5568; margin-bottom: 12px;">Nama Penerima: <span style="font-weight: 600; color: #2d3748;">{{ $purcase->recipient_name }}</span></p>
                    <p style="font-size: 1rem; color: #4a5568; margin-bottom: 12px;">Batas Pengambilan: <span style="font-weight: 600; color: #2d3748;">{{ date('d M Y', strtotime($purcase->order_date . ' + 3 days')) }}</span></p>
                    <p style="font-size: 1rem; color: #4a5568; margin-bottom: 12px;">Tanggal Pengambilan: <span style="font-weight: 600; color: #2d3748;">{{ $purcase->order_complete ? date('d M Y', strtotime($purcase->order_complete)) : "-" }}</span></p>
                    <p style="font-size: 1rem; color: #4a5568; margin-bottom: 12px;">Tanggal Pemesanan: <span style="font-weight: 600; color: #2d3748;">{{ date('d M Y', strtotime($purcase->order_date)) }}</span></p>
                    <p style="font-size: 1rem; color: #4a5568; margin-bottom: 12px;">No. Handphone: <span style="font-weight: 600; color: #2d3748;">{{ $purcase->recipient_phone }}</span></p>
                        @if ($purcase->recipient_file)
                            <a href="/resep_dokter/{{ $purcase->recipient_file }}/{{ $purcase->selling_invoice_id }}" target="_blank" style="color: #4e73df; text-decoration: none; font-weight: bold; transition: color 0.3s ease;">
                                {{ $purcase->recipient_file }}
                            </a>
                        @endif
                    </p>
                </div>
                    
                <div style="background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <p style="font-size: 1rem; color: #4a5568; margin-bottom: 12px;">Catatan Tambahan:</p>
                    <div class="additional-notes" style="background-color: #f1f5f9; padding: 12px; border-radius: 8px; margin-top: 10px; color: #2d3748; font-style: italic;">
                        {{ $purcase->recipient_request ?? "-" }}
                    </div>
                </div>
            </div>
            <div class="my-6" style="margin-left:20px;">
                <p class="text-xl font-semibold">Informasi Pembayaran:</p>
                <a href="/informasi_pembayaran/{{ $purcase->recipient_payment }}/{{ $purcase->selling_invoice_id }}" class="text-blue-600 underline">
                    <i class="fa-solid fa-file"></i>
                    {{ $purcase->recipient_payment }}
                </a>
                <p class="text-lg">({{ $purcase->recipient_bank }})</p>
            </div>
            @if ($purcase->reject_comment)
        <div class="my-6">
            <p class="text-xl font-semibold">Alasan Penolakan:</p>
            <div class="shadow-md p-4 bg-red-50 rounded-lg">
                {{ $purcase->reject_comment }}
            </div>
        </div>
        @endif

        </div>
        <div class="flex gap-6 my-6" style="margin-left:650px; margin-bottom:-12px;">
            <span class="px-4 py-2 rounded-lg text-white font-semibold
            @if($purcase->order_status == 'Berhasil')
                bg-green-600
            @elseif($purcase->order_status == 'Menunggu Pengembalian' || $purcase->order_status == 'Menunggu Konfirmasi' || $purcase->order_status == 'Menunggu Pengambilan')
                bg-yellow-500
            @elseif($purcase->order_status == 'Gagal' || $purcase->order_status == 'Refund')
                bg-red-500
            @endif">
                {{ $purcase->order_status }}
            </span>

            @if ($purcase->order_status == 'Berhasil')
                <a href="/cetak-struk/{{ $purcase->selling_invoice_id }}" target="_blank" class="text-lg text-blue-600 hover:text-blue-800">
                    <i class="fa-solid fa-note-sticky"></i>
                    {{ $purcase->invoice_code }}
                </a>
            @elseif ($purcase->order_status == 'Refund')
                <a href="/refund/{{ $purcase->refund_file }}/{{ $purcase->selling_invoice_id }}" class="text-lg text-blue-600 hover:text-blue-800">
                    <i class="fa-solid fa-note-sticky"></i>
                    Refund_{{ $purcase->invoice_code }}
                </a>
            @endif
        </div>
        </div>


        

        <!-- Daftar Pesanan -->
        <div class="table-container"  style="margin-left:60px; margin-right:60px; margin-bottom:40px;">
            <table class="w-full table-auto">
                <thead class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left table-header">No</th>
                        <th class="px-4 py-3 text-left table-header">Nama Produk</th>
                        <th class="px-4 py-3 text-left table-header">Harga</th>
                        <th class="px-4 py-3 text-left table-header" >Kuantitas</th>
                        <th class="px-4 py-3 text-left table-header">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalHarga = 0;
                        $no = 1;
                    @endphp
                    @foreach ($detail_products as $detail)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2 text-center">{{ $no }}</td>
                            <td class="px-4 py-2">{{ $detail->product_name }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($detail->product_sell_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-center">{{ $detail->quantity }}</td>
                            @php
                                $total = DB::select('SELECT Total_Harga(?,?) AS hasil', array($detail->quantity, $detail->product_sell_price));
                            @endphp
                            <td class="px-4 py-2 text-center">Rp {{ number_format($total[0]->hasil, 0, ',', '.') }}</td>
                        </tr>
                        @php
                            $no += 1;
                            $totalHarga += $total[0]->hasil;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white">
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-right">Total Belanja:</td>
                        <td class="px-4 py-3 text-center font-semibold total-price" style="color: white">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    @include('user.components.footer')

</body>

</html>