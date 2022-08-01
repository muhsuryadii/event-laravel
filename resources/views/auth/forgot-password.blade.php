<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>

        <div class="center pb-[2rem]">
            <img src=" {{ asset('image/logo_usni.png') }}" alt="logo"
                class="block mx-auto w-1/4 h-1/4  md:h-1/3 md:w-1/1">
            <h2 class="text-center font-bold  text-lg pt-4 uppercase">Lupa Kata Sandi</h2>
        </div>


        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4 text-sm text-gray-800">
                {{ __('Pastikan Email Anda Terdaftar di Sistem. Dengan Melakukan Reset Kata Sandi Maka Sistem Akan Mengirimkan Email Berisi Informasi Perubahan Kata Sandi.') }}
            </div>

            <div class="flex items-center justify-center flex-wrap flex-col mt-5 w-full">
                <x-jet-button class="ml-4  w-fit py-3 px-4 mx-0">
                    {{ __('Ubah Kata Sandi') }}
                </x-jet-button>
            </div>

            <div class="flex items-center justify-end mt-1">
                    <a class="flex items-center justify-center flex-wrap flex-col mt-2 w-full" href="{{ route('login') }}">
                        {{ __('Kembali ke Halaman Login') }}
                    </a>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
