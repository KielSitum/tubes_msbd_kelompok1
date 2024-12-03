{{-- SIDEBAR START --}}
<div class="flex">
    <nav class="bg-gradient-to-r from-blue-500 to-blue-700 p-8 w-[15%] shadow-lg fixed left-0 top-0 h-full z-20 flex flex-col gap-8" id="sidebar">
        <div class="flex justify-between w-full mb-6">
            <p class="bg-blue text-white font-bold px-4 py-2 rounded-full text-2xl leading-tight text-left">
                <span class="block">Toko Obat</span>
                <span class="block">Subur</span>
            </p>
        </div>

        <hr class="border border-1 border-gray-200 opacity-40 mb-6">

        <div class="flex flex-col gap-6 text-white text-lg">
            <a href="/cashier" class="flex items-center gap-3 hover:bg-blue-600 p-3 rounded-md transition-colors">
                Kasir
            </a>
            <a href="/cashier/pesanan-online" class="flex items-center gap-3 hover:bg-blue-600 p-3 rounded-md transition-colors">
                Pesanan Online
            </a>
            <a href="/cashier/pesanan-pending" class="flex items-center gap-3 hover:bg-blue-600 p-3 rounded-md transition-colors">
                Pesanan Pending
            </a>
            <a href="/cashier/riwayat-transaksi" class="flex items-center gap-3 hover:bg-blue-600 p-3 rounded-md transition-colors">
                Riwayat Transaksi
            </a>
            <div>
                <button onclick="logoutAlert()" type="button" class="flex items-center gap-3 hover:bg-blue-600 p-3 rounded-md transition-colors">
                    Logout
                </button>
            </div>
        </div>
    </nav>
</div>
{{-- SIDEBAR END --}}

{{-- SIDEBAR END --}}

{{-- LOGOUT ALERT START --}}
<form action="/logout" method="POST" class="w-screen h-screen opacity-0 absolute top-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="logoutAlertPopUp">
    @csrf
    <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
        <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
        <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin ingin keluar dari akun Anda?</p>
        <button onclick="logoutAlert()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Kembali</button>
        <button type="submit" class="bg-mediumRed w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnLogout">Keluar</button>
    </div>
</form>  
{{-- LOGOUT ALERT END --}}

<script>
    const logoutAlert = () => {
        const modal = document.getElementById('logoutAlertPopUp');
        const button = document.getElementById("btnLogout");

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
