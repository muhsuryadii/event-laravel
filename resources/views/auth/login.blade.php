<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" class='p-4' action="{{ route('login') }}">
            @csrf
            <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-3" href="/">
                <i class="fa-solid fa-arrow-left-long"></i>
                {{ __('Kembali') }}
            </a>


            <div class="center pb-[2rem]">
                <img src=" {{ asset('image/logo_usni.png') }}" alt="logo"
                    class="block mx-auto w-1/4 h-1/4  md:h-1/3 md:w-1/3">
                <h2 class="text-center font-bold  text-2xl pt-4 uppercase">Login</h2>
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="flex justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-center flex-wrap flex-col mt-5 w-full">
                <x-jet-button class="ml-4  w-fit py-3 px-4 mx-0">
                    {{ __('Log in') }}
                </x-jet-button>
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-3"
                        href="{{ route('register') }}">
                        {{ __('Belum punya akun ?') }}
                    </a>
                @endif

            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
