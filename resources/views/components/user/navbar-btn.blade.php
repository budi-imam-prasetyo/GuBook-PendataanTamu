<a {{ $attributes }}>
    <li
        class="{{ request()->is($slot) ? 'border-b-2 border-lightBlue2' : 'ease' }} capitalize hover:border-b-2 hover:border-lightBlue2 hover:text-lightBlue2 md:px-4 md:py-2 hover:md:py-2">
        {{ $slot }}
    </li>
</a>
