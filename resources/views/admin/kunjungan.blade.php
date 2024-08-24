<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link rel=" stylesheet " href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css " />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>

    </style>
</head>

<body
    class="m-0 bg-gray-50 font-sans text-base font-medium leading-default text-slate-500 antialiased dark:bg-slate-900">
    @apexchartsScripts

    <div class="absolute min-h-80 w-full bg-blue-500 dark:hidden"></div>

    <x-admin.sidebar></x-admin.sidebar>

    <main class="relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out xl:ml-68">
        {{-- Navbar --}}
        <x-admin.navbar>Kunjungan</x-admin.navbar>

        <div class="w-full flex flex-col gap-7 p-6 pt-3">
            {{-- Rows 1 --}}
            <div class="w-full flex">
                <div class=" w-full h-full grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div
                        class="flex flex-col order-last md:order-first bg-light shadow-sm rounded-4.5 md:col-span-3 p-5">
                        <div class="w-full">
                            <h1 class="text-dark text-xl">Kedatangan Tamu</h1>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-full">
                            {{-- Card 1 --}}
                            <div
                                class="-mx-1 flex flex-row justify-between bg-lightBlue rounded-3 h-full shadow-md p-5">
                                <div class="max-w-full flex-none">
                                    <div>
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
                                            Selesai
                                        </p>
                                        <h5 class="mb-2 font-bold">7</h5>
                                        <p class="mb-2 text-xs">> 50% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="text-right flex items-center justify-center">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-b from-green-500 to-green-400 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6" alt="">
                                    </div>
                                </div>
                            </div>
                            {{-- Card 2 --}}
                            <div
                                class="-mx-1 flex flex-row justify-between bg-lightBlue rounded-3 h-full shadow-md p-5">
                                <div class="max-w-full flex-none">
                                    <div>
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
                                            Belum Datang
                                        </p>
                                        <h5 class="mb-2 font-bold">2</h5>
                                        <p class="mb-2 text-xs">> 25% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="text-right flex items-center justify-center">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-b from-yellow-500 to-yellow-400 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6" alt="">
                                    </div>
                                </div>
                            </div>
                            {{-- Card 3 --}}
                            <div
                                class="-mx-1 flex flex-row justify-between bg-lightBlue rounded-3 h-full shadow-md p-5">
                                <div class="max-w-full flex-none">
                                    <div>
                                        <p class="mb-0 font-sans text-lg font-semibold leading-normal">
                                            Tidak Hadir
                                        </p>
                                        <h5 class="mb-2 font-bold">1</h5>
                                        <p class="mb-2 text-xs">> 75% dari kemarin</p>
                                    </div>
                                </div>
                                <div class="text-right flex items-center justify-center">
                                    <div
                                        class="h-16 w-16 rounded-circle bg-gradient-to-b from-red-500 to-red-400 flex items-center justify-center">
                                        <img src="{{ asset('assets/icons/group-user.svg') }}" class="h-6" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded-4.5 p-1 h-full shadow-sm">{!! $chart->container() !!}</div>
                </div>
            </div>

            {{-- Rows 2 --}}
            <div class="w-full flex mt-1">
                <div class="w-full grid grid-cols-1 md:grid-cols-7 gap-6">
                    <div class="w-full flex flex-col bg-light p-5 col-span-3 gap-6 rounded-4.5 shadow-md" id="cardDetail">
                        <div class="w-full flex flex-col col-span-3 gap-6 rounded-4.5">
                            <!-- Skeleton for Profile Picture -->
                            <div class="w-full flex items-center justify-center">
                                <div class="rounded-full flex items-center justify-center w-25 h-25 outline outline-4 bg-base-300 skeleton">
                                    <div class="h-full rounded-full bg-base-300 skeleton"></div>
                                </div>
                            </div>

                            <!-- Skeleton for Name, Meeting, and Time -->
                            <div class="w-full flex gap-2 justify-around">
                                <div class="w-full flex flex-col items-center justify-center gap-2">
                                    <div class="h-4 w-20 bg-base-300 skeleton rounded"></div>
                                    <div class="h-5 w-32 bg-base-300 skeleton rounded"></div>
                                </div>
                                <div class="w-full flex flex-col items-center justify-center gap-2">
                                    <div class="h-4 w-20 bg-base-300 skeleton rounded"></div>
                                    <div class="h-5 w-32 bg-base-300 skeleton rounded"></div>
                                </div>
                                <div class="w-full flex flex-col items-center justify-center gap-2">
                                    <div class="h-4 w-20 bg-base-300 skeleton rounded"></div>
                                    <div class="h-5 w-32 bg-base-300 skeleton rounded"></div>
                                </div>
                            </div>

                            <!-- Skeleton for Other Details -->
                            <div class="w-full px-4">
                                <div class="h-6 w-36 bg-base-300 skeleton rounded mb-2 px-2"></div>
                                <div class="bg-lightBlue p-4 rounded-4.5 space-y-3.5">
                                    <div class="flex mb-2">
                                        <div class="w-1/6 h-4 bg-lightBlue2 skeleton rounded"></div>
                                        <div class="w-5/6 h-4 bg-lightBlue2 skeleton rounded ml-2"></div>
                                    </div>
                                    <div class="flex mb-2">
                                        <div class="w-1/6 h-4 bg-lightBlue2 skeleton rounded"></div>
                                        <div class="w-5/6 h-4 bg-lightBlue2 skeleton rounded ml-2"></div>
                                    </div>
                                    <div class="flex mb-2">
                                        <div class="w-1/6 h-4 bg-lightBlue2 skeleton rounded"></div>
                                        <div class="w-5/6 h-4 bg-lightBlue2 skeleton rounded ml-2"></div>
                                    </div>
                                    <div class="flex mb-2">
                                        <div class="w-1/6 h-4 bg-lightBlue2 skeleton rounded"></div>
                                        <div class="w-5/6 h-4 bg-lightBlue2 skeleton rounded ml-2"></div>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <div class="h-4 w-20 bg-lightBlue2 skeleton rounded"></div>
                                        <div class="w-full py-2 px-3 bg-lightBlue2 skeleton rounded-lg h-24"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-full bg-light rounded-4.5 shadow-md col-span-4 p-4.5">
                        <div class="relative mb-4">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <img src="{{ asset('assets/icons/search2.svg') }}" class="w-5 h-5" alt="">
                            </div>
                            <input type="email"
                                class="peer py-3 px-4 ps-11 block w-full bg-lightBlue border rounded-lg text-sm focus:border-opacity-50 disabled:opacity-50 disabled:pointer-events-none placeholder:font-semibold placeholder:text-grey"
                                placeholder="Enter name">
                        </div>
                        <!-- Batasi tinggi div ini dan tambahkan scrollbar -->
                        <ul class="mb-0 flex flex-col gap-2.5 rounded-lg pl-0 max-h-125 overflow-y-auto">
                            @forelse ($kedatangan as $item)
                            <li class="relative mb-2 flex rounded-xl rounded-t-inherit border-0 bg-lightBlue px-6 py-4 dark:bg-slate-850">
                                <div class="flex gap-7 ml-4">
                                    <div class="flex items-center justify-center h-full">
                                        @if ($item->type == 'tamu')
                                        <img src="{{ asset('assets/icons/user2.svg') }}" alt="">
                                        @else
                                        <img src="{{ asset('assets/icons/box2.svg') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h5 class="text-lg font-semibold">
                                            {{ $item->user->nama }}
                                        </h5>
                                        <div class="flex gap-2">
                                            <div class="mb-2 text-sm flex flex-col gap-3 leading-tight">
                                                @if ($item->type == 'tamu')
                                                <p class="font-semibold capitalize"><span class="font-normal">Nama: </span>{{ $item->tamu->nama }}</p>
                                                <p class="font-semibold capitalize"><span class="font-normal">Email: </span>{{ $item->tamu->email }}</p>
                                                <p class="font-semibold capitalize"><span class="font-normal">Tanggal Perjanjian: </span>{{ $item->formatWaktu }}</p>
                                                @else
                                                <p class="font-semibold capitalize"><span class="font-normal">Nama Kurir: </span>{{ $item->ekspedisi->nama_kurir }}</p>
                                                <p class="font-semibold capitalize"><span class="font-normal">Ekspedisi: </span>{{ $item->ekspedisi->ekspedisi }}</p>
                                                <p class="font-semibold capitalize"><span class="font-normal">Tanggal Kedatangan: </span>{{ $item->formatWaktu }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-auto text-right flex items-center">
                                    <a href="javascript:;" onclick="loadDetail('{{ $item->id_kedatangan }}', '{{ $item->type }}')" class="mb-0 inline-block cursor-pointer rounded-lg border-0 bg-transparent bg-150 bg-x-25 px-4 py-2.5 text-center align-middle text-sm font-bold leading-normal text-slate-700 shadow-none transition-all ease-in hover:-translate-y-px active:opacity-85 dark:text-white">Detail</a>

                                </div>
                            </li>
                            @empty
                            <div class="flex items-center justify-center h-full">
                                <li class="text-center mt-4 text-grey text-lg">Tidak Ada Data Kunjungan</li>
                            </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div fixed-plugin fixed-plugin-button fixed-plugin-card fixed-plugin-close-button transparent-style-btn
        white-style-btn navbarFixed dark-toggle />
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- plugin for scrollbar  -->
<!-- <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script> -->
<!-- main script file  -->
<!-- <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> -->
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable({});
    });
</script> -->
{{ $chart->script() }}


<script>
    function loadDetail(id, type) {
        $.ajax({
            url: '/admin/kunjungan/' + id, // Pastikan URL ini sesuai dengan route Anda
            method: 'GET',
            success: function(data) {
                // Update container dengan partial view yang diterima dari server
                $('#cardDetail').html(data);
            },
            error: function() {
                alert('Terjadi kesalahan saat memuat data.');
            }
        });
    }
</script>

</html>