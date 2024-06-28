<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - GuBook</title>
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


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
                <img src="{{ asset('assets/icons/user.svg') }}" class="h-36 z-0" alt="user icon">
            </div>
            <div class="mb-4">
                <ul class="flex flex-wrap -mb-px font-medium text-3xl">
                    <li class="mr-2">
                        <a href="/form-tamu"
                            class="inline-block text-light hover:text-lightBlue2 hover:border-lightBlue2 rounded-t-lg py-4 px-4 text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300">Tamu</a>
                    </li>
                    <li class="mr-2">
                        <a href="/form-kurir"
                            class="inline-block text-light hover:text-lightBlue2 hover:border-lightBlue2 rounded-t-lg py-4 px-4 text-center border-light border-b-2 dark:text-gray-400 dark:hover:text-lightBlue2">Kurir</a>
                    </li>
                </ul>
            </div>
            <form>
                <div class="w-100 md:w-240 mt-8 grid lg:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="text-sm text-light block mb-1 font-medium">Pengirim</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Nama" />
                    </div>

                    <div>
                        <label for="email" class="text-sm text-light block mb-1 font-medium">Ekspedisi</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-grey w-full h-12"
                            placeholder="Masukan Ekspedisi" />
                    </div>

                    <div>
                        <label class="text-sm text-light block mb-1 font-medium">Pegawai</label>
                        <div x-data="select" class="relative w-full" @click.outside="open = false">
                            <button
                                @click.prevent="toggle":class="{'text-grey': !selectedPegawai, 'text-dark': selectedPegawai, 'ring-blue-600': open}"
                                class="flex w-full items-center justify-between rounded-lg bg-white text-dark h-12 p-2 ring-1 ring-gray-300">
                                <span x-text="selectedPegawai ? selectedPegawai : 'Pilih Pegawai'"></span>
                                <img src="{{ asset('assets/icons/caret.svg') }}" class="h-3 text-grey" alt="^">
                            </button>

                            <ul class="z-10 absolute mt-1 w-full rounded text-dark bg-gray-50 ring-1 ring-gray-300 max-h-40 overflow-y-auto"
                                x-show="open">
                                @foreach ($listpegawai as $pegawai)
                                    <li class="cursor-pointer select-none p-2 hover:bg-gray-200"
                                        @click="setPegawai('{{ $pegawai->name }}')">{{ $pegawai->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="">

                        <label class="text-sm text-light block mb-1 font-medium">Foto</label>
                        <div class="relative h-12">
                            <input type="textarea" id="date"
                                class="bg-gray-100 border border-gray-200 rounded-lg py-1 px-3 block text-grey placeholder:text-grey w-full h-12"
                                placeholder="Masukan Tujuan" />
                            <img src="{{ asset('assets/icons/camera.svg') }}" class="h-7 absolute top-3 right-3" alt="">
                        </div>
                    </div>

                </div>

                <div class="md:w-1/2 float-right w-full">
                    <div class="gap-4 mt-8 flex flex-row">
                        <button
                            class="py-1 px-4 bg-white text-gray-600 h-12 w-24 flex items-center justify-center rounded-lg hover:bg-gray-100">
                            <img src="{{ asset('assets/icons/reset.svg') }}" class="h-6" alt="reset icon">
                        </button>
                        <button type="submit"
                            class="py-2 bg-secondaryBlue text-white w-full text-base rounded-lg h-12 hover:text-lightBlue2">Save</button>

                    </div>
                </div>
            </form>
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
                }
            }))
        })

        // tanggal
        document.getElementById('date').addEventListener('change', function() {
            this.classList.remove('bg-gray-100', 'text-grey', 'placeholder:text-grey');
            this.classList.add('bg-black', 'text-dark', 'placeholder:text-dark');
        });
    </script>
</body>

</html>
