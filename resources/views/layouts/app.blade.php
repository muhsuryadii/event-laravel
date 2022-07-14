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


  @livewireStyles
  @include('parts.admin.head')


  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>

  {{-- Template --}}
</head>

<body class="g-sidenav-show bg-gray-100">
  <x-jet-banner />

  <div class="min-height-300 bg-primary position-absolute w-full"></div>
  {{-- Sidebar Template --}}
  @include('parts.admin.sidebar')


  <!-- Page Content -->
  <main class="main-content position-relative border-radius-lg min-h-[100vh]">
    @include('parts.admin.navbar')
    <div class="content mx-4 px-3">
      {{ $slot }}
    </div>
  </main>

  @stack('modals')

  <section class="script-sections">
    @include('parts.admin.script')
    @livewireScripts
    @stack('js')
  </section>
</body>

</html>
