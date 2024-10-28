@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $kyc = getContent('user_kyc.content', true);
    @endphp



<section class="service-section">
    <div class="container">
      
        <div class="services-data">
            <div class="row">

                <div class="col-md-12">
                    @if ($user->kv == 0)

                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"> <i class="las la-user"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>@lang('KYC Verification required') </h3>
                            <p class="text-size-18">{{ __($kyc->data_values->verification_content) }}</p>
                            <a  class="more" href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a>

                        </div>
                    </div>
                        
                    @elseif($user->kv == 2)

                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"> <i class="las la-user"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>@lang('KYC Verification pending')</h3>
                            <p class="text-size-18">{{ __($kyc->data_values->pending_content) }} </p>
                            <a  class="more"  href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>

                        </div>
                    </div>


                    @elseif($user->kv == 3)

                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"> <i class="fa fa-building"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>@lang('Create Personal Account Number')</h3>
                            <p class="text-size-18">{{ __(@$kyc->data_values->create_bank_account_content) }} </p>
                            <a  class="more"  href="{{ route('user.deposit.create-bank-account') }}">@lang('Create Bank Account')</a>

                        </div>
                    </div>

                       
                    @endif
                </div>

                
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"> <i class="las la-money-bill-wave"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>{{ $general->cur_sym }}{{ showAmount($widget['total_balance']) }} </h3>
                            <p class="text-size-18"> @lang('Total Balance')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"> <i class="las la-wallet"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>{{ $general->cur_sym }}{{ showAmount($widget['total_deposit']) }} </h3>
                            <p class="text-size-18"> @lang('Total Deposit')</p>
                        </div>
                    </div>
                </div>


                {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"><i class="las la-hand-holding-usd"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>{{ $general->cur_sym }}{{ showAmount($widget['total_withdrawn']) }} </h3>
                            <p class="text-size-18"> @lang('Total Spent')</p>
                        </div>
                    </div>
                </div> --}}


                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"><i class="las la-hand-holding-usd"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>{{ $general->cur_sym }}{{ showAmount($widget['total_bonus']) }} </h3>
                            <p class="text-size-18"> @lang('Total Cashback')</p>
                            @livewire('child.withdraw-bonus')
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid">
                                {{-- <i class="fa fa-user"></i> --}}
                                <img  style="width: 100px" src="{{getImage('assets/images/user_type/' . auth()->user()->userType->logo) }}" alt="">
                            </span>
                            
                        </figure>
                        <div class="content">
                            <h3>{{ auth()->user()->userType->name  }} </h3>
                            <p class="text-size-18"> @lang('User Plan')</p>
                            @livewire('child.update-user-plan')
                        </div>
                    </div>
                </div>

                @if ($user->bank)
                    
                
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <span style="font-size:40px; color:var(--e-global-color-accent)" class="img-fluid"> <i class="las la-building"></i></span>
                            
                        </figure>
                        <div class="content">
                            <h3>{{ $user->account_number }} </h3>
                            <h4>{{ $user->bank->bank_name }}</h4>
                            <p class="text-size-18"> @lang('Bank Details')</p>
                        </div>
                    </div>
                </div>
                @endif
               
            </div>
           
        </div>
        <figure class="element2 mb-0">
            <img src="{{asset($activeTemplateTrue . '/images/what-we-do-icon-2.png')}}" class="img-fluid" alt="">
        </figure>
    </div>
</section>




<section class="service-section">
    <div class="container">
        <div class="row position-relative">
            <div class="service-content">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <figure class="mb-0 services-icon">
                        <img src="{{asset($activeTemplateTrue . 'images/services-our-services-icon-1.png')}}" class="img-fluid" alt="">
                    </figure>
                    <h6>{{ __("Available Services") }}</h6>
                    <h2>{{ __("We offer below services") }}</h2>
                   
                </div>
            </div>
        </div>
        <figure class="element1 mb-0">
            <img src="{{asset($activeTemplateTrue . 'images/what-we-do-icon-1.png')}}" class="img-fluid" alt="village">
        </figure>
        <div class="services-data">
            <div class="row">
                @foreach ($services as $k=>$item)
                <a href="{{ route('user.play.game', $item->alias) }}" class="col-lg-3 col-md-3 col-sm-6 col-6">
                    {{-- style="border: 1px solid #c4c4c4; border-radius:10%" --}}
                    <div class="service-box" style="padding: 2px;border: 1px solid var(--e-global-color-accent); border-radius:10%">
                        <figure class="img img1">
                            <img style="width: 60px; height:60px; object-fit:cover" src="{{ getImage(getFilePath('game') . '/' . $item->image, getFileSize('game')) }}" alt="" class="img-fluid rounded-circle">
                        </figure>
                        <div class="content">
                            <h3>{{ __(@$item->name) }}</h3>
                            <h4>Price Range</h4>
                            <span style="color:var(--e-global-color-accent)">{{ $general->cur_sym }}{{ showAmount( $item->min_limit ) }}</span> -
                            <span style="color:var(--e-global-color-accent)">{{ $general->cur_sym }}{{ showAmount( $item->max_limit ) }}</span>

                            <p class="text-size-18"> {{ __(@$item->data_values->description) }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
               
            </div>
           
        </div>
        <figure class="element2 mb-0">
            <img src="{{asset($activeTemplateTrue . '/images/what-we-do-icon-2.png')}}" class="img-fluid" alt="">
        </figure>
    </div>
</section>
 
@php
$content = getContent('general_notification.content',true);
$element = getContent('general_notification.element', false, null, true);
    $currentDate = date('Y-m-d');
    $startDate = @$content->data_values->start_date ?? null;
    $endDate = @$content->data_values->end_date ?? null;
@endphp

@if ($startDate && $endDate && $currentDate >= $startDate && $currentDate <= $endDate)

<div class="modal fade" id="cronModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{@$content->data_values->title}}</h5>
                <span class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></span>
            </div>
            <div class="modal-body">
                <p class="lead">
                    {!! @$content->data_values->notification !!}


                </p>

               
               
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('script')

@if ($startDate && $endDate && $currentDate >= $startDate && $currentDate <= $endDate)

<script>
      $(document).ready(function() {
           
                $("#cronModal").modal('show')
        });


</script>
@endif 

@endpush
