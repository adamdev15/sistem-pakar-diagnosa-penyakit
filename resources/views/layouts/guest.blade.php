<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Pakar') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-green-50 via-white to-green-100">
        
        <!-- Background Ornaments -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-green-200/50 blur-[100px]"></div>
            <div class="absolute top-[60%] -right-[10%] w-[50%] h-[50%] rounded-full bg-green-300/30 blur-[120px]"></div>
        </div>

        <div class="z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white/80 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-white/50">
            <div class="flex justify-center mb-8">
                <a href="/" class="flex items-center gap-3 group">
                    <x-application-logo class="w-12 h-12 object-contain group-hover:scale-105 transition-transform duration-300" />
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-700 to-green-500">
                        Pakar<span class="font-light">Medis</span>
                    </span>
                </a>
            </div>

            {{ $slot }}
        </div>
        
        <div class="mt-8 text-center text-sm text-gray-500 z-10">
            &copy; {{ date('Y') }} Sistem Pakar Diagnosa Penyakit. All rights reserved.
        </div>
    </div>
</body>
</html>
