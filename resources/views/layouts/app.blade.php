<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="app-bg min-h-screen font-sans text-gray-900">
        <header class="w-full p-6 lg:p-8 flex justify-end">
            <nav class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-outline">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-ghost">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main class="container mx-auto p-6">
            @yield('content')
        </main>

    </body>
</html>
