<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Biblioteca Digital') }}</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        header {
            background: transparent;
            color: white;
            text-align: center;
            padding: 3rem 1rem 1.5rem;
        }

        header h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        main {
            background: #ffffff;
            border-radius: 20px;
            margin: 2rem auto;
            padding: 2.5rem;
            max-width: 1100px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        main:hover {
            transform: translateY(-3px);
        }

        footer {
            text-align: center;
            color: #fff;
            opacity: 0.85;
            font-size: 0.9rem;
            padding: 2rem 1rem;
        }

        /* Colores claros y oscuros */
        .dark main {
            background: #ffffffff;
            color: #f3f4f6;
        }

        .dark footer {
            color: #ddd;
        }

        /* Ajuste visual del nav */
        nav {
            background-color: rgba(17, 24, 39, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Navegación -->
        @include('layouts.navigation')

        <!-- Encabezado del Dashboard -->
        @isset($header)
            <header>
                {{ $header }}
            </header>
        @endisset

        <!-- Contenido principal -->
        <main>
            {{ $slot }}
        </main>

        <!-- Pie de página -->
        <footer>
            &copy; {{ date('Y') }} Biblioteca Digital — Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>
