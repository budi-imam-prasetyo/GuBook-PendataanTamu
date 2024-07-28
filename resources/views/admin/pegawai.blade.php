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
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <!-- Nucleo Icons -->
    <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased dark:bg-slate-900">
    <div class="absolute min-h-80 w-full bg-blue-500 dark:hidden"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        <!-- Navbar -->
        <x-admin.navbar></x-admin.navbar>

        <div class="mx-auto w-full p-6 ">
            <form id="pegawaiForm" action="{{ route('admin.store.pegawai') }}" method="POST"
                class="flex flex-col w-full p-6 mx-auto mt-10 bg-white border rounded-2xl shadow-lg dark:bg-slate-850 dark:border-transparent dark:shadow-dark-xl">
                @csrf
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="pegawaiId" name="id">
                <h1 class="mb-4 text-2xl font-bold text-center dark:text-white" id="formTitle">Tambah Guru</h1>

                <!-- Nama -->
                <label for="nama" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nama

                    Guru</label>
                <input type="text" id="nama" name="nama"
                    class="w-full px-3 py-2 mb-3 border rounded-md focus:outline-none focus:ring focus:ring-primaryBlue  dark:bg-slate-850 dark:border-white dark:text-white"
                    placeholder="Masukkan Nama" required />

                <!-- Email dan Password -->
                <label for="email"
                    class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full px-3 py-2 mb-3 border rounded-md focus:outline-none focus:ring focus:ring-primaryBlue dark:bg-slate-850 dark:border-white dark:text-white"
                    placeholder="contoh@email.com" required />

                <label for="password" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Kata
                    Sandi</label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:ring-primaryBlue dark:bg-slate-850 dark:border-white dark:text-white"
                    placeholder="******" />
                <small class="text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengubah password</small>

                <!-- Nomor Telepon, NIP, dan PTK -->
                <label for="no_telpon" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nomor
                    Telepon</label>
                <input type="text" id="no_telpon" name="no_telpon"
                    class="w-full px-3 py-2 mb-3 border rounded-md focus:outline-none focus:ring focus:ring-primaryBlue dark:bg-slate-850 dark:border-white dark:text-white"
                    placeholder="Masukkan Nomor Telepon" required />

                <label for="NIP" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">NIP (Nomor
                    Induk Pegawai)</label>
                <input type="text" id="NIP" name="NIP"
                    class="w-full px-3 py-2 mb-3 border rounded-md focus:outline-none focus:ring focus:ring-primaryBlue dark:bg-slate-850 dark:border-white dark:text-white"
                    placeholder="Masukkan NIP" required />

                <label for="PTK" class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">PTK</label>
                <select id="PTK" name="PTK"
                    class="select w-full select-primary"
                    required>
                    <option value="" disabled selected>Pilih Mapel</option>
                    @foreach ($listpegawai as $mapel)
                        <option value="{{ $mapel->PTK }}">{{ $mapel->PTK }}</option>
                    @endforeach
                </select>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
                    id="formSubmitButton">Submit</button>
            </form>



            <form id="updateForm" action="" method="post" style="display: none;"
                onsubmit="return validateUpdateForm()"
                class="flex flex-col w-full p-6 mx-auto mt-10 bg-white border rounded-2xl shadow-md dark:bg-slate-850 dark:border-transparent dark:shadow-dark-xl">
                <h1 class="mb-4 text-2xl font-bold text-center dark:text-white">Edit Guru</h1>
                @csrf
                <input type="hidden" id="pegawaiId" name="id">

                <label for="newName"
                    class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Nama</label>
                <input type="text" name="newName" id="newName"
                    class="w-full px-3 py-2 mb-3 border rounded-md focus:outline-none  dark:bg-slate-850 dark:border-white dark:text-white">

                <label for="newEmail"
                    class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Email</label>
                <input type="text" name="newEmail" id="newEmail"
                    class="w-full px-3 py-2 mb-3 border rounded-md focus:outline-none  dark:bg-slate-850 dark:border-white dark:text-white">

                <label for="newPassword"
                    class="block mb-2 text-sm font-semibold text-gray-600 dark:text-white">Password</label>
                <input type="password" name="newPassword" id="newPassword"
                    class="w-full px-3 py-2 mb-4 border rounded-md focus:outline-none  dark:bg-slate-850 dark:border-white dark:text-white">

                <div class="flex space-x-4">
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-green-700">Update</button>
                    <button type="button" onclick="closeUpdateForm()"
                        class="w-full px-4 py-2 text-white bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Tutup</button>
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
                        <div class="flex-auto p-5 pt-0">
                            <div class="overflow-x-auto p-0">
                                <h2 class="text-2xl mx-5 my-5 font-bold mb-4">Tabel Pegawai</h2>
                                <livewire:search-pegawai/>
                                <table id="example" class="table-auto w-full">
                                    <thead class="border-b border-dark">
                                        <tr>
                                            <th class="px-4 py-2">Nama</th>
                                            <th class="px-4 py-2">No Telepon</th>
                                            <th class="px-4 py-2">NIP</th>
                                            <th class="px-4 py-2">PTK</th>
                                            <th class="px-4 py-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listpegawai as $pegawai)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $pegawai->user->nama }}</td>
                                                <td class="border px-4 py-2">{{ $pegawai->no_telpon }}</td>
                                                <td class="border px-4 py-2">{{ $pegawai->NIP }}</td>
                                                <td class="border px-4 py-2">{{ $pegawai->PTK }}</td>
                                                <td class="border px-4 py-2">
                                                    <button
                                                        class="text-xs font-semibold leading-tight text-white bg-primaryBlue hover:bg-secondaryBlue px-4 py-2 rounded-lg edit-pegawai"
                                                        data-pegawai='@json($pegawai)'>Edit</button>
                                                    <form
                                                        action="{{ route('admin.pegawai.delete', $pegawai->user->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-xs font-semibold leading-tight text-primaryBlue hover:text-light border-primaryBlue border hover:bg-secondaryBlue px-4 py-2 rounded-lg"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="m-2 flex justify-between">
                            <div class="hidden sm:flex">
                                <div class="mx-1">
                                    <form action="{{ route('pegawai.import') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" required>
                                        <button type="submit"
                                            class="rounded-lg px-3 py-1 text-red-500 transition-all ease-in-out hover:btn hover:btn-error hover:btn-sm">
                                            <i class="fa fa-file-import text-dark"></i>
                                            Import
                                        </button>
                                    </form>
                                </div>
                                <div class="mx-1">
                                    <a href="{{ route('pegawai.export') }}"
                                        class="rounded-lg px-3 py-1 text-green-500 transition-all ease-in-out hover:btn hover:btn-success hover:btn-sm">
                                        <i class="fa fa-file-export text-dark"></i>
                                        Export
                                    </a>
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
        @livewireScripts
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#example').DataTable({});
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
    nomorTeleponSpans.forEach(function(span) {
        span.textContent = generateRandomPhoneNumber();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-pegawai');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const pegawai = JSON.parse(this.getAttribute('data-pegawai'));

                document.getElementById('pegawaiId').value = pegawai.user.id;
                document.getElementById('newName').value = pegawai.user.nama;
                document.getElementById('newEmail').value = pegawai.user.email;
                document.getElementById('updateForm').action =
                    `/admin/pegawai/update/${pegawai.user.id}`;
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

        if (newName === '' || newEmail === '') {
            alert('Mohon isi semua kolom yang dibutuhkan.');
            return false;
        }
        return true;
    }
</script>



</html>
