@extends($activeTemplate.'layouts.master')
@section('content')


<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
          
            <h2>@lang('Paystack')</h2>
         </div>
      
          <div class="login-form-box">
             <div class="login-card">
                <form  action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" >
                  @csrf
                  

                 
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
                   <button type="submit" class="btn btn-primary"id="btn-confirm">@lang('Pay Now')</button>
                   <script src="//js.paystack.co/v1/inline.js" data-key="{{ $data->key }}" data-email="{{ $data->email }}" data-amount="{{ round($data->amount) }}" data-currency="{{$data->currency}}" data-ref="{{ $data->ref }}" data-custom-button="btn-confirm">
                   </script>
                </form>
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
                        <h5 class="card-title">@lang('Paystack')</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" class="text-center">
                            @csrf
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
                            <button type="button" class="cmn-btn w-100 mt-3" id="btn-confirm">@lang('Pay Now')</button>
                            <script src="//js.paystack.co/v1/inline.js" data-key="{{ $data->key }}" data-email="{{ $data->email }}" data-amount="{{ round($data->amount) }}" data-currency="{{$data->currency}}" data-ref="{{ $data->ref }}" data-custom-button="btn-confirm">
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection