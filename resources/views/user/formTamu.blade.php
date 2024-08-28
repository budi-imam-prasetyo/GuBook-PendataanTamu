<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>

    @vite('resources/css/app.css', 'resources/js/app.js')

    <style>
        /* Custom styles for modal */
        .modal-content {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="text-light bg-gradient-to-b from-secondaryBlue to-primaryBlue relative h-screen">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-990">
        <img src="{{ asset('assets/logo2.png') }}" class="h-100 sm:h-135 md:h-180 opacity-40" alt="">
    </div>
    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center">
            <div class="mt-10">
                <img src="{{ asset('assets/icons/user.svg') }}" class="h-36 z-0" alt="user icon">
            </div>
            <div class="mb-4">
                <ul class="flex flex-wrap -mb-px font-medium text-3xl">
                    <li class="mr-2">
                        <a href="/form-tamu"
                            class="inline-block text-light hover:text-lightBlue2 hover:border-lightBlue2 rounded-t-lg py-4 px-4 text-center border-light border-b-2 dark:hover:text-lightBlue2">Tamu</a>
                    </li>
                    <li class="mr-2">
                        <a href="/form-kurir"
                            class="inline-block text-light hover:text-lightBlue2 hover:border-lightBlue2 rounded-t-lg py-4 px-4 text-center border-transparent border-b-2 dark:hover:text-gray-300">Kurir</a>
                    </li>
                </ul>
            </div>
            <form id="tamuForm" action="{{ route('tamu.store') }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="id_user" value="{{ $listpegawai->user->id }}" id="updateId"> --}}

                <div class="w-100 md:w-240 mt-8 grid lg:grid-cols-2 gap-4">
                    <!-- Form Fields -->
                    <div>
                        <label for="nama" class="text-sm text-light block mb-1 font-medium">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Nama" />
                    </div>

                    <div>
                        <label for="email" class="text-sm text-light block mb-1 font-medium">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Email" />
                    </div>

                    <div>
                        <label for="alamat" class="text-sm text-light block mb-1 font-medium">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Alamat" />
                    </div>

                    <div>
                        <label class="text-sm text-light block mb-1 font-medium">No Telpon</label>
                        <input type="number" name="no_telpon" id="no_telpon"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Nomor" />
                    </div>
                    <div>
                        <label class="text-sm text-light block mb-1 font-medium">Pegawai</label>
                        <div class="relative w-full">
                            <select name="pegawai" id="pegawai" class="select select-bordered w-full text-dark">
                                <option disabled selected class="text-dark">Pilih Pegawai</option>
                                @foreach ($listpegawai as $pegawai)
                                    <option value="{{ $pegawai->NIP }},{{ $pegawai->user->id }}" class="text-dark">
                                        {{ $pegawai->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label class="text-sm text-light block mb-1 font-medium">Tanggal Pertemuan</label>
                        <input type="datetime-local" id="tanggal" name="waktu_perjanjian"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-grey placeholder:text-grey w-full h-12"
                            placeholder="DD/MM/YYYY" />
                    </div>
                    <div class="">
                        <label class="text-sm text-light block mb-1 font-medium">Tujuan</label>
                        <input type="textarea" id="tujuan" name="tujuan"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-grey placeholder:text-grey w-full h-12"
                            placeholder="Masukan Tujuan" />
                    </div>
                    <div class="">
                        <label class="text-sm text-light block mb-1 font-medium">Instansi</label>
                        <input type="text" id="instansi" name="instansi"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-grey placeholder:text-grey w-full h-12"
                            placeholder="Masukan Instansi" />
                    </div>
                    <input type="hidden" name="qrData" id="qrcodeField">
                </div>
                <div class="md:w-1/2 float-right w-full">
                    <div class="gap-4 mt-8 flex flex-row">
                        <div>
                            <button type="reset"
                                class="group flex h-12 w-24 items-center justify-center rounded-lg bg-white px-4 py-1 text-gray-600 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/reset.svg') }}"
                                    class="h-6 transition-all duration-150 group-hover:-rotate-45" alt="reset icon" />
                            </button>
                        </div>
                        <input type="submit" value="Kirim"
                            class="py-2 bg-secondaryBlue cursor-pointer text-white w-full text-base rounded-lg h-12 hover:text-lightBlue2">
                    </div>
                </div>
            </form>

            <!-- Modal HTML -->
            <div id="qrCodeModal"
                class="fixed inset-0 flex items-center justify-center z-50 hidden backdrop-blur-sm backdrop-brightness-75"
                role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
                <div class="bg-white shadow-lg rounded-lg max-w-lg w-full mx-4 relative">
                    <div class="border-b p-4">
                        <h5 id="qrCodeModalLabel" class="text-lg text-dark font-semibold">QR Code</h5>
                    </div>
                    <div>
                        <div class="p-4 text-center w-64 mx-auto" id="qrCodeContent">
                            <!-- QR Code will be inserted here -->
                        </div>
                    </div>
                    <div class="border-t p-4 flex justify-center">
                        <a id="downloadBtn" href="#" class="btn btn-primary">Download QR Code</a>
                    </div>
                </div>
            </div>
    </main>

    <!-- DaisyUI and Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.js"></script>

    <script>
        document.getElementById('tamuForm').addEventListener('submit', function(event) {
            event.preventDefault();
            fetch(this.action, {
                    method: this.method,
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const qrCodeImg = document.createElement('img');
                        qrCodeImg.src = 'data:image/png;base64,' + data.qr_code;
                        qrCodeImg.alt = 'QR Code';
                        qrCodeImg.style.width = '100%'; // Adjust size as needed

                        const qrCodeContent = document.getElementById('qrCodeContent');
                        qrCodeContent.innerHTML = ''; // Clear previous content
                        qrCodeContent.appendChild(qrCodeImg);

                        const downloadBtn = document.getElementById('downloadBtn');
                        downloadBtn.href = qrCodeImg.src;
                        downloadBtn.download = 'qr_code.png';

                        document.getElementById('qrCodeModal').classList.remove('hidden');
                    } else {
                        let errorMessage = 'Gagal menambahkan kedatangan tamu.';
                        if (data.errors) {
                            errorMessage += '\n' + Object.values(data.errors).join('\n');
                        }
                        alert(errorMessage);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan dalam mengirim data. Silakan coba lagi.', error);
                });
        });
        document.getElementById('qrCodeModal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.classList.add('hidden');
                document.getElementById('tamuForm').reset();
            }
        });
    </script>
</body>

</html>
