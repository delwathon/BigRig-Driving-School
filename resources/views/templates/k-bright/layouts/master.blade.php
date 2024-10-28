@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.user_header')

    @if (!request()->routeIs('home'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif

    @yield('content')
    @livewire('child.whats-app-popover')

    @include($activeTemplate . 'partials.footer')
@endsection

@push('script')
    <script>

function success(data) {

$('.win-loss-popup').addClass('active');
// $('.win-loss-popup__body').find('img').addClass('d-none');
if (data.type == 'success') {
    $('.win-loss-popup__body').find('.win').removeClass('d-none');
} else {
    $('.win-loss-popup__body').find('.lose').removeClass('d-none');
}
$('.win-loss-popup__footer').find('.data-result').text(data.result);


// var bal = parseFloat(data.bal);
// $('.bal').html(bal.toFixed(2));
// $('button[type=submit]').html('Play');
// $('button[type=submit]').removeAttr('disabled');
// $('.single-select').removeClass('active');
// $('.single-select').removeClass('op');
// $('.single-select').find('img').removeClass('op');
// $('img').removeClass('op');
}

// success("village")


Livewire.on('closeModal', function() {
            // const mymodal = document.querySelector('#addsubject');
                 const modal = document.querySelector('.modal');
                //  console.log(modal);
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
                $('.bodywrapper__inner').load(window.location.href + ' .bodywrapper__inner');
                });

Livewire.on('successConfirmation', function(res) {

    var status =  res.status;
    var amount =  res.amount;
    var message =  res.message;
    var icon = res.icon;
    // console.log(icon);
    // console.log(message);
    // console.log(parseFloat(amount).toFixed(2));
    $('.win-loss-popup').addClass('active');
        $('.win-loss-popup__body').find('.amount').text(parseFloat(amount).toFixed(2));
        // if (status == 'success') {
            $('.win-loss-popup__body').find('.iconv').html(icon);
            $('.win-loss-popup__inner').find('.status').text(status);
        // } else {
        //     $('.win-loss-popup__body').find('.status').html('<i class="fa fa-times"></i>');
        // }

        $('.win-loss-popup__footer').find('.data-result').text(message);

});

        (function($) {
            "use strict";
            $(document).on('click touchstart', function(e) {
                $('.win-loss-popup').removeClass('active');
            });
        })(jQuery)
    </script>




@endpush
