<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GuBook | Kunjungan</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans text-base font-medium leading-default text-slate-500 antialiased ">
    @apexchartsScripts

    <div class="absolute min-h-80 w-full bg-primaryBlue"></div>

    <x-FO.sidebar></x-FO.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        {{-- Navbar --}}
        <x-FO.navbar>Laporan Tamu</x-FO.navbar>

        <div class="w-full grid grid-cols-7 gap-2 p-6 pt-3">
            <input type="text" id="searchInput" class="input input-bordered col-span-4" placeholder="Cari Tamu ..."
                autocomplete="off">
            <div class="drawer drawer-end col-span-1 z-10">
                <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <!-- Page content here -->
                    <label for="my-drawer-4" class="drawer-button btn font-normal">
                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 2.00245C4.73478 2.00245 4.48043 2.10781 4.29289 2.29534C4.10536 2.48288 4 2.73723 4 3.00245C4 3.26767 4.10536 3.52202 4.29289 3.70956C4.48043 3.89709 4.73478 4.00245 5 4.00245C5.26522 4.00245 5.51957 3.89709 5.70711 3.70956C5.89464 3.52202 6 3.26767 6 3.00245C6 2.73723 5.89464 2.48288 5.70711 2.29534C5.51957 2.10781 5.26522 2.00245 5 2.00245ZM2.17 2.00245C2.3766 1.41692 2.75974 0.909884 3.2666 0.55124C3.77346 0.192596 4.37909 0 5 0C5.62091 0 6.22654 0.192596 6.7334 0.55124C7.24026 0.909884 7.6234 1.41692 7.83 2.00245H15C15.2652 2.00245 15.5196 2.10781 15.7071 2.29534C15.8946 2.48288 16 2.73723 16 3.00245C16 3.26767 15.8946 3.52202 15.7071 3.70956C15.5196 3.89709 15.2652 4.00245 15 4.00245H7.83C7.6234 4.58798 7.24026 5.09502 6.7334 5.45366C6.22654 5.81231 5.62091 6.0049 5 6.0049C4.37909 6.0049 3.77346 5.81231 3.2666 5.45366C2.75974 5.09502 2.3766 4.58798 2.17 4.00245H1C0.734784 4.00245 0.48043 3.89709 0.292893 3.70956C0.105357 3.52202 0 3.26767 0 3.00245C0 2.73723 0.105357 2.48288 0.292893 2.29534C0.48043 2.10781 0.734784 2.00245 1 2.00245H2.17ZM11 8.00245C10.7348 8.00245 10.4804 8.10781 10.2929 8.29534C10.1054 8.48288 10 8.73723 10 9.00245C10 9.26767 10.1054 9.52202 10.2929 9.70956C10.4804 9.89709 10.7348 10.0025 11 10.0025C11.2652 10.0025 11.5196 9.89709 11.7071 9.70956C11.8946 9.52202 12 9.26767 12 9.00245C12 8.73723 11.8946 8.48288 11.7071 8.29534C11.5196 8.10781 11.2652 8.00245 11 8.00245ZM8.17 8.00245C8.3766 7.41692 8.75974 6.90988 9.2666 6.55124C9.77346 6.1926 10.3791 6 11 6C11.6209 6 12.2265 6.1926 12.7334 6.55124C13.2403 6.90988 13.6234 7.41692 13.83 8.00245H15C15.2652 8.00245 15.5196 8.10781 15.7071 8.29534C15.8946 8.48288 16 8.73723 16 9.00245C16 9.26767 15.8946 9.52202 15.7071 9.70956C15.5196 9.89709 15.2652 10.0025 15 10.0025H13.83C13.6234 10.588 13.2403 11.095 12.7334 11.4537C12.2265 11.8123 11.6209 12.0049 11 12.0049C10.3791 12.0049 9.77346 11.8123 9.2666 11.4537C8.75974 11.095 8.3766 10.588 8.17 10.0025H1C0.734784 10.0025 0.48043 9.89709 0.292893 9.70956C0.105357 9.52202 0 9.26767 0 9.00245C0 8.73723 0.105357 8.48288 0.292893 8.29534C0.48043 8.10781 0.734784 8.00245 1 8.00245H8.17ZM5 14.0025C4.73478 14.0025 4.48043 14.1078 4.29289 14.2953C4.10536 14.4829 4 14.7372 4 15.0025C4 15.2677 4.10536 15.522 4.29289 15.7096C4.48043 15.8971 4.73478 16.0025 5 16.0025C5.26522 16.0025 5.51957 15.8971 5.70711 15.7096C5.89464 15.522 6 15.2677 6 15.0025C6 14.7372 5.89464 14.4829 5.70711 14.2953C5.51957 14.1078 5.26522 14.0025 5 14.0025ZM2.17 14.0025C2.3766 13.4169 2.75974 12.9099 3.2666 12.5512C3.77346 12.1926 4.37909 12 5 12C5.62091 12 6.22654 12.1926 6.7334 12.5512C7.24026 12.9099 7.6234 13.4169 7.83 14.0025H15C15.2652 14.0025 15.5196 14.1078 15.7071 14.2953C15.8946 14.4829 16 14.7372 16 15.0025C16 15.2677 15.8946 15.522 15.7071 15.7096C15.5196 15.8971 15.2652 16.0025 15 16.0025H7.83C7.6234 16.588 7.24026 17.095 6.7334 17.4537C6.22654 17.8123 5.62091 18.0049 5 18.0049C4.37909 18.0049 3.77346 17.8123 3.2666 17.4537C2.75974 17.095 2.3766 16.588 2.17 16.0025H1C0.734784 16.0025 0.48043 15.8971 0.292893 15.7096C0.105357 15.522 0 15.2677 0 15.0025C0 14.7372 0.105357 14.4829 0.292893 14.2953C0.48043 14.1078 0.734784 14.0025 1 14.0025H2.17Z"
                                fill="black" />
                        </svg>
                        Filter & Ekspor</label>
                </div>
                <div class="drawer-side">
                    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                    <div class="menu flex flex-col gap-4 p-4 bg-white min-h-full rounded-lg w-full md:w-80 shadow mb-4">
                        <form id="filterForm" method="GET" action="{{ route('FO.laporanKurir') }}"
                            class="flex flex-col gap-4 h-full">
                            {{-- Preserve existing sort parameters --}}
                            <input type="hidden" name="sort" value="{{ $sort }}">
                            <input type="hidden" name="direction" value="{{ $direction }}">

                            <!-- Filter Type Selection -->
                            <div class="flex flex-col gap-2">
                                <label for="filterType" class="font-medium">Tipe Filter</label>
                                <select id="filterType" name="filterType"
                                    class="select select-bordered w-full min-w-[200px]"
                                    onchange="toggleFilterOptions()">
                                    <option value="daily" {{ $currentFilter['type'] === 'daily' ? 'selected' : '' }}>
                                        Harian</option>
                                    <option value="monthly"
                                        {{ $currentFilter['type'] === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="yearly" {{ $currentFilter['type'] === 'yearly' ? 'selected' : '' }}>
                                        Tahunan</option>
                                </select>
                            </div>

                            <!-- Daily Filter Options -->
                            <div id="dailyFilter" class="hidden flex-col gap-2">
                                <div class="flex gap-4 flex-col">
                                    <div class="flex flex-col gap-2">
                                        <label for="startDate" class="font-medium">Tanggal Mulai</label>
                                        <input type="date" id="startDate" name="startDate"
                                            class="input input-bordered" value="{{ $currentFilter['startDate'] }}">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="endDate" class="font-medium">Tanggal Selesai</label>
                                        <input type="date" id="endDate" name="endDate" class="input input-bordered"
                                            value="{{ $currentFilter['endDate'] }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly Filter Options -->
                            <div id="monthlyFilter" class="hidden flex-col gap-2">
                                <div class="flex gap-4 flex-col">
                                    <div class="flex flex-col gap-2">
                                        <label for="month" class="font-medium">Bulan</label>
                                        <select id="month" name="month"
                                            class="select select-bordered w-full min-w-[200px]">
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ $month }}"
                                                    {{ $currentFilter['month'] == $month ? 'selected' : '' }}>
                                                    {{ Carbon\Carbon::createFromDate(null, $month, 1)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="monthYear" class="font-medium">Tahun</label>
                                        <select id="monthYear" name="monthYear"
                                            class="select select-bordered w-full min-w-[200px]">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Yearly Filter Options -->
                            <div id="yearlyFilter" class="hidden flex-col gap-2">
                                <div class="flex flex-col gap-2">
                                    <label for="year" class="font-medium">Tahun</label>
                                    <select id="year" name="year"
                                        class="select select-bordered w-full min-w-[200px]">
                                    </select>
                                </div>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="fixed bottom-0 left-0 right-0 flex flex-col p-4 gap-4 w-full">
                                <a href="{{ route('FO.laporanKurir.export', request()->query()) }}"
                                    class="btn btn-primary bg-primaryBlue w-full text-white opacity-100">Ekspor</a>
                                <div class="w-full flex gap-4">
                                    <div class="flex-1">
                                        <a href="{{ route('FO.laporanTamu') }}"
                                            class="btn btn-outline w-full">Reset</a>
                                    </div>
                                    <div class="flex-1">
                                        <button type="submit"
                                            class="btn btn-primary bg-primaryBlue text-white opacity-100 w-full">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto p-6 pt-0">
            <table id="pegawaiTable" class="table w-full min-w-full shadow">
                <thead class="tracking-widest text-slate-700 bg-lightBlue">
                    <tr>
                        <th class="p-4 text-base text-center cursor-pointer select-none rounded-tl-lg">
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'nama_kurir', 'direction' => $sort === 'nama_kurir' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Nama Kurir
                                @if ($sort === 'nama_kurir')
                                    @if ($direction === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="p-4 text-base text-center cursor-pointer select-none">
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'nama_pegawai', 'direction' => $sort === 'nama_pegawai' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Pegawai
                                @if ($sort === 'nama_pegawai')
                                    @if ($direction === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="p-4 text-base text-center cursor-pointer select-none">
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'ekspedisi', 'direction' => $sort === 'ekspedisi' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Ekspedisi
                                @if ($sort === 'ekspedisi')
                                    @if ($direction === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="p-4 text-base text-center cursor-pointer select-none">
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'no_telpon', 'direction' => $sort === 'no_telpon' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                No Telpon
                                @if ($sort === 'no_telpon')
                                    @if ($direction === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="p-4 text-base text-center cursor-pointer select-none">
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'waktu_kedatangan', 'direction' => $sort === 'waktu_kedatangan' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Waktu Kedatangan
                                @if ($sort === 'waktu_kedatangan')
                                    @if ($direction === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="p-4 text-base text-center select-none rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pegawai-list" class="bg-white">
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-4"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada Kedatangan</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-6 py-4"></td>
                        </tr>
                    @else
                        @foreach ($data as $laporanTamu)
                            <tr class="border-b hover:bg-gray-100 group ">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col text-center">
                                        <div class="text-sm font-medium text-gray-900 capitalize">
                                            {{ $laporanTamu->nama_kurir }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $laporanTamu->email }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ $laporanTamu->nama_pegawai }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ $laporanTamu->ekspedisi->ekspedisi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ $laporanTamu->ekspedisi->no_telpon }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    @if ($laporanTamu->waktu_kedatangan)
                                        <div class="flex flex-col items-center">
                                            <span
                                                class="">{{ \Carbon\Carbon::parse($laporanTamu->waktu_kedatangan)->format('H:i') }}</span>
                                            <span
                                                class="text-gray-500">{{ \Carbon\Carbon::parse($laporanTamu->waktu_kedatangan)->format('d M Y') }}</span>
                                        </div>
                                    @else
                                        <span class="font-bold">---</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <label for="detail-modal-{{ $laporanTamu->id_kedatangan }}"
                                        class="inline-flex items-center justify-center p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </label>
                                </td>
                                <input type="checkbox" id="detail-modal-{{ $laporanTamu->id_kedatangan }}"
                                    class="modal-toggle" />
                                <div class="modal backdrop-blur-sm">
                                    <div class="modal-box relative max-w-lg bg-white rounded-lg shadow-xl">
                                        <label for="detail-modal-{{ $laporanTamu->id_kedatangan }}"
                                            class="btn btn-sm btn-circle absolute right-3 top-3 hover:bg-gray-100 focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </label>

                                        <div class="p-6 pt-2">
                                            <div class="avatar flex justify-center">
                                                <div class="avatar flex justify-center">
                                                    @if ($laporanTamu->foto)
                                                        <img src="{{ asset('storage/img-kurir/' . $laporanTamu->foto) }}"
                                                            class="w-30 rounded-full" alt="Foto Tamu">
                                                    @else
                                                        <img src="{{ $nullFoto }}" class="w-30 rounded-full"
                                                            alt="Foto Default">
                                                    @endif
                                                    {{-- {{ dd($laporanTamu->foto) }} --}}
                                                </div>

                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900 mb-6">Detail Tamu</h3>
                                            <div class="space-y-4">
                                                <div class="flex items-center border-b border-gray-100 pb-4">
                                                    <span class="w-1/3 text-gray-500">Nama</span>
                                                    <span
                                                        class="w-2/3 font-medium">{{ $laporanTamu->nama_kurir }}</span>
                                                </div>
                                                <div class="flex items-center border-b border-gray-100 pb-4">
                                                    <span class="w-1/3 text-gray-500">No Telepon</span>
                                                    <span
                                                        class="w-2/3 font-medium">{{ $laporanTamu->no_telpon }}</span>
                                                </div>
                                                <div class="flex items-center border-b border-gray-100 pb-4">
                                                    <span class="w-1/3 text-gray-500">NIP</span>
                                                    <span class="w-2/3 font-medium">{{ $laporanTamu->NIP }}</span>
                                                </div>
                                                <div class="flex items-center border-b border-gray-100 pb-4">
                                                    <span class="w-1/3 text-gray-500">PTK</span>
                                                    <span class="w-2/3 font-medium">{{ $laporanTamu->PTK }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="w-1/3 text-gray-500">Tanggal Kedatangan</span>
                                                    <span
                                                        class="w-2/3 font-medium">{{ $laporanTamu->waktu_kedatangan ? date('d M Y, H:i', strtotime($laporanTamu->waktu_kedatangan)) : '-' }}</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    @endif
            </table>

            <div class="mt-4">
                {{ $data->appends(['sort' => $sort, 'direction' => $direction])->links('components.pagination') }}
            </div>
        </div>

        <x-FO.footer />

    </main>

    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Populate year options
    function populateYears() {
        const currentYear = new Date().getFullYear();
        const yearSelects = document.querySelectorAll('#year, #monthYear');
        const selectedMonthYear = '{{ $currentFilter['monthYear'] }}';
        const selectedYear = '{{ $currentFilter['year'] }}';

        yearSelects.forEach(select => {
            select.innerHTML = ''; // Clear existing options
            for (let year = currentYear; year >= currentYear - 10; year--) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;

                // Set selected based on filter type
                if (select.id === 'monthYear' && year.toString() === selectedMonthYear) {
                    option.selected = true;
                } else if (select.id === 'year' && year.toString() === selectedYear) {
                    option.selected = true;
                }

                select.appendChild(option);
            }
        });
    }

    // Clear all filter values
    function clearFilterValues() {
        // Clear daily filter values
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';

        // Clear monthly filter values
        document.getElementById('month').selectedIndex = 0;
        document.getElementById('monthYear').selectedIndex = 0;

        // Clear yearly filter values
        document.getElementById('year').selectedIndex = 0;
    }

    // Toggle filter options based on selection
    function toggleFilterOptions() {
        const filterType = document.getElementById('filterType').value;
        const dailyFilter = document.getElementById('dailyFilter');
        const monthlyFilter = document.getElementById('monthlyFilter');
        const yearlyFilter = document.getElementById('yearlyFilter');

        // Hide all filters first
        dailyFilter.classList.add('hidden');
        dailyFilter.style.display = 'none';
        monthlyFilter.classList.add('hidden');
        monthlyFilter.style.display = 'none';
        yearlyFilter.classList.add('hidden');
        yearlyFilter.style.display = 'none';

        // Clear all filter values when switching types
        clearFilterValues();

        // Show selected filter
        if (filterType === 'daily') {
            dailyFilter.classList.remove('hidden');
            dailyFilter.style.display = 'flex';
        } else if (filterType === 'monthly') {
            monthlyFilter.classList.remove('hidden');
            monthlyFilter.style.display = 'flex';
        } else if (filterType === 'yearly') {
            yearlyFilter.classList.remove('hidden');
            yearlyFilter.style.display = 'flex';
        }
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        populateYears();
        toggleFilterOptions();
    });

    // Add form submit handler to validate required fields
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        const filterType = document.getElementById('filterType').value;

        if (filterType === 'daily') {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            if (!startDate || !endDate) {
                e.preventDefault();
                alert('Silakan isi tanggal mulai dan tanggal selesai untuk filter harian');
            }
        } else if (filterType === 'monthly') {
            const month = document.getElementById('month').value;
            const monthYear = document.getElementById('monthYear').value;
            if (!month || !monthYear) {
                e.preventDefault();
                alert('Silakan pilih bulan dan tahun untuk filter bulanan');
            }
        } else if (filterType === 'yearly') {
            const year = document.getElementById('year').value;
            if (!year) {
                e.preventDefault();
                alert('Silakan pilih tahun untuk filter tahunan');
            }
        } else {
            e.preventDefault();
            alert('Silakan pilih tipe filter');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const tbody = document.getElementById('pegawai-list');

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                const query = this.value;

                // Jika search kosong, reload halaman untuk mengembalikan pagination
                if (query.length === 0) {
                    window.location.reload();
                    return;
                }

                fetch(`/FO/search-kurir?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        tbody.innerHTML = ''; // Clear existing rows

                        if (data.length === 0) {
                            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data ditemukan</td>
                </tr>
                `;
                            return;
                        }

                        data.forEach(item => {
                            const row = `
                <tr class="border-b hover:bg-gray-100 group ">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col text-center">
                            <div class="text-sm font-medium text-gray-900 capitalize">
                                ${item.nama_kurir}
                            </div>
                            <div class="text-sm text-gray-500">
                                ${item.email || ''}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                        ${item.nama_pegawai}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                        ${item.ekspedisi}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                        ${item.no_telpon}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                        ${item.waktu_kedatangan ? 
                            `<div class="flex flex-col items-center">
                                <span>${new Date(item.waktu_kedatangan).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</span>
                                <span class="text-gray-500">${new Date(item.waktu_kedatangan).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'})}</span>
                             </div>` 
                            : '<span class="font-bold">---</span>'
                        }
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <label for="detail-modal-${item.id_kedatangan}"
                            class="inline-flex items-center justify-center p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </label>
                    </td>
                </tr>
            `;
                            tbody.innerHTML += row;
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-4">Terjadi kesalahan saat mencari data</td>
            </tr>
        `;
                    });
            }, 500); // Delay 500ms untuk mengurangi request ke server
        });
    });
</script>


</html>
