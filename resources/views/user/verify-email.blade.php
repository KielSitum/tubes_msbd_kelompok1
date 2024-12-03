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
        .verify-card {
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
        .verify-header {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Status Message */
        .status-message {
            color: #003cff;
            font-size: 1rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Button Style */
        .btn, .logout-btn {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 1rem;
            text-align: center;
        }

        /* Button Hover Effect */
        .btn:hover, .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(255, 117, 143, 0.3);
        }

        /* Button Specific Styles */
        .btn {
            wdisplay: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem 2rem;
            width: 400px;
            font-size: 1rem;
            font-weight: 700;
            background: linear-gradient(90deg, #ff7eb3, #ff758f);
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 1rem;
        }

        .logout-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 2rem;
            width: 400px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 700;
            background: #f56565;
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            margin-top: 1rem;
        }

        .logout-btn:hover {
            background: #c53030;
        }

    </style>
</head>
<body>
    <div class="verify-card">
        <p class="verify-header">Verifikasi Email</p>
        <p class="text-md" style="text-align: center;">Cek Email yang Anda daftarkan untuk memverifikasi akun Anda.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="status-message">
                {{ __('Link Verifikasi Baru Telah Dikirimkan, Silahkan Cek Email Yang Anda Daftarkan!') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn">Kirim Ulang Verifikasi</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
