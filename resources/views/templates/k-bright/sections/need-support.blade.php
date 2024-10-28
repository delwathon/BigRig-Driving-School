@php
$content = getContent('need-support.content',true);
$element = getContent('need-support.element', false, null, true);
@endphp


<section class="need-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content" data-aos="fade-right">
                    <h6>{{ __(@$content->data_values->title) }}</h6>
                    <h2> {{ __(@$item->data_values->heading) }}.</h2>
                    <p class="text-size-18"> {{ __(@$item->data_values->description) }}</p>
                </div>
            </div>
        </div>
        <div class="row position-relative">
            @foreach ($element as $k=>$item)

            @if ($k%2==0)
                
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img img1">
                        <img src="{{ getImage('assets/images/frontend/need-support/'.@$item->data_values->icon_image) }}" alt="" class="img-fluid">
                    </figure>
                    <h3>{{ __(@$item->data_values->title) }}</h3>
                    <p class="text-size-18">{{ __(@$item->data_values->description) }}</p>
                    <a href="{{ __(@$item->data_values->button_url) }}" class="btn">{{ __(@$item->data_values->button_text) }}</a>
                </div>
            </div>
            <figure class="arrow1 mb-0" data-aos="fade-down">
                <img src="{{asset($activeTemplateTrue . '/images/need-arrow1.png')}}" class="img-fluid" alt="">
            </figure>
            @else
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1 service2">
                    <figure class="img img2">
                        <img src="{{ getImage('assets/images/frontend/need-support/'.@$item->data_values->icon_image) }}" alt="" class="img-fluid">
                    </figure>
                    <h3>{{ __(@$item->data_values->title) }}</h3>
                    <p class="text-size-18">{{ __(@$item->data_values->description) }}</p>
                    
                    <a href="{{ __(@$item->data_values->button_url) }}" class="btn">{{ __(@$item->data_values->button_text) }}</a>
                </div>
            </div>
            <figure class="arrow2 mb-0" data-aos="fade-up">
                <img src="{{asset($activeTemplateTrue . '/images/need-arrow-2.png')}}" class="img-fluid" alt="">
            </figure>
            @endif
            @endforeach
           
        </div>
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{asset($activeTemplateTrue . '/images/need-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>





