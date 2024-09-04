<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-r from-secondaryBlue to-primaryBlue">
    <div class="h-1/2">
        <div class="flex flex-col items-center justify-center h-full gap-2 p-12 text-center align-middle bg-white rounded-lg shadow-xl bg-opacity-90">
            <h1 class="font-extrabold select-none text-secondaryBlue text-8xl">404</h1>
            <p class="mt-4 text-3xl font-semibold text-gray-500">Halaman yang Anda cari tidak ditemukan.</p>
            <div class="mt-8">
                <a href="/"
                    class="inline-block px-10 py-4 text-lg font-bold text-white transition duration-300 ease-in-out rounded-full bg-primaryBlue hover:bg-secondaryBlue">
                    Kembali ke Beranda
                </a>
                <a href="/contact"
                    class="inline-block px-10 py-4 ml-4 text-lg font-bold transition duration-300 ease-in-out bg-white border-2 rounded-full text-primaryBlue border-primaryBlue hover:text-secondaryBlue hover:border-secondaryBlue hover:bg-gray-100">
                    Hubungi Dukungan
                </a>
            </div>
        </div>
    </div>
</body>

</html>
