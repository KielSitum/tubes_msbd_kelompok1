<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>
    
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap');

        /* General Body Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #3b8d99, #6b8dff, #a6b1e1);
            background-size: 400% 400%;
            animation: backgroundAnimation 10s infinite;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Background Animation */
        @keyframes backgroundAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Card Style */
        .reset-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 2rem;
            width: 400px;
            animation: fadeIn 1.5s ease-out;
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Heading Style */
        .reset-header {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .text-md {
            font-size: 1rem;
            color: white;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Input Field */
        .input-container {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .input-field {
            margin-left: -15px;
            margin-right: 130px;
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-field:focus {
            border-color: #3b8d99;
            outline: none;
            box-shadow: 0 0 8px rgba(59, 141, 153, 0.3);
        }

        .input-field.error {
            border-color: #ff3b3b;
        }

        /* Error Message */
        .error-message {
            color: #ff3b3b;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Pesan area untuk menghindari perubahan ukuran */
        .message-container {
            min-height: 1rem; /* Ruang untuk pesan error/sukses */
            margin-bottom: 1rem;
            text-align: center;
        }

        .status-message {
            color: #006eff;
            font-size: 0.9rem;
        }

        /* Button Style */
        .btn-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .cancel-btn {
            flex: 0 0 53%; /* Setengah dari ukuran input box */
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            text-align: center;
            text-decoration: none; /* Hilangkan garis bawah */
            margin-right: 20px;
            margin-left: -40px;
        }

        .btn:hover, .cancel-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(255, 117, 143, 0.3);
        }

        /* Button Specific Styles */
        .btn {
            flex: 0 0 60%; /* Setengah dari ukuran input box */
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            text-align: center;
            text-decoration: none;
            margin-right: 40px;
            margin-left: 5px;
            background: linear-gradient(90deg, #ff7eb3, #ff758f);
        }

        .cancel-btn {
            background: #c53030;
        }

        .cancel-btn:hover {
            background: #9b2c2c;
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <p class="reset-header">Reset Kata Sandi</p>
        <p class="text-md">Masukkan alamat email Anda untuk menerima tautan reset kata sandi.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-container">
                <input name="email" type="email" placeholder="Email Anda" 
                       class="input-field @error('email') error @enderror">
            </div>

            <!-- Pesan Status/Error -->
            <div class="message-container">
                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

                @if (session()->has('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <!-- Tombol -->
            <div class="btn-container">
                <a href="login" class="cancel-btn">Batal</a>
                <button class="btn" type="submit">Kirim</button>
            </div>
        </form>
    </div>
</body>
</html>
