    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=\, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Toko Obat Subur Tigarunggu</title>
        @vite('resources/css/app.css')
        @livewireStyles

        {{-- FONT AWESOME --}}
        <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

        <style>
            table {
                border: 3px solid #ccc; /* Border solid di tabel */
                border-radius: 8px; /* Membuat sudut tumpul */
            }

            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 2px solid rgba(0, 0, 0, 0.1); /* Border solid dan lebih tipis untuk setiap baris */
                border-right: 2px solid #ccc; /* Menambahkan garis vertikal di kanan setiap header */

            }

            tr {
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .rounded-md {
                border-radius: 8px; /* Mengubah border radius di elemen dengan kelas rounded-md */
            }

            .w-full {
                border-radius: 8px; /* Mengubah border radius di elemen dengan kelas w-full */
            }

        </style>
    </head>

    <body class="font-Inter">
        @include('user.components.navbar')

        <div class="flex flex-col items-center mb-8">

            <div class="w-[70vw] mt-8 flex flex-col">

                <div>
                    <p> </p>
                </div>
                <div class="md:flex md:grid-cols-2 justify-between">
                    <p class="font-semibold text-4xl">Keranjang</p>                

                </div>

                {{-- table --}}
                <div class="rounded-md w-full h-fit my-7">
                    <div class="overflow-x-auto py-5">
                        <table class="w-full">
                            <thead class="bg-white">
                                <tr class="bg-white text-black h-[5vh] rounded-tl-md rounded-tr-md text-center align-middle">
                                    <th class="text-center align-middle">Produk</th>
                                    <th class="text-center align-middle">Harga</th>
                                    <th class="text-center align-middle">Hapus</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Total Harga</th>
                                </tr>
                            </thead>
                            @php
                                $jumlah = 0;
                            @endphp
                            <tbody class="border-t">
                                @isset($carts)
                                @foreach ($carts as $cart)
                                <tr>

                                    <th scope="row" class="w-5/12">
                                        <div class="sm:flex sm:grid-cols-3 gap-4 justify-center my-5">
                                            <div class="w-2/5">
                                                @if (file_exists(public_path('storage/gambar-obat/' . $cart->product_photo)) && $cart->product_photo !== NULL)
                                                    <img src="{{ asset('storage/gambar-obat/' . $cart->product_photo) }}" alt="" class="w-full">
                                                @else
                                                    <img src="{{asset('img/obat1.jpg/')}}" alt="" class="w-full">
                                                @endif
                                            </div>
                                            <div class="w-3/5 text-start flex flex-col gap-1 items-left justify-center">
                                                <p class="font-semibold text-wrap ">{{ $cart->product_name }}</p>
                                                <p class="font-normal">Kategori Obat : {{ $cart->category }}</p> 

                                            </div>
                                            
                                        </div>
                                    </th>
                                    <th scope="row" class="w-2/12">
                                        <p class="font-semibold text-lg">Rp {{ number_format($cart->product_sell_price , 0, ',', '.') }}</p>
                                    </th>
                                    <th scope="row" class="w-1/12">
                                        <form action="/keranjang/hapus" method="POST">
                                            @csrf
                                            <input type="hidden" name="hapus" value="satuan">
                                            <input type="hidden" name="cart_id" value="{{ $cart->cart_id }}">
                                            <button type="submit" class="w-[50px] h-[50px]">
                                                <p class="text-center"style="color: red;">Hapus</p>
                                            </button>
                                        </form>
                                    </th>
                                    <th class="w-2/12">
                                        <div class="sm:flex sm:grid-cols-3 gap-4 justify-center ">
                                            <livewire:count-product-cart :price="$cart->product_sell_price" :cart="$cart->cart_id" :stock="$cart->product_stock" :quantity="$cart->quantity" :keranjang="true"/>
                                        </div>
                                    </th>
                                    <th class="w-2/12 text-center align-middle">
                                        <livewire:product-price-cart :cart="$cart->cart_id" :totalprice="$cart->total_harga"/>
                                        </th>
                                    </tr>
                                    @php
                                    $jumlah += $cart->total_harga
                                    @endphp
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>

                @isset($cart)

                    <div class="flex justify-end items-end my-3 me-10">
                        <a href="/booking" class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-[#3498db]">Lanjut</a>
                    </div>
                @else
                    <div class="text-black text-center flex flex-col items-center justify-center px-60 gap-4 h-96">
                        <p class="text-center text-2xl font-bold">
                            Keranjang Anda Kosong <br>
                        </p>
                    </div>

                    {{-- <div class="flex justify-end items-end my-3 me-10">
                        <button disabled class="p-2 px-7 rounded-lg shadow-lg text-white font-semibold bg-slate-400">Booking</button>
                    </div> --}}
                @endisset

            </div>
        </div>


        @include('user.components.footer')
        @livewireScripts
        <script>
            const cartAlert = () => {
            const modals = document.getElementById('cartAlertPopUp');
            const buttons = document.getElementById("btnCart");

            if (modals.classList.contains('hidden')) {
                buttons.disabled = false;
                requestAnimationFrame(() => {
                    modals.classList.remove('hidden');
                    document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modals.classList.add('opacity-100');
                    });
                });
            } else {
                buttons.disabled = true;
                requestAnimationFrame(() => {
                    modals.classList.remove('opacity-100');
                    document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modals.classList.add('hidden');
                    });
                });
            }
        }
        </script>
    </body>

    </html>