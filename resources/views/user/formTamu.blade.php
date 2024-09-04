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

<body class="relative h-screen text-light bg-gradient-to-b from-secondaryBlue to-primaryBlue">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 -z-990">
        <img src="{{ asset('assets/logo2.png') }}" class="h-100 sm:h-135 md:h-180 opacity-40" alt="">
    </div>
    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center">
            <div class="mt-10">
                <img src="{{ asset('assets/icons/user.svg') }}" class="z-0 h-36" alt="user icon">
            </div>
            <div class="mb-4">
                <ul class="flex flex-wrap -mb-px text-3xl font-medium">
                    <li class="mr-2">
                        <a href="/form-tamu"
                            class="inline-block px-4 py-4 text-center border-b-2 rounded-t-lg text-light hover:text-lightBlue2 hover:border-lightBlue2 border-light dark:hover:text-lightBlue2">Tamu</a>
                    </li>
                    <li class="mr-2">
                        <a href="/form-kurir"
                            class="inline-block px-4 py-4 text-center border-b-2 border-transparent rounded-t-lg text-light hover:text-lightBlue2 hover:border-lightBlue2 dark:hover:text-gray-300">Kurir</a>
                    </li>
                </ul>
            </div>
            <form id="tamuForm" action="{{ route('tamu.store') }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="id_user" value="{{ $listpegawai->user->id }}" id="updateId"> --}}

                <div class="grid gap-4 mt-8 w-100 md:w-240 lg:grid-cols-2">
                    <!-- Form Fields -->
                    <div>
                        <label for="nama" class="block mb-1 text-sm font-medium text-light">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Nama" />
                    </div>

                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-light">Email</label>
                        <input type="text" name="email" id="email"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Email" />
                    </div>

                    <div>
                        <label for="alamat" class="block mb-1 text-sm font-medium text-light">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Alamat" />
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-light">No Telpon</label>
                        <input type="number" name="no_telpon" id="no_telpon"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Nomor" />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-light">Pegawai</label>
                        <div class="relative w-full">
                            <select name="pegawai" id="pegawai" class="w-full select select-bordered text-dark">
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
                        <label class="block mb-1 text-sm font-medium text-light">Tanggal Pertemuan</label>
                        <input type="datetime-local" id="tanggal" name="waktu_perjanjian"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-grey placeholder:text-grey"
                            placeholder="DD/MM/YYYY" />
                    </div>
                    <div class="">
                        <label class="block mb-1 text-sm font-medium text-light">Tujuan</label>
                        <input type="textarea" id="tujuan" name="tujuan"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-grey placeholder:text-grey"
                            placeholder="Masukan Tujuan" />
                    </div>
                    <div class="">
                        <label class="block mb-1 text-sm font-medium text-light">Instansi</label>
                        <input type="text" id="instansi" name="instansi"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-grey placeholder:text-grey"
                            placeholder="Masukan Instansi" />
                    </div>
                    {{-- <input type="hidden" name="qrData" id="qrcodeField"> --}}
                </div>
                <div class="float-right w-full md:w-1/2">
                    <div class="flex flex-row gap-4 mt-8">
                        <div>
                            <button type="reset"
                                class="flex items-center justify-center w-24 h-12 px-4 py-1 text-gray-600 bg-white rounded-lg group hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/reset.svg') }}"
                                    class="h-6 transition-all duration-150 group-hover:-rotate-45" alt="reset icon" />
                            </button>
                        </div>
                        <input type="submit" value="Kirim"
                            class="w-full h-12 py-2 text-base text-white rounded-lg cursor-pointer bg-secondaryBlue hover:text-lightBlue2">
                    </div>
                </div>
            </form>

            <!-- Modal HTML -->
            {{-- <div id="qrCodeModal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm backdrop-brightness-75"
                role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
                <div class="relative w-full max-w-lg mx-4 bg-white rounded-lg shadow-lg">
                    <div class="p-4 border-b">
                        <h5 id="qrCodeModalLabel" class="text-lg font-semibold text-dark">QR Code</h5>
                    </div>
                    <div>
                        <div class="w-64 p-4 mx-auto text-center" id="qrCodeContent">
                            <!-- QR Code will be inserted here -->
                        </div>
                    </div>
                    <div class="flex justify-center p-4 border-t">
                        <a id="downloadBtn" href="#" class="btn btn-primary">Download QR Code</a>
                    </div>
                </div>
            </div> --}}
            <div id="warningModal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm backdrop-brightness-75"
                role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
                <div class="relative w-full max-w-lg mx-4 bg-white rounded-lg shadow-lg">
                    <div class="p-4">
                        <h5 id="warningModalLabel" class="text-lg font-semibold text-dark">Peringatan</h5>
                    </div>
                    <div class="p-4 text-center text-dark">
                        <p>Waktu Pertemuan</p>
                        <p class="text-sm text-dark">Senin - Jumat <span class="font-semibold">(07.00 - 17.00)</span>
                        </p>
                        <p class="text-sm text-dark">Sabtu - Minggu <span class="font-semibold">Tutup</span></p>
                    </div>
                    <div class="flex justify-center p-4">
                        <button id="closeWarningBtn" class="btn btn-primary">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('tamuForm').addEventListener('submit', function(event) {
            const waktuPerjanjian = new Date(document.getElementById('tanggal').value);
            const hari = waktuPerjanjian.getDay();
            const startHour = 7; // 07:00
            const endHour = 17; // 17:00

            const hours = waktuPerjanjian.getHours();
            if (hari < 1 || hari > 5 || hours < startHour || hours >= endHour) {
                event.preventDefault();
                document.getElementById('warningModal').classList.remove('hidden');
                return;

                // Cek apakah jam pertemuan berada di luar rentang 07:00 hingga 17:00
                // if (hours < startHour || hours >= endHour) {
                //     event.preventDefault();
                //     document.getElementById('warningModal').classList.remove('hidden');
                //     document.querySelector('#warningModal .text-gray-700').innerText =
                //         'Waktu pertemuan harus antara pukul 07:00 hingga 17:00. Silakan pilih waktu yang sesuai.';
                //     return;

                // Lanjutkan dengan pengiriman form jika semua kondisi terpenuhi
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
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan dalam mengirim data. Silakan coba lagi.', error);
                    });
                // }
            }
        });

        document.getElementById('qrCodeModal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.classList.add('hidden');
                document.getElementById('tamuForm').reset();
            }
        });

        document.getElementById('closeWarningBtn').addEventListener('click', function() {
            document.getElementById('warningModal').classList.add('hidden');
        });
    </script>
</body>

</html>
