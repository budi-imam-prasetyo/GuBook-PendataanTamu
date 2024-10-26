<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Kunjungan</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased">
    @apexchartsScripts

    <div class="absolute min-h-80 w-full bg-primaryBlue"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        {{-- Navbar --}}
        <x-admin.navbar>Kunjungan</x-admin.navbar>

        <div class="w-full flex flex-col gap-7 p-6 pt-3">
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
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
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
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
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
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
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
                    <div class="bg-light rounded-4.5 p-1 pt-4 h-full shadow-sm">{!! $chart->container() !!}</div>
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
                                class="peer py-3 px-4 ps-11 block w-full bg-lightBlue border-lightBlue2 border rounded-lg text-sm focus:border-opacity-50 disabled:opacity-50 disabled:pointer-events-none placeholder:font-semibold placeholder:text-grey"
                                placeholder="Enter name">
                        </div>

                        <div class="mb-4 flex gap-4">
                            <button id="filter-all"
                                class="filter-btn border-2 border-primaryBlue bg-primaryBlue text-white font-semibold py-2 px-4 rounded-lg active"
                                onclick="filterStatus('semua', this)">Semua</button>
                            <button id="filter-accepted"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 px-4 rounded-lg"
                                onclick="filterStatus('diterima', this)">Diterima</button>
                            <button id="filter-rejected"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 px-4 rounded-lg"
                                onclick="filterStatus('ditolak', this)">Ditolak</button>
                            <button id="filter-pending"
                                class="filter-btn bg-lightBlue border-2 border-lightBlue2 text-primaryBlue font-semibold py-2 px-4 rounded-lg"
                                onclick="filterStatus('menunggu', this)">Menunggu</button>
                        </div>

                        <div class="relative">
                            <ul id="visitList"
                                class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0 max-h-116 min-h-116 overflow-y-auto">
                                @forelse ($kedatanganTamu as $item)
                                    <li class="search-item relative mb-2 flex rounded-xl rounded-t-inherit border-2 border-lightBlue2 bg-lightBlue px-6 py-4 "
                                        data-status="{{ $item->status }}">
                                        <div class="flex gap-7 ml-4">
                                            <div class="flex items-center justify-center h-full">
                                                <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <h5 class="text-lg font-semibold capitalize">
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
                                                            </span>{{ $item->formatWaktu }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-auto text-right flex items-center">
                                            <a href="javascript:;"
                                                onclick="loadDetail('{{ $item->id_kedatangan }}', '{{ $item->type }}')"
                                                class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 ">Detail</a>
                                        </div>
                                    </li>
                                @empty
                                    <div class="flex items-center justify-center h-full">
                                        <li class="text-center mt-4 text-grey text-lg">Tidak Ada Data Kunjungan</li>
                                    </div>
                                @endforelse
                            </ul>
                            {{ $kedatanganTamu->links('components.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-admin.footer />
    </main>

    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- plugin for scrollbar  -->
<!-- <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script> -->
<!-- main script file  -->
<!-- <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> -->
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable({});
    });
</script> -->
{{ $chart->script() }}


<script>
    function filterStatus(status, element) {
        const items = document.querySelectorAll('.search-item');
        const buttons = document.querySelectorAll('.filter-btn');

        // Filter the list items based on the status
        items.forEach(item => {
            if (status === 'semua' || item.getAttribute('data-status') === status) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });

        // Reset all button colors to default
        buttons.forEach(button => {
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
            url: '/admin/kunjungan/' + id, // Pastikan URL ini sesuai dengan route Anda
            method: 'GET',
            success: function(data) {
                // Update container dengan partial view yang diterima dari server
                $('#cardDetail').html(data);
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
