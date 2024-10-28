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
          <h5 class="pb-3 text-center border-bottom">@lang('Verify Email Address')</h5>

       </div>
          <div class="login-form-box">
             <div class="login-card">
                <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form row gap-2">
                    @csrf

                    
                    <p class="pt-3">@lang('A 6 digit verification code sent to your email address') :  {{ showEmailAddress($email) }}</p>
                    <input type="hidden" name="email" value="{{ $email }}">

                    @include($activeTemplate.'partials.verification_code')

                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary">@lang('Submit')</button>
                    </div>

                    <div>
                        @lang('Please check including your Junk/Spam Folder. if not found, you can')
                        <a href="{{ route('user.password.request') }}" class="text--base">@lang('Try to send again')</a>
                    </div>

                </form>
             </div>
                        
         

          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>

{{-- @livewire('child.whats-app-popover') --}}

@endsection
