<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Dashboard</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="m-0 font-sans text-base antialiased font-medium no-scrollbar bg-gray-50 leading-default text-slate-500">
    @apexchartsScripts
    <div class="absolute w-full min-h-80 bg-primaryRed"></div>
    <!-- sidenav  -->
    <x-pegawai.sidebar></x-pegawai.sidebar>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out rounded-xl xl:ml-68">
        <!-- Navbar -->
        <x-pegawai.navbar>Dashboard</x-pegawai.navbar>

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
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Tamu Hari
                                        Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $tamuHariIni }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-red-500 to-red-600 p-4 rounded-full">
                                    <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6 w-6 text-white"
                                        alt="Ikon Grup Pengguna">
                                </div>
                            </div>
                        </div>
                        <div class="bg-primaryRed/12.5 px-6 py-3">
                            <p class="text-xs font-medium text-orange-600 ">
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
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Kunjungan
                                        Minggu Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $totalMingguIni }}
                                    </p>
                                </div>
                                <div class="bg-gradient-to-br from-red-500 to-orange-600 p-4 rounded-full ml-4">
                                    <img src="{{ asset('assets/icons/calendar.svg') }}" class="h-7 w-7 text-white"
                                        alt="Calendar Icon">
                                </div>
                                <div class="flex-1 text-right">
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Kunjungan
                                        Bulan Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $totalBulanIni }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-primaryRed/20 px-6 py-3 flex justify-between">
                            <p class="text-xs font-medium text-red-600">
                                <span
                                    class="inline-block mr-1">{{ $persentaseKenaikanMingguan >= 0 ? '↑' : '↓' }}</span>
                                {{ number_format(abs($persentaseKenaikanMingguan), 0) }}%
                                {{ $persentaseKenaikanMingguan >= 0 ? 'bertambah' : 'berkurang' }} dari minggu kemarin
                            </p>
                            <p class="text-xs font-medium text-red-600">
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
                                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-4 rounded-full">
                                    <img src="{{ asset('assets/icons/box.svg') }}" class="h-6 w-6 text-white"
                                        alt="Box Icon">
                                </div>
                                <div class="flex-1 text-right">
                                    <h2 class="text-sm font-semibold text-gray-600 mb-1">Kurir Hari
                                        Ini</h2>
                                    <p class="text-2xl font-bold text-gray-800">{{ $kurirHariIni }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-primaryRed/12.5 px-6 py-3">
                            <p class="text-xs font-medium text-orange-600 text-right">
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
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow rounded-2xl bg-clip-border">
                    <div class="flex justify-between px-4">
                        <div class="p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                            <h6 class="mb-0 text-lg font-bold">
                                Daftar Kunjungan
                            </h6>
                        </div>
                        @if ($kedatangan->isNotEmpty())
                            <a href="{{ route('pegawai.kunjungan') }}">
                                <div class="p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                                    <p class="flex gap-2 mb-0 font-semibold">
                                        Lihat Semua <img src="{{ asset('assets/icons/arrow.svg') }}"
                                            class="w-3 rotate-180" alt="">
                                    </p>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="flex-auto p-4 pt-6">
                        <ul class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0">
                            @forelse ($kedatangan->take(3) as $item)
                                <li
                                    class="relative flex px-6 py-4 mb-2 border-0 rounded-xl rounded-t-inherit bg-lightRed">
                                    <div class="flex ml-4 gap-7">
                                        <div class="flex items-center justify-center h-full">
                                            @if ($item->type == 'tamu')
                                                <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                            @else
                                                <img src="{{ asset('assets/icons/box2.svg') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <h5 class="text-lg font-semibold">
                                                {{ $item->Tamu->nama ?? $item->ekspedisi->nama_kurir }}
                                            </h5>
                                            <div class="flex gap-2">
                                                <div class="flex flex-col gap-3 mb-2 text-sm leading-tight">
                                                    @if ($item->type == 'tamu')
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Email :
                                                            </span>{{ $item->tamu->email }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Tanggal Perjanjian : </span>
                                                            {{ $item->waktu_perjanjian }}</p>
                                                    @else
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Ekspedisi :
                                                            </span>{{ $item->ekspedisi->ekspedisi }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Tanggal Kedatangan : </span>
                                                            {{ $item->waktu_kedatangan }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <div class="w-full my-2">
                                    <p class="text-center text-darkGray">Belum ada kunjungan</p>
                                </div>
                            @endforelse
                        </ul>
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


</body>

</html>
