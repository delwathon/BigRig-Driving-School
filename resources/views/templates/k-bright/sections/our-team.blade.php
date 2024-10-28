@php
$content = getContent('our-team.content',true);
$teams = getContent('our-team.element',false,3);
@endphp
<div class="team-area-start rts-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-style-center">
                    <div class="pre-title-area">
                        <img src="{{asset($activeTemplateTrue . '/images/about/02.png')}}" alt="about">
                        <span class="pre-title">{{ __(@$content->data_values->title) }}</span>
                    </div>
                    <h2 class="title quote">{{ __(@$content->data_values->heading) }} </h2>
                </div>
            </div>
        </div>
        <div class="row mt--30 g-24 rts-slide-up">
            @foreach ($teams as $item)
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <!-- team area start -->
                <div class="team-area-start-one">
                    <a href="team-single.html" class="thumbnail">
                        <img src="{{ getImage('assets/images/frontend/our-team/'.@$item->data_values->image) }}" alt="team_area">
                    </a>
                    <div class="team-content">
                        <div class="name-area">

                            <h4 >
                                <h6 class="name">{{ __(@$item->data_values->name) }}</h6>
                            </h4>
                            <h6 class="desig pl--0">{{ __(@$item->data_values->title) }}</h6>
                        </div>

                        <br>
                       
                    </div> 
                    <div class="social-team-one">
                            <ul>
                                <li><a href="{{ __(@$item->data_values->facebook) }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ __(@$item->data_values->twitter) }}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{ __(@$item->data_values->whatsApp) }}"><i class="fab fa-twitter"></i></a></li>
                                
                            </ul>
                        </div>
                </div>
                <!-- team area end -->
            </div>
            @endforeach
           
        </div>
    </div>
</div>