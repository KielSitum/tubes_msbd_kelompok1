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
    {{-- FLATPICKR.JS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- flatpickr.js --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        body {
            background-color: #fff8e7;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .shadow-lg {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .border-mainColor {
            border-color: #ADD8E6;
        }

        .text-mediumGrey {
            color: #6e6e6e;
        }

        button {
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #e6e6e6;
            transform: scale(1.1);
        }

        i {
            color: #ADD8E6 !important;
        }

        #buttonToggle {
            transition: all 0.3s ease;
        }

        #buttonToggle:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .rounded-full {
            border-radius: 50%;
        }

        .rounded-lg {
            border-radius: 12px;
        }

        .shadow {
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .font-bold {
            font-weight: 700;
        }

        .font-Inter {
            font-family: 'Inter', sans-serif;
        }

        .transition {
            transition: all 0.3s ease;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-10 bg-white min-h-[100vh] h-full" id="mainContent">

        <div class="flex flex-col gap-8">
            <div class="md:flex gap-4 items-center">
                @include('pemilik.components.navbar')

                <p class="text-3xl font-bold ms-16">Dashboard</p>
            </div>

            <div class="md:flex gap-6 justify-between">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 md:justify-center items-center">
                        <div class="border-2 border-mainColor p-4 rounded-full">
                            <i class="fa-solid fa-spinner fa-2xl"></i>
                        </div>
                        <div>
                            <p class="text-md text-mediumGrey font-bold">Pesanan Menunggu Pengembalian</p>
                            <p class="text-lg font-bold">{{ $pending }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 items-center">
                        <div class="border-2 border-mainColor p-4 rounded-full">
                            <i class="fa-solid fa-prescription-bottle-medical fa-2xl"></i>
                        </div>
                        <div>
                            <p class="text-md text-mediumGrey font-bold">Produk</p>
                            <p class="text-lg font-bold">{{ $product }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 items-center">
                        <div class="border-2 border-mainColor p-4 rounded-full">
                            <i class="fa-solid fa-users fa-2xl"></i>
                        </div>
                        <div>
                            <p class="text-md text-mediumGrey font-bold">User</p>
                            <p class="text-lg font-bold">{{ $user }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 items-center">
                        <div class="border-2 border-mainColor p-4 rounded-full">
                            <i class="fa-solid fa-truck fa-2xl"></i>
                        </div>
                        <div>
                            <p class="text-md text-mediumGrey font-bold">Supplier</p>
                            <p class="text-lg font-bold">{{ $supplier }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex gap-6">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full flex flex-col items-center">
                    <p class="text-xl font-bold">Laporan Keuntungan</p>
                    <div class="w-[90%] shadow border border-mainColor my-3"></div>

                    <canvas id="myChart"></canvas>

                    <script>
                        var ctx = document.getElementById('myChart').getContext('2d');

                        var labels = <?php echo json_encode(array_column($results, 'year')); ?>;
                        var data = <?php echo json_encode(array_column($results, 'total_profit')); ?>;

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total Profit',
                                    data: data,
                                    backgroundColor: '#ADD8E6',
                                    borderColor: '#5bc0de',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>

            <p class="font-bold text-2xl mt-5">Transaksi Terakhir</p>
            <livewire:transaksi-terakhir />
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    {{-- CHART SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    <script>
        var today = new Date();
        var year = today.getFullYear();
        var month = (today.getMonth() + 1).toString().padStart(2, '0');
        var maxDate = year + '-' + month;
        document.getElementById('tgl-transaksi').setAttribute('max', maxDate);
    </script>
</body>

</html>
