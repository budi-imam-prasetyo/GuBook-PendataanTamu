<aside
    class="ease-nav-brand no-scrollbar fixed inset-y-0 z-990 my-4 block w-full max-w-64 -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-1 antialiased shadow-xl transition-transform duration-200 dark:bg-slate-850 dark:shadow-none xl:left-0 xl:ml-6 xl:translate-x-0"
    aria-expanded="false">
    <div class="flex h-20 justify-center">
        <i class="fas fa-times absolute right-0 top-0 cursor-pointer p-4 text-slate-400 opacity-50 dark:text-white xl:hidden"
            sidenav-close></i>
        <a class="m-0 block whitespace-nowrap px-8 py-6 text-sm text-slate-700"
            href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
            <img src={{ asset('GuBook.png') }}
                class="ease-nav-brand inline h-full max-h-full w-30 max-w-full transition-all duration-200"
                alt="main_logo" />
        </a>
    </div>

    <div class="block h-screen max-h-screen w-auto grow basis-full items-center overflow-auto">
        <ul class="mb-0 flex flex-col pl-0 relative h-[86%]">

            <x-admin.sidebar-btn class="fa fa-tv text-blue-500 text-lg">
                dashboard
            </x-admin.sidebar-btn>

            <x-admin.sidebar-btn class="fa fa-user-plus text-orange-500 text-lg">
                pegawai
            </x-admin.sidebar-btn>
            <x-admin.sidebar-btn class="fa fa-map-marker text-emerald-500 text-lg">
                kunjungan
            </x-admin.sidebar-btn>


            <li class="mt-4 w-full">
                <h6 class="ml-2 pl-6 text-xs font-bold uppercase leading-tight opacity-60 dark:text-white">
                    Account pages
                </h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class="ease-nav-brand mx-2 my-0 flex items-center whitespace-nowrap px-4 py-2.7 text-sm transition-colors dark:text-white dark:opacity-80"
                    href="../pages/profile.html">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-user relative top-0 text-sm leading-normal text-slate-700"></i>
                    </div>
                    <span class="ease pointer-events-none ml-1 opacity-100 duration-300">Profile</span>
                </a>
            </li>

            <li class="mt-0.5 w-full bottom-0">
                <a class="ease-nav-brand mx-2 my-0 flex items-center whitespace-nowrap px-4 py-2.7 text-sm transition-colors dark:text-white dark:opacity-80 hover:bg-primaryBlue"
                    href="../pages/sign-up.html">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-sign-out relative top-0 text-sm leading-normal text-red-500"></i>
                    </div>
                    <span class="ease pointer-events-none ml-1 opacity-100 duration-300">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
