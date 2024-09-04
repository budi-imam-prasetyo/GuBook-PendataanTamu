<!-- resources/views/components/admin/sidebar.blade.php -->
<aside id="sidebar" class="hidden fixed inset-y-0 flex-wrap items-center justify-between w-full p-0 m-4 overflow-y-auto antialiased bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 z-990 xl:block sm:left-auto sm:right-0 left-0 rounded-2xl xl:left-0 xl:right-auto">
    <div class="h-full">
        <div class="flex h-20 justify-center">
            <i id="close-sidebar" class="fas fa-times absolute right-0 top-0 cursor-pointer p-4 text-slate-400 opacity-50 dark:text-white xl:hidden"></i>
            <a class="m-0 block whitespace-nowrap px-8 py-6 text-sm text-slate-700" href="/welcome">
                <img src="{{ asset('GuBook.png') }}" class="ease-nav-brand inline h-full max-h-full w-30 max-w-full transition-all duration-200" alt="main_logo" />
            </a>
        </div>
        <div class="block w-auto grow basis-full items-center overflow-auto">
            <ul class="gap-2 flex flex-col pl-0 relative h-[86%]">
                <x-pegawai.sidebar-btn src="{{ asset('assets/icons/tv-2.svg') }}" href="/pegawai">dashboard</x-pegawai.sidebar-btn>
                <x-pegawai.sidebar-btn src="{{ asset('assets/icons/map-marker-2.svg') }}" href="/pegawai/kunjungan">kunjungan</x-pegawai.sidebar-btn>
                <li class="mt-4 w-full">
                    <h6 class="ml-2 pl-6 text-xs font-bold uppercase leading-tight opacity-60 dark:text-white">Account pages</h6>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="hover:bg-secondaryRed/5 rounded-lg mx-2 my-0 flex items-center whitespace-nowrap px-4 py-2.7 text-base transition-colors" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="mr-2 flex h-8 w-10 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <img class="relative h-4 top-0" src="{{ asset('assets/icons/open-door-2.svg') }}"></img>
                        </div>
                        <span class="capitalize ease pointer-events-none ml-1 opacity-100 duration-300">{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
