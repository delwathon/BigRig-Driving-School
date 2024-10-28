@extends($activeTemplate.'layouts.master')

@section('content')

<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
          
            <h2>@lang('Manual Payment')</h2>

            @lang('You have requested') <b class="text--success">{{ showAmount($data['amount']) }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                        <b class="text--success">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
         </div>
      
          <div class="login-form-box">
             <div class="login-card">
                <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <p class="text-size-18"> {!! __($data->gateway->description) !!}</p>
                  
                  <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />
                 
                   <div class="form-group">
                     
                    <div class="preview-details">
                        <ul class="list-group list-group-flush payment-list">
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You have to pay '):
                                <strong>{{__($data['method_currency'])}} {{showAmount($data['final_amo'])}} </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('You will get '):
                                <strong>{{__($general->cur_sym)}}{{showAmount($data['amount'])}} </strong>
                            </li>
                        </ul>
                    </div>
                   </div>
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
