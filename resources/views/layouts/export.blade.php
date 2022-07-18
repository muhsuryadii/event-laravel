<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ mix('css/print.css') }}">


  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>

  {{-- @include('parts.customer.head') --}}

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Nucleo Icons -->
  <link href={{ asset('argon/css/nucleo-icons.css') }} rel="stylesheet" />
  <link href={{ asset('argon/css/nucleo-svg.css') }} rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href={{ asset('argon/css/nucleo-svg.css') }} rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CSS Files -->
  <link id="pagestyle" type="text/css" href={{ asset('argon/css/argon-dashboard.css?v=2.0.2') }} rel="stylesheet" />

</head>

<body>
  <div class="font-sans text-slate-800 antialiased">
    {{ $slot }}
  </div>
  @include('parts.customer.script')

</body>

</html>
