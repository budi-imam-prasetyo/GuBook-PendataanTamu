<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon">

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- WebcamJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    @vite('resources/css/app.css')

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
                <img src="{{ asset('assets/icons/truck.svg') }}" class="h-36 z-0" alt="user icon">
            </div>
            <div class="mb-4">
                <ul class="flex flex-wrap -mb-px font-medium text-3xl">
                    <li class="mr-2">
                        <a href="/form-tamu"
                            class="inline-block text-light hover:text-lightBlue2 hover:border-lightBlue2 rounded-t-lg py-4 px-4 text-center border-transparent border-b-2 dark:hover:text-lightBlue2">Tamu</a>
                    </li>
                    <li class="mr-2">
                        <a href="/form-kurir"
                            class="inline-block text-light hover:text-lightBlue2 hover:border-lightBlue2 rounded-t-lg py-4 px-4 text-center border-light border-b-2 dark:hover:text-gray-300">Kurir</a>
                    </li>
                </ul>
            </div>
            <!-- Form for Kurir -->
            <form action="{{ route('kurir.store') }}" method="POST">
                @csrf
                <!-- Input fields -->
                <div class="w-100 md:w-240 mt-8 grid lg:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_kurir" class="text-sm text-light block mb-1 font-medium">Pengirim</label>
                        <input type="text" name="nama_kurir" id="nama_kurir"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Nama" />
                    </div>
                    <div>
                        <label for="email" class="text-sm text-light block mb-1 font-medium">Ekspedisi</label>
                        <input type="text" name="ekspedisi" id="ekspedisi"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Ekspedisi" />
                    </div>
                    <div>
                        <label class="text-sm text-light block mb-1 font-medium">Pegawai</label>
                        <div class="relative w-full">
                            <select name="pegawai" id="pegawai" class="select select-bordered w-full text-dark">
                                <option disabled selected class="text-dark">Pilih Pegawai</option>
                                @foreach ($listpegawai as $pegawai)
                                    <option value="{{ $pegawai->NIP }}" class="text-dark">
                                        {{ $pegawai->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-light block mb-1 font-medium">No Telpon</label>
                        <input type="number" name="no_telpon" id="no_telpon"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Nomor" />
                    </div>
                    <!-- The button to open modal -->
                    <div>
                        <label class="text-sm text-light block mb-1 font-medium">No Telpon</label>
                        <label for="my_modal_6" class="btn w-full">Open Modal</label>

                        <input type="hidden" id="foto-data" name="foto">
                        <input type="checkbox" id="my_modal_6" class="modal-toggle" />

                        <div class="modal">
                            <div class="modal-box">
                                <h5 class="modal-title">Ambil Foto</h5>
                                <div class="modal-body d-flex flex-column align-items-center justify-content-center p-0"
                                    style="height: 350px;">
                                    <video id="video" class="border-radius-lg" width="320" height="240"
                                        autoplay></video>
                                    <canvas id="canvas" width="320" height="240"
                                        style="display: none;"></canvas>
                                    <img class="border-radius-lg" id="foto-preview" src="" alt="Foto Preview"
                                        style="display: none;">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="snap" class="btn btn-primary">Ambil Foto</button>
                                    <button type="button" id="save" class="btn btn-success"
                                        style="display: none;">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit & Reset Buttons -->
                    {{-- {{ dd($kedatanganEkspedisi) }} --}}
                    {{-- @foreach ($kedatanganEkspedisi as $ekspedisiFoto)
                        <img src="{{ Storage::url($ekspedisiFoto->foto) }}" class="h-12"
                            alt="Foto Kedatangan">
                    @endforeach --}}
                    <div class="md:w-1/2 float-right w-full">
                        <div class="gap-4 mt-8">
                            <button type="reset"
                                class="py-1 px-4 bg-white text-gray-600 h-12 w-24 flex items-center justify-center rounded-lg hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/reset.svg') }}" class="h-6" alt="reset icon">
                            </button>
                            <button type="submit" class="btn btn-primary w-full">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- JavaScript for WebcamJS -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const video = document.getElementById('video');
                const canvas = document.getElementById('canvas');
                const snapButton = document.getElementById('snap');
                const saveButton = document.getElementById('save');
                const fotoPreview = document.getElementById('foto-preview');
                const fotoData = document.getElementById('foto-data');
                const modalToggle = document.getElementById('my_modal_6');
                let stream;
                let fotoCaptured = false;
                let fotoTempData = '';

                modalToggle.addEventListener('change', function() {
                    if (modalToggle.checked) {
                        navigator.mediaDevices.getUserMedia({
                                video: true
                            })
                            .then(s => {
                                stream = s;
                                video.srcObject = stream;
                                video.play();
                            })
                            .catch(err => {
                                console.error("Error accessing webcam: ", err);
                            });
                    } else {
                        if (stream) {
                            let tracks = stream.getTracks();
                            tracks.forEach(track => track.stop());
                        }
                        if (!fotoCaptured) {
                            fotoData.value = '';
                            fotoPreview.src = '';
                            fotoPreview.style.display = 'none';
                            fotoTempData = '';
                        }
                        fotoCaptured = false;
                    }
                });

                // Capture photo when button is clicked
                snapButton.addEventListener('click', function() {
                    const context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const dataURL = canvas.toDataURL('image/png');
                    fotoPreview.src = dataURL;
                    fotoPreview.style.display = 'block';
                    fotoTempData = dataURL;
                    fotoCaptured = true;
                    video.style.display = 'none';
                    snapButton.style.display = 'none';
                    saveButton.style.display = 'inline-block';
                });

                // Save photo and close modal when save button is clicked
                saveButton.addEventListener('click', function() {
                    fotoData.value = fotoTempData;
                    modalToggle.checked = false; // Close modal
                });

                // Reset foto data on close button click
                document.getElementById('close').addEventListener('click', function() {
                    if (!fotoCaptured) {
                        fotoData.value = '';
                    }
                    modalToggle.checked = false; // Close modal
                });
            });
        </script>
    </main>
</body>

</html>
