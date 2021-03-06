<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    @include('parts.customer.head')


    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen  ">

        @include('parts.customer.navbar')

        <!-- Page Content -->
        <main class=' min-h-[100vh]'>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @include('parts.customer.footer')

    <section class="script-sections">
        @include('parts.customer.script')
        @livewireScripts
        @stack('js')

       

    </section>
</body>

</html>
