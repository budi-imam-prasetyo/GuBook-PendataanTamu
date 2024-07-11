<li class="mt-0.5 w-full">
    <a class="{{ request()->is($slot) ? 'rounded-lg bg-secondaryBlue/13 font-semibold text-slate-700' : 'ease' }} hover:bg-primaryBlue/5 rounded-lg mx-2 my-0 flex items-center whitespace-nowrap px-4 py-2.7 text-base transition-colors" {{ $attributes }}>
        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
        <img {{ $attributes }} class="relative top-0 text-xl h-5"></img>

        </div>
        <span class="capitalize ease pointer-events-none ml-1 opacity-100 duration-300">{{ $slot }}</span>
    </a>
</li>
