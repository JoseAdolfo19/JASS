<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JASS - Water Conservation</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        body {
           background-image: url('https://blogcusco.com/wp-content/uploads/catarata-arin02.webp'); /* Cambia esto por la URL de tu imagen */
           background-size: cover; 
            color: #004D40; /* Dark teal for text */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Instrument Sans', sans-serif;
        }
        .header {
            width: 100%;
            max-width: 600px;
            text-align: center;
            margin-bottom: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #00796B; /* Teal */
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #004D40; /* Darker teal */
        }
        .content {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #00695C; /* Darker teal */
        }
    </style>
</head>
<body>
    <header class="header">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="button">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="button">Iniciar Secion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button">Registrar</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div class="content">
        <h1>Bienbenido a JASS</h1>
        <p>Un sistema para una mejor organizacion y agilizacion de trabajo!</p>
        <ul>
            <li>Cuenta con gestion de asociados.</li>
            <li>Una mejor organizacion para asabmbleas y faenas.</li>
            <li>Sera mas facil hacer el seguimoiento de consumo de agua!</li>
        </ul>
    </div>
    <!-- <div>
        <footer class="footer">
            &copy; 2025 JASS - Water Conservation Management System
        </footer>
    </div> -->
</body>
</html>