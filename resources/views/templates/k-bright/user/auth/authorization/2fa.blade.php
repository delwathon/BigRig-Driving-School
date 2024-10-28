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
          <h5 class="pb-3 text-center border-bottom">@lang('2FA Verification')</h5>

       </div>
          <div class="login-form-box">
             <div class="login-card">
                <form class="submit-form" action="{{ route('user.go2fa.verify') }}" method="POST">
                    @csrf

                    <div class="mt-3">
                        @include($activeTemplate . 'partials.verification_code')
                    </div>

                    <div class="form--group">
                        <button  class="btn btn-primary" type="submit">@lang('Submit')</button>
                    </div>
                </form>
             </div>
                        
         

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
                    <h5 class="border-bottom pb-3 text-center">@lang('2FA Verification')</h5>
                    <form class="submit-form" action="{{ route('user.go2fa.verify') }}" method="POST">
                        @csrf

                        <div class="mt-3">
                            @include($activeTemplate . 'partials.verification_code')
                        </div>

                        <div class="form--group">
                            <button class="cmn-btn w-100" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- @livewire('child.whats-app-popover') --}}

@endsection