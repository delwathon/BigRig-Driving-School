@extends($activeTemplate.'layouts.app')
@section('app')
    @include($activeTemplate.'partials.header')

        @if (!request()->routeIs('home'))
            @include($activeTemplate.'partials.breadcrumb')
        @endif

        @yield('content')

        @livewire('child.whats-app-popover')

    @include($activeTemplate.'partials.footer')
@endsection