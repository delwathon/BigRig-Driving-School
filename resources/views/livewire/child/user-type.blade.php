<div  wire:ignore.self class="modal fade" id="addModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @if ($editId)
                    @lang("Update")
                @else
                    @lang('Add New') 
                @endif {{ __(keyToTitle($key)) }} @lang('Item')</h5>
                <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>User Type Logo</label>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-image: url({{ $editId ? getImage('assets/images/user_type/'. $image):$image }})">
                                        <button class="remove-image" type="button"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input class="profilePicUpload" id="addImage{{ "logo"}}"  wire:model.defer="logo" type="file" accept=".png, .jpg, .jpeg">
                                    <label class="bg--success" for="addImage{{ "logo" }}">User Type Logo</label>
                                    <small class="mt-2">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>.
                                     
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __("Name") }}</label>
                        <input class="form-control" type="text"
                        wire:model.defer="name"  required />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __("General Discount") }}</label>
                        <input class="form-control" type="number" step="0.01"
                        wire:model.defer="discount"  required />
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>




                    {{-- @foreach ($section->element as $k => $type)
                        @if ($k != 'modal')
                            @if ($type == 'icon')
                                <div class="form-group">
                                    <label>{{ __(keyToTitle($k)) }}</label>
                                    <div class="input-group">
                                        <input class="form-control iconPicker icon" wire:model.defer="category.{{ $k }}" type="text" autocomplete="off" required>
                                        <span class="input-group-text input-group-addon" data-icon="las la-home" role="iconpicker"></span>
                                        @error('category.'.$k)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                            @elseif($k == 'select')
                                <div class="form-group">
                                    <label>{{ keyToTitle(@$section->element->$k->name) }}</label>
                                   
                                    <select class="form-control"  wire:model.defer="category.{{ @$section->element->$k->name }}">
                                        @foreach ($section->element->$k->options as $selectKey => $options)
                                            <option value="{{ $selectKey }}">{{ $options }}</option>
                                        @endforeach
                                    </select>

                                    @error('category.'.@$section->element->$k->name)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            @elseif($k == 'images')
                                @foreach ($type as $imgKey => $image)
                                    <input  wire:model.defer="category.has_image" type="hidden" value="1">
                                    <div class="form-group">
                                        <label>{{ __(keyToTitle($k)) }}</label>
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview" style="background-image: url({{ getImage('/', @$section->element->images->$imgKey->size) }})">
                                                        <button class="remove-image" type="button"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input class="profilePicUpload" id="addImage{{ $loop->index }}"  wire:model.defer="category.image_input[{{ $imgKey }}]" type="file" accept=".png, .jpg, .jpeg">
                                                    <label class="bg--success" for="addImage{{ $loop->index }}">{{ __(keyToTitle($imgKey)) }}</label>
                                                    <small class="mt-2">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>.
                                                        @if (@$section->element->images->$imgKey->size)
                                                            | @lang('Will be resized to'): <b>{{ @$section->element->images->$imgKey->size }}</b> @lang('px').
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($type == 'textarea')
                                <div class="form-group">
                                    <label>{{ __(keyToTitle($k)) }}</label>
                                    <textarea class="form-control"  wire:model.defer="category.{{ $k }}" rows="4" required></textarea>
                                    @error('category.'.$k)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            @elseif($type == 'textarea-nic')
                                <div class="form-group">
                                    <label>{{ __(keyToTitle($k)) }}</label>
                                    <textarea class="form-control nicEdit"  wire:model.defer="category.{{ $k }}" rows="4"></textarea>
                                    @error('category.'.$k)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="form-group">
                                    <label>{{ __(keyToTitle($k)) }}</label>
                                    <input class="form-control" @if ($type=="number")
                                        step="0.01"
                                    @endif  
                                    wire:model.defer="category.{{ $k }}" type="{{$type}}" required />
                                    @error('category.'.$k)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        @endif
                    @endforeach --}}



                </div>


                <div class="modal-footer">
                    <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>