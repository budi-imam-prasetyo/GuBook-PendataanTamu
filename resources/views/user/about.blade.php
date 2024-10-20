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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-secondaryBlue to-primaryBlue text-light">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    {{-- Hero Section --}}
    <section class="relative h-screen flex items-center justify-center transition-all duration-500">
        <div class="absolute inset-0 bg-cover bg-center z-10 container transition-all duration-500 rounded-xl h-100 p-0 overflow-hidden" style="background-image: url('{{ asset('assets/jumbotron.jpeg') }}');">
            <div class="relative z-20 flex flex-col items-center justify-center h-full w-full text-center text-white backdrop-blur-sm">
                <h1 class="text-4xl md:text-5xl font-bold transition-all duration-500">Datanglah dengan Senang Hati! <br>Kami layani sepenuh hati.</h1>
                <p class="mt-4 text-xl transition-all duration-500">Mari kita membuat pengalaman kunjungan Anda lebih mudah dan aman.</p>
            </div>
        </div>
    </section>

    {{-- Mengapa Kami Penting Section --}}
    <section class="bg-lightBlue py-12 text-center">
        <h2 class="text-3xl font-bold mb-8">Mengapa Kami Penting?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <i class="fas fa-shield-alt text-4xl mb-4 text-primaryBlue"></i>
                <h3 class="text-xl font-semibold mb-2">Keamanan Terjamin</h3>
                <p>Dengan mendaftar, Anda membantu kami menjaga keamanan lingkungan sekolah.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <i class="fas fa-user-check text-4xl mb-4 text-primaryBlue"></i>
                <h3 class="text-xl font-semibold mb-2">Kenyamanan Kunjungan</h3>
                <p>Membantu kami menyambut Anda dengan lebih baik dan mempercepat waktu tunggu.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <i class="fas fa-file-alt text-4xl mb-4 text-primaryBlue"></i>
                <h3 class="text-xl font-semibold mb-2">Pemenuhan Regulasi</h3>
                <p>Menyokong komitmen kami dalam mematuhi standar keamanan dan regulasi sekolah.</p>
            </div>
        </div>
    </section>

    {{-- Kontak Kami Section --}}
    <section class="bg-primaryBlue py-12 text-white text-center">
        <h2 class="text-3xl font-bold mb-8">Kontak Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0006691416984!2d107.55575517514706!3d-6.890521767427951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMKN%2011%20Bandung!5e0!3m2!1sid!2sid!4v1727232727553!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="text-left">
                <p><strong>Alamat:</strong> Jl. Raya Cilembang, Sukaraja, Kec. Cicendo, Kota Bandung</p>
                <p><strong>Email:</strong> smkn11bdg@gmail.com</p>
                <p><strong>Telepon:</strong> 022-6652442</p>
                <p><strong>Instagram:</strong> @info.smkn11bandung</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-darkBlue text-center text-white py-6">
        <div class="flex justify-center items-center mb-4">
            <img src="{{ asset('assets/logo2.png') }}" alt="Logo" class="h-12 mr-2">
            <span>SMKN 11 Bandung | GuBook</span>
        </div>
        <p>© 2024 SMKN 11 Bandung. All rights reserved.</p>
    </footer>

</body>

</html>
