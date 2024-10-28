<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->siteName(__(@$pageTitle)) }}</title>

    @include('partials.seo')

   

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  
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

    
  


  
      



  
    
    <link href="{{ mix('css/js.css') }}" rel="stylesheet">


</body>

</html>
