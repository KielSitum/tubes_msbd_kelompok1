<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Obat Subur Tigarunggu</title>

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

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

        .register-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 2rem;
            width: 450px;
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

        .register-header {
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
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .input-group input.error {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff7b7b;
        }

        .input-group .error-message {
            color: #ff7b7b;
            font-size: 0.85rem;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            margin-top: 0.5rem;
            font-weight: 600;
            padding-left: 1rem;  /* Optional: to align with input */
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            left: 450px;
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

        .error-message {
            color: #ff7b7b;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .status-message {
            color: #ff7eb3; 
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <form action="/register" method="POST">
        @csrf
        <div class="register-card">
            <h1 class="register-header">Daftar</h1>
    
            @error('registerError')
            <p class="error-message">{{ $message }}</p>
            @enderror
    
            @if (session('status') == 'verification-email')
            <p class="status-message">{{ __('Link Verifikasi Telah Dikirimkan Ke Email Anda') }}</p>
            @endif
    
            <!-- Email Input -->
            <div class="input-group">
                <input name="email" value="{{ @old('email') }}" type="email" placeholder="Email" class="{{ $errors->has('email') ? 'error' : '' }}">
                @error('email')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Username Input -->
            <div class="input-group">
                <input name="username" value="{{ @old('username') }}" type="text" placeholder="Username" class="{{ $errors->has('username') ? 'error' : '' }}">
                @error('username')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Password Input -->
            <div class="input-group">
                <input id="passwordInput" name="password" type="password" placeholder="Sandi" class="{{ $errors->has('password') ? 'error' : '' }}">
                <i class="fa-solid fa-eye eye-icon" id="togglePassword"></i>
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Confirm Password Input -->
            <div class="input-group">
                <input id="passwordConfirmInput" name="konfirmasiPassword" type="password" placeholder="Konfirmasi Sandi" class="{{ $errors->has('konfirmasiPassword') ? 'error' : '' }}">
                <i class="fa-solid fa-eye eye-icon" id="toggleConfirmPassword"></i>
                @error('konfirmasiPassword')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
    
            <input type="hidden" name="role" value="user">

            <button class="btn" type="submit">Daftar</button>
    
            <p style="margin-top:30px">Sudah punya akun? <a href="login" class="register-link" style="color: rgb(255, 255, 255);">Masuk disini</a></p>
        </div>
    </form>
    

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordInput = document.querySelector("#passwordInput");

        togglePassword.addEventListener("click", function () {
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });

        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const passwordConfirmInput = document.querySelector("#passwordConfirmInput");

        toggleConfirmPassword.addEventListener("click", function () {
            const type = passwordConfirmInput.type === "password" ? "text" : "password";
            passwordConfirmInput.type = type;
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>
</html>
 