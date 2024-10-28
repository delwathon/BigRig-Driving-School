 @php
     $banner = getContent('type.content', true);
     $element = getContent('type.element', false, null, true);
 @endphp

 <div class="s6jvneh">



    @foreach ($element as $k=>$item)

    @if ($k%2==1)



      <a href="{{ @$item->data_values->button_url }}" keep-scroll-position="true" class="nav-item-wrap">
        <div class="nav-item">
          <div class="top-img-wrap"><img class="top-img" src="{{ getImage('assets/images/frontend/type/'.@$item->data_values->image) }}" alt="" /></div>
          <div class="wrap">
            <div class="cont">
              <div class="tit"><img class="icon-img" src="{{ getImage('assets/images/frontend/type/'.@$item->data_values->image) }}" alt="" />
                <div class="txt ttu">{{ @$item->data_values->name }}</div>
              </div>
              <div class="desc">{{ @$item->data_values->description }}</div><button class="ui-button button-normal s-conic3">
                <div class="button-inner">{{ @$item->data_values->button }}</div>
              </button>
            </div>
          </div>
        </div>
      </a>

    @else

    <a href="{{ @$item->data_values->button_url }}" keep-scroll-position="true" class="nav-item-wrap">
        <div class="nav-item sport">
          <div class="top-img-wrap"><img class="top-img" src="{{ getImage('assets/images/frontend/type/'.@$item->data_values->image) }}" alt="" /></div>
          <div class="wrap">
            <div class="cont">
              <div class="tit"><img class="icon-img" src="{{ getImage('assets/images/frontend/type/'.@$item->data_values->image) }}" alt="" />
                <div class="txt ttu">{{ @$item->data_values->name }}</div>
              </div>
              <div class="desc">{{ @$item->data_values->description }}</div><button class="ui-button button-normal s-conic">
                <div class="button-inner">{{ @$item->data_values->button }}</div>
              </button>
            </div>
          </div>
        </div>
      </a>




    @endif



  @endforeach

</div>



{{-- <section class="what-we-do position-relative">
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
                        <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$item->data_values->icon) !!}</span>

                        {{-- <img src="assets/images/what-we-do-credit-debit-icon.png" alt="" class="img-fluid"> --}}
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
                        <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$item->data_values->icon) !!}</span>
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


        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-12">

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="account" data-aos="fade-right">
                    <div class="accounticon">
                        <figure class="mb-0">
                            <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$content->data_values->action_1_icon) !!}</span>
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
                            <span style="font-size:90px; color:var(--e-global-color-accent)" class="img-fluid">{!! __(@$content->data_values->action_2_icon) !!}</span>
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
</section> --}}
