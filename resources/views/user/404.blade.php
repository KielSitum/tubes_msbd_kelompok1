<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    {{-- TailwindCSS (Make sure you have this in your project) --}}
    <style>
        /* Background gradient with modern blue tones */
        body {
            background: linear-gradient(135deg, #0066cc, #00bcd4); /* Modern blue gradient */
        }

        /* Glow animation for text */
        @keyframes glow {
            0% { text-shadow: 0 0 5px #fff, 0 0 10px #00bcd4, 0 0 20px #00bcd4, 0 0 30px #00bcd4, 0 0 40px #00bcd4, 0 0 50px #00bcd4, 0 0 75px #00bcd4; }
            50% { text-shadow: 0 0 10px #fff, 0 0 20px #00bcd4, 0 0 30px #00bcd4, 0 0 40px #00bcd4, 0 0 50px #00bcd4, 0 0 75px #00bcd4; }
            100% { text-shadow: 0 0 5px #fff, 0 0 10px #00bcd4, 0 0 20px #00bcd4, 0 0 30px #00bcd4, 0 0 40px #00bcd4, 0 0 50px #00bcd4, 0 0 75px #00bcd4; }
        }

        .glowing-text {
            font-weight: bold;
            animation: glow 1.5s ease-in-out infinite;
        }

        /* Button Hover Effect */
        .btn-hover {
            background-color: #1e3a8a; /* Deep blue */
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            background-color: #3b82f6; /* Light blue on hover */
            transform: translateY(-4px);
        }

        /* Center content */
        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            flex-direction: column;
            gap: 20px;
        }

        .title {
            font-size: 80px;
            color: #fff;
        }

        .subtitle {
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .description {
            font-size: 18px;
            color: #f0f0f0;
            width: 80%;
        }

        .home-link {
            display: inline-block;
            padding: 15px 30px;
            background: #0066cc;
            color: white;
            font-size: 20px;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .home-link:hover {
            background: #00bcd4;
            transform: scale(1.05);
        }
    </style>
</head>

<body class="font-Roboto">
    <div class="content-container">
        <p class="title glowing-text">Oops!</p>
        <p class="subtitle">404 - HALAMAN TIDAK TERSEDIA</p>
        <p class="description">Halaman yang anda cari mungkin sudah dihapus, berubah penamaan, atau sedang tidak tersedia.</p>
        <a href="/" class="home-link btn-hover">Kembali ke Website</a>
    </div>
</body>

</html>
