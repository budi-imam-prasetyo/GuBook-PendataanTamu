<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon" />

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- WebcamJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    @vite('resources/css/app.css')
</head>

<body class="relative h-screen bg-gradient-to-b from-secondaryBlue to-primaryBlue text-light">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    <div class="absolute left-1/2 top-1/2 -z-990 -translate-x-1/2 -translate-y-1/2 transform">
        <img src="{{ asset('assets/logo2.png') }}" class="h-100 opacity-40 sm:h-135 md:h-180" alt="" />
    </div>
    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center">
            <div class="mt-10">
                <img src="{{ asset('assets/icons/truck.svg') }}" class="z-0 h-36" alt="user icon" />
            </div>
            <div class="mb-4">
                <ul class="-mb-px flex flex-wrap text-3xl font-medium">
                    <li class="mr-2">
                        <a href="/form-tamu"
                            class="inline-block rounded-t-lg border-b-2 border-transparent px-4 py-4 text-center text-light hover:border-lightBlue2 hover:text-lightBlue2 dark:hover:text-lightBlue2">
                            Tamu
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="/form-kurir"
                            class="inline-block rounded-t-lg border-b-2 border-light px-4 py-4 text-center text-light hover:border-lightBlue2 hover:text-lightBlue2 dark:hover:text-gray-300">
                            Kurir
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Form for Kurir -->
            <form action="{{ route('kurir.store') }}" method="POST">
                @csrf
                <!-- Input fields -->
                <div class="mt-8 grid w-100 gap-4 md:w-240 lg:grid-cols-2">
                    <div>
                        <label for="nama_kurir" class="mb-1 block text-sm font-medium text-light">
                            Pengirim
                        </label>
                        <input type="text" name="nama_kurir" id="nama_kurir"
                            class="block h-12 w-full rounded-lg border border-gray-200 bg-gray-100 px-3 py-1 text-dark placeholder:text-grey"
                            placeholder="Masukan Nama" />
                    </div>
                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-light">
                            Ekspedisi
                        </label>
                        <input type="text" name="ekspedisi" id="ekspedisi"
                            class="block h-12 w-full rounded-lg border border-gray-200 bg-gray-100 px-3 py-1 text-dark placeholder:text-grey"
                            placeholder="Masukan Ekspedisi" />
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-light">
                            Pegawai
                        </label>
                        <div class="relative w-full">
                            <select name="pegawai" id="pegawai" class="select select-bordered w-full text-dark">
                                <option disabled selected class="text-dark">
                                    Pilih Pegawai
                                </option>
                                @foreach ($listpegawai as $pegawai)
                                    <option value="{{ $pegawai->NIP }},{{ $pegawai->user->id }}" class="text-dark">
                                        {{ $pegawai->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-light">
                            No Telpon
                        </label>
                        <input type="number" name="no_telpon" id="no_telpon"
                            class="block h-12 w-full rounded-lg border border-gray-200 bg-gray-100 px-3 py-1 text-dark placeholder:text-grey"
                            placeholder="Masukan Nomor" />
                    </div>
                    <!-- The button to open modal -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-light">
                            Foto
                        </label>
                        <label for="my_modal_6" class="btn w-full">
                            Foto Diri Anda
                        </label>

                        <input type="hidden" id="foto-data" name="foto" />
                        <input type="checkbox" id="my_modal_6" class="modal-toggle" />

                        <div class="modal">
                            <div class="modal-box flex flex-col gap-4">
                                <h5 class="text-center text-xl font-semibold text-dark">
                                    Ambil Foto
                                </h5>
                                <div
                                    class="modal-body align-items-center justify-content-center flex flex-col space-y-2 p-0">
                                    <video id="video" class="w-full rounded-lg" width="320" height="240"
                                        autoplay></video>
                                    <canvas id="canvas" width="320" height="240" style="display: none"></canvas>
                                    <img class="rounded-lg" id="foto-preview" src="" alt="Foto Preview"
                                        style="display: none" />
                                    <div class="flex justify-center">
                                        <button type="button" id="snap"
                                            class="btn bg-primaryBlue hover:bg-secondaryBlue">
                                            <img src="{{ asset('assets/icons/camera-light.svg') }}" class="my-1 mx-3 group-hover:mt-0.5 w-6 " alt="camera">
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-action">
                                    <button type="button" class="btn" data-dismiss="modal" id="close">
                                        Close
                                    </button>
                                    <button type="button" id="save" class="btn bg-primaryBlue text-light hover:bg-secondaryBlue"
                                        style="display: none">
                                        Kirim
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit & Reset Buttons -->
                    {{-- {{ dd($kedatanganEkspedisi) }} --}}
                    {{--
                            @foreach ($kedatanganEkspedisi as $ekspedisiFoto)
                            <img src="{{ Storage::url($ekspedisiFoto->foto) }}" class="h-12"
                            alt="Foto Kedatangan">
                            @endforeach
                        --}}
                    <div class="w-full">
                        <div class="flex mt-7 flex-row gap-4">
                            <div>
                                <button type="reset"
                                    class="group flex h-12 w-24 items-center justify-center rounded-lg bg-white px-4 py-1 text-gray-600 hover:bg-gray-100">
                                    <img src="{{ asset('assets/icons/reset.svg') }}"
                                        class="h-6 transition-all duration-150 group-hover:-rotate-45"
                                        alt="reset icon" />
                                </button>
                            </div>
                            <button type="submit"
                                class="h-12 w-full rounded-lg bg-secondaryBlue py-2 text-base text-white transition-all duration-150 hover:text-lg hover:font-semibold hover:text-lightBlue2">
                                Kirim
                            </button>
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
                        navigator.mediaDevices
                            .getUserMedia({
                                video: true,
                            })
                            .then((s) => {
                                stream = s;
                                video.srcObject = stream;
                                video.play();
                            })
                            .catch((err) => {
                                console.error(
                                    'Error accessing webcam: ',
                                    err,
                                );
                            });
                    } else {
                        if (stream) {
                            let tracks = stream.getTracks();
                            tracks.forEach((track) => track.stop());
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
                    context.drawImage(
                        video,
                        0,
                        0,
                        canvas.width,
                        canvas.height,
                    );
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
                document
                    .getElementById('close')
                    .addEventListener('click', function() {
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
