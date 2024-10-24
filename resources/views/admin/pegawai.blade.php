<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GuBook | Pegawai</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="m-0 font-sans text-base antialiased font-medium bg-gray-50 leading-default text-slate-500 dark:bg-slate-900">
    <div class="absolute w-full min-h-80 bg-primaryBlue"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out rounded-xl xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar>Pegawai</x-admin.navbar>

        <div class="w-full p-6 pb-0 mx-auto ">
            <form id="pegawaiForm" action="{{ route('admin.store.pegawai') }}" method="POST"
                class="flex flex-col w-full p-6 mx-auto mt-10 bg-white border shadow-lg rounded-2xl dark:bg-slate-850 dark:border-transparent dark:shadow-dark-xl">
                @csrf
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="pegawaiId" name="NIP">
                <p class="mb-4 text-2xl font-bold text-center select-none dark:text-white" id="formTitle">Tambah Pegawai
                </p>

                <!-- Nama -->
                <div class="grid w-full grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="nama"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nama
                            Guru</label>
                        <input type="text" id="nama" name="nama"
                            class="w-full mb-3 input input-bordered dark:text-white"
                            placeholder="Masukkan Nama" required />
                    </div>
                    <div>
                        <label for="PTK"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">PTK</label>
                        <select id="PTK" name="PTK"
                            class="w-full mb-3 select select-bordered dark:text-white" required>
                            <option value="" disabled selected>Pilih Mapel</option>
                            @foreach ($mapel as $item)
                                {{-- {{ dd($item); }} --}}
                                <option value="{{ $item->PTK }}">{{ $item->PTK }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Email dan Password -->
                <div class="grid w-full grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full mb-3 input input-bordered dark:text-white"
                            placeholder="contoh@email.com" required />
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Kata
                            Sandi</label>
                        <input type="password" id="password" name="password"
                            class="w-full mb-4 input input-bordered dark:text-white" placeholder="******" />
                    </div>
                </div>

                <!-- Nomor Telepon, NIP, dan PTK -->
                <div class="grid w-full grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="no_telpon"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nomor
                            Telepon</label>
                        <input type="text" id="no_telpon" name="no_telpon"
                            class="w-full mb-3 input input-bordered dark:text-white"
                            placeholder="Masukkan Nomor Telepon" required />
                    </div>

                    <div>
                        <label for="NIP" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">NIP
                            (Nomor
                            Induk Pegawai)</label>
                        <input type="text" id="NIP" name="NIP"
                            class="w-full mb-3 input input-bordered dark:text-white" placeholder="Masukkan NIP"
                            required />
                    </div>
                </div>



                <!-- Tombol Submit -->
                <button type="submit" class="w-full text-base btn btn-primary bg-primaryBlue text-light"
                    id="formSubmitButton">Submit</button>
            </form>




            <form id="updateForm" action="{{ route('admin.pegawai.update', ['id' => ':id']) }}" method="POST"
                style="display: none;" onsubmit="return validateUpdateForm()"
                class="flex flex-col w-full p-6 mx-auto mt-10 bg-white border shadow-md rounded-2xl dark:bg-slate-850 dark:border-transparent dark:shadow-dark-xl">
                <h1 class="mb-4 text-2xl font-bold text-center dark:text-white">Edit Guru</h1>
                @csrf
                <input type="hidden" name="emailToUpdate" id="emailToUpdate">
                <input type="hidden" name="NIP" id="updateId">

                <div class="grid w-full grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="newName"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nama</label>
                        <input type="text" name="newName" id="newName"
                            class="w-full mb-3 input input-bordered dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                    <div>
                        <label for="newPTK"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">PTK</label>
                        <select id="newPTK" name="newPTK"
                            class="w-full mb-3 select select-bordered dark:bg-slate-850 dark:border-white dark:text-white"
                            required>
                            <option value="" selected>Pilih Mapel</option>
                            @foreach ($mapel as $item)
                                {{-- {{ dd($item); }} --}}
                                <option value="{{ $item->PTK }}">{{ $item->PTK }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid w-full grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="newEmail"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Email</label>
                        <input type="text" name="newEmail" id="newEmail"
                            class="w-full mb-3 input input-bordered dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                    <div>
                        <label for="newPassword"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Password</label>
                        <input type="password" name="newPassword" id="newPassword"
                            class="w-full mb-4 input input-bordered dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                </div>
                <div class="grid w-full grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="newNIP"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">NIP</label>
                        <input type="text" name="newNIP" id="newNIP"
                            class="w-full mb-3 input input-bordered dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                    <div>
                        <label for="newNo_telpon"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nomor
                            Telepon</label>
                        <input type="text" name="newNo_telpon" id="newNo_telpon"
                            class="w-full mb-3 input input-bordered dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="submit"
                        class="w-1/2 text-base btn btn-primary text-light bg-primaryBlue">Update</button>
                    <button type="button" onclick="closeUpdateForm()"
                        class="w-1/2 text-base btn ">Tutup</button>
                </div>
            </form>

            <!-- table 1 -->

            <div class="flex flex-wrap mt-5 -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-transparent border-solid shadow-lg rounded-2xl bg-clip-border dark:bg-slate-850 dark:shadow-dark-xl">
                        <!-- <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="uppercase dark:text-white">Tabel Guru</h6>
                        </div> -->
                        <div class="flex-auto p-5">
                            <div class="p-4 overflow-x-auto">
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
                                <div class="flex w-full mb-2">
                                    <div class="flex m-2 join">
                                        <label
                                            class="flex items-center w-full border rounded-lg input input-lg input-bordered join-item">
                                            <input type="text" class="grow" id="searchInput"
                                                placeholder="Search" />
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="h-7 w-7 opacity-70">
                                                <path fill-rule="evenodd"
                                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </label>
                                        <select id="filterPTK" class="select select-bordered join-item select-lg">
                                            <option value="">Filter</option>
                                            @foreach ($listpegawai->pluck('PTK')->unique() as $ptk)
                                                <option value="{{ $ptk }}">{{ $ptk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="m-2 mx-1 w-52">
                                        <div
                                            class="w-full dropdown dropdown-bottom md:dropdown-hover md:dropdown-right">
                                            <div tabindex="0" role="button"
                                                class="w-full btn btn-lg bg-primaryBlue text-light btn-primary">Import
                                                / Export</div>
                                            <ul tabindex="0"
                                                class="p-2 shadow dropdown-content menu bg-base-100 rounded-box z-990 w-52">
                                                <button
                                                    class="my-1 btn bg-grey text-light hover:bg-primaryBlue hover:text-light"
                                                    onclick="my_modal_2.showModal()">Import</button>
                                                <a href="{{ route('pegawai.export') }}"
                                                    class="my-1 btn bg-grey text-light hover:btn-error hover:text-light">
                                                    Export
                                                </a>
                                            </ul>
                                        </div>
                                        <dialog id="my_modal_2" class="modal backdrop-blur-sm">
                                            <div class="modal-box">

                                                <form action="{{ route('pegawai.import') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="flex items-center justify-center w-full">
                                                        <label for="dropzone-file"
                                                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                                                            <div
                                                                class="flex flex-col items-center justify-center pt-5 pb-6">
                                                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 20 16">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                                </svg>
                                                                <div id="isi">
                                                                    <p
                                                                        class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                                        <span class="font-semibold">Click to
                                                                            upload</span>
                                                                        or drag and drop
                                                                    </p>
                                                                    <p
                                                                        class="text-sm text-center text-gray-500 dark:text-gray-400">
                                                                        xlsx, xls, csv</p>
                                                                </div>
                                                                <p id="file-name"
                                                                    class="hidden mt-2 text-base font-bold text-green-500 dark:text-green-400">
                                                                    File uploaded successfully!</p>
                                                            </div>
                                                            <input id="dropzone-file" type="file" name="file"
                                                                class="hidden" />
                                                        </label>
                                                    </div>

                                                    <button type="submit"
                                                        class="w-full my-3 btn btn-primary bg-primaryBlue text-light">Import</button>
                                                </form>

                                                <script>
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

                                                    // Optionally, you can hide the notification after a few seconds
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        const successNotification = document.getElementById('success-notification');
                                                        if (successNotification) {
                                                            setTimeout(() => {
                                                                successNotification.style.display = 'none';
                                                            }, 5000); // Hide after 5 seconds
                                                        }
                                                    });
                                                </script>

                                                <form method="dialog">
                                                    <!-- if there is a button in form, it will close the modal -->
                                                    <button
                                                        class="w-full btn hover:btn-error hover:text-light">Close</button>
                                                </form>
                                            </div>

                                        </dialog>

                                    </div>
                                </div>



                                <table id="pegawaiTable" class="table w-full ">
                                    <thead class="tracking-widest text-white border bg-primaryBlue">
                                        <tr>
                                            <th class="p-4 text-base text-center cursor-pointer select-none"
                                                onclick="sortTable(0)">Nama</th>
                                            <th class="p-4 text-base text-center cursor-pointer select-none"
                                                onclick="sortTable(1)">No Telepon</th>
                                            <th class="p-4 text-base text-center cursor-pointer select-none"
                                                onclick="sortTable(2)">NIP</th>
                                            <th class="p-4 text-base text-center cursor-pointer select-none"
                                                onclick="sortTable(3)">PTK</th>
                                            <th class="p-4 text-base text-center select-none" style="width: 100px;">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pegawai-list" class="bg-white border">
                                        @foreach ($listpegawai as $pegawai)
                                            <tr class="border-b hover:bg-gray-100 group dark:hover:bg-slate-700">
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950">{{ $pegawai->user->nama }}</td>
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950">{{ $pegawai->no_telpon }}</td>
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950">{{ $pegawai->NIP }}</td>
                                                <td class="px-4 text-base text-center group-hover:text-indigo-950">{{ $pegawai->PTK }}</td>
                                                <td class="px-4 text-center">
                                                    <div class="flex justify-center join">
                                                        <button
                                                            class="font-semibold leading-tight btn btn-primary join-item bg-primaryBlue text-light edit-pegawai"
                                                            data-pegawai='@json($pegawai)'>Edit</button>
                                                        <form
                                                            action="{{ route('admin.pegawai.delete', $pegawai->NIP) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="font-semibold leading-tight btn btn-outline hover:border-primaryBlue border-primaryBlue hover:bg-secondaryBlue join-item text-primaryBlue"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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

        </div>
        <x-admin.footer />
    </main>
    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
    @livewireScripts
</body>
<script src="{{ asset('js/html5-qrcode.min.js') }}" async></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}

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
