@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="login-form d-flex align-items-center">
        <div class="container">

            <div class="login-form-box">
                @livewire('user.services.waec', ['service' => $game->id], key($game->id))

            </div>
        </div>
       
    </section>

    <!-- Modal -->
    <div class="modal fade" id="purchaseInstruction" role="dialog" aria-labelledby="purchaseInstructionTitle"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content section--bg">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('Game Rule')</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php echo $game->instruction @endphp
                </div>
            </div>
        </div>
    </div>
@endsection


