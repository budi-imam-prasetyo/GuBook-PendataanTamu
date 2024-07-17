<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> -->
    <!-- Main Styling -->
    {{--
    <link href="../../src/output.css" rel="stylesheet" /> --}}
    @vite('resources/css/app.css')
    <style>

    </style>
</head>

<body
    class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased dark:bg-slate-900">
    @apexchartsScripts

    <div class="absolute min-h-75 w-full bg-blue-500 dark:hidden"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        {{-- Navbar --}}
        <x-admin.navbar></x-admin.navbar>

        <div class="w-full flex flex-col gap-7 px-10">
            {{-- Rows 1 --}}
            <div class="w-full flex">
                <div class=" w-full h-full grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div
                        class="flex flex-col order-last md:order-first bg-light shadow-sm rounded-4.5 md:col-span-3 p-5">
                        <div class="w-full">
                            <h1 class="text-dark text-xl">Kedatangan Tamu</h1>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-full">
                            {{-- Card 1 --}}
                            <div
                                class="-mx-1 flex flex-row justify-between bg-lightBlue rounded-3 h-full shadow-md p-5">
                                <div class="max-w-full flex-none">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                            Selesai
                                        </p>
                                        <h5 class="mb-2 font-bold">7</h5>
                                        <p class="mb-2 text-xs">> 50% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="text-right flex items-center justify-center">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-b from-green-500 to-green-400 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            {{-- Card 2 --}}
                            <div
                                class="-mx-1 flex flex-row justify-between bg-lightBlue rounded-3 h-full shadow-md p-5">
                                <div class="max-w-full flex-none">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                            Belum Datang
                                        </p>
                                        <h5 class="mb-2 font-bold">2</h5>
                                        <p class="mb-2 text-xs">> 25% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="text-right flex items-center justify-center">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-b from-yellow-500 to-yellow-400 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            {{-- Card 3 --}}
                            <div
                                class="-mx-1 flex flex-row justify-between bg-lightBlue rounded-3 h-full shadow-md p-5">
                                <div class="max-w-full flex-none">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-lg font-semibold leading-normal dark:text-white dark:opacity-60">
                                            Tidak Hadir
                                        </p>
                                        <h5 class="mb-2 font-bold">1</h5>
                                        <p class="mb-2 text-xs">> 75% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="text-right flex items-center justify-center">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-b from-red-500 to-red-400 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded-4.5 p-1 h-full shadow-sm">{!! $chart->container() !!}</div>
                </div>
            </div>
            {{-- Rows 2 --}}
            <div class="w-full flex mt-1">
                <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="w-full flex flex-col bg-light p-5 gap-6 rounded-4.5 shadow-md   ">
                        <div class="w-full flex items-center justify-center">
                            <div class="rounded-full flex items-center justify-center w-25 h-25 outline outline-4 outline-green-400">
                                <img src="{{ asset('assets/user.jpg') }}" class="h-full rounded-full" alt="">
                            </div>
                        </div>
                        <div class="w-full flex gap-2 justify-around">
                            <div class="w-full flex flex-col items-center justify-center">
                                <h6 class="text-sm leading-0 text-grey">Nama Tamu</h6>
                                <h6 class="text-base text-darkGray">Gultom Julius</h6>
                            </div>
                            <div class="w-full flex flex-col items-center justify-center">
                                <h6 class="text-sm leading-0 text-grey">Bertemu Dengan</h6>
                                <h6 class="text-base text-darkGray">Pak Engkus</h6>
                            </div>
                            <div class="w-full flex flex-col items-center justify-center">
                                <h6 class="text-sm leading-0 text-grey">Waktu Pertemuan</h6>
                                <h6 class="text-base text-darkGray">08.00 - 08.30</h6>
                            </div>
                        </div>
                        <div class="w-full px-4">
                            <h2 class="text-lg font-semibold  px-2 leading-4">Detail Lainnya</h2>
                            <div class="bg-lightBlue p-4 rounded-4.5">
                                <div class="flex mb-2">
                                    <span class="font-semibold w-1/6">Email</span>
                                    <span class="w-5/6">: julius@gmail.com</span>
                                </div>
                                <div class="flex mb-2">
                                    <span class="font-semibold w-1/6">No. Telpon</span>
                                    <span class="w-5/6">: 089752686437</span>
                                </div>
                                <div class="flex mb-2">
                                    <span class="font-semibold w-1/6">Alamat</span>
                                    <span class="w-5/6">: Pasir Koja</span>
                                </div>
                                <div class="flex mb-2">
                                    <span class="font-semibold w-1/6">Instansi</span>
                                    <span class="w-5/6">: -</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <span class="font-semibold">Tujuan</span>
                                    <div class="w-full py-2 px-3 bg-lightBlue2 rounded-lg h-24">
                                        Membicarakan tentang P5
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-light rounded-4.5 shadow-md">a</div>
                </div>
            </div>
        </div>
    </main>
    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#example').DataTable({});
    });
</script>
{{ $chart->script() }}


<script>
    // Fungsi untuk menghasilkan nomor telepon acak
    function generateRandomPhoneNumber() {
        let randomNumber = "";

        for (let i = 0; i < 11; i++) {
            randomNumber += Math.floor(Math.random() * 10);
        }

        return randomNumber;
    }

    // Mendapatkan semua elemen dengan kelas "nomorTelepon"
    let nomorTeleponSpans = document.querySelectorAll(".nomorTelepon");

    // Mengganti teks pada setiap elemen dengan nomor telepon acak
    nomorTeleponSpans.forEach(function(span) {
        span.textContent = generateRandomPhoneNumber();
    });
</script>

</html>
