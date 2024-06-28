<!--

=========================================================
* Argon Dashboard 2 Tailwind - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " />
    <!-- <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    {{-- <link href="../../src/output.css" rel="stylesheet" /> --}}
    @vite('resources/css/app.css')
</head>

<body
    class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased dark:bg-slate-900">
    <div class="absolute min-h-75 w-full bg-primaryBlue dark:hidden"></div>
    <!-- sidenav  -->
    <x-admin.sidebar></x-admin.sidebar>

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar></x-admin.navbar>

        <!-- end Navbar -->

        <!-- cards -->
        <div class="mx-auto w-full px-6 py-6">
            <!-- row 1 -->
            <div class="-mx-3 flex flex-wrap">
                <!-- card1 -->
                <div class="order-2 mb-6 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:order-1 xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto py-6 px-4">
                            <div class="-mx-3 flex flex-row">
                                <div class="w-2/3 max-w-full flex-none px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                            Kunjungan Tamu
                                        </p>
                                        <h5 class="mb-2 font-bold dark:text-white">12</h5>
                                    </div>
                                </div>
                                <div class="basis-1/3 px-3 text-right">
                                    <div
                                        class="inline-block h-16 w-16 rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500 text-center">
                                        <i class="fa fa-users relative top-5 text-2xl leading-none text-white"></i>
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
                        class="relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto p-4">
                            <div class="-mx-3 flex flex-row">
                                <div class="flex-none w-1/3 max-w-full px-3">
                                    <p
                                        class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                        Kunjungan Minggu Ini
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white">
                                        112
                                    </h5>
                                </div>
                                <div class="basis-1/3 px-3 text-center  ">
                                    <div
                                        class="inline-block h-20 w-20 rounded-circle bg-gradient-to-tl from-red-600 to-orange-600 text-center">
                                        <i class="fa fa-calendar relative top-6 text-3xl leading-none text-white"></i>
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

                <!-- card4 -->
                <div class="order-3 w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:order-3 xl:w-1/4">
                    <div
                        class="relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="flex-auto px-4 py-6">
                            <div class="-mx-3 flex flex-row">
                                <div class="basis-1/3 px-3 text-left">
                                    <div
                                        class="inline-block h-16 w-16 rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500 text-center">
                                        <i class="fa fa-box-open relative top-5 text-2xl leading-none text-white"></i>
                                    </div>
                                </div>
                                <div class="w-2/3 max-w-full flex-none px-3">
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

            <!-- cards row 2 -->
            <div class="-mx-3 mt-6 flex flex-wrap">
                <div class="mt-0 w-full max-w-full px-3 lg:flex-none">
                    <div
                        class="relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-dark/12.5 bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                        <div class="mb-0 rounded-t-2xl border-b-0 border-solid border-dark/12.5 p-6 pb-0 pt-4">
                            <h6 class="capitalize dark:text-white">Grafik Bulan Ini</h6>
                            <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                                <i class="fa fa-arrow-up text-emerald-500"></i>
                                <span class="font-semibold">4% lebih banyak</span> dari
                                Januari
                            </p>
                        </div>
                        <div class="flex-auto p-4">
                            <div>
                                <canvas id="chart-line" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cards row 3 -->

            <div class="mt-6 w-full max-w-full  md:flex-none">
                <div
                    class="relative flex min-w-0 flex-col break-words rounded-2xl border-0 bg-white bg-clip-border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl">
                    <div class="flex justify-between">
                        <div class="mb-0 rounded-t-2xl border-b-0 p-6 px-4 pb-0">
                            <h6 class="mb-0 text-lg font-bold dark:text-white">
                                Daftar Kunjungan
                            </h6>
                        </div>
                        <div class="mb-0 rounded-t-2xl border-b-0 p-6 px-4 pb-0">
                            <h6 class="mb-0 dark:text-white">
                                Lihat Semua <i class="fa fa-arrow-right"></i>
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto p-4 pt-6">
                        <ul class="mb-0 flex flex-col rounded-lg pl-0">
                            <li
                                class="relative mb-2 flex rounded-xl rounded-t-inherit border-0 bg-gray-50 p-6 dark:bg-slate-850">
                                <div class="flex flex-col">
                                    <h6 class="mb-4 text-sm leading-normal dark:text-white">
                                        Oliver Liam
                                    </h6>
                                    <span class="mb-2 text-xs leading-tight dark:text-white/80">Alamat Email:
                                        <span
                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">oliver@burrito.com</span></span>
                                    <span class="mb-2 text-xs leading-tight dark:text-white/80">Bertemu:
                                        <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">Viking
                                            Burrito</span></span>
                                    <span class="text-xs leading-tight dark:text-white/80">Waktu:
                                        <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">08.30, 27
                                            March 2020</span></span>
                                </div>
                                <div class="ml-auto text-right flex items-center">
                                    <a class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white"
                                        href="javascript:;">Detail</a>
                                </div>
                            </li>
                            <li class="relative mb-2 mt-4 flex rounded-xl border-0 bg-gray-50 p-6 dark:bg-slate-850">
                                <div class="flex flex-col">
                                    <h6 class="mb-4 text-sm leading-normal dark:text-white">
                                        Lucas Harper
                                    </h6>
                                    <span class="mb-2 text-xs leading-tight dark:text-white/80">Alamat Email:
                                        <span
                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">lucas@stone-tech.com</span></span>
                                    <span class="mb-2 text-xs leading-tight dark:text-white/80">Bertemu:
                                        <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">Stone Tech
                                            Zone</span></span>
                                    <span class="text-xs leading-tight dark:text-white/80">Waktu:
                                        <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">13.20, 09
                                            November 2020</span></span>
                                </div>
                                <div class="ml-auto text-right flex items-center">
                                    <a class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white"
                                        href="javascript:;">Detail</a>
                                </div>
                            </li>
                            <li
                                class="relative mb-2 mt-4 flex rounded-xl rounded-b-inherit border-0 bg-gray-50 p-6 dark:bg-slate-850">
                                <div class="flex flex-col">
                                    <h6 class="mb-4 text-sm leading-normal dark:text-white">
                                        Ethan James
                                    </h6>
                                    <span class="mb-2 text-xs leading-tight dark:text-white/80">Ekspedisi
                                        <span
                                            class="font-semibold text-slate-700 dark:text-white sm:ml-2">JNE</span></span>
                                    <span class="mb-2 text-xs leading-tight dark:text-white/80">Untuk:
                                        <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">Fiber
                                            Notion</span></span>
                                    <span class="text-xs leading-tight dark:text-white/80">Waktu:
                                        <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">11.36, 27
                                            March 2020</span></span>
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

            <footer class="pt-4">
                <div class="mx-auto w-full px-6">
                    <div class="-mx-3 flex flex-wrap items-center lg:justify-between">
                        <div class="mb-6 mt-0 w-full max-w-full shrink-0 px-3 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="text-center text-sm leading-normal text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com"
                                    class="font-semibold text-slate-700 dark:text-white" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="mt-0 w-full max-w-full shrink-0 px-3 lg:w-1/2 lg:flex-none">
                            <ul class="mb-0 flex list-none flex-wrap justify-center pl-0 lg:justify-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com"
                                        class="block px-4 pb-1 pt-0 text-sm font-normal text-slate-500 transition-colors ease-in-out"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation"
                                        class="block px-4 pb-1 pt-0 text-sm font-normal text-slate-500 transition-colors ease-in-out"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://creative-tim.com/blog"
                                        class="block px-4 pb-1 pt-0 text-sm font-normal text-slate-500 transition-colors ease-in-out"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license"
                                        class="block px-4 pb-1 pr-0 pt-0 text-sm font-normal text-slate-500 transition-colors ease-in-out"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end cards -->
        <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
            white-style-btn navbarFixed dark-toggle />
    </main>
</body>
<!-- plugin for charts  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script src="{{ asset('js/charts.js') }}" async></script> --}}
<!-- plugin for scrollbar  -->
<script src="{{ asset('js/perfect-scrollbar.min.js') }}" async></script>
{{-- <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script> --}}
<!-- main script file  -->
<script src="{{ asset('js/argon-dashboard-tailwind.js') }}" async></script>
{{-- <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script> --}}

</html>
