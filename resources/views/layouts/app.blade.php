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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
            color: #333;
        }

        .min-h-screen {
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: white;
            padding: 2.5rem 1rem;
            margin: 0 1rem 2rem;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
        }

        header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        header p {
            font-size: 1rem;
            opacity: 0.95;
            font-weight: 500;
        }

        main {
            background: #ffffff;
            border-radius: 16px;
            margin: 0 1rem 2rem;
            padding: 2rem;
            flex: 1;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
            max-width: 1200px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        main:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            padding: 1.5rem;
            font-weight: 500;
            margin-top: auto;
        }

        nav {
            background: linear-gradient(90deg, rgba(31, 41, 55, 0.95) 0%, rgba(51, 65, 85, 0.95) 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Mejoras de tipografía */
        h1 { font-size: 2rem; font-weight: 700; letter-spacing: -0.5px; }
        h2 { font-size: 1.75rem; font-weight: 700; letter-spacing: -0.5px; }
        h3 { font-size: 1.5rem; font-weight: 600; }
        h4 { font-size: 1.25rem; font-weight: 600; }
        h5 { font-size: 1.1rem; font-weight: 600; }
        h6 { font-size: 1rem; font-weight: 600; }

        p { line-height: 1.6; }

        /* Responsive */
        @media (max-width: 768px) {
            header { padding: 1.5rem 1rem; }
            header h2 { font-size: 1.75rem; }
            main { padding: 1.5rem; margin: 0 0.5rem 1.5rem; }
            footer { padding: 1rem; }
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
