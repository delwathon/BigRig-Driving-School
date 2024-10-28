@php
$content = getContent('what-we-do.content',true);
$element = getContent('what-we-do.element', false, null, true);
@endphp


<section class="what-we-do position-relative">
    <div class="container">
        <figure class="element1 mb-0">
            <img src="{{asset($activeTemplateTrue . '/images/what-we-do-icon-1.png')}}" class="img-fluid" alt="">
        </figure>
        <div class="row">
            <div class="col-12">
                <div class="subheading" data-aos="fade-right">
                    <h6>{{ __(@$content->data_values->title) }}</h6>
                    <h2>{{ __(@$content->data_values->heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row position-relative">

            @foreach ($element as $k=>$item)

            @if ($k%2==0)
                
           
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img">
                        {{-- <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$item->data_values->icon) !!}</span> --}}

                        <img src="{{ getImage('assets/images/frontend/what-we-do/'.@$item->data_values->icon_image) }}" alt="" class="img-fluid">
                    </figure>
                    <h3>{{ __(@$item->data_values->title) }}</h3>
                    <p class="mb-0 text-size-18">
                        {{ __(@$item->data_values->description) }}
                    </p>
                </div>
            </div>

            <figure class="arrow1 mb-0" data-aos="fade-down">
                <img src="{{asset($activeTemplateTrue . '/images/what-we-do-arrow-1.png')}}"  class="img-fluid" alt="">
            </figure>
             @else
                
            

            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1 service2">
                    <figure class="img">
                        <img src="{{ getImage('assets/images/frontend/what-we-do/'.@$item->data_values->icon_image) }}" alt="" class="img-fluid">

                        {{-- <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$item->data_values->icon) !!}</span> --}}
                        
                    </figure>
                    <h3>{{ __(@$item->data_values->title) }}</h3>
                    <p class="mb-0 text-size-18">
                        {{ __(@$item->data_values->description) }}

                    </p>
                </div>
            </div>

            <figure class="arrow2 mb-0" data-aos="fade-up">
                <img src="{{asset($activeTemplateTrue . '/images/what-we-do-arrow-2.png')}}"  class="img-fluid" alt="">
            </figure>
            @endif

            @endforeach



            <figure class="element3 mb-0">
                <img src="{{asset($activeTemplateTrue . 'images/what-we-do-element.png')}}" alt="">
            </figure>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-12">

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="account" data-aos="fade-right">
                    <div class="accounticon">
                        <figure class="mb-0">
                            <img src="{{ getImage('assets/images/frontend/what-we-do/'.@$content->data_values->action_1_icon_image) }}" class="img-fluid" alt="">

                            {{-- <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$content->data_values->action_1_icon) !!}</span> --}}
                        </figure>
                    </div>
                    <div class="heading">
                        <h3 class="mb-0">{{ __(@$content->data_values->action_1_text) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="account" data-aos="fade-right">
                    <div class="accounticon">
                        <figure class="mb-0">
                            <img src="{{ getImage('assets/images/frontend/what-we-do/'.@$content->data_values->action_2_icon_image) }}" class="img-fluid" alt="">
                        </figure>
                    </div>
                    <div class="heading">
                        <h3 class="mb-0">{{ __(@$content->data_values->action_2_text) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12 col-12">

            </div>
            <figure class="element2 mb-0">
                <img src="{{asset($activeTemplateTrue . '/images/what-we-do-icon-2.png')}}" class="img-fluid" alt="">
            </figure>
        </div>
    </div>
</section>

