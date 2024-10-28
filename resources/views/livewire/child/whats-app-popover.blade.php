<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div id="myWhatsappButton"></div>

    @php
         $phone = substr($general->phone, 0, 1) === '0' ? '234' . substr($general->phone, 1) : $general->phone;
    @endphp
</div>

@push('style')
<link rel="stylesheet" href="{{asset('whatsapp/floating-wpp.min.css')}}">
@endpush

@push('script-lib')
<script src="{{asset('whatsapp/floating-wpp.min.js')}}"></script>
<script type="text/javascript">

    $(function () {
        $('#myWhatsappButton').floatingWhatsApp({
            phone: "{{$phone}}",
            popupMessage: 'Hello, how can we help you?',
            message: "How to get started",
            showPopup: true,
            showOnIE: true,
            headerTitle: 'Welcome!',
            position:'right',
            headerColor: 'green',
            backgroundColor: 'green',
            buttonImage: '<img src="{{asset('whatsapp/whatsapp.svg')}}" />'
        });
    });
</script>
@endpush