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
    class="m-0 font-sans text-base antialiased font-medium no-scrollbar bg-gray-50 leading-default text-slate-500 dark:bg-slate-900">
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
            <div class="flex flex-wrap -mx-3 transition-all h-30">
                <!-- card1 -->
                <div class="order-2 w-full px-3 mb-6 sm:w-1/2 xl:order-1 xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl rounded-3xl bg-clip-border dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto p-4 sm:p-6">
                            <div class="flex flex-col items-center justify-between sm:flex-row">
                                <div class="w-full mb-4 sm:w-2/3 sm:mb-0">
                                    <p
                                        class="mb-1 font-sans text-sm font-semibold leading-normal sm:text-base dark:text-white dark:opacity-60">
                                        Kunjungan Tamu Hari Ini
                                    </p>
                                    <h5 class="text-lg font-bold sm:text-lg dark:text-white">{{ $tamuHariIni }}
                                    </h5>
                                </div>
                                <div class="flex justify-center w-full sm:w-1/3 sm:justify-end">
                                    <div
                                        class="flex items-center justify-center rounded-full h-14 w-14 sm:h-16 sm:w-16 bg-gradient-to-tl from-blue-500 to-violet-500">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6 sm:h-6"
                                            alt="Ikon Grup Pengguna">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div
                    class="order-1 w-full max-w-full px-3 mb-6 sm:w-full sm:flex-none lg:w-full xl:order-2 xl:mb-0 xl:w-2/4">
                    <div
                        class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl rounded-3xl bg-clip-border dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row items-center justify-center -mx-3">
                                <div class="flex-none w-1/3 max-w-full px-3">
                                    <p
                                        class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                        Kunjungan Minggu Ini
                                    </p>
                                    <h5 class="mb-2 text-lg font-bold dark:text-white">{{ $totalMingguIni }}
                                    </h5>
                                </div>
                                <div class="px-3 text-center basis-1/3">
                                    <div
                                        class="flex items-center justify-center w-20 h-20 mx-auto rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                        <img src="{{ asset('assets/icons/calendar.svg') }}" class="h-10"
                                            alt="">
                                    </div>
                                </div>
                                <div class="flex-none w-1/3 max-w-full px-3">
                                    <p
                                        class="mb-0 font-sans text-lg font-semibold leading-normal text-right dark:text-white dark:opacity-60">
                                        Kunjungan Bulan Ini
                                    </p>
                                    <h5 class="mb-2 text-lg font-bold text-right dark:text-white">
                                        {{ $totalBulanIni }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card 3 -->
                <div class="order-3 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:order-3 xl:w-1/4">
                    <div
                        class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl rounded-3xl bg-clip-border dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto px-4 py-6">
                            <div class="flex flex-row justify-between ">
                                <div class="text-left ">
                                    <div
                                        class="flex items-center justify-center w-16 h-16 rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                        <img src="{{ asset('assets/icons/box.svg') }}" class="h-6" alt="">
                                    </div>
                                </div>
                                <div class="w-full mb-4 mr-4 sm:w-2/3 sm:mb-0">
                                    <div class="text-right">
                                        <p
                                            class="mb-1 font-sans text-sm font-semibold leading-normal sm:text-base dark:text-white dark:opacity-60">
                                            Kunjungan Kurir Hari Ini
                                        </p>
                                        <h5 class="text-lg font-bold  dark:text-white">
                                            {{ $kurirHariIni }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
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
                            <h6 class="capitalize dark:text-white">Grafik Bulan Ini</h6>
                            <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
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
                            <h6 class="mb-0 text-lg font-bold dark:text-white">
                                Daftar Kunjungan
                            </h6>
                        </div>
                        @if ($kedatangan->isNotEmpty())
                            <a href="{{ route('admin.kunjungan') }}">
                                <div class="p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                                    <p class="flex gap-2 mb-0 font-semibold dark:text-white">
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
                                    class="relative flex px-6 py-4 mb-2 border-0 rounded-xl rounded-t-inherit bg-lightBlue dark:bg-slate-850">
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
                                                {{ $item->user->nama }}
                                            </h5>
                                            <div class="flex gap-2">
                                                <div class="flex flex-col gap-3 mb-2 text-sm leading-tight">
                                                    @if ($item->type == 'tamu')
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Nama :
                                                            </span>{{ $item->tamu->nama }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Email :
                                                            </span>{{ $item->tamu->email }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Tanggal Perjanjian : </span>
                                                            {{ $item->waktu_perjanjian }}
                                                        </p>
                                                    @else
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Nama Kurir :
                                                            </span>{{ $item->ekspedisi->nama_kurir }}
                                                        </p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Ekspedisi :
                                                            </span>{{ $item->ekspedisi->ekspedisi }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Tanggal Kedatangan : </span>
                                                            {{ $item->waktu_kedatangan }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center ml-auto text-right">
                                        <a class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white"
                                            href="javascript:;">Detail</a>
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
