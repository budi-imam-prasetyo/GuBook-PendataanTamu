<nav class="relative mx-6 flex flex-wrap items-center justify-between rounded-2xl px-0 py-2 shadow-none transition-all duration-250 ease-in lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="false">
    <div class="mx-auto flex w-full items-center justify-between pl-4 pr-2 py-1 flex-wrap-inherit">
        <nav>
            <!-- breadcrumb -->
            <ol class="mr-12 flex flex-wrap rounded-lg bg-transparent pt-1 sm:mr-16">
                <li class="text-sm leading-normal">
                    <a class="text-white opacity-50" href="/">Home</a>
                </li>
                <li class="pl-2 text-sm capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                    aria-current="page">
                    Dashboard
                </li>
            </ol>
            <h6 class="mb-0 font-bold capitalize text-white">Dashboard</h6>
        </nav>

        <div class="mt-2 flex  items-center sm:mr-6 sm:mt-0 md:mr-0 lg:flex lg:basis-auto">
            <div x-data="{ isOpen: false }" class="flex items-center justify-end ml-auto pr-4">
                <div @click="isOpen = true" class="group flex w-full items-center justify-center rounded-lg bg-white hover:bg-secondary transition duration-300 ease-in-out">
                    <span class="flex items-center justify-center rounded-lg border border-transparent bg-transparent p-2.5 pb-2 text-center text-xl font-bold leading-normal text-slate-800 transition duration-300 ease-in-out">
                        <i class="fa fa-qrcode "></i>
                    </span>
                    <button class="m-0 flex items-center justify-center rounded-lg font-medium text-sm text-gray-700 group-hover:font-semibold transition duration-300 ease-in-out dark:bg-slate-850 dark:text-white pr-2.5">
                        <span class="md:hidden">Scan</span>
                        <span class="hidden md:block">QR Code</span>
                    </button>
                    
                </div>
                <div class="fixed inset-0 flex items-center justify-center z-50" x-show="isOpen" @click.away="isOpen = false">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold mb-4">Ini Isi Popup</h2>
                        <p class="text-gray-700 mb-2">Ini adalah konten dari popup.</p>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="isOpen = false">Tutup</button>
                    </div>
                </div>
            </div>
            <ul class="mb-0 flex list-none flex-row justify-end pl-0 md-max:w-full">
                <!-- online builder btn  -->
                <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->
                <li class="flex items-center">
                    <a href="../pages/sign-in.html"
                        class="ease-nav-brand block px-0 py-2 text-lg font-semibold text-white transition-all">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
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
                <!-- <li fixed-plugin-button-nav class="flex items-center px-4">
                    <label class="relative float-left ml-auto cursor-pointer">
                        <input id="dark-toggle"
                            class="w-5 h-5 appearance-none rounded-10 border-gray-200 bg-slate-800/10 bg-none cursor-pointer bg-contain bg-left bg-no-repeat align-top transition-all duration-250 ease-in-out opacity-0 absolute"
                            type="checkbox" />
                        <i class="ph ph-sun block text-white dark:hidden"></i>
                        <i class="ph ph-moon-stars hidden dark:block"></i>
                    </label>
                </li> -->



                <!-- notifications -->

                <!-- <li class="relative flex items-center pr-2">
                    <p class="hidden transform-dropdown-show"></p>
                    <a href="javascript:;" class="ease-nav-brand block p-0 text-sm text-white transition-all"
                        dropdown-trigger aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>

                    <ul dropdown-menu
                        class="before:ease pointer-events-none absolute right-0 top-0 z-50 min-w-44 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-sm text-slate-500 opacity-0 transition-all duration-250 transform-dropdown before:absolute before:left-auto before:right-2 before:top-0 before:z-50 before:inline-block before:font-awesome before:text-5.5 before:font-normal before:leading-default before:text-white before:antialiased before:transition-all before:duration-350 before:content-['\f0d8'] dark:bg-slate-850 dark:shadow-dark-xl sm:-mr-6 before:sm:right-8 lg:absolute lg:left-auto lg:right-0 lg:mt-2 lg:block lg:cursor-pointer lg:shadow-3xl">
                        <li class="relative mb-2">
                            <a class="ease clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 py-1.2 duration-300 hover:bg-gray-200 hover:text-slate-700 dark:hover:bg-slate-900 lg:transition-colors"
                                href="javascript:;">
                                <div class="flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/team-2.jpg"
                                            class="mr-4 inline-flex h-9 w-9 max-w-none items-center justify-center rounded-xl text-sm text-white" />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white">
                                            <span class="font-semibold">New message</span> from
                                            Laur
                                        </h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                                            <i class="fa fa-clock mr-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="relative mb-2">
                            <a class="ease clear-both block w-full whitespace-nowrap rounded-lg px-4 py-1.2 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700 dark:hover:bg-slate-900"
                                href="javascript:;">
                                <div class="flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/small-logos/logo-spotify.svg"
                                            class="mr-4 inline-flex h-9 w-9 max-w-none items-center justify-center rounded-xl bg-gradient-to-tl from-zinc-800 to-zinc-700 text-sm text-white dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850" />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white">
                                            <span class="font-semibold">New album</span> by
                                            Travis Scott
                                        </h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                                            <i class="fa fa-clock mr-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="relative">
                            <a class="ease clear-both block w-full whitespace-nowrap rounded-lg px-4 py-1.2 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700 dark:hover:bg-slate-900"
                                href="javascript:;">
                                <div class="flex py-1">
                                    <div
                                        class="ease-nav-brand my-auto mr-4 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tl from-slate-600 to-slate-300 text-sm text-white transition-all duration-200">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>crLaporan-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background"
                                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                opacity="0.593633743"></path>
                                                            <path class="color-background"
                                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white">
                                            Payment successfully completed
                                        </h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                                            <i class="fa fa-clock mr-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
