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

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #e8f0f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 15px;
            width: 90%;
            max-width: 900px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            background-size: 200% 200%;
            animation: gradientAnimation 4s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 200% 0;
            }
            50% {
                background-position: 0 100%;
            }
            100% {
                background-position: 200% 0;
            }
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .header .price {
            font-weight: bold;
            font-size: 2rem;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-section label {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 8px;
        }

        .payment-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            padding: 10px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .payment-option:hover {
            background-color: #f2f2f2;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .payment-option img {
            height: 40px;
            width: auto;
        }

        .file-input {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .file-input:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .file-input input[type="file"] {
            display: none;
        }

        .file-input p {
            color: #555;
            font-size: 1rem;
        }

        .file-input .icon {
            background-color: #3498db;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .terms {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #444;
        }

        .terms input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-top: 25px;
        }

        .buttons button {
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .buttons button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        .error-message {
            color: red;
            font-size: 1rem;
            text-align: left;
            margin-top: 5px;
        }

        .file-upload-text {
            color: #777;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p>Total Pembayaran</p>
            <p class="price">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>

        <form action="/pembayaran" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-section">
                <p class="font-bold" style="text-align:center;">Pilihan Rekening & E-Wallet</p>

                <div class="payment-options" style="text-align:center;">
                    <!-- Gopay -->
                    <div class="payment-option" >
                        <input type="radio" name="paymentMethod" value="Gopay" id="paymentMethod1" class="h-5 w-5" required>
                        <label for="paymentMethod1" >
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/1280px-Gopay_logo.svg.png" alt="Gopay">
                            Gopay
                        </label>
                    </div>

                    <!-- Shopeepay -->
                    <div class="payment-option">
                        <input type="radio" name="paymentMethod" value="Shopeepay" id="paymentMethod2">
                        <label for="paymentMethod2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/375px-Shopee.svg.png" alt="ShopeePay">
                            Shopeepay
                        </label>
                    </div>

                    <!-- BCA -->
                    <div class="payment-option">
                        <input type="radio" name="paymentMethod" value="BCA" id="paymentMethod3">
                        <label for="paymentMethod3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/330px-Bank_Central_Asia.svg.png" alt="BCA">
                            BCA
                        </label>
                    </div>

                    <!-- Mandiri -->
                    <div class="payment-option">
                        <input type="radio" name="paymentMethod" value="Mandiri" id="paymentMethod4">
                        <label for="paymentMethod4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/330px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri">
                            Mandiri
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <p class="font-bold">Bukti Pembayaran</p>

                <label for="buktiPembayaran" class="file-input">
                    <input type="file" onchange="updateLabel()" name="buktiPembayaran" required id="buktiPembayaran" accept=".pdf, .png, .jpg, .jpeg">
                    <div class="icon"><i class="fa-solid fa-download"></i></div>
                    <p id="fileName" class="file-upload-text">Upload Bukti Pembayaran</p>
                </label>

                @error('buktiPembayaran')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="buttons">
                <input type="hidden" name="nama" value="{{ $nama }}">
                <input type="hidden" name="nomor_telepon" value="{{ $nomor_telepon }}">
                @if ($catatan != NULL)
                    <input type="hidden" name="catatan" value="{{ $catatan }}">
                @endif
                <input type="hidden" name="status" value="Menunggu Konfirmasi">

                <div class="w-[70vw] flex justify-end text-white font-semibold gap-4">
                    <button type="button" class="bg-red-600 h-fit w-fit px-10 py-1 rounded-lg shadow-md">
                        Kembali
                    </button>
                    <button type="submit" class="bg-mainColor h-fit w-fit px-10 py-1 rounded-lg shadow-md">
                        Kirim
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const updateLabel = () => {
            const input = document.getElementById('buktiPembayaran');
            const fileName = input.files[0].name;
            const label = document.getElementById('fileName');
            label.textContent = fileName;
        }
    </script>
</body>
</html>