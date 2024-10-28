@extends($activeTemplate . 'layouts.master')
@section('content')

<section class="message-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="message_content" data-aos="fade-up">
                        <form action="{{ route('user.kyc.submit') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row gy-2">
                                <x-viser-form identifier="act" identifierValue="kyc" />
                            </div>

                            <div class="form-group">
                                <button class="submit" type="submit">@lang('Submit')</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
