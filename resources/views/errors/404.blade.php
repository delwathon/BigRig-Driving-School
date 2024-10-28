<!-- meta tags and other links -->
@php
    $pageTitle = "404";
@endphp
@extends($activeTemplate.'layouts.app')

@section('app')
@php
$login = getContent('login.content',true);
$socialIcon  = getContent('social_icon.element', false, null, true);

@endphp

<section class="coming-soon">
  <div class="container">
      <div class="row">
          <div class="col-12">
              <div class="content">
                  <a class="logo" href="{{route('home')}}"><figure class="mb-3"><img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="" class="img-fluid"></figure></a>
                  <h1 class="mb-3 display-1">404</h1>
                  <p class="mb-5">@lang('Sorry your, the resouces you are looking for is not available..')</p>
                  <a class="button mb-4 text-decoration-none" href="{{route('contact')}}">Contact Us</a>
                  <ul class="social-icon">
                    @foreach ($socialIcon as $social)
                    <li>
                        <a href="{{ @$social->data_values->url }}"> {!!$social->data_values->social_icon!!} </a>
                    </li>
                    @endforeach
                    
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <figure class="mb-0 need-layer">
      <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
  </figure>
</section>


@endsection

