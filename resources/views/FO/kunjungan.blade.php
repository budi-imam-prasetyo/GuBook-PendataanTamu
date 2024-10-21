<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Kunjungan</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased">
    @apexchartsScripts

    <div class="absolute min-h-80 w-full bg-primaryBlue"></div>

    <x-FO.sidebar></x-FO.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        {{-- Navbar --}}
        <x-FO.navbar>Kunjungan</x-FO.navbar>

        <div class="w-full flex flex-col gap-7 p-6 pt-3">
            {{-- Rows 1 --}}
            <div class="w-full flex">
                <div class="w-full h-full md:h-36 grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="flex flex-col order-last md:order-first rounded-xl md:col-span-3">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-full">
                            {{-- Card 1 --}}
                            <div class="col-span-1">
                                <div
                                    class="bg-lightBlue border-2 border-lightBlue2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h2 class="text-sm font-semibold text-gray-600 mb-1">
                                                    Selesai</h2>
                                                <p class="text-2xl font-bold text-gray-800">7</p>
                                            </div>
                                            <div class="bg-gradient-to-br from-green-500 to-green-600 p-4 rounded-full">
                                                <img src="{{ asset('assets/icons/group-user.svg') }}"
                                                    class="h-6 w-6 text-white" alt="Ikon Grup Pengguna">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-lightBlue2 px-6 py-3">
                                        <p class="text-xs font-medium text-green-600">
                                            <span class="inline-block mr-1">↑</span>50% dari kemarin
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Card 2 --}}
                            <div class="col-span-1">
                                <div
                                    class="bg-lightBlue border-2 border-lightBlue2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h2 class="text-sm font-semibold text-gray-600 mb-1">
                                                    Belum Datang</h2>
                                                <p class="text-2xl font-bold text-gray-800">2</p>
                                            </div>
                                            <div
                                                class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-4 rounded-full">
                                                <img src="{{ asset('assets/icons/group-user.svg') }}"
                                                    class="h-6 w-6 text-white" alt="Ikon Grup Pengguna">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-lightBlue2   px-6 py-3">
                                        <p class="text-xs font-medium text-yellow-600 ">
                                            <span class="inline-block mr-1">↑</span>25% dari kemarin
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Card 3 --}}
                            <div class="col-span-1">
                                <div
                                    class="bg-lightBlue border-2 border-lightBlue2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h2 class="text-sm font-semibold text-gray-600 mb-1">
                                                    Tidak Hadir</h2>
                                                <p class="text-2xl font-bold text-gray-800">1</p>
                                            </div>
                                            <div class="bg-gradient-to-br from-red-500 to-red-600 p-4 rounded-full">
                                                <img src="{{ asset('assets/icons/group-user.svg') }}"
                                                    class="h-6 w-6 text-white" alt="Ikon Grup Pengguna">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-lightBlue2 px-6 py-3">
                                        <p class="text-xs font-medium text-red-600">
                                            <span class="inline-block mr-1">↑</span>75% dari kemarin
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded-xl p-1 pt-2 w-full h-[9.3rem] shadow-sm">{!! $chart->container() !!}</div>
                </div>
            </div>


            {{-- Rows 2 --}}
            <div class="w-full flex mt-1">
                <div class="w-full grid grid-cols-1 md:grid-cols-7 gap-y-6 md:gap-6">
                    <div class="w-full flex flex-col bg-light p-5 col-span-3 rounded-4.5 shadow-md" id="cardDetail">
                        <div class="w-full h-135 flex flex-col col-span-3 gap-6 rounded-4.5 text-center">
                            <!-- <div class="w-full flex items-center justify-center">
                                <div class="rounded-full flex items-center justify-center w-25 h-25 outline outline-4 bg-base-200 outline-base-300">
                                    <img src="{{ asset('assets/user.jpg') }}" class="h-full rounded-full" alt="">
                                </div>
                            </div> -->
                            <div class="w-full mt-4 flex flex-col items-center justify-center h-full">
                                <h5 class="text-xl font-semibold text-grey select-none">Klik detail untuk melihat</h5>
                            </div>
                        </div>
                    </div>

                    <div class="w-full bg-light rounded-4.5 shadow-md col-span-4 p-4.5">
                        <div class="relative mb-4">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <img src="{{ asset('assets/icons/search2.svg') }}" class="w-5 h-5" alt="">
                            </div>
                            <input id="searchInput" type="text"
                                class="peer py-3 px-4 ps-11 block w-full bg-lightBlue border-lightBlue2 border-2 rounded-lg text-sm focus:border-opacity-50 disabled:opacity-50 disabled:pointer-events-none placeholder:font-semibold placeholder:text-grey"
                                placeholder="Enter name">
                        </div>

                        <div class="mb-4 flex gap-4">
                            <button id="konfirmasi-btn"
                                class="filter-btn border-2 border-primaryBlue bg-primaryBlue text-white font-semibold py-2 w-1/2 rounded-lg active"
                                onclick="toggleButtons('konfirmasi')">Konfirmasi</button>
                            <button id="kunjungan-btn"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 w-1/2 rounded-lg"
                                onclick="toggleButtons('kunjungan')">Kunjungan Tamu</button>
                        </div>

                        <!-- Bagian tombol yang tersembunyi pada awalnya -->
                        <div id="visit-options" class="mb-4 flex gap-4 hidden">
                            <button id="filter-all"
                                class="filter-btn border-2 border-primaryBlue bg-primaryBlue text-white font-semibold py-2 w-1/3 rounded-lg active"
                                onclick="filterStatus('semua', this)">Semua</button>
                            <button id="filter-accepted"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 w-1/3 rounded-lg"
                                onclick="filterStatus('diterima', this)">Menunggu</button>
                            <button id="filter-rejected"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 w-1/3 rounded-lg"
                                onclick="filterStatus('ditolak', this)">Diterima</button>
                            <button id="filter-rejected"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 w-1/3 rounded-lg"
                                onclick="filterStatus('ditolak', this)">Ditolak</button>
                        </div>

                        <!-- Konfirmasi Section -->
                        <div id="konfirmasi-section">
                            <ul id="konfirmasiList"
                                class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0 max-h-116 min-h-116 overflow-y-auto border-y-2 border-lightBlue2">
                                @forelse ($konfirmasi as $item)
                                    <li class="search-item relative mb-2 flex rounded-xl rounded-t-inherit border-2 border-lightBlue2 bg-lightBlue px-6 py-4"
                                        data-status="{{ $item->status }}"
                                        data-sudah-datang="{{ $item->sudah_datang ? 'true' : 'false' }}">
                                        <div class="flex gap-7 ml-4">
                                            <div class="flex items-center justify-center h-full">
                                                <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                            </div> 
                                            <div class="flex flex-col gap-2">
                                                {{-- @if ($item->type == 'tamu') --}}
                                                <h5 class="text-lg font-semibold">
                                                    {{ $item->tamu->nama }}
                                                </h5>
                                                <div class="flex gap-2">
                                                    <div class="flex flex-col gap-3 mb-2 text-sm leading-tight">
                                                        <p class="font-semibold"><span class="font-normal">Email:
                                                            </span>{{ $item->tamu->email }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Status:
                                                            </span>{{ $item->status }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Tanggal Perjanjian:
                                                            </span>{{ $item->waktu_perjanjian }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-auto text-right flex items-center">
                                            <a href="javascript:;"
                                                onclick="loadDetail('{{ $item->id_kedatangan }}', '{{ $item->type }}')"
                                                class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85">Detail</a>
                                        </div>
                                    </li>
                                @empty
                                    <div class="flex items-center justify-center h-full">
                                        <li class="text-center mt-4 text-grey text-lg">Tidak Ada Data Konfirmasi</li>
                                    </div>
                                @endforelse
                            </ul>
                            {{ $konfirmasi->links('components.pagination') }}

                        </div>
                        <div id="kunjungan-tamu-section" class="hidden">
                            <ul id="kunjunganList"
                                class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0 max-h-116 min-h-116 overflow-y-auto">
                                @forelse ($kunjungan_tamu as $item)
                                    <li class="search-item relative mb-2 flex rounded-xl rounded-t-inherit border-2 border-lightBlue2 bg-lightBlue px-6 py-4"
                                        data-status="{{ $item->status }}"
                                        data-sudah-datang="{{ $item->sudah_datang ? 'true' : 'false' }}">
                                        <div class="flex gap-7 ml-4">
                                            <div class="flex items-center justify-center h-full">
                                                <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                {{-- @if ($item->type == 'tamu') --}}
                                                <h5 class="text-lg font-semibold">
                                                    {{ $item->tamu->nama }}
                                                </h5>
                                                <div class="flex gap-2">
                                                    <div class="flex flex-col gap-3 mb-2 text-sm leading-tight">
                                                        <p class="font-semibold"><span class="font-normal">Email:
                                                            </span>{{ $item->tamu->email }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Waktu Kedatangan:
                                                            </span>{{ $item->waktu_kedatangan }}</p>
                                                        <p class="font-semibold capitalize"><span
                                                                class="font-normal">Tanggal Perjanjian:
                                                            </span>{{ $item->waktu_perjanjian }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-auto text-right flex items-center">
                                            <a href="javascript:;"
                                                onclick="loadDetail('{{ $item->id_kedatangan }}', '{{ $item->type }}')"
                                                class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85">Detail</a>
                                        </div>
                                    </li>
                                @empty
                                    <div class="flex items-center justify-center h-full">
                                        <li class="text-center mt-4 text-grey text-lg">Tidak Ada Data Konfirmasi</li>
                                    </div>
                                @endforelse
                            </ul>
                            {{ $kunjungan_tamu->links('components.pagination') }}
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <x-FO.footer />
    </main>

    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- plugin for scrollbar  -->
<!-- <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script> -->
<!-- main script file  -->
<!-- <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script> -->
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable({});
    });
</script> -->
{{ $chart->script() }}


<script>
    function toggleButtons(section) {
        const konfirmasiBtn = document.getElementById('konfirmasi-btn');
        const kunjunganBtn = document.getElementById('kunjungan-btn');
        const konfirmasiSection = document.getElementById('konfirmasi-section');
        const kunjunganSection = document.getElementById('kunjungan-tamu-section');
        const visitOptions = document.getElementById('visit-options');

        if (section === 'konfirmasi') {
            konfirmasiBtn.classList.add('active', 'bg-primaryBlue', 'text-white', 'border-primaryBlue');
            konfirmasiBtn.classList.remove('bg-lightBlue', 'text-primaryBlue', 'border-lightBlue2');
            kunjunganBtn.classList.remove('active', 'bg-primaryBlue', 'text-white', 'border-primaryBlue');
            kunjunganBtn.classList.add('bg-lightBlue', 'text-primaryBlue', 'border-lightBlue2');
            visitOptions.classList.add('hidden');
            konfirmasiSection.classList.remove('hidden');
            kunjunganSection.classList.add('hidden');
        } else if (section === 'kunjungan') {
            kunjunganBtn.classList.add('active', 'bg-primaryBlue', 'text-white', 'border-primaryBlue');
            kunjunganBtn.classList.remove('bg-lightBlue', 'text-primaryBlue', 'border-lightBlue2');
            konfirmasiBtn.classList.remove('active', 'bg-primaryBlue', 'text-white', 'border-primaryBlue');
            konfirmasiBtn.classList.add('bg-lightBlue', 'text-primaryBlue', 'border-lightBlue2');
            visitOptions.classList.remove('hidden');
            konfirmasiSection.classList.add('hidden');
            kunjunganSection.classList.remove('hidden');
            filterStatus('semua', document.getElementById('filter-all'));
        }
    }

    function filterStatus(status, element) {
        const items = document.querySelectorAll('#kunjungan-tamu-section .search-item');
        const filterButtons = document.querySelectorAll('#visit-options .filter-btn');

        items.forEach(item => {
            if (status === 'semua') {
                item.style.display = 'flex';
            } else if (status === 'diterima') {
                item.style.display = item.getAttribute('data-sudah-datang') === 'true' ? 'flex' : 'none';
            } else if (status === 'ditolak') {
                item.style.display = item.getAttribute('data-sudah-datang') === 'false' ? 'flex' : 'none';
            } else {
                item.style.display = item.getAttribute('data-status') === status ? 'flex' : 'none';
            }
        });

        // Reset only visit options button colors
        filterButtons.forEach(button => {
            button.classList.remove('border-primaryBlue', 'bg-primaryBlue', 'text-white', 'active');
            button.classList.add('bg-lightBlue', 'text-primaryBlue');
        });

        // Set the clicked button as active
        element.classList.remove('bg-lightBlue', 'text-primaryBlue');
        element.classList.add('border-primaryBlue', 'bg-primaryBlue', 'text-white', 'active');
    }

    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.search-item');

        items.forEach(function(item) {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    function loadDetail(id, type) {
        $.ajax({
            url: '/FO/kunjungan/' + id, // Pastikan URL ini sesuai dengan route Anda
            method: 'GET',
            success: function(data) {
                // Update container dengan partial view yang diterima dari server
                $('#cardDetail').html(data);
                console.log(data);
            },
            error: function() {
                alert('Terjadi kesalahan saat memuat data.');
            }
        });
    }

    document.getElementById('scrollDown').addEventListener('click', function() {
        var visitList = document.getElementById('visitList');
        visitList.scrollTo({
            top: visitList.scrollHeight, // Menggulung hingga mentok paling bawah
            behavior: 'smooth'
        });
    });
</script>

</html>
