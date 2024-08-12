<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    {{-- <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " /> --}}
    {{-- <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script> --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="m-0 no-scrollbar bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased dark:bg-slate-900">
    @apexchartsScripts
    <div class="absolute min-h-80 w-full bg-primaryBlue dark:hidden"></div>
    <!-- sidenav  -->
    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar>Dashboard</x-admin.navbar>

        <!-- cards -->
        <div class="mx-auto w-full p-6">
            <!-- row 1 -->
            <div class="-mx-3 flex flex-wrap">
                <!-- card1 -->
                <div class="order-2 mb-6 w-full px-3 sm:w-1/2 sm:flex-none xl:order-1 xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex min-w-0 flex-col break-words rounded-3xl bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto py-6 px-4">
                            <div class="-mx-1 flex flex-row justify-between">
                                <div class="max-w-full flex-none px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                            Kunjungan Tamu
                                        </p>
                                        <h5 class="mb-2 font-bold dark:text-white">12</h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div
                    class="order-1 mb-6 w-full max-w-full px-3 sm:w-full sm:flex-none lg:w-full xl:order-2 xl:mb-0 xl:w-2/4">
                    <div
                        class="relative flex min-w-0 flex-col break-words rounded-3xl bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto p-4">
                            <div class="-mx-3 flex flex-row items-center justify-center">
                                <div class="flex-none w-1/3 max-w-full px-3">
                                    <p
                                        class="mb-0 font-sans text-lg font-semibold leading-normal">
                                        Kunjungan Minggu Ini
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white">
                                        112
                                    </h5>
                                </div>
                                <div class="basis-1/3 px-3 text-center  ">
                                    <div
                                        class="h-20 w-20 rounded-circle bg-gradient-to-tl from-red-600 to-orange-600 mx-auto flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/calendar.svg') }}" class="h-10"
                                            alt="">
                                    </div>
                                </div>
                                <div class="w-1/3 max-w-full flex-none px-3">
                                    <p
                                        class="mb-0 font-sans text-lg text-right font-semibold leading-normal dark:text-white dark:opacity-60">
                                        Kunjungan Bulan Ini
                                    </p>
                                    <h5 class="mb-2 font-bold text-right dark:text-white">
                                        541
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card 3 -->
                <div class="order-3 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:order-3 xl:w-1/4">
                    <div
                        class="relative flex min-w-0 flex-col break-words rounded-3xl bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto px-4 py-6">
                            <div class="-mx-3 justify-between flex flex-row">
                                <div class="pl-6 text-left">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/box.svg') }}" class="h-6" alt="">
                                    </div>
                                </div>
                                <div class="max-w-full flex-none px-3">
                                    <div class="text-right">
                                        <p
                                            class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                            Kunjungan Kurir
                                        </p>
                                        <h5 class="mb-2 font-bold dark:text-white">24</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cards row 1 -->
            <div class="-mx-3 mt-6 flex flex-wrap">
                <div class="mt-0 w-full max-w-full px-3 lg:flex-none">
                    <div
                        class="relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-dark/12.5 bg-white bg-clip-border shadow">
                        <div class="mb-0 rounded-2xl border-b-0 border-solid border-dark/12.5 p-6 pb-0 pt-4">

                            <h6 class="capitalize dark:text-white">Grafik Bulan Ini</h6>
                            <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                                {{-- <i class="fa fa-arrow-up text-emerald-500"></i> --}}
                                <span class="font-semibold">4% lebih banyak</span> dari
                                Januari
                            </p>
                            <div class="">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cards row 2 -->

            <div class="mt-6 w-full max-w-full  md:flex-none">
                <div
                    class="relative flex min-w-0 flex-col break-words rounded-2xl border-0 bg-white bg-clip-border shadow">
                    <div class="flex justify-between">
                        <div class="mb-0 rounded-t-2xl border-b-0 p-6 px-4 pb-0">
                            <h6 class="mb-0 text-lg font-bold dark:text-white">
                                Daftar Kunjungan
                            </h6>
                        </div>
                        <div class="mb-0 rounded-t-2xl border-b-0 p-6 px-4 pb-0">
                            <h6 class="mb-0 dark:text-white">
                                Lihat Semua 
                                {{-- <i class="fa fa-arrow-right"></i> --}}
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto p-4 pt-6">
                        <ul class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0">
                            <li
                                class="relative mb-2 flex rounded-xl rounded-t-inherit border-0 bg-lightBlue px-6 py-4 dark:bg-slate-850">
                                <div class="flex gap-7 ml-4">
                                    <div class="flex items-center justify-center h-full">
                                        <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                    </div>                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-lg">
                                            Oliver Liam
                                        </h5>
                                        <div class="flex gap-2 ml-1">
                                            <div class="flex flex-col gap-3">
                                                <img src="{{ asset('assets/icons/arrow-left.svg') }}" class="w-5" alt="arrow">
                                                <img src="{{ asset('assets/icons/mail.svg') }}" class="w-5" alt="mail">
                                                <img src="{{ asset('assets/icons/time.svg') }}" class="w-5" alt="time">
                                            </div>
                                            <div class="mb-2 text-sm flex flex-col gap-3 leading-tight">
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">Corey George</span>
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">oliver@burrito.com</span>
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">13 Juni 2024, 12.41</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-auto text-right flex items-center">
                                    <a class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white"
                                        href="javascript:;">Detail</a>
                                </div>
                            </li>
                            <li
                                class="relative mb-2 flex rounded-xl rounded-t-inherit border-0 bg-lightBlue px-6 py-4 dark:bg-slate-850">
                                <div class="flex gap-7 ml-4">
                                    <div class="flex items-center justify-center h-full">
                                        <img src="{{ asset('assets/icons/box2.svg') }}" alt="">
                                    </div>                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-lg">
                                            Oliver Liam
                                        </h5>
                                        <div class="flex gap-2 ml-1">
                                            <div class="flex flex-col gap-3">
                                                <img src="{{ asset('assets/icons/arrow-left.svg') }}" class="w-5" alt="arrow">
                                                <img src="{{ asset('assets/icons/truck2.svg') }}" class="w-5" alt="truck">
                                                <img src="{{ asset('assets/icons/time.svg') }}" class="w-5" alt="time">
                                            </div>
                                            <div class="mb-2 text-sm flex flex-col gap-3 leading-tight">
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">Corey George</span>
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">J&T</span>
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">oliver@burrito.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-auto text-right flex items-center">
                                    <a class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white"
                                        href="javascript:;">Detail</a>
                                </div>
                            </li>
                            <li
                                class="relative mb-2 flex rounded-xl rounded-t-inherit border-0 bg-lightBlue px-6 py-4 dark:bg-slate-850">
                                <div class="flex gap-7 ml-4">
                                    <div class="flex items-center justify-center h-full">
                                        <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                    </div>                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-lg">
                                            Oliver Liam
                                        </h5>
                                        <div class="flex gap-2 ml-1">
                                            <div class="flex flex-col gap-3">
                                                <img src="{{ asset('assets/icons/arrow-left.svg') }}" class="w-5" alt="arrow">
                                                <img src="{{ asset('assets/icons/mail.svg') }}" class="w-5" alt="mail">
                                                <img src="{{ asset('assets/icons/time.svg') }}" class="w-5" alt="time">
                                            </div>
                                            <div class="mb-2 text-sm flex flex-col gap-3 leading-tight">
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">Corey George</span>
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">oliver@burrito.com</span>
                                                <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">13 Juni 2024, 12.41</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-auto text-right flex items-center">
                                    <a class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white"
                                        href="javascript:;">Detail</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end cards -->
        <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
            white-style-btn navbarFixed dark-toggle />
            <footer class="text-center py-4 dark:bg-gray-800">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    &copy; <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <span class="text-primaryBlue">GuBook</span>, dibuat dengan 
                    {{-- <i class="fa fa-heart"></i> --}}
                     untuk web yang lebih baik.
                </p>
            </footer>
    </main>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

    {{ $chart->script() }}
    <!-- plugin for scrollbar  -->
    {{-- <script src="{{ asset('js/perfect-scrollbar.min.js') }}" async></script> --}}
    <script src="{{ asset('js/argon-dashboard-tailwind.js') }}" async></script>
    <script src="{{ asset('js/html5-qrcode.min.js') }}" async></script>
    <script src="{{ asset('js/sidenav-burger.js') }}" async></script>
    <!-- Initialize QR Code Scanner -->


</body>

</html>
