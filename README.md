# Toko Obat Subur Tigarunggu

## Daftar Isi
- [Anggota](#anggota)
- [Tentang Aplikasi](#tentang-aplikasi)
- [Environment](#environment)
- [Instalasi](#instalasi)

## Anggota
- **Euprasia Enjelika Situmorang** (231402013)  
- **Yehezkiel Situmorang** (231402061)  
- **Jonathan Del Piero Manik** (231402095)  
- **Jonathan C. Amadeo Sembiring** (231402111)  

## Tentang Aplikasi
**Toko Obat Subur Tigarunggu** adalah platform yang dikembangkan sebagai bagian dari tugas besar mata kuliah Manajemen Sistem Basis Data di Program Studi Teknologi Informasi, Universitas Sumatera Utara.
Website ini dirancang untuk:
- Mempermudah pencarian dan pemesanan obat-obatan secara online.
- Menyediakan antarmuka yang intuitif untuk kenyamanan pelanggan.
- Membantu pihak owner dalam mengelola data secara efisien dan terorganisir.

## Environment
- **PHP Version**: 8.1  
- **Laravel Version**: 10  
- **Development Tool**: Laragon  

## Instalasi
   - #### Start Laragon
   - #### Clone This Repository
      Git clone https://github.com/KielSitum/tubes_msbd_kelompok1.git
   - #### Open VSCode
   - #### Jalankan perintah berikut:
         - composer install atau composer update
         - npm install
         - cp .env.example .env
         - Tambahkan ini di file .env supaya saat adanya penggunaan user privilege yang berbeda

            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=tokoobat
            DB_USERNAME=root
            DB_PASSWORD=

            DB_HOST_CUSTOMER=127.0.0.1
            DB_PORT_CUSTOMER=3306
            DB_DATABASE_CUSTOMER=tokoobat
            DB_USERNAME_CUSTOMER=root
            DB_PASSWORD_CUSTOMER=    

            DB_HOST_CASHIER=127.0.0.1
            DB_PORT_CASHIER=3306
            DB_DATABASE_CASHIER=tokoobat
            DB_USERNAME_CASHIER=root
            DB_PASSWORD_CASHIER=           

            DB_HOST_OWNER=127.0.0.1
            DB_PORT_OWNER=3306
            DB_DATABASE_OWNER=tokoobat
            DB_USERNAME_OWNER=root
            DB_PASSWORD_OWNER=

         - Ubah Pengaturan Mail
            MAIL_MAILER=smtp
            MAIL_HOST=smtp.gmail.com
            MAIL_PORT=465
            MAIL_USERNAME="Emailmu"
            MAIL_PASSWORD="password" 
            MAIL_ENCRYPTION=null
            MAIL_FROM_ADDRESS="Emailmu"
            MAIL_FROM_NAME="${APP_NAME}"

            Untuk mendapatkan passwordnya, buka Google Chrome, klik profile, lalu tekan "Manage Your Google Account", lalu search "Sandi Aplikasi" atau "App Password". Lalu buat nama aplikasi "tokoobat". Setelah itu akan ditampilkan 4 kalimat dengan 4 huruf acak. Copy kalimat tersebut dan letakkan pada Mail_Password dengan spasi pada tiap kalimat dihapus, jadi 4 kalimat tersebut digabung.

         - php artisan key:generate
         - php artisan migrate
         - php artisan db:seed
         - php artisan serve
         - npm run dev
