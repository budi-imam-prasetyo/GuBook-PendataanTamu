<!-- resources/views/components/admin/sidebar-btn.blade.php -->
@props(['href', 'src'])

<li class="mt-0.5 w-full">
    <a href="{{ $href }}" class="{{ request()->is(ltrim($href, '/')) ? 'rounded-lg bg-secondaryRed/13 font-semibold text-slate-700' : 'ease' }} hover:bg-primaryRed/5 rounded-lg mx-2 my-0 flex items-center whitespace-nowrap px-4 py-2.7 text-base transition-colors">
        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <img src="{{ $src }}" class="relative top-0 text-xl h-5"></img>
        </div>
        <span class="capitalize ease pointer-events-none ml-1 opacity-100 duration-300">{{ $slot }}</span>
    </a>
</li>
