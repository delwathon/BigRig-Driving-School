@php
$pages = App\Models\Page::where('tempname',$activeTemplate)->where('is_default',App\Constants\Status::NO)->get();
$socialIcon  = getContent('social_icon.element', false, null, true);

@endphp
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 sol-sm-12">
                <div class="email">
                    <figure class="mb-0 emailicon">
                        <img src="{{asset($activeTemplateTrue . 'images/header-emailicon.png')}}" alt="" class="img-fluid">
                    </figure>
                    <a href="mailto:{{$general->email_from }}" class="mb-0 text-size-16 text-white">{{$general->email_from }}</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 sol-sm-12 d-md-block d-none">
                <div class="mb-0 social-icons">
                    <ul class="mb-0 list-unstyled">

                        <li>Follow us on:</li>
                        @foreach ($socialIcon as $social)
                        <li>
                            <a href="{{ @$social->data_values->url }}"> {!!$social->data_values->social_icon!!} </a>
                        </li>
                        @endforeach
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<header class="header">
    <div class="container">
        <nav class="navbar position-relative navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{route('home')}}"><figure class="mb-0"><img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="" class="img-fluid"></figure></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li  class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a  class="nav-link"href="{{ route('home') }}">@lang('Home')</a></li>
                    @foreach ($pages as $k => $data)
                    <li class="nav-item {{ request()->routeIs(route('pages', [$data->slug])) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
                    @endforeach
                    <li  class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a></li>

                    @auth
                    <li class="nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('user.home') }}"><i class="las la-tachometer-alt"></i> @lang('Dashboard')</a>
                    </li>
                    <li class="nav-item" >
                         <a class="nav-link" href="{{ route('user.logout') }}"><i class="las la-sign-out-alt"></i> @lang('Logout')
                    </a>
                    </li>
                   
                    @else
                    <li class="nav-item {{ request()->routeIs('user.login') ? 'active' : '' }}">
                         <a  class="nav-link sign" href="{{ route('user.login') }}"><i class="las la-sign-in-alt"></i> @lang('Login')
                            </a>
                    </li>

                   
                    @if ($general->registration)
                    <li class="nav-item">
                         <a  class="nav-link signup {{ request()->routeIs('user.register') ? 'active' : '' }}" href="{{ route('user.register') }}"><i class="las la-user-plus"></i> @lang('Registration')</a>

                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>



@push('style')
<style>
    .nav-right .langSel {
        padding: 7px 20px;
        height: 37px;
    }
</style>
@endpush
