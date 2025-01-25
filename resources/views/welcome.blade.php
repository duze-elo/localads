<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tablica ogłoszeń</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 pt-10">
                    <div class="font-bold text-gray-900 text-5xl">
                        <img src="{{ asset('images/Logo.png') }}" alt="LocalAds" class="h-20 w-20 inline-block align-middle mr-4 object-contain">LocalAds
                    </div>
                    @if (Route::has('login'))
                        <div class="space-x-4 text-2xl">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Panel</a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 hover:text-3xl hover:duration-200 duration-200">Logowanie</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900 hover:text-3xl hover:duration-200 duration-200">Rejestracja</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <div class="mt-20 text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Witaj w LocalAds, Twojej tablicy ogłoszeń
                    </h1>
                    <p class="text-2xl text-gray-900 mb-8">
                        Przeglądaj, dodawaj i zarządzaj ogłoszeniami w prosty sposób
                    </p>
                    <div class="space-x-4">
                        @auth
                            <a href="{{ route('advertisements.index') }}" class="text-2xl inline-block border-2 border-gray-600 text-gray-600 px-6 py-3 rounded-lg hover:border-gray-900 hover:text-gray-900 hover:scale-110 duration-200">
                                Przeglądaj ogłoszenia
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-2xl inline-block border-2 border-gray-600 text-gray-600 px-6 py-3 rounded-lg hover:border-gray-900 hover:text-gray-900 hover:scale-110 duration-200">
                                Jestem członkiem
                            </a>
                            <a href="{{ route('register') }}" class="text-2xl inline-block border-2 border-gray-600 text-gray-600 px-6 py-3 rounded-lg hover:border-gray-900 hover:text-gray-900 hover:scale-110 duration-200">
                                Dołącz do nas
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>