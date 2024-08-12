<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
    <!-- <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " /> -->
    <!-- <script src="//unpkg.com/alpinejs" defer></script> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased dark:bg-slate-900">
    <div class="absolute min-h-80 w-full bg-blue-500 dark:hidden"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar>Pegawai</x-admin.navbar>

        <div class="mx-auto w-full p-6 ">
            <form id="pegawaiForm" action="{{ route('admin.store.pegawai') }}" method="POST"
                class="flex flex-col w-full p-6 mx-auto mt-10 bg-white border rounded-2xl shadow-lg dark:bg-slate-850 dark:border-transparent dark:shadow-dark-xl">
                @csrf
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="pegawaiId" name="NIP">
                <p class="mb-4 text-2xl font-bold text-center dark:text-white select-none" id="formTitle">Tambah Pegawai
                </p>

                <!-- Nama -->
                <div class="w-full grid grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="nama"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nama
                            Guru</label>
                        <input type="text" id="nama" name="nama"
                            class="input input-lg input-bordered w-full mb-3 dark:text-white"
                            placeholder="Masukkan Nama" required />
                    </div>
                    <div>
                        <label for="PTK"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">PTK</label>
                        <select id="PTK" name="PTK"
                            class="select select-lg select-bordered w-full mb-3 dark:text-white" required>
                            <option value="" disabled selected>Pilih Mapel</option>
                            @foreach ($listpegawai as $mapel)
                                <option value="{{ $mapel->PTK }}">{{ $mapel->PTK }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Email dan Password -->
                <div class="w-full grid grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Email</label>
                        <input type="email" id="email" name="email"
                            class="input input-lg input-bordered w-full mb-3 dark:text-white"
                            placeholder="contoh@email.com" required />
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Kata
                            Sandi</label>
                        <input type="password" id="password" name="password"
                            class="input input-lg input-bordered w-full mb-4 dark:text-white" placeholder="******" />
                    </div>
                </div>

                <!-- Nomor Telepon, NIP, dan PTK -->
                <div class="w-full grid grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="no_telpon"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nomor
                            Telepon</label>
                        <input type="text" id="no_telpon" name="no_telpon"
                            class="input input-lg input-bordered w-full mb-3 dark:text-white"
                            placeholder="Masukkan Nomor Telepon" required />
                    </div>

                    <div>
                        <label for="NIP" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">NIP
                            (Nomor
                            Induk Pegawai)</label>
                        <input type="text" id="NIP" name="NIP"
                            class="input input-lg input-bordered w-full mb-3 dark:text-white" placeholder="Masukkan NIP"
                            required />
                    </div>
                </div>



                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary btn-lg text-base bg-primaryBlue text-light w-full"
                    id="formSubmitButton">Submit</button>
            </form>




            <form id="updateForm" action="{{ route('admin.pegawai.update', ['id' => ':id']) }}" method="POST"
                style="display: none;" onsubmit="return validateUpdateForm()"
                class="flex flex-col w-full p-6 mx-auto mt-10 bg-white border rounded-2xl shadow-md dark:bg-slate-850 dark:border-transparent dark:shadow-dark-xl">
                <h1 class="mb-4 text-2xl font-bold text-center dark:text-white">Edit Guru</h1>
                @csrf
                <input type="hidden" name="emailToUpdate" id="emailToUpdate">
                <input type="hidden" name="NIP" id="updateId">

                <div class="w-full grid grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="newName"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nama</label>
                        <input type="text" name="newName" id="newName"
                            class="input input-lg input-bordered w-full mb-3 dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                    <div>
                        <label for="newPTK"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">PTK</label>
                        <select id="newPTK" name="newPTK"
                            class="select select-lg select-bordered w-full mb-3 dark:bg-slate-850 dark:border-white dark:text-white"
                            required>
                            <option value="" selected>Pilih Mapel</option>
                            @foreach ($listpegawai as $mapel)
                                <option value="{{ $mapel->PTK }}">{{ $mapel->PTK }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="w-full grid grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="newEmail"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Email</label>
                        <input type="text" name="newEmail" id="newEmail"
                            class="input input-lg input-bordered w-full mb-3 dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>

                    <div>
                        <label for="newPassword"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Password</label>
                        <input type="password" name="newPassword" id="newPassword"
                            class="input input-lg input-bordered w-full mb-4 dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                </div>

                <div class="w-full grid grid-cols-1 md:grid-cols-2 md:space-x-4">
                    <div>
                        <label for="newNIP"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">NIP</label>
                        <input type="text" name="newNIP" id="newNIP"
                            class="input input-lg input-bordered w-full mb-3 dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>

                    <div>
                        <label for="newNo_telpon"
                            class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nomor
                            Telepon</label>
                        <input type="text" name="newNo_telpon" id="newNo_telpon"
                            class="input input-lg input-bordered w-full mb-3 dark:bg-slate-850 dark:border-white dark:text-white">
                    </div>
                </div>



                <div class="flex space-x-4">
                    <button type="submit"
                        class="btn btn-lg btn-primary w-1/2 text-base text-light bg-primaryBlue">Update</button>
                    <button type="button" onclick="closeUpdateForm()"
                        class="btn btn-lg text-base w-1/2">Tutup</button>
                </div>
            </form>



            <!-- table 1 -->

            <div class="-mx-3 mt-5 flex flex-wrap">
                <div class="w-full max-w-full flex-none px-3">
                    <div
                        class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border border-solid border-transparent bg-white bg-clip-border shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
                        <!-- <div class="border-b-solid mb-0 rounded-t-2xl border-b-0 border-b-transparent p-6 pb-0">
                            <h6 class="uppercase dark:text-white">Tabel Guru</h6>
                        </div> -->
                        <div class="flex-auto p-5">
                            <div class="overflow-x-auto p-4">
                                <h1 class="mb-4 text-2xl font-bold text-center select-none dark:text-white">Tabel
                                    Pegawai</h1>
                                <div class="w-full mb-2 flex">
                                    <div class=" join flex m-2">
                                        <label
                                            class="input input-lg input-bordered join-item border rounded-lg w-full flex items-center">
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
                                    <div class="mx-1 m-2 w-52">
                                        <div
                                            class="dropdown dropdown-bottom md:dropdown-hover md:dropdown-right w-full">
                                            <div tabindex="0" role="button"
                                                class="btn btn-lg bg-primaryBlue w-full text-light btn-primary">Import
                                                / Export</div>
                                            <ul tabindex="0"
                                                class="dropdown-content menu bg-base-100 rounded-box z-990 w-52 p-2 shadow">
                                                <button
                                                    class="btn bg-grey text-light hover:bg-primaryBlue hover:text-light my-1"
                                                    onclick="my_modal_2.showModal()">Import</button>
                                                <a href="{{ route('pegawai.export') }}"
                                                    class="btn bg-grey text-light hover:btn-error hover:text-light my-1">
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
                                                                    class="hidden text-base font-bold text-green-500 dark:text-green-400 mt-2">
                                                                    File uploaded successfully!</p>
                                                            </div>
                                                            <input id="dropzone-file" type="file" name="file"
                                                                class="hidden" />
                                                        </label>
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-primary bg-primaryBlue my-3 w-full text-light">Import</button>
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
                                                        class="btn hover:btn-error hover:text-light w-full">Close</button>
                                                </form>
                                            </div>

                                        </dialog>

                                    </div>
                                </div>



                                <table id="pegawaiTable" class="table w-full">
                                    <thead class="bg-primaryBlue border text-white tracking-widest">
                                        <tr>
                                            <th class="p-4 select-none text-base text-center">Nama</th>
                                            <th class="p-4 select-none text-base text-center">No Telepon</th>
                                            <th class="p-4 select-none text-base text-center">NIP</th>
                                            <th class="p-4 select-none text-base text-center">PTK</th>
                                            <th class="p-4 select-none text-base text-center" style="width: 100px;">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pegawai-list" class="bg-white border">
                                        @foreach ($listpegawai as $pegawai)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-slate-700 border-b">
                                                <td class="px-4 text-base text-center">{{ $pegawai->user->nama }}</td>
                                                <td class="px-4 text-base text-center">{{ $pegawai->no_telpon }}</td>
                                                <td class="px-4 text-base text-center">{{ $pegawai->NIP }}</td>
                                                <td class="px-4 text-base text-center">{{ $pegawai->PTK }}</td>
                                                <td class="px-4 text-center">
                                                    <div class="flex justify-center join">
                                                        <button
                                                            class="btn btn-primary join-item bg-primaryBlue text-light font-semibold leading-tight edit-pegawai"
                                                            data-pegawai='@json($pegawai)'>Edit</button>
                                                        <form
                                                            action="{{ route('admin.pegawai.delete', $pegawai->user->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline hover:border-primaryBlue border-primaryBlue  hover:bg-secondaryBlue join-item font-semibold leading-tight text-primaryBlue"
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
                    @if (session('success'))
                        <div id="success-notification"
                            class="p-4 mb-4 text-sm text-green-700 absolute bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif


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
                    `/admin/pegawai/update/${pegawai.id}`;
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
