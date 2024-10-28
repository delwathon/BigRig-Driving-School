@php
$content = getContent('activity-counter.content',true);
$counters = getContent('activity-counter.element',false,3);
@endphp

<div class="rts-counterup-area-start rts_jump_counter__animation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="counter-main-wrapper-two counter_animation">

                    @foreach ($counters as $item)
                        
                    
                    <!-- ingle counter up -->
                    <div class="counter-single counter__anim">
                        <i class="fa fa-user"></i>
                        <div class="inner">
                            <h2 class="title"><span class="counter">{{ __(@$item->data_values->number) }}</span></h2>
                            <p>{{ __(@$item->data_values->activity) }}</p>
                        </div>
                    </div>
                    @endforeach
                    <!-- ingle counter up end -->
                   
                </div>
            </div>
        </div>
    </div>
</div>