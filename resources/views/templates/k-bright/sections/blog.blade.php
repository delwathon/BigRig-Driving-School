@php
$content = getContent('blog.content',true);
$blogs = getContent('blog.element',false,3);
@endphp


<div class="rts-blog-area rts-parallex-top bg-white-para rts_portfolio_animation-wrapper-2 ptb_sm--80">
    <div class="container border-top-in-container rts-section-gap ptb_sm--60">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="project-full-top-wrapper">
                    <!-- title-left -->
                    <div class="title-area-style-six-left">
                        
                        <h2 class="title">{{ __(@$content->data_values->heading) }}</h2>
                    </div>
                    <!-- title mid text -->
                    <p class="disc">
                        {{ __(@$content->data_values->subheading) }}
                    </p>
                    <a href="{{route('blog')}}" class="rts-read-more-circle-btn">
                        <i class="fa-solid fa-arrow-up-right"></i>
                        <p>@lang('Read More')</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt--30 g-5">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <!-- signle blog area start -->
                <div class="rts-blog-area-start-six rts-portfolio__item-2">
                    <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}" class="thumbnail">
                        <img src="{{ getImage('assets/images/frontend/blog/thumb_'.@$blog->data_values->image,'350x250') }}" alt="blog">
                    </a>
                    <div class="inner-content">
                        <div class="top">
                            <span>Interior</span>
                            <span>{{ @$blog->created_at->format('d M, Y') }}</span>
                        </div>
                        <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}">
                            <h3 class="title">{{ __(@$blog->data_values->title) }}</h3>
                        </a>
                        <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}" class="rts-read-more">@lang('Read More')<i class="fa-light fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- signle blog area end -->
            </div>
            @endforeach
           
        </div>
    </div>
</div>

{{-- <section class="pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mt-3">{{ __(@$content->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row mb-none-30 justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                <div class="post-card">
                    <div class="post-card__thumb">
                        <img src="{{ getImage('assets/images/frontend/blog/thumb_'.@$blog->data_values->image,'350x250') }}" alt="image">
                        <span class="post-card__date">{{ @$blog->created_at->format('d M, Y') }}</span>
                    </div>
                    <div class="post-card__content">
                        <h3 class="post-card__title mt-2 mb-3"><a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}">{{ __(@$blog->data_values->title) }}</a>
                        </h3>
                        <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}" class="cmn-btn btn-sm mt-3">@lang('Read More')</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> --}}