<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Inter">
    @include('user.components.navbar')

    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}

            <a href="/"
                class="flex items-center justify-center rounded-xl bg-blue-500 hover:bg-blue-600 shadow-lg h-12 px-4 text-white text-lg font-medium transition duration-300 ease-in-out transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 14l-4 -4l4 -4"></path>
                    <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                </svg>
                <span class="ml-2">Kembali</span>
            </a>

            </div>

            <div class="my-7">
                <p class="text-3xl font-semibold">Riwayat Pesanan</p>

                {{-- search --}}
                
                {{-- table --}}
                <div class="overflow-x-auto p-4 bg-opacity-50 bg-white rounded-lg shadow-2xl">
                    <table class="w-full mt-5 table-auto border-collapse shadow-lg bg-white rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="pb-2 px-4 text-left">No. Invoice</th>
                                <th class="pb-2 px-4 text-left">Tanggal Belanja</th>
                                <th class="pb-2 px-4 text-left">Keterangan</th>
                                <th class="pb-2 px-4 text-left">Status</th>
                                <th class="pb-2 px-4 text-left">Total Belanja</th>
                            </tr>
                        </thead>
                
                        <tbody class="text-sm">
                            @foreach ($products_purcase as $product_purcase)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $product_purcase->invoice_code }}</td>
                                <td class="px-4 py-3 font-light">{{ date('d M Y', strtotime($product_purcase->order_date)) }}</td>
                                <td class="px-4 py-3">
                                    <a href="/detail-riwayat-pesanan?pesanan={{ $product_purcase->selling_invoice_id }}" class="text-blue-600 underline font-semibold">Lihat Detail</a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <p class="
                                        @if($product_purcase->order_status == 'Berhasil') bg-green-700 
                                        @elseif ($product_purcase->order_status == 'Menunggu Pengembalian' || $product_purcase->order_status == 'Menunggu Konfirmasi' || $product_purcase->order_status == 'Menunggu Pengambilan') 
                                        bg-yellow-500
                                        @elseif ($product_purcase->order_status == 'Gagal' || $product_purcase->order_status == 'Refund')
                                        bg-red-500
                                        @endif w-56 py-1 px-4 rounded-lg text-white font-semibold">{{ $product_purcase->order_status }}</p>
                                </td>
                                @php
                                    $totalBelanja = 0;
                                    $product = $product_purcase->invoiceSellingDetail;
                                    foreach ($product as $p) {
                                        $totalBelanja += $p->product_sell_price * $p->quantity;
                                    }
                                @endphp
                                <td class="px-4 py-3">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products_purcase->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleStatus = () => {
            const menu2 = document.getElementById('dropdownMenu2');
    
            if (menu2.classList.contains('hidden')) {
                requestAnimationFrame(() => {
                    menu2.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        menu2.classList.add('opacity-100');
                    });
                });
            } else {
                requestAnimationFrame(() => {
                    menu2.classList.remove('opacity-100');
                    requestAnimationFrame(() => {
                        menu2.classList.add('hidden');
                    });
                });
            }
        }
    
        const menu2 = document.querySelector('#dropdownMenu2');
    
        document.addEventListener('click', (event) => {
            if (event.target !== menu) {
                menu2.classList.add('hidden');
                menu2.classList.remove('opacity-100');
                menu2.classList.add('opacity-0');
            }
        });
    </script>

    @include('user.components.footer')
</body>

</html>