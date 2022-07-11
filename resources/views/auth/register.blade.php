<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="center pb-6  pt-5">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-3" href="/">
                    {{-- <i class="fa-solid fa-arrow-left-long"></i> --}}
                    {{ __('Kembali') }}
                </a>
                <img src=" {{ asset('image/logo_usni.png') }}" alt="logo"
                    class="block mx-auto w-1/4 h-1/4 md:h-1/3 md:w-1/3">
                <h2 class="text-center font-bold  text-2xl pt-4 uppercase">Register</h2>
            </div>

            <div>
                <x-jet-label for="nama" value="{{ __('Nama') }}" />
                <x-jet-input id="nama" class="form-control block mt-1 w-full " type="text" name="nama"
                    :value="old('nama')" required autofocus autocomplete="nama" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="form-control block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <div class="input-password-wrapper flex">

                    <x-jet-input id="password" class="block mt-1 w-full mr-3" type="password" name="password"
                        required />
                    <button type="button" id="btn-show-password"
                        class='px-3 py-2 border border-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-500
                         hover:bg-slate-200 active:bg-slate-500
                        rounded-md shadow-sm transition duration-300 ease-in-out '>
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <div class="input-password-wrapper flex">

                    <x-jet-input id="password_confirmation" class="block mt-1 w-full mr-3" type="password"
                        name="password_confirmation" required />
                    <button type="button" id="btn-show-confirm-password"
                        class='px-3 py-2 border border-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                        hover:bg-slate-200 active:bg-slate-500
                        rounded-md shadow-sm transition duration-300 ease-in-out '>
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

            </div>



            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

    @push('js')
        <script>
            const showPassword = (id, buttonId) => {
                const input = document.getElementById(id);
                const btn = document.getElementById(buttonId);
                const icon = btn.querySelector(`#${buttonId} i`);
                const type = input.getAttribute('type');

                if (type === 'password') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    input.setAttribute('type', 'text');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    input.setAttribute('type', 'password');
                }
            };

            const btnPassword = document.querySelector('#btn-show-password');
            const btnConfirmPassword = document.querySelector('#btn-show-confirm-password');
            btnPassword.addEventListener('click', () => {
                showPassword('password', 'btn-show-password');
            });
            btnConfirmPassword.addEventListener('click', () => {
                showPassword('password_confirmation', 'btn-show-confirm-password');
            });
        </script>
    @endpush
</x-guest-layout>
