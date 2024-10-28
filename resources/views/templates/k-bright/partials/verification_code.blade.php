<div class="container">
    <div class="login-form-title text-center">
     
        <h2>@lang('Verification Code')</h2>
     </div>
    <div class="login-form-bo">
    <div class="verification-code">
        <input class="form-control overflow-hidden" id="verification-code" name="code" type="text" required autocomplete="off">
        <div class="verificationbox">
            <span>-</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
        </div>
    </div>
    </div>
</div>

@push('style')
    <link href="{{ asset('assets/global/css/verification-code.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script>
        $('#verification-code').on('input', function() {
            $(this).val(function(i, val) {
                if (val.length >= 6) {
                    $('.submit-form').find('button[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                    $('.submit-form').submit()
                }
                if (val.length > 6) {
                    return val.substring(0, val.length - 1);
                }
                return val;
            });
            for (let index = $(this).val().length; index >= 0; index--) {
                $($('.verificationbox span')[index]).html('');
            }
        });
    </script>
@endpush
