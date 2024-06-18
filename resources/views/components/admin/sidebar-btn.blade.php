<li class="mt-0.5 w-full">
    <a class="{{ request()->is($slot) ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'ease' }} mx-2 my-0 flex items-center whitespace-nowrap px-4 py-2.7 text-base transition-colors dark:text-white dark:opacity-80"
        href="{{ $slot }}">
        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
        <i {{ $attributes }} class=" relative top-0 text-xl"></i>

        </div>
        <span class="capitalize ease pointer-events-none ml-1 opacity-100 duration-300">{{ $slot }}</span>
    </a>
</li>
