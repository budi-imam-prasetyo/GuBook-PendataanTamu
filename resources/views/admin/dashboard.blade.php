<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Dashboard</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans text-base antialiased font-medium no-scrollbar bg-gray-50 leading-default text-slate-500">
    @apexchartsScripts
    <div class="absolute w-full min-h-80 bg-primaryBlue"></div>
    <!-- sidenav  -->
    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out rounded-xl xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar>Dashboard</x-admin.navbar>

        <!-- cards -->
        <div class="w-full p-6 mx-auto">
            <!-- row 1 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                <!-- Card 1: Kunjungan Tamu Hari Ini -->
                <div class="col-span-1 sm:col-span-1 xl:col-span-1">
                    <div
                        class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Tamu Hari Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $tamuHariIni }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-4 rounded-full">
                                    <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6 w-6 text-white"
                                        alt="Ikon Grup Pengguna">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-lightBlue to-indigo-50 px-6 py-3">
                            <p class="text-xs font-medium text-blue-600">
                                <span class="inline-block mr-1">{{ $persentaseTamuHarian >= 0 ? '↑' : '↓' }}</span>
                                {{ number_format(abs($persentaseTamuHarian), 0) }}%
                                {{ $persentaseTamuHarian >= 0 ? 'bertambah' : 'berkurang' }} dari kemarin
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Kunjungan Minggu & Bulan Ini -->
                <div class="col-span-1 sm:col-span-2 xl:col-span-2 sm:order-1 xl:order-none">
                    <div
                        class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Kunjungan Minggu Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $totalMingguIni }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-orange-500 to-yellow-500 p-4 rounded-full ml-4">
                                    <img src="{{ asset('assets/icons/calendar.svg') }}" class="h-7 w-7 text-white"
                                        alt="Calendar Icon">
                                </div>
                                <div class="flex-1 text-right">
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Kunjungan Bulan Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $totalBulanIni }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-orange-50 to-yellow-50 px-6 py-3 flex justify-between">
                            <p class="text-xs font-medium text-orange-600">
                                <span
                                    class="inline-block mr-1">{{ $persentaseKenaikanMingguan >= 0 ? '↑' : '↓' }}</span>
                                {{ number_format(abs($persentaseKenaikanMingguan), 0) }}%
                                {{ $persentaseKenaikanMingguan >= 0 ? 'bertambah' : 'berkurang' }} dari minggu kemarin
                            </p>
                            <p class="text-xs font-medium text-yellow-600">
                                <span class="inline-block mr-1">{{ $persentaseKenaikan >= 0 ? '↑' : '↓' }}</span>
                                {{ number_format(abs($persentaseKenaikan), 0) }}%
                                {{ $persentaseKenaikan >= 0 ? 'bertambah' : 'berkurang' }} dari bulan kemarin
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Kunjungan Kurir Hari Ini -->
                <div class="col-span-1 sm:col-span-1 xl:col-span-1">
                    <div
                        class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="bg-gradient-to-br from-red-500 to-pink-600 p-4 rounded-full">
                                    <img src="{{ asset('assets/icons/box.svg') }}" class="h-6 w-6 text-white"
                                        alt="Box Icon">
                                </div>
                                <div class="flex-1 text-right">
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Kurir Hari Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $kurirHariIni }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-3">
                            <p class="text-xs font-medium text-red-600 text-right">
                                <span class="inline-block mr-1">{{ $persentaseKurirHarian >= 0 ? '↑' : '↓' }}</span>
                                {{ number_format(abs($persentaseKurirHarian), 0) }}%
                                {{ $persentaseKurirHarian >= 0 ? 'bertambah' : 'berkurang' }} dari kemarin
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- cards row 1 -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3 mt-0 lg:flex-none">
                    <div
                        class="relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-dark/12.5 bg-white bg-clip-border shadow">
                        <div class="mb-0 rounded-2xl border-b-0 border-solid border-dark/12.5 p-6 pb-0 pt-4">
                            <h6 class="capitalize">Grafik Bulan Ini</h6>
                            <p class="mb-0 text-sm leading-normal">
                                <i class="fa fa-arrow-up text-emerald-500"></i>
                                <span class="font-semibold">
                                    {{ abs(round($persentaseKenaikan, 2)) }}%
                                    @if ($persentaseKenaikan >= 0)
                                        lebih banyak
                                    @else
                                        lebih sedikit
                                    @endif
                                </span>
                                dari Bulan Sebelumnya
                            </p>

                            <div class="">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cards row 2 -->

            <div class="w-full max-w-full mt-6 md:flex-none">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-lg rounded-2xl overflow-hidden bg-clip-border">
                    <div class="flex justify-between items-center p-6 border-b bg-primaryBlue text-white">
                        <h2 class="text-xl font-bold">Daftar Kunjungan</h2>
                        @if ($kedatangan->isNotEmpty())
                            <a href="{{ route('admin.kunjungan') }}" class="flex items-center text-white group">
                                <span class="mr-1">Lihat Semua</span>
                                <svg class="w-4 h-4group-hover:translate-x" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div role="tablist" class="tabs tabs-bordered w-full mx-auto my-4">

                        <input type="radio" name="my_tabs" role="tab" class="tab"
                            aria-label="Pertemuan Hari Ini" checked/>
                        <div role="tabpanel" class="tab-content p-4">
                            @if ($hari_ini->isEmpty())
                                <p class="text-center text-gray-500">Tidak ada pertemuan hari ini.</p>
                            @else
                                @foreach ($hari_ini as $item)
                                    @include('components.kedatanganTamu', ['item' => $item])
                                @endforeach
                            @endif
                        </div>

                        <input type="radio" name="my_tabs" role="tab" class="tab"
                            aria-label="Menunggu Konfirmasi" />
                        <div role="tabpanel" class="tab-content p-4">
                            @if ($menunggu->isEmpty())
                                <p class="text-center text-gray-500">Tidak ada kunjungan yang menunggu konfirmasi hari
                                    ini.</p>
                            @else
                                @foreach ($menunggu as $item)
                                    @include('components.kedatanganTamu', ['item' => $item])
                                @endforeach
                            @endif
                        </div>
                        <input type="radio" name="my_tabs" role="tab" class="tab" aria-label="Selesai"/>
                        <div role="tabpanel" class="tab-content p-4">
                            @if ($selesai->isEmpty())
                                <p class="text-center text-gray-500">Tidak ada kunjungan selesai hari ini.</p>
                            @else
                                @foreach ($selesai as $item)
                                    @include('components.kedatanganTamu', ['item' => $item])
                                @endforeach
                            @endif
                        </div>

                        <input type="radio" name="my_tabs" role="tab" class="tab" aria-label="Ditolak" />
                        <div role="tabpanel" class="tab-content p-4">
                            @if ($ditolak->isEmpty())
                                <p class="text-center text-gray-500">Tidak ada kunjungan yang ditolak hari ini.</p>
                            @else
                                @foreach ($ditolak as $item)
                                    @include('components.kedatanganTamu', ['item' => $item])
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end cards -->
        <x-admin.footer />
    </main>
    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

    {{ $chart->script() }}
    <!-- plugin for scrollbar  -->
    {{-- <script src="{{ asset('js/perfect-scrollbar.min.js') }}" async></script> --}}
    <script src="{{ asset('js/argon-dashboard-tailwind.js') }}" async></script>
    <script src="{{ asset('js/sidenav-burger.js') }}" async></script>
    <!-- Initialize QR Code Scanner -->

    <script>
        $(document).ready(function() {
            // Handle tab button click
            $('.tab-button').click(function() {
                // Remove active class from all buttons and add to the clicked one
                $('.tab-button').removeClass('active');
                $(this).addClass('active');

                // Get the status from data attribute
                var status = $(this).data('status');

                // Hide all tab content and show the selected one
                $('.tab-content').addClass('hidden'); // Sembunyikan semua tab
                $('.' + status).removeClass('hidden'); // Tampilkan tab yang dipilih
            });
        });
    </script>

</body>

</html>
