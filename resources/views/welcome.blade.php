<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

</head>

<body class="text-light" style="background-image: url('{{ asset('assets/background.svg') }}');">
    {{-- Navigation --}}
    <nav class= "px-8 py-4 md:px-auto w-full">
        <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
            <div class="md:order-1">
                <img src="{{ asset('assets/logo.png') }}" class="h-10" alt="Logo GuBook Title">
            </div>
            <div class="order-3 w-full md:w-auto md:order-2">
                <ul class="flex font-semibold justify-between">
                    <li class="md:px-4 md:py-2 hover:text-lightBlue2 hover:underline hover:underline-offset-8"><a
                            href="#">Beranda</a></li>
                    <li class="md:px-4 md:py-2 hover:text-lightBlue2 hover:underline hover:underline-offset-8"><a
                            href="#">Pegawai</a></li>
                    <li class="md:px-4 md:py-2 hover:text-lightBlue2 hover:underline hover:underline-offset-8"><a
                            href="#">Tentang</a></li>
                </ul>
            </div>
            <div class="order-2 md:order-3">
                <button
                    class="ml-12 px-4 py-2 bg-lightBlue hover:bg-lightBlue2 text-primaryBlue hover:text-secondaryBlue font-bold rounded-lg flex items-center gap-2">
                    Login
                </button>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center mt-32">
            <div class="">
                <img src="{{ asset('assets/logo2.png') }}" class="h-48" alt="Logo GuBook">
            </div>
            <div class="text-center flex flex-col">
                <h1 class="text-light">Selamat Datang di GuBook</h1>
                <p class="text-light font-medium">Datanglah dengan <span class="font-semibold">Senang Hati,</span> Kami
                    Layani <span class="font-semibold">Sepenuh Hati</span></p>
            </div>
            <div class="mt-6">
                <a class="flex gap-2 group bg-secondaryBlue rounded-2xl py-5 px-14" href="#">
                    <div class="h-6 w-6 overflow-hidden">
                        <img src="{{ asset('assets/icons/plus.svg') }}" class="invert transition-all duration-200 h-0 group-hover:h-7 group-hover:block " alt="">
                    </div>
                    <span class="font-semibold text-lg transition-all duration-200 -translate-x-4 group-hover:translate-x-2">Buat Pertemuan</span>
                </a>
            </div>
        </div>
    </main>

</body>

</html>
