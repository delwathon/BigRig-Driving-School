<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->siteName(__(@$pageTitle)) }}</title>

    @include('partials.seo')

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
    {{-- @vite('resources/css/app.css') --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

  
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }

        .swal2-cancel,
        .swal2-confirm {
            margin: 10px;
        }
    </style>
    @stack('style-lib')
    @stack('style')
</head>

<body>
    @stack('fbComment')

    @yield('app')

    
  


  
      



  
    
    {{-- <link href="{{ mix('css/js.css') }}" rel="stylesheet"> --}}
    {{-- @vite('resources/js/app.js') --}}

</body>

</html>
