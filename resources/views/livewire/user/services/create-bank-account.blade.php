<div class="login-card">

    @error('general_error')
    <p class="text-danger">{{ $message }}</p>
    @enderror


    <form id="game" wire:submit.prevent="submit">
        @csrf
       

     

        <div class="form-group">
            <label for="exampleInputEmail1"> @lang('BVN')</label>
            <input class="input-field form-control"  type="text"  wire:model.lazy="bvn"
                 autocomplete="off" placeholder="BVN">

            @error('username')
            <p class="text-danger">{{ $message }}</p>
            @enderror    
        </div>
       
        @if ($verify_name)
        <h3 class="text-center">{{$verify_name}}</h3>
            
        @endif

     
        <div class="form-group">
            <label for="exampleInputEmail1"> @lang('Verify Name')</label>
            <input class="input-field form-control" type="text"  readonly  wire:model.defer="name"
                value="{{ old('amount') }}" autocomplete="off" placeholder="Elon Musk">


         @error('amount')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
       
        

        <button type="submit" class="btn btn-primary"> <span wire:loading.remove>@lang('Create Account Now') </span> <span wire:loading>Please Wait...<span  class="mx-2 spinner-border text-light" role="status"></span></span>  </button>
        

    </form>
</div>