@extends($activeTemplate . 'layouts.app')
@section('app')
@php
$banned = getContent('banned.content',true);
@endphp



<section class="login-form d-flex align-items-center">
    <div class="container">
       <div class="login-form-title text-center">
          <a href="{{route('home')}}">
          <figure class="login-page-logo">
             <img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="">
          </figure>
          </a>
          <div class="col-xl-10">
            <h3 class="text--danger mb-2">{{ __(@$banned->data_values->heading) }}</h3>
        </div>
       

       </div>
          <div class="login-form-box">
             <div class="login-card">
                {{-- <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form row gap-2">
                    @csrf

                    
                    <p class="pt-3">@lang('A 6 digit verification code sent to your email address') :  {{ showEmailAddress($email) }}</p>
                    <input type="hidden" name="email" value="{{ $email }}">

                    @include($activeTemplate.'partials.verification_code')

                    <div class="form-group">
                        <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                    </div>

                    <div>
                        @lang('Please check including your Junk/Spam Folder. if not found, you can')
                        <a href="{{ route('user.password.request') }}" class="text--base">@lang('Try to send again')</a>
                    </div>

                </form> --}}

                <div class="col-sm-6 col-8 col-lg-12">
                    <img src="{{ getImage('assets/images/frontend/banned/' . @$banned->data_values->image, '360x370') }}" alt="@lang('image')" class="img-fluid mx-auto mb-5">
                </div>
                <p class="text-center mx-auto mb-4">{{ __($user->ban_reason) }} </p>
                <a href="{{ route('home') }}"  class="btn btn-primary"> @lang('Go to Home') </a>
             </div>
                        
         

          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>

{{-- <div class="maintenance-page flex-column justify-content-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 text-center">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <h3 class="text--danger mb-2">{{ __(@$banned->data_values->heading) }}</h3>
                    </div>
                    <div class="col-sm-6 col-8 col-lg-12">
                        <img src="{{ getImage('assets/images/frontend/banned/' . @$banned->data_values->image, '360x370') }}" alt="@lang('image')" class="img-fluid mx-auto mb-5">
                    </div>
                </div>
                <p class="text-center mx-auto mb-4">{{ __($user->ban_reason) }} </p>
                <a href="{{ route('home') }}" class="cmn-btn"> @lang('Go to Home') </a>
            </div>
        </div>
    </div>
</div> --}}
{{-- @livewire('child.whats-app-popover') --}}

@endsection