@extends($activeTemplate . 'layouts.master')
@section('content')
<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
            @if (auth()->user()->referrer)
            <h2>@lang('You are referred by') {{ auth()->user()->referrer->fullname }}</h2>
            @endif
        </div>
          <div class="login-form-box">
             <div class="login-card">

                <div class="form-group">
                    <div class="input-group">
                        <input class="input-field form-control referralURL" type="text" value="{{ route('home') }}?reference={{ auth()->user()->username }}" readonly>
                        <button  id="copyBoard" class="btn btn-primary -bottom-left-copytext" id="copyBoard" type="button"><i class="fas fa-copy"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <h1>{{$user->allReferrals->count() }}</h1>
                @if ($user->allReferrals->count() > 0 && $maxLevel > 0)
                    <div class="treeview-container">
                        <ul class="treeview">
                            <li class="items-expanded"> {{ $user->fullname }} ( {{ $user->username }} )
                                @include($activeTemplate . 'partials.under_tree', ['user' => $user, 'layer' => 0, 'isFirst' => true])
                            </li>
                        </ul>
                    </div>
                @endif
                </div>


             </div>


            </div>   
      </div>
      <figure class="mb-0 need-layer">
          <img src="{{asset($activeTemplateTrue . 'images/need-layer.png')}}" alt="" class="img-fluid">
      </figure>
  </section>


@endsection

@push('style-lib')
    <link type="text/css" href="{{ asset($activeTemplateTrue . '/css/jquery.treeView.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/jquery.treeView.js') }}"></script>
@endpush
@push('style')
    <style type="text/css">
        .content-wrapper {
            margin-top: -90px;
            min-height: calc(100vh - 157px);
        }

        .copytext {
            cursor: pointer;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.treeview').treeView();

            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
