<div class="login-card">

    @error('general_error')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    @if ($purchased_code)
    <h2>{!!$purchased_code!!}</h2>
    @endif

    <form id="game" wire:submit.prevent="submit">
        @csrf
        <h3 class="f-size--28 mb-4 text-center">@lang('Current Balance') : <span
                class="base--color">{{ __($general->cur_sym) }}<span
                    class="bal">{{ showAmount(auth()->user()->balance) }}</span> </span>
        </h3>

        <div class="form-group">
            <label for="inputNoncorehub">@lang('Action')</label>
            <select id="inputNoncorehub" class="form-control select-option" wire:model="type">
                <option value="">@lang('Select One')</option>
                @foreach ($types as $k=>$ty)
                    <option value="{{ $k }}" >{{ ucwords($ty) }}
                    </option>
                @endforeach
            </select>


            @error('type')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputNoncorehub">@lang('Exam')</label>
            <select id="inputNoncorehub" class="form-control select-option" wire:model="plan" required>
                <option value="">@lang('Select One')</option>
                @foreach ($plans as $pl)
                    <option value="{{ $pl['variation_code'] }}" >{{ ucwords($pl['name']) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> @lang('Profile Code')</label>
            <input class="input-field form-control"  type="text"  wire:model.lazy="profile_code"
                 autocomplete="off" placeholder="0123456789">

            @error('profile_code')
            <p class="text-danger">{{ $message }}</p>
            @enderror    
        </div>
       
        @if ($verify_name)
        <h3 class="text-center">{{$verify_name}}</h3>
            
        @endif

     
        <div class="form-group">
            <label for="exampleInputEmail1">{{ $general->cur_sym }} @lang('Amount')</label>
            <input class="input-field form-control" readonly type="number" min="{{$service->min_limit}}" max="{{$service->max_limit}}" step="any" wire:model.defer="amount"
                value="{{ old('amount') }}" autocomplete="off" placeholder="50000">


         @error('amount')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        @if ($amount)
        <i>Discount: </i> <i class="text-success"> - {{ $general->cur_sym }}{{showAmount($discount)}} </i>
    @endif
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> @lang('Transaction PIN')</label>
            <input class="input-field form-control" type="password" maxlength="4" wire:model.defer="transaction_pin"
                  >

            @error('transaction_pin')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
       
        
        <small class="form-text text-muted"><i class="fas fa-info-circle mr-2"></i> @lang('Minimum :')
            {{ $service->min_limit + 0 }} {{ $general->cur_text }}
            | @lang('Maximum :') {{ showAmount($service->max_limit + 0) }} {{ __($general->cur_text) }}
            | <span class="text--warning"> @lang('Win Amount') @if ($service->invest_back == 1)
                    {{ showAmount($service->win + 100) }}
                @else
                    {{ showAmount($service->win) }}
                @endif @lang('%') </span></small>

        <button type="submit" class="btn btn-primary"> <span wire:loading.remove>@lang('Purchase Now') </span> <span wire:loading>Please Wait...<span  class="mx-2 spinner-border text-light" role="status"></span></span>  </button>
        <a href="" class="game-instruction text-danger mt-2" data-bs-toggle="modal"
            data-bs-target="#purchaseInstruction">@lang('Puchase Instruction')
            <i class="las la-info-circle"></i>
        </a>

    </form>
</div>