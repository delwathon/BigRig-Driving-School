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
          <h5 class="pb-3 text-center border-bottom">@lang('Verify Email')</h5>

       </div>
          <div class="login-form-box">
             <div class="login-card">
                <form class="submit-form row gy-3" action="{{ route('user.verify.email') }}" method="POST">
                    @csrf
                    <p class="pt-3">@lang('A 6 digit verification code sent to your email address'): {{ showEmailAddress(auth()->user()->email) }}</p>

                    @include($activeTemplate . 'partials.verification_code')

                    <div class="col-12">
                        <button class="cmn-btn w-100" type="submit">@lang('Submit')</button>
                    </div>

                    <div class="mb-3">
                        <p>
                            @lang('If you don\'t get any code'), <a class="text--base" href="{{ route('user.send.verify.code', 'email') }}"> @lang('Try again')</a>
                        </p>

                        @if ($errors->has('resend'))
                            <small  class="btn btn-primary">{{ $errors->first('resend') }}</small>
                        @endif
                    </div>
                </form>
             </div>
                        
         

          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>

    {{-- <section class="pt-120 pb-120">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <div class="d-flex justify-content-center border-bottom flex-wrap pb-3 text-center">
                            <h5>@lang('Verify Email')</h5>
                        </div>
                        <form class="submit-form row gy-3" action="{{ route('user.verify.email') }}" method="POST">
                            @csrf
                            <p class="pt-3">@lang('A 6 digit verification code sent to your email address'): {{ showEmailAddress(auth()->user()->email) }}</p>

                            @include($activeTemplate . 'partials.verification_code')

                            <div class="col-12">
                                <button class="cmn-btn w-100" type="submit">@lang('Submit')</button>
                            </div>

                            <div class="mb-3">
                                <p>
                                    @lang('If you don\'t get any code'), <a class="text--base" href="{{ route('user.send.verify.code', 'email') }}"> @lang('Try again')</a>
                                </p>

                                @if ($errors->has('resend'))
                                    <small class="text--danger d-block">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- @livewire('child.whats-app-popover') --}}

@endsection
