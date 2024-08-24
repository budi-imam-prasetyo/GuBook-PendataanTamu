<nav class="md:px-auto w-full px-8 py-4">
    <div class="container mx-auto flex h-28 flex-wrap items-center justify-between md:h-16 md:flex-nowrap md:px-4">
        <div class="md:order-1">
            <img src="{{ asset('assets/logo.png') }}" class="h-10" alt="Logo GuBook Title" />
        </div>
        <div class="order-3 w-full md:order-2 md:w-auto">
            <ul class="flex justify-between font-semibold">
                <x-user.navbar-btn href="/">welcome</x-user.navbar-btn>
                <x-user.navbar-btn href="/list-pegawai">
                    pegawai
                </x-user.navbar-btn>
                <x-user.navbar-btn href="/tentang">tentang</x-user.navbar-btn>
            </ul>
        </div>
        <div class="order-2 md:order-3">
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->role == 'superadmin')
                        <a href="/admin"
                            class="ml-12 flex items-center gap-2 rounded-lg bg-lightBlue px-4 py-2 font-bold text-primaryBlue hover:bg-lightBlue2 hover:text-secondaryBlue">
                            Dashboard
                        </a>
                    @elseif (Auth::user()->role == 'pegawai')
                        <a href="/pegawai"
                            class="ml-12 flex items-center gap-2 rounded-lg bg-lightBlue px-4 py-2 font-bold text-primaryBlue hover:bg-lightBlue2 hover:text-secondaryBlue">
                            Dashboard
                        </a>
                    @elseif (Auth::user()->role == 'FO')
                        <a href="/FO"
                            class="ml-12 flex items-center gap-2 rounded-lg bg-lightBlue px-4 py-2 font-bold text-primaryBlue hover:bg-lightBlue2 hover:text-secondaryBlue">
                            Dashboard
                        </a>
                    @endif
                @else
                    <button
                        class="ml-12 flex items-center gap-2 rounded-lg bg-lightBlue px-4 py-2 font-bold text-primaryBlue hover:bg-lightBlue2 hover:text-secondaryBlue"
                        onclick="my_modal_1.showModal()">Login</button>
                    <dialog id="my_modal_1" class="modal">
                        <div class="modal-box p-2 overflow-visible">
                            <div class="border-3 border-primaryBlue rounded-xl relative p-3">
                                <img src="{{ asset('assets/modal-vector.png') }}" class="w-85 absolute -top-30 left-1/2 transform -translate-x-1/2" alt="">
                                <div class="mt-30">
                                    <p class=" text-center text-xl text-dark text-wrap">Khusus <span class="font-bold">Pegawai</span>, Apakah anda <br/> yakin ingin masuk?</p>
                                    <div class="flex my-4 justify-evenly">
                                        <form method="dialog">
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button class="btn btn-primary bg-primaryBlue hover:bg-secondaryBlue text-light rounded-full h-10 w-25">Tidak</button>
                                        </form>
                                        <a href="{{ route('login') }}"
                                            class="btn btn-primary bg-primaryBlue hover:bg-secondaryBlue text-light rounded-full h-10 w-25">
                                            Ya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dialog>
                @endauth
            @endif
        </div>
    </div>
</nav>
