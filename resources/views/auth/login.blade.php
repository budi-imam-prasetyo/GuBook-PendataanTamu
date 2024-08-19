@extends('layouts.app')

@section('content')
    <div class="grid h-screen grid-cols-2">
        {{-- <div class="relative bg-no-repeat bg-cover h-screen" style="background-image: url({{ asset('assets/bg-login2.svg') }});"> --}}
        <div class="relative flex justify-start bg-primaryBlue xl:bg-transparent">
            <img src="{{ asset('assets/bg-login2.svg') }}" class="absolute hidden h-screen w-full object-cover xl:block"
                alt="" />
            <img src="{{ asset('assets/logo3.png') }}" class="absolute left-8 top-8 w-50" alt="gubook" />
            <img src="{{ asset('assets/icons/star.svg') }}" class="absolute left-10 top-64" alt="star" />
            <img src="{{ asset('assets/icons/star.svg') }}" class="absolute right-1/4 top-20" alt="star" />
            <img src="{{ asset('assets/icons/star.svg') }}" class="absolute bottom-40 right-15/100" alt="star" />
            <div
                class="absolute left-1/2 top-1/2 flex -translate-x-1/2 -translate-y-1/2 transform items-center justify-center lg:-translate-x-2/3">
                <img src="{{ asset('assets/guest.svg') }}" class="w-full max-w-sm md:max-w-lg lg:max-w-xl" alt="" />
            </div>
            <div class="absolute bottom-0">
                <img src="{{ asset('assets/wave.svg') }}"
                    class="hidden -translate-x-0 object-cover mix-blend-lighten md:block" alt="" />
            </div>
        </div>
        <div class="flex justify-start">
            <div class="w-full max-w-2xl">
                <div class="mb-4 flex flex-col px-8 pb-8 pt-6">
                    <div class="">
                        <div class="mb-1 flex items-center gap-4 text-4xl font-bold text-darkGray">
                            <a href="/">
                                <img src="{{ asset('assets/icons/arrow.svg') }}" class="h-5" alt="" />
                            </a>
                            {{ __('Sign In') }}
                        </div>
                        <div class="ml-10 text-darkGray">
                            {{ __('Welcome to GuBook') }}
                        </div>
                    </div>

                    <div class="m-10 mt-80 flex h-full flex-col">
                        <form method="POST" action="{{ route('login') }}"
                            class="mx-auto flex w-full max-w-full flex-col gap-10">
                            @csrf

                            <div class="mb-4 w-full items-center">
                                <div class="relative">
                                    <input autocomplete="off" id="email" name="email" type="text"
                                        class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:border-dark focus:outline-none focus:placeholder:text-grey"
                                        placeholder="Masukan Email" />
                                    <label for="email"
                                        class="peer-placeholder-shown:text-gray-440 absolute -top-3.5 left-0 text-base text-gray-600 transition-all peer-placeholder-shown:top-2 peer-focus:-top-4 peer-focus:text-base peer-focus:font-bold peer-focus:text-gray-600">
                                        {{ __('Email Address') }}
                                    </label>
                                    {{--
                                        <script>
                                        document.getElementById('email').addEventListener('focus', function() {
                                        document.querySelector('label[for="email"]').textContent = 'Masukan Email';
                                        });
                                        document.getElementById('email').addEventListener('blur', function() {
                                        document.querySelector('label[for="email"]').textContent = 'Email Address';
                                        });
                                        </script>
                                    --}}
                                </div>
                                @error('email')
                                    <p class="mt-2 text-xs italic text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-4 w-full" x-data="{ show: true }">
                                <div class="relative">
                                    <input autocomplete="off" id="password" name="password"
                                        :type="show ? 'password' : 'text'"
                                        class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:border-dark focus:outline-none focus:placeholder:text-grey"
                                        placeholder="Masukan Password" />
                                    <label for="password"
                                        class="peer-placeholder-shown:text-gray-440 absolute -top-3.5 left-0 text-base text-gray-600 transition-all peer-placeholder-shown:top-2 peer-focus:-top-4 peer-focus:text-base peer-focus:font-bold peer-focus:text-gray-600">
                                        Password
                                    </label>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 text-sm leading-5">
                                        <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                            :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                            </path>
                                        </svg>

                                        <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                            :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 640 512">
                                            <path fill="currentColor"
                                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-xs italic text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-0 flex justify-end">
                                <div class="flex w-2/3 items-center justify-end">
                                    <button type="submit"
                                        class="focus:shadow-outline rounded-full bg-primaryBlue px-10 py-2 text-sm font-semibold text-white hover:bg-secondaryBlue focus:outline-none">
                                        {{ __('Sign In') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
@endsection
