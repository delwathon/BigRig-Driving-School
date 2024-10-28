@php
$banner = getContent('easy_pay.content', true);
$element = getContent('easy_pay.element', false, null, true);
@endphp

<div class="sd1yyof">

    @foreach ($element as $k=> $item)


        @if($k==0)
        <div class="worldcup-imgs">
            <img alt="worldcup" src="{{ getImage('assets/images/frontend/easy_pay/'.@$item->data_values->image) }}" />
        </div>
        @endif


        @if ($k==1)
        <div class="payment-list">
        @endif

        @if ($k==2)
            <div class="top-list">
        @endif

        @if ($k >=2 && $k <=5)
            <img src="{{ getImage('assets/images/frontend/easy_pay/'.@$item->data_values->image) }}" alt="" />
        @endif


        @if ($k==2)
            </div>
        @endif


        @if ($k==6)
            <div class="bot-list">
        @endif

        @if ($k >5)
            <img src="{{ getImage('assets/images/frontend/easy_pay/'.@$item->data_values->image) }}" alt="" />
        @endif



        @if ($k==6)
        </div>
        @endif

        @if ($k==1)
        </div>
        @endif
    @endforeach

    <div class="payment-opt">
      <div class="payment-cont">
        <div class="payment-title">{{ __(@$banner->data_values->heading) }}</div>
        <div class="payment-desc">{{ __(@$banner->data_values->description) }}</div>
        <div class="btn-wrap"><button class="ui-button button-normal s-conic2">
            <div class="button-inner">{{ __(@$banner->data_values->button) }}</div>
          </button></div>
      </div>
    </div>
  </div>
