<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-gradient-to-br from-primaryBlue to-secondaryBlue">
    <div class="w-full max-w-lg overflow-hidden bg-white shadow-2xl rounded-2xl">
        <div class="p-8 text-center">
            <div class="relative mb-6">
                <h1 class="mb-4 font-bold text-transparent text-9xl bg-clip-text bg-gradient-to-r from-primaryBlue to-secondaryBlue">404</h1>
            </div>
            
            <h2 class="mb-2 text-2xl font-semibold text-gray-800">Halaman Tidak Ditemukan</h2>
            <p class="mb-8 text-gray-600">Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.</p>
            
            <div class="grid gap-4">
                <a href="/" class="flex items-center justify-center w-full px-6 py-3 font-semibold text-white transition-all duration-300 ease-in-out rounded-lg shadow-md bg-gradient-to-r from-primaryBlue to-secondaryBlue hover:opacity-90">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Beranda
                </a>

                <a href="javascript:history.back()" class="flex items-center justify-center w-full px-6 py-3 font-semibold text-blue-600 transition-all duration-300 ease-in-out bg-white border border-blue-600 rounded-lg shadow-md hover:bg-blue-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>
</body>

</html>