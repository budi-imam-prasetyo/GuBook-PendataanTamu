<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Beranda - GuBook</title>
        <link
            rel="icon"
            href="{{ asset("assets/logo2.png") }}"
            type="image/x-icon"
        />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css"
            rel="stylesheet"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
            defer
        ></script>

        @vite("resources/css/app.css")
    </head>

    <body
        class="relative h-screen bg-gradient-to-b from-secondaryBlue to-primaryBlue text-light"
    >
        {{-- Navigation --}}
        <x-user.navbar></x-user.navbar>

        <div
            class="absolute left-1/2 top-1/2 -z-990 -translate-x-1/2 -translate-y-1/2 transform"
        >
            <img
                src="{{ asset("assets/logo2.png") }}"
                class="h-100 opacity-40 sm:h-135 md:h-180"
                alt=""
            />
        </div>
        {{-- Main --}}
        <main>
            <div class="w-[90%]">
                <div class="flex w-full">
                    <div
                        class="h-100 w-full bg-cover bg-top"
                        style="
                            background-image: url('{{ asset("assets/jumbotron.jpeg") }}');
                        "
                    ></div>
                </div>
            </div>
        </main>

        <script>
            //select pegawai
            document.addEventListener('alpine:init', () => {
                Alpine.data('select', () => ({
                    open: false,
                    selectedPegawai: '',
                    toggle() {
                        this.open = !this.open;
                    },
                    setPegawai(name) {
                        this.selectedPegawai = name;
                        this.open = false;
                    },
                }));
            });

            // tanggal
            document
                .getElementById('date')
                .addEventListener('change', function () {
                    this.classList.remove(
                        'bg-gray-100',
                        'text-grey',
                        'placeholder:text-grey',
                    );
                    this.classList.add(
                        'bg-black',
                        'text-dark',
                        'placeholder:text-dark',
                    );
                });
        </script>
    </body>
</html>
