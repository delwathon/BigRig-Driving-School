@php
$banner = getContent('banner.content',true);
$element = getContent('banner.element', false, null, true);
@endphp

<section class="banner main  position-relative">
    <div id="koadit_banner" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner" style="overflow: unset">

            @foreach ($element as $k=>$item)
            <div class="carousel-item  {{$k==0?"active":""}}">

            <figure class="mb-0 bgshape">
                <img src="{{asset($activeTemplateTrue .'/images/homebanner-bgshape.png')}}" alt="" class="img-fluid">
            </figure>
            <div class="container bannermain">
                
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="banner" data-aos="fade-right">
                            <h6>{{ __(@$item->data_values->title) }} </h6>
                            <h1>{{ __(@$item->data_values->heading) }}</h1>

                            <p class="banner-text">
                                
                                {!! __(@$item->data_values->description) !!}
                            </p>


                            
                            <div class="button">
                                @if (@$item->data_values->button_url)
                                        <a class="button_text m-3" href="{{ __(@$item->data_values->button_url) }}">{{ __(@$item->data_values->button_text) }}</a>
                                @endif
                                    @if (@$item->data_values->button_2_url)
                                        <a class="button_text m-3" href="{{ __(@$item->data_values->button_2_url) }}">{{ __(@$item->data_values->button_2_text) }}</a>
                                    @endif

                            </div>
                        
                        </div>
                    </div>
                    <div class=" col-lg-7 col-md-7 col-sm-12">
                        <div class="banner-wrapper">

                            <figure class="mb-0 homeelement1">
                                <img src="{{asset($activeTemplateTrue .'/images/homeelement1.png')}}" class="img-fluid" alt="">
                            </figure>
                            <figure class="mb-0 banner-image">
                                <img src="{{ getImage('assets/images/frontend/banner/'.@$item->data_values->image) }}" class="img-fluid" alt="banner-image">
                            </figure>
                            <figure class="mb-0 content img-bg">
                                <img src="{{asset($activeTemplateTrue .'/images/homebanner-img-bg.png')}}" alt="banner-image-bg">
                            </figure>

                            <figure class="mb-0 homeelement">
                                <img src="{{asset($activeTemplateTrue .'/images/homeelement.png')}}" class="img-fluid" alt="">
                            </figure>


                        </div>
                    </div>
                </div>
            </div>

            </div>
            @endforeach


            <div class="pagination-outer">
                <a class="carousel-control-prev" href="#koadit_banner" role="button" data-slide="prev">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#koadit_banner" role="button" data-slide="next">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>

</div>
</div> 
</section>


    <!-- banner one swiper fade area start -->
    {{-- <div class="banner-one-swiper-fade-swip">
        <!-- Swiper -->
        <div class="swiper mySwiper-banner-one-in-two">
            <div class="swiper-wrapper">
                @foreach ($element as $k=>$item)
                <div class="swiper-slide">
                    <!-- rts-banner-area -->
                    <div class="rts-banner-area-start-one pb--100 ptb_sm--140">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-right-content">
                                        <!-- single-swiper-area start -->
                                        <div class="signle-swiper-start">
                                            <div class="thumbnail-banner-one">
                                                <img src="{{ getImage('assets/images/frontend/banner/'.@$item->data_values->image) }}" alt="banner">
                                            </div>
                                        </div>
                                        <!-- single-swiper-area end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-swiper-area-start">
                            <div class="right-shape">
                                <img src="{{asset($activeTemplateTrue . 'images/banner/icon/03.png')}}" alt="">
                            </div>

                            <!-- single swiper area start -->
                            <div class="single-left-banner-swiper-start">
                                <span class="pre">{{ __(@$item->data_values->title) }}</span>
                                <h2 class="title">
                                    {{ __(@$item->data_values->subtitle) }}
                                    </h3>
                                    <p class="disc">
                                        {!! __(@$item->data_values->description) !!}
                                    </p>
                                    <div class="animation-55"><a href="{{ __(@$item->data_values->button_url) }}" class="rts-btn btn-border">{{ __(@$item->data_values->button_text) }}</a></div>
                            </div>
                            <!-- single swiper area end -->
                        </div>
                    </div>
                    <!-- rts-banner-area end -->
                </div>
                @endforeach
               

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div> --}}
    <!-- banner one swiper fade area end -->
{{-- <section class="hero bg_img" style="background-image: url( {{ getImage('assets/images/frontend/banner/'.@$banner->data_values->image,'1920x780') }} );">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="hero__content text-lg-left">
                    <h2 class="hero__title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">{{ __(@$banner->data_values->heading) }}</h2>
                    <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">{{ __(@$banner->data_values->subheading) }}</p>
                    <div class="btn-group justify-content-lg-start justify-content-center mt-4 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">
                        <a href="{{ __(@$banner->data_values->button_url_one) }}" class="cmn-btn">{{ __(@$banner->data_values->button_one) }}</a>
                        <a href="{{ __(@$banner->data_values->button_url_two) }}" class="cmn-btn-two">{{ __(@$banner->data_values->button_two) }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
