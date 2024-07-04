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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    @vite('resources/css/app.css')

</head>

<body class="text-light bg-secondaryBlue relative h-screen">
    {{-- Navigation --}}
    <x-user.navbar></x-user.navbar>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-990">
        <img src="{{ asset('assets/logo2.png') }}" class="h-100 sm:h-135 md:h-180 opacity-40" alt="">
    </div>
    {{-- Main --}}
    <main>
        <div class="flex flex-col items-center justify-center gap-5">
            <div class="w-full text-center">
                <h1 class="text-3xl text-light">List Pegawai</h1>
            </div>
            {{-- ! INPUT SECTION --}}
            <div class="flex w-full">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-5 w-full md:w-[70%] mx-auto px-10">
                    <div class="w-full">
                        <input type="text" name="name" id="name"
                            class="bg-light border border-gray-200 rounded-lg py-1 px-3 block text-dark placeholder:text-darkGray w-full h-12"
                            placeholder="Nama Pegawai" autocomplete="nickname" />
                    </div>
                    <div class="">
                        <div x-data="select" class="relative w-full z-10" @click.outside="open = false"
                            x-init="setPegawai('Guru')">
                            <button
                                @click.prevent="toggle":class="{'text-darkGray': !selectedPegawai, 'text-dark': selectedPegawai, 'ring-blue-600': open}"
                                class="flex w-full items-center justify-between rounded-lg bg-white text-dark h-12 p-2 ring-1 ring-gray-300">
                                <span x-text="selectedPegawai ? selectedPegawai : 'Guru'"></span>
                                <img src="{{ asset('assets/icons/caret.svg') }}" class="h-3 text-darkGray" alt="^">
                            </button>

                            <ul class="z-2 absolute mt-1 w-full rounded text-dark bg-gray-50 ring-1 ring-gray-300 max-h-40 overflow-y-auto"
                                x-show="open">
                                <li class="cursor-pointer select-none p-2 hover:bg-gray-200"
                                    @click="setPegawai('Guru')">Guru</li>
                                <li class="cursor-pointer select-none p-2 hover:bg-gray-200"
                                    @click="setPegawai('Tendik')">Tendik</li>
                            </ul>
                        </div>
                    </div>
                    <div class="">
                        <div x-data="select" class="relative w-fullz-20" @click.outside="open = false">
                            <button
                                @click.prevent="toggle":class="{'text-darkGray': !selectedPegawai, 'text-dark': selectedPegawai, 'ring-blue-600': open}"
                                class="flex w-full items-center justify-between rounded-lg bg-white text-dark h-12 p-2 ring-1 ring-gray-300">
                                <span x-text="selectedPegawai ? selectedPegawai : 'Pilih PTK'"></span>
                                <img src="{{ asset('assets/icons/caret.svg') }}" class="h-3 text-darkGray" alt="^">
                            </button>

                            <ul class="z-2 absolute mt-1 w-full rounded text-dark bg-gray-50 ring-1 ring-gray-300 max-h-40 overflow-y-auto"
                                x-show="open">
                                @foreach ($listmapel as $list)
                                    <li class="cursor-pointer select-none p-2 hover:bg-gray-200"
                                        @click="setPegawai('{{ $list }}')">{{ $list }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ! INPUT SECTION --}}

            {{-- ! TABLE SECTION --}}
            <div class="w-full md:w-2/3">
                <div class="block w-full overflow-x-auto px-10 md:px-3">
                    <table class="items-center bg-light w-full border-collapse rounded-xl">
                        <thead>
                            <tr class="shadow-sm">
                                <th
                                    class="px-2 w-[5%] text-light bg-primaryBlue rounded-tl-xl align-middle py-4 text-sm uppercase whitespace-nowrap font-semibold text-center">
                                    No.
                                </th>
                                <th
                                    class="px-6 w-[30%] text-light bg-primaryBlue align-middle py-4 text-sm uppercase whitespace-nowrap font-semibold text-center">
                                    NIP
                                </th>
                                <th
                                    class="px-6 w-[25%] text-light bg-primaryBlue align-middle py-4 text-sm uppercase whitespace-nowrap font-semibold text-center">
                                    Nama Pegawai
                                </th>
                                <th
                                    class="px-6 w-[25%] text-light bg-primaryBlue align-middle py-4 text-sm uppercase whitespace-nowrap font-semibold text-center">
                                    Email
                                </th>
                                <th
                                    class="px-6 w-[15%] text-light bg-primaryBlue rounded-tr-xl align-middle py-4 text-sm uppercase whitespace-nowrap font-semibold text-center">
                                    PTK
                                </th>
                            </tr>
                        </thead>

                        <tbody id="guestTableBody">
                            @foreach ($listpegawai as $list)
                            <tr class="hover:bg-lightBlue2 group">
                                <th class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
                                    {{ $list->id }}.
                                </th>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
                                    {{ $list->NIP }}
                                </td>
                                <td class="border-t-0 align-center border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
                                    {{ $list->name }}
                                </td>
                                <td class="border-t-0 align-center border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark lowercase">
                                    {{ $list->name }}@gmail.com
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
                                    {{ $list->PTK }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <button id="loadMoreBtn" class="relative text-secondaryBlue font-bold py-2 px-4 rounded">Lihat Lebih Banyak <i class="ml-1 fas fa-chevron-down"></i></button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        </div>
        {{-- ! TABLE SECTION --}}
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


        $(document).ready(function() {
            var skip = 10; // initial data count

            $('#loadMoreBtn').click(function() {
                $.ajax({
                    url: '/pegawai/load',
                    type: 'GET',
                    data: { skip: skip },
                    success: function(data) {
                        $('#guestTableBody').append(data);
                        skip += 15; // increment skip count by 15
                    }
                });
            });
        });
    </script>
</body>

</html>
