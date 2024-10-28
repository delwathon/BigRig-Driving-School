@php
$breadcrumb = getContent('breadcrumb.content', true);
@endphp

<div class="sub-banner">
    <section class="banner-section">
        <figure class="mb-0 bgshape">
            <img src="{{ getImage('assets/images/frontend/breadcrumb/' . @$breadcrumb->data_values->image, '1920x189') }}" alt="" class="img-fluid">
        </figure>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="banner_content">
                        <h1>{{ __($pageTitle) }}</h1>
                        <p>{{ __(@$breadcrumb->data_values->description) }}</p>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <div class="box">
        <span class="mb-0 text-size-16">Home</span><span class="mb-0 text-size-16 dash">-</span><span class="mb-0 text-size-16 box_span">{{ __($pageTitle) }}</span>
    </div>
</div>


