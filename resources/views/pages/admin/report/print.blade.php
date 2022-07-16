<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Styles -->
  {{-- <link rel="stylesheet" type="text/css" href="/css/app.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="/css/style.css"> --}}
  <link href="{{ public_path('css/app.css') }}" type="text/css" media="all" rel="stylesheet">
  {{-- <link href="{{ public_path('css/style.css') }}"type="text/css" rel="stylesheet"> --}}


  <!-- Scripts -->
  {{-- <script src="/js/app.js" defer></script> --}}
  <script src="{{ public_path('js/app.js') }}" defer></script>
  {{-- <link href="{{ public_path('js/app.js') }}" rel="stylesheet"> --}}



</head>

<body>
  <span class='bold text-center capitalize'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit quas qui
    necessitatibus, ad culpa
    enim cupiditate
    consequatur, recusandae nesciunt est et inventore ab quia error, quidem ratione. Minima, doloribus voluptatum?
  </span>

</body>

</html>
