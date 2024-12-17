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
            <h1 class="text-4xl font-bold text-mainColor">Pesanan Pending</h1>
            <p class="text-gray-600">Kelola pesanan pending dengan mudah.</p>
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

        <div class="bg-gray-50 rounded-lg shadow p-6">
            <table id="myTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-mainColor text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No.</th>
                        <th class="py-3 px-6 text-left">Nomor Invoice</th>
                        <th class="py-3 px-6 text-left">Nama Pengambil</th>
                        <th class="py-3 px-6 text-left">Metode Pembayaran</th>
                        <th class="py-3 px-6 text-left">Informasi Pembayaran</th>
                        <th class="py-3 px-6 text-left">Keterangan</th>
                        <th class="py-3 px-6 text-center">Detail Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @php $index = 1; @endphp
                    @foreach ($pendingOrders as $order)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-6">{{$i}}</td>
                        <td class="py-3 px-6 font-bold">{{ $order->invoice_code }}</td>
                        <td class="py-3 px-6">{{ $order->recipient_name }}</td>
                        <td class="py-3 px-6">{{ $order->recipient_bank }}</td>
                        <td class="py-3 px-6">
                            <button onclick="showPaymentSS({{ $index }})" class="underline">{{ $order->recipient_payment }}</button>
                        </td>
                        <td class="py-3 px-6">
                            <p class="font-bold opacity-60">{{ date('d M Y',strtotime($order->order_date)) }}</p>
                        </td>
                        <td class="py-3 <td class="py-3 px-6 text-center">
                            <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" type="button" onclick="toggleDetail({{ $index }})">Lihat</button>

                            {{-- MODAL DETAIL PESANAN PENDING START --}}
                    <div class="fixed w-full h-full top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="detailModal{{ $index }}">
                        <div class="w-[90%] md:w-[70%] lg:w-[50%] h-fit max-h-full bg-blue-50 rounded-lg shadow-lg p-6 flex flex-col gap-6 overflow-auto transition-transform transform scale-95 hover:scale-100 duration-300 ease-in-out">
                            <div class="flex justify-between items-center">
                                <h2 class="text-2xl font-semibold text-blue-800">Detail Pesanan</h2>
                                <button onclick="toggleDetail({{ $index }})" type="button" class="text-gray-500 hover:text-gray-700">
                                    <i class="fa-solid fa-xmark fa-lg"></i>
                                </button>
                            </div>

                            <div class="px-8 py-2 w-full flex flex-col">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-300">
                                            <th class="pb-2 text-left">No</th>
                                            <th class="pb-2 text-left">Nama</th>
                                            <th class="pb-2 text-center">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $j  = 1; @endphp
                                        @foreach ($order->invoiceSellingDetail as $detail)
                                        <tr class="border-b hover:bg-blue-100">
                                            <td class="py-2 text-center">{{$j}}</td>
                                            <td class="py-2">{{ $detail->product_name }}</td>
                                            <td class="py-2 text-center">{{ $detail->quantity }}</td>
                                        </tr>
                                        @php $j++ @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="px-8 w-full">
                                <p class="text-blue-800 font-bold py-2 border-b border-gray-300">Catatan</p>
                                <p class="py-4">{{ $order->recipient_request }}</p>
                            </div>

                            <form action="{{ route('owner-refund', $order->selling_invoice_id) }}" method="post" enctype="multipart/form-data">
                                <div class="px-8 w-full">
                                    <p class="text-blue-800 font-bold py-2 border-b border-gray-300">Upload Bukti Refund</p>

                                    <div class="md:flex w-full items-center">
                                        <div class="me-3">
                                            <input type="file" id="buktiRefund{{ $index }}" name="buktiRefund" class="invisible" accept=".pdf, .png, .jpg, .jpeg" onchange="updateLabel({{ $index }});showFile(this, {{ $index }});" required>
                                            <button id="file" onclick="document.getElementById('buktiRefund{{ $index }}').click(); return false;" class="p-2 w-full border rounded-xl shadow hover:bg-blue-100 transition duration-200">
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-solid fa-arrow-up-from-bracket p-2 px-2.5 rounded-full bg-blue-600 w-fit ms-2" style="color: white;"></i>
                                                    <p id="fileName{{ $index }}" class="text-mediumGrey">Upload gambar</p>
                                                </div>
                                            </button>
                                            <p class="text-xs text-mediumRed mt-2">*Maks 5mb</p>
                                        </div>
                                        <div class="w-full h-full m-2 border-2 flex justify-center">
                                            <img src="" alt="" id="uploadedFile{{ $index }}" class="max-w-full max-h-full rounded-lg shadow-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end w-full">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md hover:bg-blue-700 transition duration-200">
                                        Tandai Selesai
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- MODAL DETAIL PESANAN PENDING END --}}
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @php $index++  @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal'+index);
            modal.classList.toggle('hidden');
        }

        const showPaymentSS = (index) => {
            const modalBukti = document.getElementById('ModalBuktiPembayaran'+index);
            modalBukti.classList.toggle('hidden');
        }

        const updateLabel = (index) => {
            const input = document.getElementById('buktiRefund'+index);
            const fileName = input.files[0].name;
            const label = document.getElementById('fileName'+index);
            label.textContent = fileName;
        }

        function showFile(input, index) {
            const getFile = document.getElementById('uploadedFile'+index);
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