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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- WebcamJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    @vite('resources/css/app.css')
</head>

<body class="relative h-screen bg-gradient-to-b from-secondaryBlue to-primaryBlue text-light">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    <div class="absolute transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2 -z-990">
        <img src="{{ asset('assets/logo2.png') }}" class="h-100 opacity-40 sm:h-135 md:h-180" alt="" />
    </div>
    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center">
            <div class="mt-10">
                <img src="{{ asset('assets/icons/truck.svg') }}" class="z-0 h-36" alt="user icon" />
            </div>
            <div class="mb-4">
                <ul class="flex flex-wrap -mb-px text-3xl font-medium">
                    <li class="mr-2">
                        <a href="/form-tamu"
                            class="inline-block px-4 py-4 text-center border-b-2 border-transparent rounded-t-lg text-light hover:border-lightBlue2 hover:text-lightBlue2 dark:hover:text-lightBlue2 ">
                            Tamu
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="/form-kurir"
                            class="inline-block px-4 py-4 text-center border-b-2 rounded-t-lg border-light text-light hover:border-lightBlue2 hover:text-lightBlue2 dark:hover:text-gray-300">
                            Kurir
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Form for Kurir -->
            <form action="{{ route('kurir.store') }}" method="POST">
                @csrf
                <!-- Input fields -->
                <div class="grid gap-4 mt-8 w-100 md:w-240 lg:grid-cols-2">
                    <div>
                        <label for="nama_kurir" class="block mb-1 text-sm font-medium text-light">
                            Pengirim
                        </label>
                        <input type="text" name="nama_kurir" id="nama_kurir"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Nama" />
                    </div>
                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-light">
                            Ekspedisi
                        </label>
                        <input type="text" name="ekspedisi" id="ekspedisi"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Ekspedisi" />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-light">
                            Pegawai
                        </label>
                        <div class="relative w-full">
                            <select name="pegawai" id="pegawai1" class="w-full select select-bordered text-dark">
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
                        <label class="block mb-1 text-sm font-medium text-light">
                            No Telpon
                        </label>
                        <input type="number" name="no_telpon" id="no_telpon"
                            class="block w-full h-12 px-3 py-1 bg-gray-100 border border-gray-200 rounded-lg text-dark placeholder:text-grey"
                            placeholder="Masukan Nomor" />
                    </div>
                    <!-- The button to open modal -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-light">
                            Foto
                        </label>
                        <label for="my_modal_6" class="w-full btn">
                            Foto Diri Anda
                        </label>

                        <input type="hidden" id="foto-data" name="foto" />
                        <input type="checkbox" id="my_modal_6" class="modal-toggle" />

                        <div class="modal">
                            <div class="flex flex-col gap-4 modal-box">
                                <h5 class="text-xl font-semibold text-center text-dark">
                                    Ambil Foto
                                </h5>
                                <div
                                    class="flex flex-col p-0 space-y-2 modal-body align-items-center justify-content-center">
                                    <video id="video" class="w-full rounded-lg" width="320" height="240"
                                        autoplay></video>
                                    <canvas id="canvas" width="320" height="240" style="display: none"></canvas>
                                    <img class="rounded-lg" id="foto-preview" src="" alt="Foto Preview"
                                        style="display: none" />
                                    <div class="flex justify-center">
                                        <button type="button" id="snap"
                                            class="btn bg-primaryBlue hover:bg-secondaryBlue">
                                            <img src="{{ asset('assets/icons/camera-light.svg') }}"
                                                class="my-1 mx-3 group-hover:mt-0.5 w-6 " alt="camera">
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-action">
                                    <button type="button" class="btn" data-dismiss="modal" id="close">
                                        Close
                                    </button>
                                    <button type="button" id="save"
                                        class="btn bg-primaryBlue text-light hover:bg-secondaryBlue"
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
                        <div class="flex flex-row gap-4 mt-7">
                            <div>
                                <button type="reset"
                                    class="flex items-center justify-center w-24 h-12 px-4 py-1 text-gray-600 bg-white rounded-lg group hover:bg-gray-100">
                                    <img src="{{ asset('assets/icons/reset.svg') }}"
                                        class="h-6 transition-all duration-150 group-hover:-rotate-45"
                                        alt="reset icon" />
                                </button>
                            </div>
                            <button type="submit"
                                class="w-full h-12 py-2 text-base text-white transition-all duration-150 rounded-lg bg-secondaryBlue hover:text-lg hover:font-semibold hover:text-lightBlue2">
                                Kirim
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                $('#pegawai1').select2({
                    placeholder: "Pilih Pegawai",
                    allowClear: true
                });
            });
        </script>

        <script>
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                });
            @endif
        </script>
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
