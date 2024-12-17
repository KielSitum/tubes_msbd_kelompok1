<!-- SIDEBAR START -->
<div class="flex">
    <nav class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 w-64 md:w-[15%] shadow-lg fixed left-0 top-0 h-full z-20 flex flex-col justify-between gap-6 animated-bg" id="sidebar">
        <!-- Title -->
        <div class="flex justify-center items-center mb-6">
            <p class="animated-title text-white font-bold text-2xl leading-tight text-center">
                <span class="block">Toko Obat</span>
                <span class="block">Subur</span>
            </p>
        </div>

        <hr class="border border-1 border-gray-300 opacity-30 mb-4">

        <!-- Menu Items -->
        <div class="flex flex-col gap-4 text-white text-lg flex-grow">
            <a href="/cashier" class="flex items-center gap-3 p-3 rounded-md bg-gray-800 hover:bg-blue-400 hover:text-gray-900 hover:shadow-lg transition-all">
                <i class="fas fa-cash-register"></i> Kasir
            </a>
            <a href="/cashier/pesanan-online" class="flex items-center gap-3 p-3 rounded-md bg-gray-800 hover:bg-blue-400 hover:text-gray-900 hover:shadow-lg transition-all">
                <i class="fas fa-shopping-cart"></i> Pesanan Online
            </a>
            <a href="/cashier/pesanan-pending" class="flex items-center gap-3 p-3 rounded-md bg-gray-800 hover:bg-blue-400 hover:text-gray-900 hover:shadow-lg transition-all">
                <i class="fas fa-clock"></i> Pesanan Pending
            </a>
            <a href="/cashier/riwayat-transaksi" class="flex items-center gap-3 p-3 rounded-md bg-gray-800 hover:bg-blue-400 hover:text-gray-900 hover:shadow-lg transition-all">
                <i class="fas fa-history"></i> Riwayat Transaksi
            </a>
        </div>

        <!-- Logout Button -->
        <div>
            <button onclick="logoutAlert()" type="button" class="flex items-center justify-center gap-3 p-3 text-white rounded-md bg-red-600 hover:bg-red-700 hover:shadow-md transition-all">
                Logout
            </button>
        </div>
    </nav>
</div>
<!-- SIDEBAR END -->

<!-- Custom Logout Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
    <div class="bg-white p-10 rounded-xl shadow-2xl w-[90%] md:w-[30rem] max-w-full">
        <h2 class="text-3xl font-bold text-gray-700 mb-6 text-center">Confirm logout</h2>
        <p class="text-lg text-gray-500 mb-8 text-center">Are you sure you want to log out?</p>
        <form method="POST" action="/logout" class="flex justify-center gap-6">
            @csrf
            <button type="button" onclick="closeLogoutModal()" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-all">
                Cancel
            </button>
            <button type="submit" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-all">
                OK
            </button>
        </form>
    </div>
</div>

<!-- Custom Styles -->
<style>
/* Custom styles */
#sidebar {
    font-family: 'Arial', sans-serif;
    display: flex;
}

#sidebar p {
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: bold;
}

#sidebar a, #sidebar button {
    transition: all 0.3s ease;
    cursor: pointer;
}

#sidebar a:hover, #sidebar button:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

hr {
    border: none;
    border-top: 1px solid rgba(255, 255, 255, 0.5);
}

/* Animated gradient background */
.animated-bg {
    background: linear-gradient(270deg, #93c5fd, #6ee7b7);
    background-size: 400% 400%;
    animation: gradientAnimation 8s ease infinite;
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

/* Animated text gradient */
.animated-title {
    background: linear-gradient(90deg, #000000, #d4af37, #000000);
    background-size: 400% 400%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: textAnimation 6s ease infinite;
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

/* Modal Fade-In Animation */
#logoutModal {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Adjustment */
@media (max-width: 768px) {
    #sidebar {
        width: 50%;
        padding: 4%;
    }
    #sidebar p {
        font-size: 1.5rem;
    }

    #logoutModal .w-[30rem] {
        width: 95%;
    }
}
</style>

<!-- JavaScript -->
<script>
function logoutAlert() {
    // Menampilkan modal
    document.getElementById('logoutModal').classList.remove('hidden');
}

function closeLogoutModal() {
    // Menyembunyikan modal
    document.getElementById('logoutModal').classList.add('hidden');
}
</script>

<!-- FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>