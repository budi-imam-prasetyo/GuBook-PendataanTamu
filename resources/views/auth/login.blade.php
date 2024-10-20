@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-primaryBlue md:bg-transparent relative overflow-hidden">
    <!-- SVG Waves Background -->
    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position: absolute; bottom: 0; left: 0; width: 100%; height: auto; z-index: -1;">
        <path fill="#0099ff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,170.7C384,181,480,171,576,144C672,117,768,75,864,64C960,53,1056,75,1152,96C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg> --}}

    <!-- Decorative Circles -->
    <div class="absolute top-0 left-0 w-32 h-32 bg-blue-300 rounded-full opacity-50 transform -translate-x-16 -translate-y-16 md:hidden"></div>
    <div class="absolute top-1/4 right-0 w-24 h-24 bg-blue-300 rounded-full opacity-50 transform translate-x-12 md:hidden"></div>

    <!-- Left side (Image and logo) -->
    <div class="relative w-full md:w-1/2 flex-grow md:bg-primaryBlue lg:bg-transparent flex items-center justify-center p-8 pb-4 lg:p-0">
        <img src="{{ asset('assets/bg-login2.svg') }}" class="hidden lg:block lg:absolute lg:inset-0 lg:w-full lg:h-full lg:object-cover" alt="Background" />
        <img src="{{ asset('assets/logo3.png') }}" class="absolute top-6 left-6 w-32 lg:w-40 z-100" alt="GuBook Logo" />

        <div class="relative text-center md:mt-0 mt-8">
            <img src="{{ asset('assets/guest.svg') }}" class="w-1/3 md:w-4/5 mx-auto" alt="Guest Illustration" />
        </div>
    </div>

    <!-- Right side (Login form) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 pt-4 lg:p-16 z-100">
        <div class="w-full max-w-md">
            <div class="text-center lg:text-left mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-light  items-center  md:text-darkGray mb-2">
                    {{-- <a href="/">
                                <img src="{{ asset('assets/icons/arrow.svg') }}" class="h-5" alt="" />
                            </a> --}}
                            {{ __('Sign In') }}</h1>
                <p class="text-light md:text-darkGray">{{ __('Welcome to GuBook') }}</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2 z-10">
                    <label for="email" class="block text-sm font-medium md:text-gray-700 text-light">
                        {{ __('Email Address') }}
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primaryBlue focus:border-primaryBlue sm:text-sm"
                        placeholder="{{ __('Enter your email') }}" />
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium md:text-gray-700 text-light">
                        {{ __('Password') }}
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primaryBlue focus:border-primaryBlue sm:text-sm"
                            placeholder="{{ __('Enter your password') }}" />
                        <button type="button" onclick="togglePasswordVisibility()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                            <svg class="h-5 w-5 text-gray-400" fill="none" id="eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor"
                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:flex justify-end">
                    <button type="submit"
                        class="w-full md:w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-secondaryBlue md:bg-primaryBlue md:hover:bg-secondaryBlue focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primaryBlue">
                        {{ __('Sign In') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path fill="currentColor"
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
            </path>
        `;
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path fill="currentColor"
                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
            </path>
        `;
    }
}
</script>
@endsection