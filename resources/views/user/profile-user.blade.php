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
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="font-Inter relative h-[100vh]">
    @include('user.components.navbar')
    <a href="/" class="py-2 flex items-center gap-3 hover:text-blue-500 transition duration-300" style="margin-left:230px; margin-top:20px;">
        <i class="fa-solid fa-arrow-left-long text-blue-600"></i>
        <p class="font-semibold text-gray-700">Kembali Belanja</p>
    </a>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
        <div class="w-[80vw] sm:w-[50vw] lg:w-[40vw] mt-8 flex flex-col gap-10">
            
    
            <form action="/hapus-akun" method="POST" class="flex justify-between items-center">
                @csrf
                <h1 class="text-3xl font-extrabold text-gray-800 text-center" style="margin-left: 260px;">Pengaturan Akun</h1>
    
                {{-- HAPUS AKUN MODAL START --}}
                <div class="w-full h-full opacity-0 absolute top-0 left-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="deleteAccountModal">
                    <div class="bg-white h-fit w-[35%] rounded-lg shadow-lg py-12 px-10 flex flex-col gap-5 items-center text-center">
                        <i class="text-6xl text-red-600 fa-solid fa-circle-exclamation"></i>
                        <p class="text-xl font-bold w-[90%]">Apakah Anda yakin ingin menghapus akun Anda?</p>
                        <button onclick="deleteAccountFirstValidation()" type="button" class="bg-gray-300 px-5 w-48 py-2 text-black font-bold rounded-md shadow-md">Batal</button>
                        <button onclick="deleteAccountSecondValidation()" type="button" class="bg-red-600 w-48 px-5 py-2 text-white font-bold rounded-md shadow-md">Hapus Akun</button>
                    </div>
                </div>
                {{-- HAPUS AKUN MODAL END --}}
            </form>
    
            <div class="flex flex-col gap-5 w-full">
                <!-- Profil Pengguna Form -->
                <form action="/user-profile" method="POST" class="w-full h-fit px-10 py-5 border-2 rounded-md border-gray-300 flex flex-col items-center gap-5">
                    @csrf
                    <input type="hidden" name="update" value="profile">
                    <p class="text-2xl font-semibold text-gray-800">Profil Pengguna</p>
    
                    @if (session()->has('success_profile'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p class="text-sm text-green-600 p-0 m-0 text-center">{{ session('success_profile') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
    
                    <div class="flex flex-col w-full gap-3">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" value="{{ $username ?? "" }}" placeholder="Username"
                        class="border-2 h-12 px-4 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('username')
                        @if ($message == 'The username field format is invalid.')
                            <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                The username field must not contain spaces (" ").
                            </div>
                        @else
                            <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                {{ $message }}
                            </div>
                        @endif
                        @enderror
                    </div>
    
                    <div class="flex flex-col w-full gap-3">
                        <label for="nohp">No Handphone :</label>
                        <input type="text" name="nohp" id="nohp" value="{{ $nomorhp ?? "" }}" placeholder="No Handphone"
                        class="border-2 h-12 px-4 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nohp')
                            <div class="text-md text-red-500 mt-1 ms-3 mb-0 text-left">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="flex flex-col w-full gap-3">
                        <label for="email">Email :</label>
                        <input type="text" name="email" id="email" value="{{ $email ?? "" }}" placeholder="Email" disabled
                        class="border-2 h-12 px-4 rounded-lg bg-gray-200 text-gray-500">
                    </div>
    
                    <button onclick="showDataChangeValidation()" type="button" class="w-fit bg-blue-500 px-5 py-2 font-semibold text-lg text-white rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Ubah Data</button>
    
                    {{-- UBAH DATA MODAL START --}}
                    <div class="w-full h-full opacity-0 absolute top-0 left-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="dataChangeModal">
                        <div class="bg-white h-fit w-[35%] rounded-lg shadow-lg py-12 px-10 flex flex-col gap-5 items-center text-center">
                            <i class="text-6xl text-blue-600 fa-solid fa-circle-question"></i>
                            <p class="text-xl font-bold w-[90%]">Apakah Anda yakin ingin mengubah profil Anda?</p>
                            <button onclick="showDataChangeValidation()" type="button" class="bg-gray-300 px-5 w-48 py-2 text-black font-bold rounded-md shadow-md">Batal</button>
                            <button type="submit" class="bg-blue-500 w-48 px-5 py-2 text-white font-bold rounded-md shadow-md" disabled id="btnDataChange">Ubah Profil</button>
                        </div>
                    </div>
                    {{-- UBAH DATA MODAL END --}}
                </form>
    
                <form action="{{ route('profile.update-password') }}" method="POST"
      class="w-full h-fit px-10 py-5 border-2 rounded-md border-gray-300 flex flex-col items-center gap-5">
    @csrf
    <p class="text-2xl font-semibold text-gray-800">Ubah Kata Sandi</p>

    @if (session()->has('success_password'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-sm text-green-600 p-0 m-0 text-center">{{ session('success_password') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <p class="text-sm text-red-500 p-0 m-0 text-center">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="flex flex-col w-full gap-3">
        <label for="current_password">Password Lama :</label>
        <input type="password" name="current_password" id="current_password" placeholder="Password Lama"
               class="border-2 h-12 px-4 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="flex flex-col w-full gap-3">
        <label for="new_password">Password Baru :</label>
        <input type="password" name="new_password" id="new_password" placeholder="Password Baru"
               class="border-2 h-12 px-4 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="flex flex-col w-full gap-3">
        <label for="new_password_confirmation">Konfirmasi Password Baru :</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Konfirmasi Password Baru"
               class="border-2 h-12 px-4 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <button type="submit" class="w-fit bg-blue-500 px-5 py-2 font-semibold text-lg text-white rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
        Ubah Kata Sandi
    </button>
</form>

            </div>
        </div>
    </div>
    <button onclick="deleteAccountFirstValidation()" type="button" class="bg-red-500 text-white px-5 py-2 font-semibold text-lg rounded-lg hover:bg-red-600 transition duration-300" style="margin-left: 890px; margin-top:20px; margin-bottom: 20px;">Hapus Akun</button>                


    <script>
        function showPassword() {
            const inputElement = event.target.previousElementSibling;
            const button = event.target;
            const toggle = button.querySelector('.toggleIcon');

            if (inputElement.type === "password") {
                inputElement.type = "text";
            } else {
                inputElement.type = "password";
            }

            if (toggle.classList.contains('fa-eye')) {
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        const showDataChangeValidation = () => {
            const modal = document.getElementById('dataChangeModal');
            const button = document.getElementById("btnDataChange");
        
            if (modal.classList.contains('hidden')) {
                button.disabled = false;
                requestAnimationFrame(() => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('opacity-100');
                    });
                });
            } else {
                button.disabled = true;
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-100');
                    document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('hidden');
                    });
                });
            }
        }

        const showPassChangeValidation = () => {
            const modal = document.getElementById('passChangeModal');
            const button = document.getElementById("btnPasswordChange");

            if (modal.classList.contains('hidden')) {
                button.disabled = false;
                requestAnimationFrame(() => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('opacity-100');
                    });
                });
            } else {
                button.disabled = true;
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-100');
                    document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('hidden');
                    });
                });
            }
        }

        const deleteAccountFirstValidation = () => {
            const modal = document.getElementById('deleteAccountModal');

            if (modal.classList.contains('hidden')) {
                requestAnimationFrame(() => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('opacity-100');
                    });
                });
            } else {
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-100');
                    document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('hidden');
                    });
                });
            }
        }

        const deleteAccountSecondValidation = () => {
            const previousModal = document.getElementById('deleteAccountModal');

            if (previousModal.classList.contains('hidden') == false) {
                previousModal.classList.add('hidden')
            }

            const modal = document.getElementById('deleteAccountSecondModal');
            const button = document.getElementById("btnDeleteAccount");

            if (modal.classList.contains('hidden')) {
                button.disabled = false;
                requestAnimationFrame(() => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('opacity-100');
                    });
                });
            } else {
                button.disabled = true;
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-100');
                    document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('hidden');
                    });
                });
            }
        }

        
    </script>
</body>
</html>