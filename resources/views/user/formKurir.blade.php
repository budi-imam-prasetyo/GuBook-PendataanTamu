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
                <img src="{{ asset('assets/icons/truck.svg') }}" class="h-36 z-0" alt="user icon">
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
</body>

</html>
