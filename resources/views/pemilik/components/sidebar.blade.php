<div class="font-TripBold h-screen fixed z-10" id="sidebar" style="transition: 0.3s; background: linear-gradient(270deg, #93c5fd, #6ee7b7); background-size: 400% 400%; animation: gradientAnimation 8s ease infinite; top: 0; left: 0; height: 100vh;">
    <div class="overflow-x-hidden pt-8 flex justify-between items-center px-6" style="transition: 0.3s;">
        <p class="animated-title text-white font-bold px-7 py-1 rounded-xl text-lg">Toko Obat Subur</p>
        <button id="buttonToggle" class="text-mainColor" onclick="sidebar()">
            <i id="toggle" class="fa-solid fa-bars text-2xl"></i>
        </button>
    </div>

    <div class="w-full shadow border border-neutral-200 my-3"></div>

    <div class="overflow-x-hidden text-white mt-6" style="transition: 0.3s;">
        <a href="{{ route('dashboard') }}" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-solid fa-chart-line me-3"></i>
            <p>Dashboard</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="{{ route('list-user') }}" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-regular fa-user me-3"></i>
            <p>User</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="/owner/kasir" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-regular fa-credit-card me-3"></i>
            <p>Kasir</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="/owner/supplier" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery me-1.5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                <path d="M3 9l4 0"></path>
            </svg>
            <p>Supplier</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="/owner/produk" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-solid fa-bag-shopping me-3"></i>
            <p>Produk</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="{{ route('list-selling-transaction') }}" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-regular fa-clipboard me-3"></i>
            <p>Transaksi Penjualan</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="/owner/transaksi-pembelian" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-regular fa-clipboard me-3"></i>
            <p>Transaksi Pembelian</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="/owner/pesanan-pending" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-solid fa-spinner me-3"></i>
            <p>Pesanan Pending</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <a href="/owner/promo" class="flex items-center text-lg hover:bg-blue-400 py-2 px-6 rounded-lg transition-all">
            <i class="fa-regular fa-folder-open me-3"></i>
            <p>Promo</p>
        </a>
    </div>

    <div class="overflow-x-hidden text-white my-4" style="transition: 0.3s;">
        <form action="/logout" method="POST">
            @csrf
            <button class="flex text-lg w-full py-2 px-6 rounded-lg hover:bg-gray-100 transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                <p>Logout</p>
            </button>
        </form>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Animated gradient background */
    .animated-bg {
        background: linear-gradient(270deg, #93c5fd, #6ee7b7);
        background-size: 400% 400%;
        animation: gradientAnimation 8s ease infinite;
    }

    /* Animated text gradient */
    .animated-title {
        background: linear-gradient(90deg, #000000, #d4af37, #000000);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes textAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
</style>

<script>
    const sidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const icon = document.getElementById('toggle');
        
        if (sidebar.classList.contains('w-0')) {
            sidebar.classList.remove('w-0');
            sidebar.classList.add('w-72');  // Set sidebar to open
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-xmark');
        } else {
            sidebar.classList.add('w-0');  // Close sidebar
            sidebar.classList.remove('w-72');
            icon.classList.add('fa-bars');
            icon.classList.remove('fa-xmark');
        }
    }
</script>