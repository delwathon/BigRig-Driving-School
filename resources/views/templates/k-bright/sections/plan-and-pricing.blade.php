@php
$content = getContent('plan-and-pricing.content',true);

$userTypes = App\Models\UserType::get();

@endphp
<section class="plan">
    <div class="container">
        <figure class="element1 mb-0">
            <img src="{{asset($activeTemplateTrue . '/assets/images/what-we-do-icon-1.png')}}" class="img-fluid" alt="">
        </figure>
        <div class="row position-relative">
            <div class="col-12">
                <div class="content" data-aos="fade-right">
                    <h6>{{ __(@$content->data_values->title) }}</h6>
                    <h2>{!! (@$content->data_values->description)  !!}</h2>
                    <figure class="element3 mb-0">
                        <img src="{{asset($activeTemplateTrue . '/images/about/02.png')}}" alt="" class="img-fluid">
                    </figure>
                </div>
            </div>
        </div>
        @foreach ($userTypes as $item)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="pricing">

                    
                    <div class="row">
                        <div class="col-lg-5 col-md-3 col-sm-6 col-6">
                            <h3>{{ $item->name }}</h3>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                            <h4 class="online-payment">{{ showAmount($item->discount) }}%</h4>
                            {{-- <p class="mb-0 text1 text">3.5% plus USD 1.00</p> --}}
                        </div>
                        {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="payout">Payout</h4>
                            <p class="mb-0 text">3.5% plus USD 1.00</p>
                        </div> --}}
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <figure class="mb-0 icon">
                                <img src="{{ getImage('assets/images/user_type/' . @$item->logo) }}" style="width: 50px" alt="" class="img-fluid">
                            </figure>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    @endforeach


        <figure class="element2 mb-0">
            <img src="{{asset($activeTemplateTrue . '/images/about/02.png')}}" class="img-fluid" alt="">
        </figure>
    </div>
</section>