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
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #F5F7FA, #B8C6DB);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #ffffff;
            width: 60%;
            max-width: 500px;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4A5568;
            margin-bottom: 0.5rem;
        }

        .form-container p {
            font-size: 0.9rem;
            color: #718096;
            margin-bottom: 1.5rem;
        }

        .form-container input {
            width: 100%;
            padding: 0.75rem 1rem;
            margin: 0.5rem 0;
            border: 1px solid #CBD5E0;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-container input:focus {
            border-color: #63B3ED;
            box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.3);
        }

        .form-container button {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            background: linear-gradient(90deg, #667EEA, #764BA2);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .form-container button:hover {
            transform: scale(1.05);
        }

        .form-container .icon-button {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            color: #718096;
        }

        .form-container .error-message {
            color: #E53E3E;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-container" style="width: 220%;">
            <h1>Ubah Sandi</h1>
            <p>Pilih sandi baru yang kuat namun mudah diingat.</p>

            <div>
                <input name="email" value="{{ $request->email }}" type="text" placeholder="Email">
                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div style="width:100%">
                <input id="passwordInput" name="password" type="password" placeholder="Sandi">
                    @error('password')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div style="position: relative;" >
                <input id="passwordConfirmInput" name="password_confirmation" type="password" placeholder="Konfirmasi Sandi">
                @error('password_confirmation')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit">Reset Password</button>
        </div>
    </form>

    <script>
        function showPassword() {
            const toggle = document.getElementById('toggle');
            const passwordInput = document.getElementById('passwordInput');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }

            toggle.classList.toggle('fa-eye');
            toggle.classList.toggle('fa-eye-slash');
        }

        function showPasswordConfirm() {
            const toggle = document.getElementById('toggleConfirm');
            const passwordInput = document.getElementById('passwordConfirmInput');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }

            toggle.classList.toggle('fa-eye');
            toggle.classList.toggle('fa-eye-slash');
        }
    </script>
</body>
</html>
