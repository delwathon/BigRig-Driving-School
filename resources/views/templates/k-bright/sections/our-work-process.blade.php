@php
$content = getContent('our-work-process.content',true);
$processes = getContent('our-work-process.element',false,null);
@endphp
 
 <!-- our woring process area start -->
 <div class="our-working-process rts-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-process-stock-text">
                    <h2 class="stock-text-1 title-large-3 text-uppercase end">
                        {{ __(@$content->data_values->title) }}
                    </h2>
                </div>

                    <p class="disc mb--10">
                        {{ __(@$content->data_values->description) }}
                    </p>

            </div>
        </div>
        <div class="row g-5 mt--30 mt_sm--0 separetor-process-top rts-slide-up">
            @foreach ($processes as $k=>$item)

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt--50 pt_md--15 pt_sm--10">
                <!-- single working process start -->
                <div class="single-working-prcess-one active">
                    <div class="inner">
                        <span>0{{ $k+1 }}</span>
                        <h4 class="title">
                            {{ __(@$item->data_values->title) }}
                        </h4>
                        <p class="disc">
                            {{ __(@$item->data_values->description) }}
                        </p>
                    </div>
                </div>
                <!-- single working process end -->
            </div>
            @endforeach
           
        </div>
    </div>
</div>
<!-- our woring process area end -->