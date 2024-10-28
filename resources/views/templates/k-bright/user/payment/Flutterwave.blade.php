@extends($activeTemplate.'layouts.master')

@section('content')


<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
          
            <h2>@lang('Flutterwave')</h2>
         </div>
      
          <div class="login-form-box">
             <div class="login-card">
             
                  

                 
                   <div class="form-group">
                     
                    <div class="preview-details">
                        <ul class="list-group list-group-flush payment-list">
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You have to pay '):
                                <strong>{{__($deposit->method_currency)}} {{showAmount($deposit->final_amo)}} </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You will get '):
                                <strong>{{__($general->cur_sym)}}{{showAmount($deposit->amount)}} </strong>
                            </li>
                        </ul>
                    </div>
                   </div>
                   <button type="submit" class="btn btn-primary"id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
                   
             </div>


          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>

{{-- <div class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title">@lang('Flutterwave')</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush payment-list">
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You have to pay '):
                                <strong>{{showAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You will get '):
                                <strong>{{showAmount($deposit->amount)}} {{__($general->cur_text)}}</strong>
                            </li>
                        </ul>
                        <button type="button" class="cmn-btn w-100 mt-3" id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@push('script')
<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script>
    "use strict"
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "{{$data->API_publicKey}}";
        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{$data->customer_email}}",
                amount: "{{$data->amount }}",
                customer_phone: "{{$data->customer_phone}}",
                currency: "{{$data->currency}}",
                txref: "{{$data->txref}}",
                onclose: function () {
                },
                callback: function (response) {
                    var txref = response.tx.txRef;
                    var status = response.tx.status;
                    var chargeResponse = response.tx.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    } else {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    }
                        // x.close(); // use this to close the modal immediately after payment.
                    }
                });
        }
</script>
@endpush