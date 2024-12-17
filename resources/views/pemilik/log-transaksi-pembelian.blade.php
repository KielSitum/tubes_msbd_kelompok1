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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-8 font-Inter bg-white shadow-lg rounded-lg m-4" id="mainContent">
        @include('pemilik.components.navbar')

        <div class="mb-6">
            <h1 class="text-4xl font-bold text-mainColor">Log Transaksi Pembelian</h1>
            <p class="text-gray-600">Kelola data transaksi pembelian dengan mudah.</p>
        </div>

        <div class="bg-gray-50 rounded-lg shadow p-6">
            <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-mainColor text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Supplier</th>
                        <th class="py-3 px-6 text-left">Tanggal Transaksi</th>
                        <th class="py-3 px-6 text-left">Nomor Faktur</th>
                        <th class="py-3 px-6 text-center">Detail Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($buying as $index => $item)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-6">{{$i++}}</td>
                        <td class="py-3 px-6 font-bold">{{ $item->supplier_name }}</td>
                        @php
                            $carbonDate = \Carbon\Carbon::parse($item->order_date);
                            $formattedDate = $carbonDate->format('j F Y');
                            $uuid = $item->buying_invoice_id;
                            $numericValue = hexdec(substr($uuid, -5));
                            $formatted = 'FR-' . str_pad($numericValue, 6, '0', STR_PAD_LEFT);
                        @endphp
                        <td class="py-3 px-6">{{ $formattedDate }}</td>
                        <td class="py-3 px-6">{{ $formatted }}</td>
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

        {{-- MODAL DETAIL TRANSAKSI PEMBELIAN START --}}
        @foreach ($buying as $index => $item)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="detailModal{{ $index }}">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto p-9 bg-white rounded-xl shadow-lg transition-transform transform scale-95 hover:scale-100">
                <div class="bg-gradient-to-tl from-indigo-600 to-blue-400 p-4 rounded-t-xl flex justify-between items-center text-white shadow-lg" style="width:130%;">
                    <span class="font-bold text-lg">Detail Transaksi  <span class="font-bold   ">
                        @php
                            $uuid = $item->buying_invoice_id;
                            $numericValue = hexdec(substr($uuid, -5));
                            echo 'FR-' . str_pad($numericValue, 6, '0', STR_PAD_LEFT);
                        @endphp
                    </span></span>
                    <button onclick="toggleDetail({{ $index }})" class="text-white text-xl">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4"> 
                    <div class="flex flex-col gap-2">
                        <p class="font-bold">Nama Supplier: <span class="font-normal">{{ $item->supplier_name }}</span></p>
                        <p class="font-bold">Tanggal Transaksi: <span class="font-normal">{{ $item->order_date }}</span></p>
                        <p class="font-bold">Nomor Faktur: 
                            <span class="font-normal">
                                @php
                                    $uuid = $item->buying_invoice_id;
                                    $numericValue = hexdec(substr($uuid, -5));
                                    echo 'FR-' . str_pad($numericValue, 6, '0', STR_PAD_LEFT);
                                @endphp
                            </span>
                        </p>
                                            </div>

                    <p class="font-bold">Detail Pesanan:</p>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="text-left py-2 px-4">Nama Produk</th>
                                <th class="text-center py-2 px-4">Expired Date</th>
                                <th class="text-center py-2 px-4">Jumlah</th>
                                <th class="text-center py-2 px-4">Harga</th>
                                <th class="text-center py-2 px-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalHarga = 0;
                            @endphp
                            @foreach ($item->invoiceBuyingDetail as $detail)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $detail->product_name }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($detail->exp_date)->format('d/m/Y') }}</td>
                                <td class="text-center py-2 px-4">{{ $detail->quantity }}</td>
                                <td class="text-center py-2 px-4">Rp {{ number_format($detail->product_buy_price, 0, ',', '.') }}</td>
                                <td class="text-center py-2 px-4">Rp {{ number_format($detail->quantity * $detail->product_buy_price, 0, ',', '.') }}</td>
                            </tr>
                            @php
                                $totalHarga += $detail->quantity * $detail->product_buy_price;
                            @endphp
                            @endforeach
                            <button class="bg-mainColor text-white px-4 py-2 rounded mt-4" onclick="downloadPDF({{ $index }})">
                                Unduh PDF
                            </button>
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
        {{-- MODAL DETAIL TRANSAKSI PEMBELIAN END --}}
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);
            modal.classList.toggle('hidden');
        }
        const downloadPDF = async (index) => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Ambil elemen modal
    const modal = document.getElementById('detailModal' + index);

    // Ambil data dari modal
    const supplierName = modal.querySelector('p:nth-child(1) span').innerText;
    const transactionDate = modal.querySelector('p:nth-child(2) span').innerText;
    const invoiceNumber = modal.querySelector('p:nth-child(3) span').innerText;

    // Ambil data tabel
    const tableRows = modal.querySelectorAll('tbody tr');
    const tableData = Array.from(tableRows).map(row => {
        const cells = row.querySelectorAll('td');
        return Array.from(cells).map(cell => cell.innerText);
    });

    // Ambil total harga
    const totalText = modal.querySelector('.mt-4.flex p span').innerText;

    let y = 10;

    // Tambahkan judul dokumen
    doc.setFontSize(18);
    doc.text('Detail Transaksi', 10, y);
    y += 10;

    // Tambahkan detail transaksi
    doc.setFontSize(12);
    doc.text(`Nama Supplier: ${supplierName}`, 10, y);
    y += 6;
    doc.text(`Tanggal Transaksi: ${transactionDate}`, 10, y);
    y += 6;
    doc.text(`Nomor Faktur: ${invoiceNumber}`, 10, y);
    y += 10;

    // Tambahkan tabel menggunakan autoTable
    doc.autoTable({
        head: [['Nama Produk', 'Expired Date', 'Jumlah', 'Harga', 'Total']],
        body: tableData,
        startY: y
    });

    // Tambahkan total harga setelah tabel
    const finalY = doc.lastAutoTable.finalY + 10; // Ambil posisi terakhir dari tabel
    doc.setFontSize(14);
    doc.text(`Total Harga: ${totalText}`, 10, finalY);

    // Simpan file PDF
    doc.save(`Detail_Transaksi_${invoiceNumber}.pdf`);
};


    </script>
</body>

</html>
