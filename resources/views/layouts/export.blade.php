<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href="{{ mix('css/apps.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">


  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>

  {{-- @include('parts.customer.head') --}}


</head>

<body>
  <div class="font-sans text-slate-800 antialiased">
    {{ $slot }}
  </div>
  @include('parts.customer.script')
  @stack('js')

</body>

</html>
