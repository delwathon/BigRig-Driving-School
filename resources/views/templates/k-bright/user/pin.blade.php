@extends($activeTemplate.'layouts.master')
@section('content')
<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-form-box">
                    <div class="login-card">
                        <form action="{{route('user.submit-change-pin')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">@lang('Current PIn')  </label>
                                <input type="password" maxlength="4" class="input-field form-control" name="current_pin" required autocomplete="current-pin">
                            
                                
                                @livewire('child.reset-current-pin')
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('New PIn')</label>
                                <input type="password" maxlength="4" class="input-field form-control" name="pin" required autocomplete="current-pin">
                               
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Confirm PIn')</label>
                                <input type="password" maxlength="4" class="input-field form-control" name="pin_confirmation" required autocomplete="current-pin">
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@if($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
