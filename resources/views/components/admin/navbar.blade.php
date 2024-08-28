<nav class="relative mx-6 flex flex-wrap items-center justify-between rounded-2xl  p-2 shadow-none transition-all duration-250 ease-in lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="false">
    <div class="flex-wrap-inherit mx-auto flex w-full items-center justify-between py-1 pr-2">
        <nav>
            <!-- breadcrumb -->
            <div class="breadcrumbs text-base text-light">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>{{ $slot }}</li>
                </ul>
            </div>
            <h6 class="mb-0 font-bold capitalize text-white">{{ $slot }}</h6>
        </nav>
        <div class="mt-2 flex items-center sm:mr-6 sm:mt-0 md:mr-0 lg:flex lg:basis-auto">
            {{-- <div class="ml-auto flex items-center justify-end pr-4">
                <div
                    onclick="openModalAndScan()"
                    class="group flex w-full items-center justify-center rounded-lg bg-white transition duration-300 ease-in-out"
                >
                    <span
                        class="flex items-center justify-center rounded-lg border border-transparent bg-transparent p-2.5 pr-1 text-center text-xl font-bold leading-normal text-slate-800 transition duration-300 ease-in-out"
                    >
                        <img
                            src="{{ asset("assets/icons/qrcode.svg") }}"
                            class="h-4.5"
                            alt="qrcode"
                        />
                    </span>
                    <button
                        class="mt-0 flex items-center justify-center rounded-lg pr-2.5 text-sm font-medium text-gray-700 transition duration-300 ease-in-out group-hover:font-semibold"
                    >
                        <span class="md:hidden">Scan</span>
                        <span class="hidden md:block">QR Code</span>
                    </button>
                </div>

                <dialog id="my_modal_1" class="modal backdrop-blur-sm">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Scan QR Code</h3>
                        <div id="qr-reader" style="width: 300px"></div>
                        <p id="qr-result" class="py-4">
                            Scan a QR code to see the result here.
                        </p>
                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn" onclick="stopScan()">
                                    Close
                                </button>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div> --}}

            <ul class="mb-0 flex list-none flex-row justify-end pl-0 md-max:w-full">
                <li class="flex items-center">
                    <a href="../pages/sign-in.html"
                        class="ease-nav-brand flex gap-1.5 px-0 py-2 text-lg font-semibold text-white transition-all">
                        <img src="{{ asset('assets/icons/user.svg') }}" class="mt-1 h-4" alt="user" />
                        <span class="hidden sm:inline">
                            {{ Auth::user()->nama }}
                        </span>
                    </a>
                </li>
                <li id="hamburger-menu" class="flex items-center pl-4 xl:hidden">
                    <a href="javascript:;" class="ease-nav-brand block p-0 text-sm text-white transition-all">
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
{{-- <script>
    let html5QrCode;
    const modal = document.getElementById('my_modal_1');
    const resultElement = document.getElementById('qr-result');

    function openModalAndScan() {
        modal.showModal();
        html5QrCode = new Html5Qrcode('qr-reader');
        html5QrCode
            .start({
                    facingMode: 'environment'
                }, // menggunakan kamera belakang
                {
                    fps: 10, // frame per second
                    disableFlip: true,
                    qrbox: {
                        width: 250,
                        height: 250
                    }, // ukuran area scan QR code
                },
                (qrCodeMessage) => {
                    resultElement.textContent = `QR Code detected: ${qrCodeMessage}`;
                    // Optionally stop scanning after a successful detection
                    // stopScan();
                },
                (errorMessage) => {
                    console.log(`Error scanning QR Code: ${errorMessage}`);
                },
            )
            .catch((err) => {
                console.log(`Error starting QR Code scanner: ${err}`);
            });
    }

    function stopScan() {
        if (html5QrCode) {
            html5QrCode
                .stop()
                .then((ignore) => {
                    html5QrCode.clear();
                })
                .catch((err) => {
                    console.log(`Error stopping QR Code scanner: ${err}`);
                });
        }
    }

    modal.addEventListener('close', stopScan);
</script> --}}
