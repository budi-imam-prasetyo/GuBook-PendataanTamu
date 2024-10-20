<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Sesi Halaman Kedaluwarsa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-gradient-to-br from-primaryBlue to-secondaryBlue">
    <div class="w-full max-w-lg overflow-hidden bg-white shadow-2xl rounded-2xl">
        <div class="p-8 text-center">
            <div class="relative mb-6">
                <h1 class="mb-4 font-bold text-transparent text-9xl bg-clip-text bg-gradient-to-r from-primaryBlue to-secondaryBlue">419</h1>
            </div>
            
            <h2 class="mb-2 text-2xl font-semibold text-gray-800">Sesi Halaman Kedaluwarsa</h2>
            <p class="mb-8 text-gray-600">Maaf, sesi halaman Anda telah kedaluwarsa. Silakan muat ulang halaman atau kembali ke halaman sebelumnya.</p>
            
            <div class="space-y-4">
                <a href="javascript:window.location.reload()" class="flex items-center justify-center w-full px-6 py-3 font-semibold text-white transition-all duration-300 ease-in-out rounded-lg shadow-md bg-gradient-to-r from-primaryBlue to-secondaryBlue hover:opacity-90 group">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Muat Ulang Halaman
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