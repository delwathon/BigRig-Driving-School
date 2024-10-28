@extends($activeTemplate . 'layouts.frontend')

@section('content')


<section class="login-form d-flex align-items-center">
    <div class="container">
       <div class="login-form-title text-center">
          <a href="{{route('home')}}">
          <figure class="login-page-logo">
             <img style="width: 233px; height:57px; object-fit:cover"  src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="">
          </figure>
          </a>
          <h2>{{ __(@$login->data_values->title) }}</h2>
       </div>
          <div class="login-form-box">
             <div class="login-card">
                <form  method="POST" action="{{ route('user.data.submit') }}">
                  @csrf
                   <div class="form-group">
                     <label for="exampleInputEmail1">@lang('First Name')</label>
                     <input class="input-field form-control"   name="firstname" type="text" value="{{ old('firstname', auth()->user()->firstname) }}"placeholder="e.g. Elon">
                   </div>
                   <div class="form-group">
                     <label for="exampleInputPassword1">@lang('Last Name')</label>
                     <input  class="input-field form-control"  name="lastname" type="text" value="{{ old('lastname', auth()->user()->lastname) }}"  placeholder="Musk">
                   </div>


                   <div class="form-group">
                    <label for="exampleInputPassword1">@lang('Phone Number')</label>
                    <input  class="input-field form-control"  name="phone_number" type="tel" value="{{ old('phone_number', auth()->user()->mobile) }}"  placeholder="08******">
                  </div>


                   <div class="form-group">
                    <label for="exampleInputPassword1">@lang('Address')</label>
                    <input  class="input-field form-control" name="address" type="text" value="{{ old('address') }}"  placeholder="Current Location">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('State')</label>
                    <input  class="input-field form-control" name="state" type="text" value="{{ old('state') }}"  placeholder="FCT">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('City')</label>
                    <input  class="input-field form-control"   name="city" type="text" value="{{ old('city') }}" placeholder="Current Town">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('Transaction PIN')</label>
                    <input  class="input-field form-control"   name="pin"  type="number" maxlength="4" value="{{ old('pin') }}" placeholder="PIN">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('Confirm Transaction PIN')</label>
                    <input  class="input-field form-control"   name="pin_confirmation" type="number" maxlength="4" value="{{ old('confirmed_pin') }}" placeholder="PIN Confirm">
                  </div>
                   <button type="submit" class="btn btn-primary"> @lang('Submit')</button>
                  
                </form>
             </div>
                        
          

          </div>   
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>
@endsection
