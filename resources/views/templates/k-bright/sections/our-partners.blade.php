@php
$content = getContent('our-partners.content',true);
$partners = getContent('our-partners.element',false,3);
@endphp


<div class="rts-brand-area-start pt--80">
    <div class="container">
        <div class="title-style-three-left">
            <span>{{ __(@$content->data_values->title) }}</span>
            <h3 class="title-sm">{{ __(@$content->data_values->heading) }}
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-area-wrapper-one">
                    <!-- single branbd area -->
                    @foreach ($partners as $item)
                    <a href="{{@$item->data_values->url}}" class="single-brand">
                        <img  style="width: 100px; object-fit:cover" class="img-fluid" src="{{ getImage('assets/images/frontend/our-partners/'.@$item->data_values->image) }}"  alt="brand">
                    </a>
                    @endforeach
                    
                    <!-- single branbd area end -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="rts-client-area rts-section-gap2Bottom bg-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="title-style-three-left">
                    <span>{{ __(@$content->data_values->title) }}</span>
                    <h3 class="title-sm">{{ __(@$content->data_values->heading) }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="row mt--60">
            <div class="col-lg-12">
                <!-- brand style three -->
                <div class="brand-style-three">
                    @foreach ($partners as $item)
                    <img style="width: 100px; object-fit:cover" class="img-fluid" src="{{ getImage('assets/images/frontend/our-partners/'.@$item->data_values->image) }}" alt="brnad">
                    @endforeach

                </div>
                <!-- single brand end -->
            </div>
        </div>
    </div>
</div> --}}