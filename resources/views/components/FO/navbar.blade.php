<nav class="relative flex flex-wrap items-center justify-between p-2 mx-6 transition-all ease-in shadow-none rounded-2xl duration-250 lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="false">
    <div class="flex items-center justify-between w-full py-1 pr-2 mx-auto flex-wrap-inherit">
        <nav>
            <!-- breadcrumb -->
            <div class="hidden md:block md:text-base breadcrumbs text-light">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>{{ $slot }}</li>
                </ul>
            </div>
            <h6 class="mb-0 font-bold text-white capitalize">{{ $slot }}</h6>
        </nav>
        <div class="flex items-center mt-2 sm:mr-6 sm:mt-0 md:mr-0 lg:flex lg:basis-auto">
            <div class="flex items-center justify-end pr-4 ml-auto">
                <div onclick="openModalAndScan()"
                    class="flex items-center justify-center w-full transition duration-300 ease-in-out bg-white rounded-lg group">
                    <span
                        class="flex items-center justify-center rounded-lg border border-transparent bg-transparent p-2.5 pr-1 text-center text-xl font-bold leading-normal text-slate-800 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/icons/qrcode.svg') }}" class="h-4.5" alt="qrcode" />
                    </span>
                    <button
                        class="mt-0 flex items-center justify-center rounded-lg pr-2.5 text-sm font-medium text-gray-700 transition duration-300 ease-in-out group-hover:font-semibold">
                        <span class="md:hidden">Scan</span>
                        <span class="hidden md:block">QR Code</span>
                    </button>
                </div>

                <dialog id="qrScanModal" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Scan QR Code</h3>
                        <div id="reader" class="w-full h-96"></div>
                        <div id="result" class="mt-4"></div>
                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn" onclick="stopQRScanner()">Close</button>
                            </form>
                        </div>
                    </div>
                </dialog>

                <!-- Tamu Detail Modal -->
                <dialog id="tamuDetailModal" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg mb-4">Detail Tamu</h3>
                        <div class="space-y-2">
                            <p><strong>Nama:</strong> <span id="modalTamuName"></span></p>
                            <p><strong>Email:</strong> <span id="modalTamuEmail"></span></p>
                            <p><strong>No Telepon:</strong> <span id="modalTamuPhone"></span></p>
                        </div>
                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn btn-outline">Close</button>
                            </form>
                            <button id="takePhotoBtn" class="btn btn-primary">Ambil Foto</button>
                        </div>
                    </div>
                </dialog>

                <input type="hidden" id="id_kedatangan" name="id_kedatangan">


                <!-- Camera Modal -->
                <dialog id="cameraModal" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Ambil Foto</h3>
                        <div id="cameraSection" class="text-center">
                            <video id="video" autoplay class="w-full h-auto"></video>
                        </div>
                        <div id="previewSection" class="text-center hidden">
                            <img id="foto-preview" src="" alt="Foto Preview" class="w-full mt-4">
                        </div>
                        <div class="modal-action">
                            <button id="snap" class="btn btn-primary">Ambil Foto</button>
                            <button id="backToCamera" class="btn btn-secondary hidden">Foto Kembali</button>
                            <button id="save-photo" class="btn btn-primary hidden">Simpan</button>
                            <form method="dialog">
                                <button class="btn btn-outline">Close</button>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                <li class="flex items-center">
                    <a href="../pages/sign-in.html"
                        class="ease-nav-brand flex gap-1.5 px-0 py-2 text-lg font-semibold text-white transition-all">
                        <img src="{{ asset('assets/icons/user.svg') }}" class="h-4 mt-1" alt="user" />
                        <span class="hidden sm:inline">
                            {{ Auth::user()->nama }}
                        </span>
                    </a>
                </li>
                <li id="hamburger-menu" class="flex items-center pl-4 xl:hidden">
                    <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand">
                        <div class="w-4.5 overflow-hidden">
                            <i class="ease relative mb-0.75 block h-0.5 rounded-sm bg-white transition-all"></i>
                            <i class="ease relative mb-0.75 block h-0.5 rounded-sm bg-white transition-all"></i>
                            <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qrScanModal = document.getElementById('qrScanModal');
        const tamuDetailModal = document.getElementById('tamuDetailModal');
        const cameraModal = document.getElementById('cameraModal');
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const fotoPreview = document.getElementById('foto-preview');
        const cameraSection = document.getElementById('cameraSection');
        const previewSection = document.getElementById('previewSection');
        const snapButton = document.getElementById('snap');
        const backToCameraButton = document.getElementById('backToCamera');
        const savePhotoButton = document.getElementById('save-photo');

        console.log('Save Photo Button:', savePhotoButton);

        let html5QrCode;

        function initializeQRScanner() {
            if (html5QrCode) {
                html5QrCode.clear();
            }
            html5QrCode = new Html5Qrcode("reader");
        }

        function startQRScanner() {
            initializeQRScanner();
            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                onScanSuccess,
                onScanError
            ).catch(err => {
                console.error('Unable to start scanning:', err);
            });
        }

        function stopQRScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    console.log('QR Code scanning stopped.');
                    html5QrCode.clear();
                }).catch(err => {
                    console.error('Failed to stop scanning:', err);
                });
            }
        }

        document.querySelector('[onclick="openModalAndScan()"]').addEventListener('click', function(event) {
            event.preventDefault();
            qrScanModal.showModal();
            startQRScanner();
        });

        qrScanModal.addEventListener('close', stopQRScanner);

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`QR Code detected: ${decodedText}`);
            stopQRScanner();
            fetch(`/FO/tamu-detail/${decodedText}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modalTamuName').innerText = data.name;
                        document.getElementById('modalTamuEmail').innerText = data.email;
                        document.getElementById('modalTamuPhone').innerText = data.phone;
                        document.getElementById('id_kedatangan').value = decodedText;
                        qrScanModal.close();
                        setTimeout(() => {
                            tamuDetailModal.showModal();
                        }, 300); // Short delay to ensure smooth transition
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                        qrScanModal.close();
                    }
                })
                .catch(error => {
                    console.error('Error fetching tamu details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memproses QR code.'
                    });
                    qrScanModal.close();
                });
        }

        function onScanError(errorMessage) {
            console.error(`QR Code scan error: ${errorMessage}`);
        }

        document.getElementById('takePhotoBtn').addEventListener('click', function() {
            tamuDetailModal.close();
            setTimeout(() => {
                cameraModal.showModal();
                startCamera();
            }, 300); // Short delay to ensure smooth transition
        });

        cameraModal.addEventListener('close', stopCamera);

        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(err => console.error('Error accessing camera:', err));
        }

        function stopCamera() {
            if (video.srcObject) {
                video.srcObject.getTracks().forEach(track => track.stop());
            }
        }

        function capturePhoto() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0);
            const dataUrl = canvas.toDataURL('image/png');
            fotoPreview.src = dataUrl;
            cameraSection.style.display = 'none';
            previewSection.style.display = 'block';
        }

        snapButton.addEventListener('click', function() {
            capturePhoto();
            backToCameraButton.style.display = 'block';
            savePhotoButton.style.display = 'block';
            console.log('Save button should be visible now');
        });

        backToCameraButton.addEventListener('click', function() {
            cameraSection.style.display = 'block';
            previewSection.style.display = 'none';
            backToCameraButton.style.display = 'none';
            savePhotoButton.style.display = 'none';
        });

        if (savePhotoButton) {
            savePhotoButton.addEventListener('click', function(event) {
                event.preventDefault();
                console.log('Save button clicked');

                canvas.toBlob(function(blob) {
                    const formData = new FormData();
                    formData.append('foto', blob, 'foto.png');
                    formData.append('id_kedatangan', document.getElementById('id_kedatangan')
                        .value);

                    console.log('FormData:', formData);

                    fetch('{{ route('update-kedatangan') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Response Data:', data);
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Data berhasil diperbarui.'
                                }).then(() => {
                                    cameraModal.close();
                                });
                            } else {
                                throw new Error(data.message ||
                                    'Terjadi kesalahan saat memperbarui data.');
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error.message
                            });
                        });
                }, 'image/png');
                cameraModal.close();
            });
        } else {
            console.error('Save Photo Button not found');
        }
    });
</script>
