@php
$content = getContent('manage-it-yourself.content',true);
$element = getContent('manage-it-yourself.element', false, null, true);
@endphp


<section class="manage-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="manage-content"  data-aos="fade-right">
                    <h2>{{ __(@$content->data_values->title) }}</h2>
                    @foreach ($element as $k=>$item)
                    <div class="first">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="{{ getImage('assets/images/frontend/manage-it-yourself/'.@$item->data_values->icon_image) }}" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>{{ __(@$item->data_values->title) }}</h4>
                                    <p class="text-size-16 text">{{ __(@$item->data_values->description) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="secound">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="{{asset($activeTemplateTrue . '/images/manageyour-best-support-icon.png')}}" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>Best Support</h4>
                                    <p class="text-size-16">Sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt Lorem ipsum dolor sit ametcon.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="assets/images/manageyour-secure-icon.png" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>Secure</h4>
                                    <p class="text-size-16">Adipiscing elit sed do eiusmod tempor in cididod temunt. Lorem ipsum dolor sit ametcon sec tetur.</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="manage-wrapper">
                    <figure class="mb-0 homeelement1">
                        <img src="{{asset($activeTemplateTrue . '/images/homeelement1.png')}}" class="img-fluid" alt="">
                    </figure>
                    <figure class="mb-0 manage-image">
                        <img src="{{ getImage('assets/images/frontend/manage-it-yourself/'.@$content->data_values->image) }}" class="img-fluid" alt="">
                    </figure>
                    <figure class="mb-0 content img-bg">
                        <img src="{{asset($activeTemplateTrue . '/manageyour-mange-your-bg.png')}}" alt="" class="">
                    </figure>
                    <figure class="mb-0 homeelement">
                        <img src="{{asset($activeTemplateTrue . '/images/homeelement.png')}}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <figure class="mb-0 manage-layer">
        <img src="{{asset($activeTemplateTrue . '/images/mange-layer.png')}}" alt="" class="img-fluid">
    </figure>
</section>



