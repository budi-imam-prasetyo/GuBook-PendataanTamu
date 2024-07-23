<nav class="relative mx-6 flex flex-wrap items-center justify-between rounded-2xl px-0 py-2 shadow-none transition-all duration-250 ease-in lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="false">
    <div class="mx-auto flex w-full items-center justify-between pl-4 pr-2 py-1 flex-wrap-inherit">
        <nav>
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
            <li class="flex items-center">
                <a href=""
                    class="ease-nav-brand px-0 py-2 text-lg flex gap-2 font-semibold text-white transition-all">
                    <img src="{{ asset('assets/icons/user.svg') }}" class="h-5" alt="">
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
            </ul>
        </div>
    </div>
</nav>
