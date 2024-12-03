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

        @keyframes backgroundAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
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

        .login-header {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .input-group {
            width: 100%;
            margin-bottom: 1.5rem;
            margin-right: 2rem;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            outline: none;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            border: none;
        }

        .input-group input.error {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff3f3f;
        }

        .input-group .error-message {
            color: #ff5555;
            font-size: 0.85rem;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            margin-top: 0.2rem;
            font-weight: 600;
        }


        .eye-icon {
            position: absolute;
            top: 50%;
            left: 390px;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .eye-icon:hover {
            color: #000;
        }

        .btn {
            width: 100%;
            padding: 1rem;
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

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(255, 117, 143, 0.3);
        }

        .forgot-password, .register-link {
            font-size: 0.9rem;
            color: #fff;
            text-decoration: none;
            margin-top: 0.5rem;
            display: block;
            text-align: center;
        }

        .forgot-password:hover, .register-link:hover {
            text-decoration: underline;
        }

        .google-btn {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            padding: 1rem;
            width: 100%;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            background-color: transparent;
            font-weight: 700;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .google-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.7);
        }

        .error-message {
            color: #ff7b7b;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .status-message {
            color: #ff7eb3;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <form action="/login" method="POST">
        @csrf
        <div class="login-card">
            <h1 class="login-header">Masuk</h1>

            @error('loginError')
            <p class="error-message">{{ $message }}</p>
            @enderror

            @if (session('status') == 'verification-email')
            <p class="status-message">{{ __('Link Verifikasi Telah Dikirimkan Ke Email Anda') }}</p>
            @endif

            <div class="input-group">
                <input name="email/username" value="{{ @old('email/username') }}" type="text" placeholder="Email/Username" class="{{ $errors->has('email/username') ? 'error' : '' }}">
                @if ($errors->has('email/username'))
                    <div class="error-message">{{ $errors->first('email/username') }}</div>
                @endif
            </div>
            
            <div class="input-group">
                <input id="passwordInput" name="password" type="password" placeholder="Password" class="{{ $errors->has('password') ? 'error' : '' }}">
                <i class="fa-solid fa-eye eye-icon" id="togglePassword"></i>
                @if ($errors->has('password'))
                    <div class="error-message">{{ $errors->first('password') }}</div>
                @endif
            </div>
            

            <a href="forgot-email" class="forgot-password">Lupa sandi?</a>

            <button class="btn" type="submit">Masuk</button>

            <!-- Auth Google -->
            <a href="{{ route('auth.goole') }}" class="google-btn" type="submit"><img src="{{ asset('img/Google.png/') }}" alt="Google" style="width: 20px;" >Masuk Dengan Google</a>                  

            <p style="margin-top:30px">Belum punya akun? <a href="register" class="register-link" >Daftar disini</a></p>
        </div>
    </form>
    <script>
        // Script untuk toggle password visibility
        const togglePassword = document.querySelector("#togglePassword");
        const passwordInput = document.querySelector("#passwordInput");

        togglePassword.addEventListener("click", function () {
            // Toggle tipe input
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;

            // Toggle ikon
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>
</html>
