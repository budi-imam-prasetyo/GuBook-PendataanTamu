<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Kunjungan</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="m-0 font-sans text-base antialiased font-medium bg-gray-50 leading-default text-slate-500 dark:bg-slate-900">
    @apexchartsScripts

    <div class="absolute w-full min-h-80 bg-primaryRed "></div>

    <x-pegawai.sidebar></x-pegawai.sidebar>

    <main class="relative h-full transition-all duration-200 ease-in-out rounded-xl xl:ml-68">
        {{-- Navbar --}}
        <x-pegawai.navbar>Kunjungan</x-pegawai.navbar>

        <div class="flex flex-col w-full p-6 pt-3 gap-7">
            {{-- Rows 1 --}}
            <div class="flex w-full">
                <div class="grid w-full h-full grid-cols-1 gap-6 md:grid-cols-4">
                    <div
                        class="flex flex-col order-last md:order-first bg-light shadow-sm rounded-4.5 md:col-span-3 p-5">
                        <div class="w-full">
                            <h1 class="text-xl text-dark">Kedatangan Tamu</h1>
                        </div>
                        <div class="grid h-full grid-cols-1 gap-6 md:grid-cols-3">
                            {{-- Card 1 --}}
                            <div class="flex flex-row justify-between h-full p-5 -mx-1 shadow-md bg-lightRed rounded-3">
                                <div class="flex-none max-w-full">
                                    <div>
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
                                            Selesai
                                        </p>
                                        <h5 class="mb-2 font-bold">7</h5>
                                        <p class="mb-2 text-xs">> 50% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center text-right">
                                    <div
                                        class="flex items-center justify-center w-16 h-16 rounded-circle bg-gradient-to-t from-primaryRed to-secondaryRed">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            {{-- Card 2 --}}
                            <div class="flex flex-row justify-between h-full p-5 -mx-1 shadow-md bg-lightRed rounded-3">
                                <div class="flex-none max-w-full">
                                    <div>
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
                                            Belum Datang
                                        </p>
                                        <h5 class="mb-2 font-bold">2</h5>
                                        <p class="mb-2 text-xs">> 25% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center text-right">
                                    <div
                                        class="flex items-center justify-center w-16 h-16 rounded-circle bg-gradient-to-tl from-primaryRed to-secondaryRed">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            {{-- Card 3 --}}
                            <div class="flex flex-row justify-between h-full p-5 -mx-1 shadow-md bg-lightRed rounded-3">
                                <div class="flex-none max-w-full">
                                    <div>
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
                                            Tidak Hadir
                                        </p>
                                        <h5 class="mb-2 font-bold">1</h5>
                                        <p class="mb-2 text-xs">> 75% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center text-right">
                                    <div
                                        class="flex items-center justify-center w-16 h-16 rounded-circle bg-gradient-to-b from-primaryRed to-secondaryRed">
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
            <div class="flex w-full mt-1">
                <div class="grid w-full grid-cols-1 md:grid-cols-7 gap-y-6 md:gap-6">
                    <div class="w-full flex flex-col bg-light p-5 col-span-3 rounded-4.5 shadow-md" id="cardDetail">
                        <div class="w-full h-135 flex flex-col col-span-3 gap-6 rounded-4.5 text-center">
                            <!-- <div class="flex items-center justify-center w-full">
                                <div class="flex items-center justify-center rounded-full w-25 h-25 outline outline-4 bg-base-200 outline-base-300">
                                    <img src="{{ asset('assets/user.jpg') }}" class="h-full rounded-full" alt="">
                                </div>
                            </div> -->
                            <div class="flex flex-col items-center justify-center w-full h-full mt-4">
                                <h5 class="text-xl font-semibold select-none text-grey">Klik detail untuk melihat</h5>
                            </div>
                        </div>
                    </div>

                    <div class="w-full bg-light rounded-4.5 shadow-md col-span-4 p-4.5">
                        <div class="relative mb-4">
                            <div
                                class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <img src="{{ asset('assets/icons/search2.svg') }}" class="w-5 h-5" alt="">
                            </div>
                            <input id="searchInput" type="text"
                                class="block w-full px-4 py-3 text-sm border-2 rounded-lg outline-none peer ps-11 bg-lightRed border-lightRed2 placeholder:font-semibold placeholder:text-grey"
                                placeholder="Enter name">
                        </div>

                        <div class="flex gap-4 mb-4">
                            <button id="filter-all"
                                class="px-4 py-2 font-semibold text-white border-2 rounded-lg filter-btn border-primaryRed bg-primaryRed active"
                                onclick="filterStatus('semua', this)">Semua</button>
                            <button id="filter-accepted"
                                class="px-4 py-2 font-semibold border-2 rounded-lg filter-btn bg-lightRed border-lightRed2 text-primaryRed"
                                onclick="filterStatus('diterima', this)">Diterima</button>
                            <button id="filter-rejected"
                                class="px-4 py-2 font-semibold border-2 rounded-lg filter-btn bg-lightRed border-lightRed2 text-primaryRed"
                                onclick="filterStatus('ditolak', this)">Ditolak</button>
                            <button id="filter-pending"
                                class="px-4 py-2 font-semibold border-2 rounded-lg filter-btn bg-lightRed border-lightRed2 text-primaryRed"
                                onclick="filterStatus('menunggu', this)">Menunggu</button>
                        </div>

                        <div class="relative">
                            <ul id="visitList"
                                class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0 max-h-116 min-h-116 overflow-y-auto">
                                @forelse ($kedatangan as $item)
                                    <li class="relative flex px-6 py-4 mb-2 border-2 search-item rounded-xl rounded-t-inherit border-lightRed2 bg-lightRed dark:bg-slate-850"
                                        data-status="{{ $item->status }}">
                                        <div class="flex ml-4 gap-7">
                                            <div class="flex items-center justify-center h-full">
                                                @if ($item->type == 'tamu')
                                                    <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                                @else
                                                    <img src="{{ asset('assets/icons/box2.svg') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                @if ($item->type == 'tamu')
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
                                                                </span>{{ $item->formatWaktu }}</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <h5 class="text-lg font-semibold">
                                                        {{ $item->ekspedisi->nama_kurir }}
                                                    </h5>
                                                    <div class="flex gap-2">
                                                        <div class="flex flex-col gap-3 mb-2 text-sm leading-tight">
                                                            <p class="font-semibold capitalize"><span
                                                                    class="font-normal">Nama
                                                                    Kurir:
                                                                </span>{{ $item->ekspedisi->nama_kurir }}</p>
                                                            <p class="font-semibold capitalize"><span
                                                                    class="font-normal">Ekspedisi:
                                                                </span>{{ $item->ekspedisi->ekspedisi }}</p>
                                                            <p class="font-semibold capitalize"><span
                                                                    class="font-normal">Tanggal Kedatangan:
                                                                </span>{{ $item->formatWaktu }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center ml-auto text-right">
                                            <a href="javascript:;"
                                                onclick="loadDetail('{{ $item->id_kedatangan }}', '{{ $item->type }}')"
                                                class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white">Detail</a>
                                        </div>
                                    </li>
                                @empty
                                    <div class="flex items-center justify-center h-full">
                                        <li class="mt-4 text-lg text-center text-grey">Tidak Ada Data Kunjungan</li>
                                    </div>
                                @endforelse
                            </ul>
                            @if ($kedatangan->count() > 3)
                            <button id="scrollDown"
                            class="absolute p-3 mt-2 rounded-full shadow-md bottom-3 start-1/2 outline outline-2 outline-light bg-lightRed2 shadow-grey">
                            <img src="{{ asset('assets/icons/arrow-left.svg') }}" class="w-5 rotate-90"
                            alt="arrow">
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
        <x-pegawai.footer />
    </main>

    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


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
                button.classList.remove('border-primaryRed', 'bg-primaryRed', 'text-white', 'active');
                button.classList.add('bg-lightRed', 'text-primaryRed');
            });

            // Set the clicked button as active
            element.classList.remove('bg-lightRed', 'text-primaryRed');
            element.classList.add('border-primaryRed', 'bg-primaryRed', 'text-white', 'active');
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('.search-item');

            items.forEach(function(item) {
                let text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        function loadDetail(id_kedatangan, type) {
            $.ajax({
                url: '/pegawai/kunjungan/' + id_kedatangan,
                method: 'GET',
                success: function(data) {
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
                top: visitList.scrollHeight,
                behavior: 'smooth'
            });
        });
    </script>
    {{ $chart->script() }}
</body>

</html>
