@extends($activeTemplate.'layouts.frontend')
@section('content')

<section class="login-form d-flex align-items-center">
    <div class="container">
       <div class="login-form-title text-center">
          <a href="{{route('home')}}">
          <figure class="login-page-logo">
             <img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="">
          </figure>
          </a>
          <h2>{{ __(@$login->data_values->title) }}</h2>
       </div>
          <div class="login-form-box">
             <div class="login-card">
                <form method="POST" action="{{ route('user.password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">@lang('Email or Username')</label>
                        <input type="text" class="form-control form--control" name="value" value="{{ old('value') }}" required autofocus="off">
                    </div>

                    <button type="submit"  class="btn btn-primary">@lang('Submit')</button>
                </form>
             </div>
                        
            @if ($general->registration)
             <div class="join-now-outer text-center">
                <a class="mb-0" href="{{ route('user.register') }}">Join now, create your FREE account</a>
             </div>
              @endif

          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>



{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="account-wrapper p-4">
                    <div class="mb-4">
                        <p>@lang('To recover your account please provide your email or username to find your account.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">@lang('Email or Username')</label>
                            <input type="text" class="form-control form--control" name="value" value="{{ old('value') }}" required autofocus="off">
                        </div>

                        <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}


{{-- @livewire('child.whats-app-popover') --}}

@endsection