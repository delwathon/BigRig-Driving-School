@extends($activeTemplate.'layouts.app')
@section('app')
@php
$login = getContent('login.content',true);
@endphp



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
                <form  method="POST" action="{{ route('user.login')}}">
                  @csrf
                   <div class="form-group">
                     <label for="exampleInputEmail1">@lang('Username or Email')</label>
                     <input class="input-field form-control"  value="{{ old('username') }}" name="username"   placeholder="e.g. elon@tesla.com">
                   </div>
                   <div class="form-group">
                     <label for="exampleInputPassword1">@lang('Password')</label>
                     <input  class="input-field form-control" type="password"  name="password"  placeholder="Password">
                   </div>
                   <button type="submit" class="btn btn-primary">@lang('Login Now')</button>
                   <div>
                      <label class="mb-0" style="cursor: pointer;">
                      <input class="checkbox" type="checkbox" name="userRememberMe">
                      Remember me
                      </label>
                      <a href="{{ route('user.password.request') }}" class="forgot-password float-right">@lang('Forget password?')</a>
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


@livewire('child.whats-app-popover')


@endsection
