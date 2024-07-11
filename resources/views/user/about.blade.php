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
        <div class="w-[90%]">
            <div class="flex w-full">
                <div class="w-full bg-cover h-100 bg-top" style="background-image: url('{{ asset('assets/jumbotron.jpeg') }}')"></div>
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
