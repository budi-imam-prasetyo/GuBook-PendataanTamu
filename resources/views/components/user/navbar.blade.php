@props(['$title'])
<nav class= "px-8 py-4 md:px-auto w-full">
    <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
        <div class="md:order-1">
            <img src="{{ asset('assets/logo.png') }}" class="h-10" alt="Logo GuBook Title">
        </div>
        <div class="order-3 w-full md:w-auto md:order-2">
            <ul class="flex font-semibold justify-between">
                <x-user.navbar-btn>welcome</x-user.navbar-btn>
                <x-user.navbar-btn>Pegawai</x-user.navbar-btn>
                <x-user.navbar-btn>Tentang</x-user.navbar-btn>
            </ul>
        </div>
        <div class="order-2 md:order-3">
            <button
                class="ml-12 px-4 py-2 bg-lightBlue hover:bg-lightBlue2 text-primaryBlue hover:text-secondaryBlue font-bold rounded-lg flex items-center gap-2">
                Login
            </button>
        </div>
    </div>
</nav>