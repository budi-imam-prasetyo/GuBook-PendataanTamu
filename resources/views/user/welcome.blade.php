<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="h-screen bg-cover example text-light"
    style="background-image: url('{{ asset('assets/background.svg') }}')">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center mt-32">
            <div class="">
                <img src="{{ asset('assets/logo2.png') }}" class="h-48" alt="Logo GuBook" />
            </div>
            <div class="flex flex-col text-center">
                <h1 class="text-xl text-light">Selamat Datang di GuBook</h1>
                <p class="text-lg font-medium text-light">
                    Datanglah dengan
                    <span class="font-semibold">Senang Hati,</span>
                    Kami Layani
                    <span class="font-semibold">Sepenuh Hati</span>
                </p>
            </div>
            {{-- {{$qrcode}} --}}
            <div class="mt-6">
                <a class="flex gap-2 py-5 group rounded-2xl bg-secondaryBlue px-14" href="/form-tamu">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="{{ asset('assets/icons/plus.svg') }}"
                            class="h-0 transition-all duration-200 group-hover:block group-hover:h-6" alt="" />
                    </div>
                    <span
                        class="text-lg font-semibold transition-all duration-200 -translate-x-4 group-hover:translate-x-2">
                        Buat Pertemuan
                    </span>
                </a>
            </div>
        </div>
    </main>
</body>

</html>
