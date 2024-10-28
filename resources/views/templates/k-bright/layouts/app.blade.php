<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->siteName(__(@$pageTitle)) }}</title>

    @include('partials.seo')

    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/line-awesome.min.css') }}" rel="stylesheet" />
    <!-- fontawesome 6.4.2 -->
    <!-- swiper Css 10.2.0 -->

    <link href="{{ asset($activeTemplateTrue . 'bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/style.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/special-classes.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link
        href="{{ asset($activeTemplateTrue . 'css/color.php?primary=' . $general->base_color . '&secondary=' . $general->secondary_color) }}"
        rel="stylesheet">
    <style>
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader-letter {
            font-size: 24px;
            /* Adjust font size as needed */
            margin-right: 5px;
            /* Adjust margin as needed */
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* You can add more animation styles or effects to the loader letters as needed */
    </style>
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

    
    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp

    @if ($cookie->data_values->status == App\Constants\Status::ENABLE && !\Cookie::get('gdpr_cookie'))
        <div class="cookies-card hide text-center">
            <div class="cookies-card__icon bg--base">
                <i class="las la-cookie-bite"></i>
            </div>
            <p class="cookies-card__content mt-4">{{ $cookie->data_values->short_desc }} <a class="text--base"
                    href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
            <div class="cookies-card__btn mt-4">
                <a class="cmn-btn w-100 policy text-white btn btn-info" href="javascript:void(0)">@lang('Allow')</a>
            </div>
        </div>
    @endif


    {{-- <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div> --}}

    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script> --}}



    <!-- scripts -->
    <script src="{{ asset($activeTemplateTrue . '/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/video_link.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/video.js') }}"></script>

    <!-- gsap plugins -->
    <script src="{{ asset($activeTemplateTrue . '/js/counter.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/custom.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/animation_links.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/animation.js') }}"></script>

    <!-- main Js -->
    @livewireScripts
    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')
    
    <script>
      



        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });


        })(jQuery);
    </script>

</body>

</html>
