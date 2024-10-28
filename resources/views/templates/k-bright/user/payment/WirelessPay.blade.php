@extends($activeTemplate.'layouts.master')

@section('content')

<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
          
            <h2>@lang('WirelessPay')</h2>
            @isset($data->payment)
                
            
            @lang('You have requested') <b class="text--success">{{__($general->cur_sym)}}{{ showAmount($data->payment->amount_to_pay) }} </b> , 
            
            <br>
            <b class="text--success">{{ $data->payment->instruction }} </b>
            @endisset                         
         </div>
      
          <div class="login-form-box">
             <div class="login-card">
                <form  action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  @if ($data->payment)
                      
                  

                  {{-- <p class="text-size-18"> {!! __($data->gateway->description) !!}</p> --}}
                  
                 
                 
                   <div class="form-group">
                     
                    <div class="preview-details">
                        <ul class="list-group list-group-flush payment-list">
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You have to pay '):
                                <strong>{{__($general->cur_sym)}}{{ showAmount($data->payment->amount_to_pay) }} </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You will get '):
                                <strong>{{__($general->cur_sym)}}{{ showAmount($data->deposit->amount) }} </strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Account Number '):
                                <strong>{{__($data->payment->account_number)}} </strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Account Name '):
                                <strong>{{__($data->payment->account_name)}} </strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Bank Name '):
                                <strong>{{__($data->payment->bank_name)}} </strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Invoice Ref '):
                                <strong>{{__($data->payment->wp_reference)}} </strong>
                            </li>


                        </ul>


                        <h3>Pay With USSD</h3>

                        @foreach ($data->payment->pay_with_ussd??[] as $bank)
                        <ul class="list-group list-group-flush payment-list">
                            <li class="list-group-item d-flex justify-content-between">
                                @lang($bank->Bank_Name):
                                <strong><a href="tel:{{__($bank->Bank_USSD_Code)}}" class="text--base">{{__($bank->Bank_USSD_Code)}}</a>  </strong>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                   </div>
                   @endif

                   <button type="submit" class="btn btn-primary"id="btn-confirm">@lang('Pay Now')</button>
                  
                </form>
             </div>


          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>


@endsection
