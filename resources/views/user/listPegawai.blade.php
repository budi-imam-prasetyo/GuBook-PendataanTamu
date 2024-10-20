<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="relative  bg-gradient-to-b from-secondaryBlue to-primaryBlue text-light">
    <!-- Navigation -->
    <x-user.navbar></x-user.navbar>

    <div class="absolute left-1/2 top-1/2 -z-990 -translate-x-1/2 -translate-y-1/2 transform">
        <img src="{{ asset('assets/logo2.png') }}" class="h-100 opacity-40 sm:h-135 md:h-180" alt="Logo" />
    </div>

    <!-- Main Content -->
    <main class="flex flex-col items-center justify-center gap-5 w-screen px-10">
        <div class="w-full text-center">
            <h1 class="text-3xl text-light">List Pegawai</h1>
        </div>

        <!-- Input Section -->
        <div class="flex w-full">
            <div class="mx-auto grid w-full gap-5 px-8 md:w-[70%] ">
                <!-- Search Input -->
                <div class="join w-full lg:w-1/3 px-10">
                    <input type="text" name="searchInput" id="searchInput"
                        class="input join-item w-full border-none bg-light text-dark placeholder:text-grey"
                        placeholder="Cari NIP, Nama, Email, PTK" autocomplete="nickname" />                                                      
                    <div class="btn join-item bg-light">
                        <img src="{{ asset('assets/icons/search2.svg') }}" class="h-5 text-dark" alt="search icon" />
                    </div>
                </div>

                <!-- Mapel Dropdown -->
                {{-- <div class="relative w-full">
                    <select id="filterPTK" class="select w-full text-dark">
                        <option value="">Pilih Mapel</option>
                        @foreach ($listmapel as $mapel)
                            <option value="{{ $mapel }}">
                                {{ $mapel }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
            </div>
        </div>

        <!-- Table Section -->
        <div class="w-full lg:w-2/3">
            <div class="block w-full overflow-auto ">
                <table class="w-full border-collapse rounded-xl bg-light" id="pegawaiTable">
                    <thead>
                        <tr class="shadow-sm">
                            <th
                                class="w-[5%] whitespace-nowrap rounded-tl-xl bg-primaryBlue px-2 py-4 text-center text-sm font-semibold uppercase text-light">
                                No.
                            </th>
                            <th
                                class="w-[30%] whitespace-nowrap bg-primaryBlue px-6 py-4 text-center text-sm font-semibold uppercase text-light">
                                NIP
                            </th>
                            <th
                                class="w-[25%] whitespace-nowrap bg-primaryBlue px-6 py-4 text-center text-sm font-semibold uppercase text-light">
                                Nama Pegawai
                            </th>
                            <th
                                class="w-[25%] whitespace-nowrap bg-primaryBlue px-6 py-4 text-center text-sm font-semibold uppercase text-light">
                                Email
                            </th>
                            <th
                                class="w-[15%] whitespace-nowrap rounded-tr-xl bg-primaryBlue px-6 py-4 text-center text-sm font-semibold uppercase text-light">
                                PTK
                            </th>
                        </tr>
                    </thead>
                    <tbody class="overflow-x-scroll">
                        @foreach (range(0, 9) as $index)
                            @if (isset($listpegawai[$index]))
                                <tr class="group hover:bg-lightBlue2">
                                    <td
                                        class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark">
                                        {{ $startIndex + $index }}.
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark">
                                        {{ $listpegawai[$index]->NIP }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark">
                                        {{ $listpegawai[$index]->user->nama }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm lowercase text-dark">
                                        {{ $listpegawai[$index]->user->email }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark">
                                        {{ $listpegawai[$index]->PTK }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5"
                                        class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark">
                                        &nbsp;
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>
                <div class="mt-4 rounded-xl bg-light py-2">
                    {{ $listpegawai->links('components.pagination') }}
                </div>
            </div>
        </div>
    </main>

    <!-- Script -->
    <script>
        document
            .getElementById('searchInput')
            .addEventListener('keyup', function() {
                filterTable();
            });

        // document
        //     .getElementById('filterPTK')
        //     .addEventListener('change', function() {
        //         filterTable();
        //     });

        function filterTable() {
            var input, filter, ptkFilter, table, tr, td, i, j, txtValue;
            input = document
                .getElementById('searchInput')
            //     .value.toLowerCase();
            // ptkFilter = document
            //     .getElementById('filterPTK')
            //     .value.toLowerCase();
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
                // if (
                //     ptkFilter &&
                //     td[3].textContent.toLowerCase() !== ptkFilter
                // ) {
                //     match = false;
                // }
                if (match) {
                    tr[i].style.display = '';
                }
            }
        }

        document
            .getElementById('searchInput')
            .addEventListener('keyup', function() {
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
