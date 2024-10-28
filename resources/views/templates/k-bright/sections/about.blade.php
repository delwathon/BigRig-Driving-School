@php
$content = getContent('about.content',true);
$abouts = getContent('about.element',false,null,true);
@endphp


<section class="about-repay">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="about-wrapper">
                    <figure class="circle mb-0">
                        <img src="{{ asset($activeTemplateTrue . '/images/image-2-bg.png') }}" alt="">
                    </figure>
                    <div class="position-relative">
                        <a class="popup-vimeo" href="{{ __(@$content->data_values->intro_video_url) }}">
                            <figure class="mb-0 videobutton">
                                <img class="thumb img-fluid" style="cursor: pointer" src="{{asset($activeTemplateTrue . '/images/play-button.png')}}" alt="">
                            </figure>
                        </a>
                    </div>
                    <figure class="image mb-0">
                        <img src="{{ getImage('assets/images/frontend/about/'.@$content->data_values->image) }}" alt="" class="img-fluid">
                    </figure>
                    <figure class="homeelement mb-0">
                        <img src="{{asset($activeTemplateTrue . '/images/homeelement.png')}}" alt="" class="img-fluid">
                    </figure>
                    <figure class="homeelement1 mb-0">
                        <img src="{{asset($activeTemplateTrue . '/images/homeelement.png')}}" alt="" class="img-fluid">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="about-content"  data-aos="fade-up">
                    <h6>{{ __(@$content->data_values->title) }}</h6>
                    <h2>{{ __(@$content->data_values->heading) }}</h2>
                    <p class="text-size-18">
                        
                        {!! __(@$content->data_values->description) !!}

                    </p>
                    <div class="right-lower">
                        <figure class="mb-0 icon">
                            <img src="{{asset($activeTemplateTrue . '/images/happy-customer-icon.png')}}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <span>55k+</span>
                            <h4 class="mb-0">Happy Customers</h4>
                        </div>
                        <figure class="mb-0 icon">
                            <img src="{{asset($activeTemplateTrue . '/images/total-customers-icon.png')}}" alt="" class="img-fluid">
                        </figure>
                        <div class="content content1">
                            <span>$249M+</span>
                            <h4 class="mb-0">Total Transections</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <div class="rts-about-area-one rts-section-gap">
    <div class="container pb--50 pb_sm--0">
        <div class="row">
            <div class="col-lg-5">
                <div class="thumbnail-about-one rts-reveal-one">
                    <img class="rts-reveal-image-one" src="{{ getImage('assets/images/frontend/about/'.@$content->data_values->image,'590x565') }}" alt="about">
                </div>
            </div>
            <div class="col-lg-6 mt_md--50 mt_sm--50">
                <div class="about-style-one-right">
                    <div class="title-style-left">
                        <div class="pre-title-area">
                            <img src="{{asset($activeTemplateTrue . '/images/about/02.png')}}" alt="about">
                            <span class="pre-title">{{ __(@$content->data_values->title) }}</span>
                        </div>
                        <h2 class="title mt--0 mb--25 quote">{{ __(@$content->data_values->heading) }}</h2>
                    </div>
                    <p class="disc mb--15">
                        {!! __(@$content->data_values->description) !!}
                    </p>
                   
                    <a href="{{ $content->data_values->button_url }}" class="rts-btn btn-border">{{ $content->data_values->button }}</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 pr-lg-5">
                <div class="about-content">
                    <h2 class="mb-3">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-3">{{ __(@$content->data_values->description) }}</p>
                    <div class="row mt-4">
                        @foreach($abouts as $about)
                        <div class="col-6 mb-15 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                            <div class="feature-card ">
                                <div class="feature-card__icon">
                                    @php echo @$about->data_values->icon @endphp
                                </div>
                                <div class="feature-card__content">
                                    <h4 class="title">{{ __(@$about->data_values->title) }}</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ $content->data_values->button_url }}" class="cmn-btn mt-3">{{ __($content->data_values->button) }}</a>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-5 d-lg-block d-none">
                <div class="about-thumb wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    <img src="{{ getImage('assets/images/frontend/about/'.@$content->data_values->image,'590x565') }}" alt="about image">
                </div>
            </div>
        </div>
    </div>
</section> --}}