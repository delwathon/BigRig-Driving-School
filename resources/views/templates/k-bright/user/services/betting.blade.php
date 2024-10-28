@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="login-form d-flex align-items-center">
        <div class="container">

            <div class="login-form-box">
                <div class="login-card">
                    <form id="game" method="post">
                        @csrf
                        <h3 class="f-size--28 mb-4 text-center">@lang('Current Balance') : <span
                                class="base--color">{{ __($general->cur_sym) }}<span
                                    class="bal">{{ showAmount(auth()->user()->balance) }}</span> </span>
                        </h3>

                        <div class="form-group">
                            <label for="inputNoncorehub">@lang('Network')</label>
                            <select id="inputNoncorehub" class="form-control select-option"name="network" required>
                                <option value="">@lang('Select One')</option>
                                @foreach (['mtn'] as $network)
                                    <option value="{{ $network }}" @selected(old('plan') == $network)>{{ ucwords($network) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputNoncorehub">@lang('Plan')</label>
                            <select id="inputNoncorehub" class="form-control select-option"name="plan" required>
                                <option value="">@lang('Select One')</option>
                                @foreach (['plan'] as $network)
                                    <option value="{{ $network }}" @selected(old('plan') == $network)>{{ ucwords($network) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ $general->cur_sym }} @lang('Debit Amount')</label>
                            <input class="input-field form-control" readonly type="number" step="any" name="amount"
                                value="{{ old('amount') }}" autocomplete="off" placeholder="50000">
                        </div>
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-2"></i> @lang('Minimum :')
                            {{ $game->min_limit + 0 }} {{ $general->cur_text }}
                            | @lang('Maximum :') {{ showAmount($game->max_limit + 0) }} {{ __($general->cur_text) }}
                            | <span class="text--warning"> @lang('Win Amount') @if ($game->invest_back == 1)
                                    {{ showAmount($game->win + 100) }}
                                @else
                                    {{ showAmount($game->win) }}
                                @endif @lang('%') </span></small>
                {{-- </div> --}}
                {{-- <div class="mt-5 text-center">
                    <button class="btn btn-primary" type="submit">@lang('Purchase Now')</button>
                  
                </div> --}}
                <button type="submit" class="btn btn-primary">@lang('Purchase Now')</button>
                <a href="" class="game-instruction text-danger mt-2" data-bs-toggle="modal"
                data-bs-target="#purchaseInstruction">@lang('Puchase Instruction')
                <i class="las la-info-circle"></i>
            </a>

                </form>
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


