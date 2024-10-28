@php
    $payment = getContent('payment_method.content', true);
    $payments = getContent('payment_method.element', false, null, true);
    $policyPages = getContent('policy_pages.element', false, null, true);
    $socialIcon = getContent('social_icon.element', false, null, true);
    $pages = App\Models\Page::where('tempname',$activeTemplate)->where('is_default',App\Constants\Status::NO)->get();
    $total_pages = count($pages);
    $half_index = ceil($total_pages / 2); // Get the index to split the array into two halves
    $first_half = $pages->slice(0, $half_index);
    $second_half = $pages->slice($half_index);
@endphp

<div class="win-loss-popup">
    <div class="win-loss-popup__bg">
        <div class="win-loss-popup__inner">
            <h5 class="text-center status"></h5>
            <div class="win-loss-popup__body">
                <span class="img-glow display-3 iconv">
                </span>
                <h2 style="color: var(--e-global-color-very-light-gray)">{{$general->cur_sym}} <span class="amount"></span></h2>
                
            </div>
            <div class="win-loss-popup__footer">
                <h3  style="color: var(--e-global-color-very-light-gray)" class="result-text"> <span class="data-result"></span></h3>
            </div>
        </div>
    </div>
</div>

<div class="scroll-to-top">
    <span class="scroll-icon">
        <i class="las la-arrow-up"></i>
    </span>
</div>
<!-- Footer -->
<section class="footer-section">

    <div class="container">
        <div class="middle-portion">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-12">
                    <a href="index.html">
                        <figure class="footer-logo">
                            <img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="img-fluid" alt="">
                        </figure>
                    </a>
                    {{-- <p class="text-size-16 footer-text">Lorem ipsum dolor sit amet, consectetur adipisc ing elitsed do eiusmod tempororem ipsum dolor sit am econsect ametconsectetetur.</p>
                    <figure class="mb-0 payment-icon">
                        <img src="assets/images/payment-card.png" class="img-fluid" alt="">
                    </figure> --}}
                </div>
                <div class="col-lg-1 col-md-1 col-sm-12 col-12 d-lg-block d-none">

                </div>
                <div class="col-lg-2 col-md-3 col-sm-12 col-12 d-md-block d-none">
                    <div class="links">
                        <h4 class="heading">Important Link</h4>
                        <hr class="line">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{route('home')}}" class=" text-size-16 text text-decoration-none">Home</a></li>
                            @foreach ($first_half as $k  => $data)
                            <li><a href="{{ route('pages', [$data->slug]) }}" class=" text-size-16 text text-decoration-none">{{ __($data->name) }}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-12 d-lg-block d-none">
                    <div class="links">
                        <h4 class="heading">Support</h4>
                        <hr class="line">
                        <ul class="list-unstyled mb-0">
                          
                            @foreach ($second_half as $k  => $data)
                            <li><a href="{{ route('pages', [$data->slug]) }}" class=" text-size-16 text text-decoration-none">{{ __($data->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-sm-block">
                    <div class="icon">
                        <h4 class="heading">Get in Touch</h4>
                        <hr class="line">
                        <ul class="list-unstyled mb-0">
                            <li class="text-size-16 text">Email: <a href="mailto:{{$general->email}}" class="mb-0 text text-decoration-none text-size-16">{{$general->email }}</a></li>
                            <li class="text-size-16 text">Phone: <a href="tel:{{$general->phone}}" class="mb-0 text text-decoration-none text-size-16">{{$general->phone}}</a></li>
                            <li class="text-size-16 text1">Mobile: <a href="tel:{{$general->mobile}}" class="mb-0 text text-decoration-none text-size-16">{{$general->mobile}}</a></li>
                            <li class="social-icons">
                                @foreach ($socialIcon as $social)
                                <div class="circle"><a href="{{ @$social->data_values->url }}"> {!!$social->data_values->social_icon!!}</a></div>

                                @endforeach
                                {{-- <div class="circle"><a href="index.html#"><i class="fa-brands fa-twitter"></i></a></div>
                                <div class="circle"><a href="index.html#"><i class="fa-brands fa-linkedin"></i></a></div>
                                <div class="circle"><a href="index.html#"><i class="fa-brands fa-pinterest"></i></a></div> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--footer area-->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-size-16">Copyright {{ "@".date('Y')}} {{$general->site_name }}. All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>








<div id="anywhere-home">
</div>
@push('style')
    <style>
        .subscribe-form {
            justify-content: space-between;
            display: flex;
            flex-wrap: wrap;
        }

        .subscribe-form .form--control {
            width: calc(100% - 155px);
        }

        .subscribe-form .cmn-btn {
            width: 135px;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {


            "use strict";
            $('.subscribe-btn').on('click', function(e) {
                e.preventDefault()
                var email = $('[name=email]').val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ route('subscribe.post') }}",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.success) {
                            $('[name=email]').val('')
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    }
                });
            });
        })(jQuery)
    </script>
@endpush
