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
    <div class="absolute min-h-75 w-full bg-blue-500 dark:hidden"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar></x-admin.navbar>

        <div class="mx-auto w-full px-6 py-6">
            <form
                class="mx-auto mb-4 mt-10 flex w-full flex-col rounded-2xl bg-white p-6 shadow-lg dark:border-transparent dark:bg-slate-850 dark:shadow-dark-xl">
                <h6 class="uppercase dark:text-white">Tambah Guru</h6>

                <!-- Baris Pertama: Nama -->
                <div class="mb-5">
                    <label for="nama" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama
                        Guru</label>
                    <input type="text" id="nama"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        placeholder="Masukkan Nama" required />
                </div>

                <!-- Baris Kedua: Email dan Password -->
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="mb-5">
                        <label for="email"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="contoh@email.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kata
                            Sandi</label>
                        <input type="password" id="password"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            required placeholder="******" />
                    </div>
                </div>

                <!-- Baris Ketiga: Nomor Telepon, NIP, dan Dropdown Mapel -->
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="mb-5">
                        <label for="telepon" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nomor
                            Telepon</label>
                        <input type="tel" id="telepon"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="Masukkan Nomor Telepon" required />
                    </div>
                    <div class="mb-5">
                        <label for="nip" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">NIP
                            (Nomor Induk Pegawai)</label>
                        <input type="text" id="nip"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="Masukkan NIP" required />
                    </div>
                    <div class="mb-5">
                        <label for="mapel"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">PTK</label>
                        <select id="mapel"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            required>
                            <option value="" disabled selected>Pilih Mapel</option>
                            <!-- Tambahkan opsi-opsi mata pelajaran di sini -->
                        </select>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="w-full rounded-lg bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">
                    Submit
                </button>
            </form>

            <!-- table 1 -->

            <div class="-mx-3 mt-5 flex flex-wrap">
                <div class="w-full max-w-full flex-none px-3">
                    <div
                        class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border border-solid border-transparent bg-white bg-clip-border shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
                        <!-- <div class="border-b-solid mb-0 rounded-t-2xl border-b-0 border-b-transparent p-6 pb-0">
                            <h6 class="uppercase dark:text-white">Tabel Guru</h6>
                        </div> -->
                        <div class="flex-auto px-0 pb-2 pt-0">
                            <div class="overflow-x-auto p-0">
                                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                                    <h2 class="text-2xl font-bold mb-4">Tabel Guru</h2>
                                    <table id="example" class="table-auto w-full">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2">Nama</th>
                                                <th class="px-4 py-2">No Telepon</th>
                                                <th class="px-4 py-2">NIP</th>
                                                <th class="px-4 py-2">PTK</th>
                                                <th class="px-4 py-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border px-4 py-2">Tiger Nixon</td>
                                                <td class="border px-4 py-2">System Architect</td>
                                                <td class="border px-4 py-2">Edinburgh</td>
                                                <td class="border px-4 py-2">61</td>
                                                <td class="border px-4 py-2">2011/04/25</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Garrett Winters</td>
                                                <td class="border px-4 py-2">Accountant</td>
                                                <td class="border px-4 py-2">Tokyo</td>
                                                <td class="border px-4 py-2">63</td>
                                                <td class="border px-4 py-2">2011/07/25</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Ashton Cox</td>
                                                <td class="border px-4 py-2">Junior Technical Author</td>
                                                <td class="border px-4 py-2">San Francisco</td>
                                                <td class="border px-4 py-2">66</td>
                                                <td class="border px-4 py-2">2009/01/12</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Cedric Kelly</td>
                                                <td class="border px-4 py-2">Senior Javascript Developer</td>
                                                <td class="border px-4 py-2">Edinburgh</td>
                                                <td class="border px-4 py-2">22</td>
                                                <td class="border px-4 py-2">2012/03/29</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Airi Satou</td>
                                                <td class="border px-4 py-2">Accountant</td>
                                                <td class="border px-4 py-2">Tokyo</td>
                                                <td class="border px-4 py-2">33</td>
                                                <td class="border px-4 py-2">2008/11/28</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Brielle Williamson</td>
                                                <td class="border px-4 py-2">Integration Specialist</td>
                                                <td class="border px-4 py-2">New York</td>
                                                <td class="border px-4 py-2">61</td>
                                                <td class="border px-4 py-2">2012/12/02</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Herrod Chandler</td>
                                                <td class="border px-4 py-2">Sales Assistant</td>
                                                <td class="border px-4 py-2">San Francisco</td>
                                                <td class="border px-4 py-2">59</td>
                                                <td class="border px-4 py-2">2012/08/06</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Herrod Chandler</td>
                                                <td class="border px-4 py-2">Sales Assistant</td>
                                                <td class="border px-4 py-2">San Francisco</td>
                                                <td class="border px-4 py-2">59</td>
                                                <td class="border px-4 py-2">2012/08/06</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Ashton Cox</td>
                                                <td class="border px-4 py-2">Junior Technical Author</td>
                                                <td class="border px-4 py-2">San Francisco</td>
                                                <td class="border px-4 py-2">66</td>
                                                <td class="border px-4 py-2">2009/01/12</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Cedric Kelly</td>
                                                <td class="border px-4 py-2">Senior Javascript Developer</td>
                                                <td class="border px-4 py-2">Edinburgh</td>
                                                <td class="border px-4 py-2">22</td>
                                                <td class="border px-4 py-2">2012/03/29</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Airi Satou</td>
                                                <td class="border px-4 py-2">Accountant</td>
                                                <td class="border px-4 py-2">Tokyo</td>
                                                <td class="border px-4 py-2">33</td>
                                                <td class="border px-4 py-2">2008/11/28</td>
                                            </tr>
                                            <tr>
                                                <td class="border px-4 py-2">Brielle Williamson</td>
                                                <td class="border px-4 py-2">Integration Specialist</td>
                                                <td class="border px-4 py-2">New York</td>
                                                <td class="border px-4 py-2">61</td>
                                                <td class="border px-4 py-2">2012/12/02</td>
                                            </tr>


                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="m-2 flex justify-between">
                            <div class="hidden sm:flex">
                                <div class="mx-1">
                                    <button
                                        class="rounded-lg px-3 py-1 text-red-500 transition-all ease-in-out hover:btn hover:btn-error hover:btn-sm">
                                        <i class="fa fa-file-import text-dark"></i>
                                        Import
                                    </button>
                                </div>
                                <div class="mx-1">
                                    <button
                                        class="rounded-lg px-3 py-1 text-green-500 transition-all ease-in-out hover:btn hover:btn-success hover:btn-sm">
                                        <i class="fa fa-file-export text-dark"></i>
                                        Export
                                    </button>
                                </div>
                            </div>
                            <div class="mx-auto flex sm:mx-1">
                                <nav aria-label="Page navigation example">
                                    <ul class="flex h-8 items-center -space-x-px text-sm">
                                        <li>
                                            <a href="#"
                                                class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                <span class="sr-only">Previous</span>
                                                <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                        </li>
                                        <li>
                                            <a href="#" aria-current="page"
                                                class="z-10 flex h-8 items-center justify-center border border-blue-300 bg-blue-50 px-3 leading-tight text-blue-600 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                <span class="sr-only">Next</span>
                                                <svg class="h-2.5 w-2.5 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card 2 -->

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
    </main>
    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
        });
    });
</script>

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
    nomorTeleponSpans.forEach(function (span) {
        span.textContent = generateRandomPhoneNumber();
    });
</script>

</html>