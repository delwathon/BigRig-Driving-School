@php
$content = getContent('our-services.content',true);
$element = getContent('our-services.element', false, null, true);
@endphp


<section class="service-section">
    <div class="container">
        <div class="row position-relative">
            <div class="service-content">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <figure class="mb-0 services-icon">
                        <img src="{{asset($activeTemplateTrue . 'images/services-our-services-icon-1.png')}}" class="img-fluid" alt="">
                    </figure>
                    <h6>{{ __(@$content->data_values->title) }}</h6>
                    <h2>{{ __(@$content->data_values->heading) }}</h2>
                    <figure class="service-image" data-aos="fade-up">
                        <img src="{{ getImage('assets/images/frontend/our-services/'.@$content->data_values->image) }}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
        </div>
        <figure class="element1 mb-0">
            <img src="{{asset($activeTemplateTrue . 'images/what-we-do-icon-1.png')}}" class="img-fluid" alt="village">
        </figure>
        <div class="services-data">
            <div class="row">
                @foreach ($element as $k=>$item)
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <img src="{{ getImage('assets/images/frontend/our-services/'.@$item->data_values->icon_image) }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>{{ __(@$item->data_values->title) }}</h3>
                            <p class="text-size-18"> {{ __(@$item->data_values->description) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
           
        </div>
        <figure class="element2 mb-0">
            <img src="{{asset($activeTemplateTrue . '/images/what-we-do-icon-2.png')}}" class="img-fluid" alt="">
        </figure>
    </div>
</section>