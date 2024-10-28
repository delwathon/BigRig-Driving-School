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
                <form method="POST" action="{{ route('user.password.update') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label class="form-label">@lang('Password')</label>
                        <input type="password" class="form-control form--control" name="password" required>
                        @if($general->secure_password)
                        <div class="input-popup">
                            <p class="error lower">@lang('1 small letter minimum')</p>
                            <p class="error capital">@lang('1 capital letter minimum')</p>
                            <p class="error number">@lang('1 number minimum')</p>
                            <p class="error special">@lang('1 special character minimum')</p>
                            <p class="error minimum">@lang('6 character password')</p>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Confirm Password')</label>
                        <input type="password" class="form-control form--control" name="password_confirmation" required>
                    </div>
                    <button type="submit"  class="btn btn-primary"> @lang('Submit')</button>
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

@if($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
