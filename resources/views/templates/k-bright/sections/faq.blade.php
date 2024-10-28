@php
$content = getContent('faq.content', true);
$faqs = getContent('faq.element', false, null, true);
@endphp

<section class="faq-section accordian-section manage-section pricing-faq">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="subheading">
                    <h6>{{ __(@$content->data_values->heading) }}</h6>
                    <h2>{{ __(@$content->data_values->subheading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row">

         
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="faq" data-aos="fade-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="accordian-section-inner position-relative">
                                <div class="accordian-inner">
                                    <div id="accordion1">
                                        @foreach ($faqs as $faq)
                                        @if ($loop->odd)
                                        <div class="accordion-card">
                                            <div class="card-header" id="headingOne{{ $loop->iteration }}">
                                                <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseOne{{ $loop->iteration }}">
                                                    <h4>{{ __(@$faq->data_values->question) }}</h4>
                                                </a>
                                            </div>
                                            <div id="collapseOne{{ $loop->iteration }}" class="collapse" aria-labelledby="headingOne{{ $loop->iteration }}">
                                                <div class="card-body">
                                                    <p class="text-size-16 text-left mb-0 p-0">{{ __(@$faq->data_values->answer) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        

            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="faq-content" data-aos="fade-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="accordian-section-inner position-relative">
                                <div class="accordian-inner">
                                    <div id="accordion2">
                                        @foreach ($faqs as $faq)
                                        @if ($loop->even)
                                        <div class="accordion-card">
                                            <div class="card-header" id="headingFour{{ $loop->iteration }}">
                                                <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseFour{{ $loop->iteration }}">
                                                    <h4>{{ __(@$faq->data_values->question) }}</h4>
                                                </a>
                                            </div>
                                            <div id="collapseFour{{ $loop->iteration }}" class="collapse" aria-labelledby="headingFour{{ $loop->iteration }}">
                                                <div class="card-body">
                                                    <p class="text-size-16 text-left mb-0 p-0">{{ __(@$faq->data_values->answer) }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                        @endforeach

                                      

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <figure class="mb-0 manage-layer">
        <img src="{{asset($activeTemplateTrue . '/images/mange-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>


{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mt-3">{{ __(@$content->data_values->subheading) }}</p>
                </div>
            </div>
            <div class="col-lg-12 order-lg-1 order-2">
                <div class="faq-content">
                    <div class="accordion cmn-accordion" id="faqAccordion-two">
                        <div class="row mb-none-30">
                            <div class="col-lg-6 mb-30">
                                @foreach ($faqs as $faq)
                                    @if ($loop->odd)
                                        <div class="card">
                                            <div class="card-header" id="h-{{ $loop->iteration }}">
                                                <button class="acc-btn collapsed" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" type="button" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                                                    <span class="text">{{ __(@$faq->data_values->question) }}</span>
                                                    <span class="plus-icon"></span>
                                                </button>
                                            </div>
                                            <div class="collapse" id="c-{{ $loop->iteration }}" data-bs-parent="#faqAccordion-two" aria-labelledby="h-{{ $loop->iteration }}">
                                                <div class="card-body">
                                                    <p>{{ __(@$faq->data_values->answer) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-lg-6 mb-30">
                                @foreach ($faqs as $faq)
                                    @if ($loop->even)
                                        <div class="card">
                                            <div class="card-header" id="h-{{ $loop->iteration }}">
                                                <button class="acc-btn collapsed" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" type="button" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                                                    <span class="text">{{ __(@$faq->data_values->question) }}</span>
                                                    <span class="plus-icon"></span>
                                                </button>
                                            </div>
                                            <div class="collapse" id="c-{{ $loop->iteration }}" data-bs-parent="#faqAccordion-two" aria-labelledby="h-{{ $loop->iteration }}">
                                                <div class="card-body">
                                                    <p>{{ __(@$faq->data_values->answer) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
