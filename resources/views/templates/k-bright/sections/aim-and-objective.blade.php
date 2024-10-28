@php
$content = getContent('aim-and-objective.content',true);
$aims = getContent('aim-and-objective.element',false,3);
@endphp
<div class="rts-service-area rts-section-gap bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="service-style-left-area">
                    <div class="title-style-left">
                        <div class="pre-title-area">
                            <img src="{{asset($activeTemplateTrue . '/images/about/02.png')}}" alt="about">
                            <span class="pre-title">{{ __(@$content->data_values->title) }}</span>
                        </div>
                        <h3 class="title quote">{{ __(@$content->data_values->heading) }}</h3>
                    </div>
                    <p class="disc mb--10">
                        {{ __(@$content->data_values->description) }}
                    </p>
                   
                    <a href="{{ __(@$content->data_values->button_url) }}" class="rts-btn btn-border">{{ __(@$content->data_values->button) }}</a>
                </div>
            </div>
            <div class="col-lg-8 pl--60 rts-slide-up pl_sm--0 pl_md--0 mt_sm--50 mt_md--50">
                <div class="row g-5">

                    @foreach ($aims as $item)
                        
                    

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="single-service-area-one two" styl="background-image: url('{{ getImage('assets/images/frontend/aim-and-objective/'.@$item->data_values->image) }}')">
                            <div class="icon">
                                {!! __(@$item->data_values->icon) !!}
                            </div>
                            <h6 class="title">{{ __(@$item->data_values->title) }}</h6>
                            <p class="disc">
                                {{ __(@$item->data_values->description) }}
                            </p>
                            <a href="{{ __(@$item->data_values->button_url) }}" class="read-more-btn">{{ __(@$item->data_values->button) }}<i class="fa-light fa-chevron-right"></i></a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>