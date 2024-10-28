@extends($activeTemplate . 'layouts.frontend')
@section('content')

<section class="login-form d-flex align-items-center">
    <div class="container">
       <div class="login-form-title text-center">
          <a href="{{route('home')}}">
          <figure class="login-page-logo">
             <img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="">
          </figure>
          </a>
          <h2>@lang('Verify Mobile Number')</h2>
       </div>
          <div class="login-form-box">
             <div class="login-card">
                <form class="submit-form" action="{{ route('user.verify.mobile') }}" method="POST">
                    @csrf
                    <p class="pt-3">@lang('A 6 digit verification code sent to your mobile number') : +{{ showMobileNumber(auth()->user()->mobile) }}</p>
                    @include($activeTemplate . 'partials.verification_code')
                    <div class="mb-3">
                        <button class="cmn-btn w-100" type="submit">@lang('Submit')</button>
                    </div>
                    <div class="form-group">
                        <p>
                            @lang('If you don\'t get any code'), <a class="forget-pass text--base" href="{{ route('user.send.verify.code', 'phone') }}"> @lang('Try again')</a>
                        </p>
                        @if ($errors->has('resend'))
                            <br />
                            <small  class="btn btn-primary">{{ $errors->first('resend') }}</small>
                        @endif
                    </div>
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

    {{-- <div class="pt-120 pb-120">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <div class="d-flex justify-content-center border-bottom flex-wrap pb-3 text-center">
                            <h5>@lang('Verify Mobile Number')</h5>
                        </div>
                        <form class="submit-form" action="{{ route('user.verify.mobile') }}" method="POST">
                            @csrf
                            <p class="pt-3">@lang('A 6 digit verification code sent to your mobile number') : +{{ showMobileNumber(auth()->user()->mobile) }}</p>
                            @include($activeTemplate . 'partials.verification_code')
                            <div class="mb-3">
                                <button class="cmn-btn w-100" type="submit">@lang('Submit')</button>
                            </div>
                            <div class="form-group">
                                <p>
                                    @lang('If you don\'t get any code'), <a class="forget-pass text--base" href="{{ route('user.send.verify.code', 'phone') }}"> @lang('Try again')</a>
                                </p>
                                @if ($errors->has('resend'))
                                    <br />
                                    <small class="text--danger">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- @livewire('child.whats-app-popover') --}}

@endsection
