@php
$content = getContent('testimonial.content', true);
$testimonials = getContent('testimonial.element');
@endphp


<section class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="content" data-aos="fade-right">
                    <figure class="quote-icon">
                        <img src="{{('assets/images/quote-icon.png')}}" alt="" class="img-fluid">
                    </figure>
                    <h6>{{ __(@$content->data_values->title) }}</h6>
                    <h2>{{ __(@$content->data_values->heading) }}</h2>
                    <p class="text-size-18">{{ __(@$content->data_values->description) }}</p>
                    {{-- <div class="button"><a  class="button-text text-size-16 text-decoration-none" href="single-post.html">More Testimonial</a></div> --}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="testimonial-wrapper">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($testimonials as $k=> $testimonial)
                            <div class="carousel-item {{ $k== 0 ?'active':""}}">
                                <div class="review_content">
                                    <img src="{{ getImage('assets/images/frontend/testimonial/' . @$testimonial->data_values->image, '338x344') }}" alt="">
                                    <p class="text-size-18">{{ __(@$testimonial->data_values->quote) }}</p>
                                    <h4 class="mb-0">{{ __(@$testimonial->data_values->name) }}</h4>
                                    {{-- <span class="text-size-16">company.com</span> --}}
                                </div>
                            </div>

                            @endforeach
                           

                            <div class="pagination-outer">
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <i class="fa fa-arrow-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <i class="fa fa-arrow-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div> 
                    <figure class="mb-0 testimonial-circle">
                        <img src="{{asset($activeTemplateTrue . '/images/testimonial-backimage.png')}}" alt="">
                    </figure>
                    <figure class="homeelement mb-0">
                        <img src="{{asset($activeTemplateTrue . '/images/homeelement.png')}}" alt="" class="img-fluid">
                    </figure>
                    <figure class="homeelement1 mb-0">
                        <img src="{{asset($activeTemplateTrue . '/images/homeelement.png')}}" alt="" class="img-fluid">
                    </figure>
                </div> 
            </div>
        </div>
    </div>
    <figure class="mb-0 manage-layer">
        <img src="{{asset($activeTemplateTrue . '/images/mange-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>

