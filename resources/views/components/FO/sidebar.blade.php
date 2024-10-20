<aside id="sidebar"
    class="fixed inset-y-0 left-0 flex-wrap items-center justify-between hidden w-full p-0 m-4 overflow-y-auto antialiased bg-white border-0 shadow-lg dark:bg-slate-850 max-w-64 z-990 xl:z-0 xl:block sm:left-auto sm:right-0 rounded-2xl xl:left-0 xl:right-auto transition-transform duration-300 transform translate-x-0">
    <div class="h-full">
        <!-- Logo & Close Button -->
        <div class="flex justify-center h-20 relative">
            <img id="close-sidebar" src="{{ asset('assets/icons/cross.svg') }}"
                class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer transition-opacity hover:opacity-100 xl:hidden"></img>
            <a class="block p-5 m-0 text-sm whitespace-nowrap text-slate-700" href="/welcome">
                <img src="{{ asset('GuBook.png') }}"
                    class="w-32 h-auto transition-transform duration-200 ease-in-out hover:scale-105" alt="main_logo" />
            </a>
        </div>

        <!-- Sidebar Menu Items -->
        <div class="items-center block w-auto overflow-auto grow basis-full">
            <ul class="gap-2 flex flex-col pl-0 relative h-[86%]">
                <x-FO.sidebar-btn src="{{ asset('assets/icons/tv.svg') }}" href="/FO">dashboard</x-FO.sidebar-btn>
                <x-FO.sidebar-btn src="{{ asset('assets/icons/school.svg') }}" href="/FO/pegawai">pegawai</x-FO.sidebar-btn>
                <!-- Dropdown for Laporan -->
                <li class="relative">
                    <div class="hover:bg-primaryBlue/5 rounded-lg mx-2 flex items-center whitespace-nowrap px-4 py-2.7 text-sm transition-colors select-none duration-200 ease-in-out text-slate-700 hover:text-primaryBlue dark:text-white cursor-pointer"
                        onclick="toggleDropdown()">
                        <div class="mr-2 flex h-10 w-10 items-center justify-center rounded-lg bg-center text-center">
                            <img class="h-5" src="{{ asset('assets/icons/report.svg') }}" alt="laporan"></img>
                        </div>
                        <span class="ml-1 capitalize">Laporan</span>
                        <svg class="ml-auto w-4 h-4 transition-transform transform" id="dropdown-icon" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <ul id="dropdown-menu" class="hidden flex-col space-y-2 py-2 pl-14 transition-all">
                        <li>
                            <a href="/FO/laporan-tamu"
                                class="{{ request()->is('FO/laporan-tamu') ? 'rounded-lg bg-secondaryBlue/13 font-semibold text-primaryBlue' : 'ease' }} block text-sm px-4 py-2 text-slate-700 hover:bg-primaryBlue/5 hover:text-primaryBlue dark:text-white rounded-md select-none transition-all">Laporan
                                Tamu</a>
                        </li>
                        <li>
                            <a href="/FO/laporan-kurir"
                                class="{{ request()->is('FO/laporan-kurir') ? 'rounded-lg bg-secondaryBlue/13 font-semibold text-primaryBlue' : 'ease' }} block text-sm px-4 py-2 text-slate-700 hover:bg-primaryBlue/5 hover:text-primaryBlue dark:text-white rounded-md select-none transition-all">Laporan
                                Kurir</a>
                        </li>
                    </ul>
                </li>

                <x-FO.sidebar-btn src="{{ asset('assets/icons/map-marker.svg') }}"
                    href="/FO/kunjungan">kunjungan</x-FO.sidebar-btn>

                <!-- Account Section -->
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60 dark:text-white">Account
                        pages</h6>
                </li>

                <!-- Logout Button -->
                <li class="mt-0.5 w-full">
                    <a class="hover:bg-primaryBlue/5 rounded-lg mx-2 flex items-center whitespace-nowrap px-4 py-2.7 text-sm transition-colors duration-200 ease-in-out text-slate-700 hover:text-primaryBlue dark:text-white"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="mr-2 flex h-10 w-10 items-center justify-center rounded-lg bg-center text-center">
                            <img class="h-5" src="{{ asset('assets/icons/open-door.svg') }}" alt="logout"></img>
                        </div>
                        <span class="ml-1 capitalize">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>

<script>
function toggleDropdown() {
    document.getElementById('dropdown-menu').classList.toggle('hidden');
    document.getElementById('dropdown-icon').classList.toggle('rotate-180');
}

document.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname.toLowerCase();
    if (['/fo/laporan-tamu', '/fo/laporan-kurir'].includes(currentPath)) {
        toggleDropdown();
    }
});
</script>