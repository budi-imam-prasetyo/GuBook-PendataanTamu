<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Pegawai</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="m-0 font-sans text-base antialiased font-medium bg-gray-50 leading-default text-slate-500 dark:bg-slate-900">
    <div class="absolute w-full min-h-80 bg-primaryBlue"></div>

    <x-FO.sidebar></x-FO.sidebar>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out rounded-xl xl:ml-68">
        <!-- Navbar -->
        <x-FO.navbar>Pegawai</x-FO.navbar>

        <div class="w-full p-6 pb-0 mx-auto ">
            <!-- table 1 -->

            <div class="flex flex-wrap mt-5 -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-transparent border-solid shadow-lg rounded-2xl bg-clip-border dark:bg-slate-850 dark:shadow-dark-xl">
                        <!-- <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="uppercase dark:text-white">Tabel Guru</h6>
                        </div> -->
                        <div class="flex-auto p-5">
                            <div class="p-4">
                                <div class="flex justify-center gap-2">
                                    <h1 class="mb-4 text-2xl font-bold text-center select-none dark:text-white">Tabel
                                        Pegawai
                                    </h1>
                                    @if (session()->has('add') || session()->has('update') || session()->has('delete'))
                                    <div role="alert"
                                        class="text-xl 
        {{ session()->has('add') ? 'text-green-500' : (session()->has('update') ? 'text-primaryBlue' : 'text-primaryRed') }}">
                                        {{ session('add') ?? (session('update') ?? session('delete')) }}
                                    </div>
                                    @endif

                                </div>
                                <div class="flex flex-col md:flex-row w-full mb-2">
                                    <div class="flex m-2 ml-0 join flex-col md:flex-row gap-3 md:gap-0">
                                        <label class="flex items-center w-full border rounded-lg input input-lg input-bordered md:join-item">
                                            <input type="text" class="grow" id="searchInput1" value="{{ request('search') }}"
                                                placeholder="Cari Pegawai..." />
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="h-7 w-7 opacity-70">
                                                <path fill-rule="evenodd"
                                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </label>
                                        <select id="filterPTK" class="select select-bordered md:join-item select-lg">
                                            <option value="">Filter</option>
                                            @foreach ($listpegawai->pluck('PTK')->unique() as $ptk)
                                            <option value="{{ $ptk }}">{{ $ptk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="overflow-x-auto">
                                    <table id="pegawaiTable" class="table w-full min-w-full">
                                        <thead class="tracking-widest text-white bg-primaryBlue">
                                            <tr>
                                                <th class="p-4 text-base text-center cursor-pointer select-none rounded-tl-lg whitespace-nowrap"
                                                    onclick="sortTable(0)">Nama</th>
                                                <th class="p-4 text-base text-center cursor-pointer select-none whitespace-nowrap"
                                                    onclick="sortTable(1)">No Telepon</th>
                                                <th class="p-4 text-base text-center cursor-pointer select-none whitespace-nowrap"
                                                    onclick="sortTable(2)">NIP</th>
                                                <th class="p-4 text-base text-center cursor-pointer select-none rounded-tr-lg whitespace-nowrap"
                                                    onclick="sortTable(3)">PTK</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pegawai-list" class="bg-white border">
                                            @foreach ($listpegawai as $pegawai)
                                            <tr class="border-b hover:bg-gray-100 group dark:hover:bg-slate-700">
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950 whitespace-nowrap">
                                                    {{ $pegawai->user->nama }}
                                                </td>
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950 whitespace-nowrap">
                                                    {{ $pegawai->no_telpon }}
                                                </td>
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950 whitespace-nowrap">
                                                    {{ $pegawai->NIP }}
                                                </td>
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950 whitespace-nowrap">
                                                    {{ $pegawai->PTK }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="mt-4">
                                {{ $listpegawai->links('components.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card 2 -->

        </d iv>
        <x-FO.footer />
    </main>
    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<script src="{{ asset('js/html5-qrcode.min.js') }}" async></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}

<script>
    document.getElementById('searchInput1').addEventListener('input', function() {
        let search = this.value;
        fetch(`/FO/pegawai?search=${search}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('pegawai-list').innerHTML = new DOMParser()
                    .parseFromString(data, 'text/html')
                    .querySelector('#pegawai-list').innerHTML;
            });
    });
</script>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterTable();
    });

    document.getElementById('filterPTK').addEventListener('change', function() {
        filterTable();
    });

    function sortTable(columnIndex) {
        var table = document.getElementById("pegawaiTable");
        var tbody = table.tBodies[0];
        var rows = Array.from(tbody.rows);
        var ascending = tbody.getAttribute("data-sort-order") !== "asc";
        rows.sort(function(rowA, rowB) {
            var cellA = rowA.cells[columnIndex].innerText.trim().toLowerCase();
            var cellB = rowB.cells[columnIndex].innerText.trim().toLowerCase();

            if (cellA < cellB) {
                return ascending ? -1 : 1;
            }
            if (cellA > cellB) {
                return ascending ? 1 : -1;
            }
            return 0;
        });

        tbody.setAttribute("data-sort-order", ascending ? "asc" : "desc");
        tbody.append(...rows);
    }

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

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-pegawai');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const pegawai = JSON.parse(this.getAttribute('data-pegawai'));

                document.getElementById('updateId').value = pegawai.NIP;
                console.log(pegawai.id);
                document.getElementById('newName').value = pegawai.user.nama;
                document.getElementById('newEmail').value = pegawai.user.email;
                document.getElementById('newPassword').value = pegawai.user.password;
                document.getElementById('newNo_telpon').value = pegawai.no_telpon;
                document.getElementById('newNIP').value = pegawai.NIP;
                document.getElementById('newPTK').value = pegawai.PTK;
                document.getElementById('updateForm').action =
                    `/admin/pegawai/update/${pegawai.NIP}`;
                // console.log(pegawai);
                document.getElementById('updateForm').style.display = 'block';
                document.getElementById('pegawaiForm').style.display = 'none';
            });
        });
    });

    function closeUpdateForm() {
        document.getElementById('updateForm').style.display = 'none';
        document.getElementById('pegawaiForm').style.display = 'block';
    }

    function validateUpdateForm() {
        var newName = document.getElementById('newName').value.trim();
        var newEmail = document.getElementById('newEmail').value.trim();
        var newPassword = document.getElementById('newPassword').value.trim();
        var newNo_telpon = document.getElementById('newNo_telpon').value.trim();
        var newNIP = document.getElementById('newNIP').value.trim();
        var newPTK = document.getElementById('newPTK').value.trim();

        if (newName === '' || newEmail === '' || newPassword === '' || newNo_telpon === '' || newNIP === '' ||
            newPTK === '') {
            alert('Mohon isi semua kolom yang dibutuhkan.');
            return false;
        }
        return true;
    }

    // Fungsi untuk menampilkan nama file
    document.getElementById('dropzone-file').addEventListener('change', function() {
        const fileNameElement = document.getElementById('file-name');
        const isiElement = document.getElementById('isi');
        if (this.files && this.files[0]) {
            fileNameElement.textContent = `File uploaded: ${this.files[0].name}`;
            fileNameElement.classList.remove('hidden');
            isiElement.classList.add('hidden');
        } else {
            fileNameElement.classList.add('hidden');
            isiElement.classList.remove('hidden');
        }
    });
</script>




</html>