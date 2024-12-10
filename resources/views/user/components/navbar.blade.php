<nav class="navbar shadow-lg fixed top-0 left-0 w-full z-50 transition-colors duration-300 rounded-b-xl" id="navbar">
    <div class="container max-w-full mx-auto px-4 md:px-24 flex justify-between items-center h-20">
        <!-- Logo -->
        <a href="/" class="navbar-title text-[#3498db] font-bold text-2xl" style="font-family: 'Poppins', sans-serif;">
            Toko Obat Subur
        </a>

        <!-- Menu -->
        <div class="flex gap-6 items-center" style="font-family: 'Poppins', sans-serif;">
            @guest
            <a href="/login" class="btn-secondary navbar-btn">Masuk</a>
            @else
                @if (auth()->user()->role == 'user')
                <a href="/produk" class="menu-link">Produk</a>
                <a href="/keranjang" class="menu-link">Keranjang</a>
                <a href="/riwayat-pesanan" class="menu-link">Riwayat Pesanan</a>
                <div class="relative">
                    <button onclick="toggleProfile()" class="menu-link">
                        Profil
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="dropdown-menu hidden">
                        <a href="/user-profile" class="dropdown-item">Profile</a>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
                @elseif (auth()->user()->role == 'cashier' || auth()->user()->role == 'owner')
                <a href="/{{ auth()->user()->role }}" class="btn-primary">Dashboard</a>
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-danger">Logout</button>
                </form>
                @endif
            @endguest
        </div>
    </div>
</nav>

<!-- Space for fixed navbar -->
<div class="h-16"></div>

<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="scroll-top-btn hidden" onclick="scrollToTop()">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<script>
    // Toggle Profile Dropdown
    const toggleProfile = () => {
        const menu = document.getElementById('dropdownMenu');

        if (menu.classList.contains('hidden')) {
            requestAnimationFrame(() => {
                menu.classList.remove('hidden');
                requestAnimationFrame(() => {
                    menu.classList.add('opacity-100');
                });
            });
        } else {
            requestAnimationFrame(() => {
                menu.classList.remove('opacity-100');
                requestAnimationFrame(() => {
                    menu.classList.add('hidden');
                });
            });
        }
    };

    const menu = document.querySelector('#dropdownMenu');

    document.addEventListener('click', (event) => {
        if (event.target !== menu) {
            menu.classList.add('hidden');
            menu.classList.remove('opacity-100');
            menu.classList.add('opacity-0');
        }
    });

</script>

<style>
    /* Navbar Style */
    .navbar {
        background-color: #ffeaa3;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .navbar.scrolled {
        background-color: #2d98da !important; /* Light Blue */
    }

    .navbar-title {
        transition: color 0.3s;
    }

    .navbar.scrolled .navbar-title {
        color: #ffeaa3 !important; /* Cream */
    }

    .menu-link {
        font-size: 1rem;
        color: #3498db;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .menu-link:hover {
        color: #2980b9;
    }

    /* Button Styles */
    .btn-primary {
        background-color: #2980b9;
        color: #ffeaa3;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        transition: background-color 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary:hover {
        background-color: #1a5780;
    }

    .btn-secondary {
        background-color: transparent;
        color: #2980b9;
        border: 2px solid #2980b9;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .navbar.scrolled .btn-secondary {
        color: #ffeaa3 !important; /* Cream */
        border-color: #ffeaa3 !important;
    }

    .btn-secondary:hover {
        background-color: #2980b9;
        color: #ffeaa3;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: #ffeaa3;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        transition: background-color 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        width: 12rem;
        background-color: #ffeaa3;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        z-index: 10;
        font-family: 'Poppins', sans-serif;
    }

    .dropdown-item {
        display: block;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: #3498db;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .dropdown-item:hover {
        background-color: #f5f5f5;
        color: #2980b9;
    }

    /* Scroll to Top Button */
    .scroll-top-btn {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        background-color: #2980b9;
        color: #ffeaa3;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .scroll-top-btn:hover {
        transform: scale(1.1);
        background-color: #1a5780;
    }
</style>

<script>
    // Change Navbar Class on Scroll
    window.onscroll = () => {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };
</script>