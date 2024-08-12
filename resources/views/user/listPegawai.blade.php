<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />
    
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="relative h-screen bg-gradient-to-b from-secondaryBlue to-primaryBlue text-light">
    <!-- Navigation -->
    <x-user.navbar></x-user.navbar>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-990">
        <img src="{{ asset('assets/logo2.png') }}" class="opacity-40 h-100 sm:h-135 md:h-180" alt="Logo">
    </div>

    <!-- Main Content -->
    <main class="flex flex-col items-center justify-center gap-5">
        <div class="w-full text-center">
            <h1 class="text-3xl text-light">List Pegawai</h1>
        </div>

        <!-- Input Section -->
        <div class="flex w-full">
            <div class="grid w-full gap-5 px-10 md:w-[70%] mx-auto md:grid-cols-3">
                <!-- Search Input -->
                <div class="w-full join">
                    <input type="text" name="searchInput" id="searchInput" class="w-full text-dark border-none input join-item bg-light placeholder:text-dark" placeholder="Nama Pegawai" autocomplete="nickname" />
                    <div class="btn bg-light join-item">
                        <img src="{{ asset('assets/icons/search2.svg') }}" class="h-5 text-dark" alt="search icon">
                    </div>
                </div>

                <!-- Mapel Dropdown -->
                <div class="relative w-full">
                    <select id="filterPTK" class="w-full select text-dark">
                        <option value="">Pilih Mapel</option>
                        @foreach ($listmapel as $mapel)
                            <option value="{{ $mapel }}">{{ $mapel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="w-full md:w-2/3">
            <div class="block w-full px-10 overflow-x-auto md:px-3">
                <table class="w-full bg-light border-collapse rounded-xl" id="pegawaiTable">
                    <thead>
                        <tr class="shadow-sm">
                            <th class="w-[5%] px-2 py-4 text-sm font-semibold text-center text-light uppercase bg-primaryBlue rounded-tl-xl whitespace-nowrap">No.</th>
                            <th class="w-[30%] px-6 py-4 text-sm font-semibold text-center text-light uppercase bg-primaryBlue whitespace-nowrap">NIP</th>
                            <th class="w-[25%] px-6 py-4 text-sm font-semibold text-center text-light uppercase bg-primaryBlue whitespace-nowrap">Nama Pegawai</th>
                            <th class="w-[25%] px-6 py-4 text-sm font-semibold text-center text-light uppercase bg-primaryBlue whitespace-nowrap">Email</th>
                            <th class="w-[15%] px-6 py-4 text-sm font-semibold text-center text-light uppercase bg-primaryBlue rounded-tr-xl whitespace-nowrap">PTK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listpegawai as $list)
                        <tr class="group hover:bg-lightBlue2">
                            <th class="py-4 text-sm text-center text-dark align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $list->id }}.</th>
                            <td class="py-4 text-sm text-center text-dark align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $list->NIP }}</td>
                            <td class="py-4 text-sm text-center text-dark align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $list->user->nama }}</td>
                            <td class="py-4 text-sm text-center text-dark align-middle border-t-0 border-l-0 border-r-0 lowercase whitespace-nowrap">{{ $list->user->email }}</td>
                            <td class="py-4 text-sm text-center text-dark align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $list->PTK }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                    
                <div class="mt-4 py-2 bg-light rounded-xl">
                    {{ $listpegawai->links('components.pagination') }}
                </div>
            </div>
        </div>
    </main>

    <!-- Script -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
        filterTable();
    });

    document.getElementById('filterPTK').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        var input, filter, ptkFilter, table, tr, td, i, j, txtValue;
        input = document.getElementById('searchInput').value.toLowerCase();
        ptkFilter = document.getElementById('filterPTK').value.toLowerCase();
        table = document.getElementById('pegawaiTable');
        tr = table.getElementsByTagName('tr');

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = 'none';
            td = tr[i].getElementsByTagName('td');
            var match = false;
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().includes(input)) {
                        match = true;
                    }
                }
            }
            if (ptkFilter && td[3].textContent.toLowerCase() !== ptkFilter) {
                match = false;
            }
            if (match) {
                tr[i].style.display = '';
            }
        }
    }

    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toLowerCase();
        table = document.getElementById('pegawaiTable');
        tr = table.getElementsByTagName('tr');

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = 'none';
            td = tr[i].getElementsByTagName('td');
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().includes(filter)) {
                        tr[i].style.display = '';
                        break;
                    }
                }
            }
        }
    });
    </script>
</body>

</html>
