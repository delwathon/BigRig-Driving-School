@extends($activeTemplate . 'layouts.app')
@section('app')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $register = getContent('register.content', true);
    @endphp


<section class="login-form sign-up-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
            <a href="{{route('home')}}">
            <figure class="login-page-logo" >
                <img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="">
            </figure>
            </a>
            <h2>{{ __(@$register->data_values->title) }}</h2>
        </div>
        <div class="login-form-box">
            <div class="login-card">
                <form class="verify-gcaptcha mt-4" action="{{ route('user.register') }}" method="POST">
                    @csrf

                    
                <div class="form-group">
                    <label for="exampleInputName1">Username</label>
                    <input  class="input-field form-control checkUser" minlength="6" id="username" name="username" type="text" value="{{ old('username') }}" placeholder="e.g. koadit">
                </div>


                
                <div class="form-group">
                    <label for="exampleInputEmail1">Your E-mail</label>
                    <input  class="input-field form-control  checkUser" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="e.g. admin@dolphinsub.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Enter your password <small>min. 6 characters</small></label>
                    <input  class="input-field form-control"  id="password" name="password" type="password"  placeholder="Password">
                
                
                
                </div>
                @if ($general->secure_password)
                <div class="input-popup">
                    <p class="error lower">@lang('1 small letter minimum')</p>
                    <p class="error capital">@lang('1 capital letter minimum')</p>
                    <p class="error number">@lang('1 number minimum')</p>
                    <p class="error special">@lang('1 special character minimum')</p>
                    <p class="error minimum">@lang('6 character password')</p>
                </div>
            @endif

                <div class="form-group">
                    <label for="exampleInputPassword1">Confirmed Password</label>
                    <input  class="input-field form-control"  id="password-confirm" name="password_confirmation" type="password"  placeholder="Password">
                </div>
                

                @if ($general->agree)
                <div class="form-group d-flex align-items-start">
                    <input class="checkbox" name="agree" type="checkbox" @checked(old('agree')) required>
                    <div class="d-flex flex-wrap gap-2">
                        <label class="ms-1 mb-0" for="agree">@lang(' I agree with') </label>
                        @foreach ($policyPages as $policy)
                            <a class="text--base" href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}">{{ __($policy->data_values->title) }}</a>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </div>

                </div>
            @endif
                <button type="submit" class="btn btn-primary mb-0"  id="recaptcha">Register Now</button>
            </form>
            </div>
            <div class="join-now-outer text-center">
            <a class="mb-0" href="{{ route('user.login') }}">Already have an account?</a>
            </div>
        </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.pn')}}g" alt="" class="img-fluid">
    </figure>
</section>




    <div class="modal fade" id="existModalCenter" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content section--bg">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <a class="cmn-btn btn-sm" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>

    @livewire('child.whats-app-popover')

@endsection
@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
@endpush
@if($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
