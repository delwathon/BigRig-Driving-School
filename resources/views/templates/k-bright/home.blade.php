@extends($activeTemplate.'layouts.frontend')
@section('content')
<div class="s16lovai">
@include($activeTemplate.'sections.banner')



@if($sections->secs != null)
@foreach(json_decode($sections->secs) as $sec)
    @include($activeTemplate.'sections.'.$sec)
@endforeach
@endif
</div>

@endsection
