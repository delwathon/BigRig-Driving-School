@extends('admin.layouts.app')
@section('panel')


    @if (@$section->element)
        <div class="d-flex justify-content-end mb-3 flex-wrap">
            <div class="d-inline">
                <div class="input-group justify-content-end">
                    <input class="form-control bg--white" name="search_table" type="text" placeholder="@lang('Search')...">
                    <button class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm table-responsive">
                            {{-- <table class="table--light style--two custom-data-table table">
                                <thead>
                                    <tr>
                                        <th>@lang('SL')</th>
                                        @if (@$section->element->images)
                                            <th>@lang('Image')</th>
                                        @endif
                                        @foreach ($section->element as $k => $type)
                                            @if ($k != 'modal')
                                            @if ($type == 'text' || $type == 'icon'|| $type == 'email'|| $type == 'tel'|| $type == 'number'|| $type == 'color'|| $type == 'date'|| $type == 'datetime'|| $type == 'time'|| $type == 'range')
                                            <th>{{ __(keyToTitle($k)) }}</th>
                                                @elseif($k == 'select')
                                                    <th>{{ keyToTitle(@$section->element->$k->name) }}</th>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if (@request()->key == 'blog')
                                            <th>@lang('Total Views')</th>
                                        @endif
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @forelse($elements as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if (@$section->element->images)
                                                @php $firstKey = collect($section->element->images)->keys()[0]; @endphp
                                                <td>
                                                    <div class="customer-details d-block">
                                                        <a class="thumb" href="javascript:void(0)">
                                                            <img src="{{ getImage('assets/images/frontend/' . $key . '/' . @$data->$firstKey, @$section->element->images->$firstKey->size) }}" alt="@lang('image')">
                                                        </a>
                                                    </div>
                                                </td>
                                            @endif
                                            @foreach ($section->element as $k => $type)
                                                @if ($k != 'modal')
                                                @if ($type == 'text' || $type == 'icon'|| $type == 'email'|| $type == 'tel'|| $type == 'number'|| $type == 'color'|| $type == 'date'|| $type == 'datetime'|| $type == 'time'|| $type == 'range')
                                                        @if ($type == 'icon')
                                                            <td>@php echo @$data->$k; @endphp</td>
                                                        @else
                                                            <td>{{ __(@$data->$k) }}</td>
                                                        @endif
                                                    @elseif($k == 'select')
                                                        @php
                                                            $dataVal = @$section->element->$k->name;
                                                        @endphp
                                                        <td>{{ @$data->$dataVal }}</td>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if (@request()->key == 'blog')
                                                <td>
                                                    {{ @$data->views }}
                                                </td>
                                            @endif
                                            <td>
                                                <div class="button--group">
                                                    @if ($section->element->modal)
                                                        @php
                                                            $images = [];
                                                            if (@$section->element->images) {
                                                                foreach ($section->element->images as $imgKey => $imgs) {
                                                                    $images[] = getImage('assets/images/frontend/' . $key . '/' . @$data->$imgKey, @$section->element->images->$imgKey->size);
                                                                }
                                                            }
                                                        @endphp
                                                        <button class="btn btn-sm btn-outline--primary updateBtn" data-id="{{ $data->id }}" data-all="{{ json_encode($data->data_values) }}" @if (@$section->element->images) data-images="{{ json_encode($images) }}" @endif>
                                                            <i class="la la-pencil-alt"></i> @lang('Edit')
                                                        </button>
                                                    @else
                                                        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.category.sections.element', [$key, $data->id]) }}"><i class="la la-pencil-alt"></i> @lang('Edit')</a>
                                                    @endif
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.category.remove', $data->id) }}" data-question="@lang('Are you sure to remove this item?')"><i class="la la-trash"></i> @lang('Remove')</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table> --}}




                            <table class="table--light style--two table">
                                <thead>
                                    <tr>
                                        <th>@lang('Logo')</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Discount')</th>
                                       
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($elements as $type)
                                        <tr>
                                            <td>
                                                <div class="customer-details d-block">
                                                    <a class="thumb" href="javascript:void(0)">
                                                        <img src="{{ getImage('assets/images/user_type/' . @$type->logo) }}" alt="{{$type->name}}">
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ __($type->name) }}</td>
                                            <td>{{ showAmount($type->discount) }}%</td>
                                         
                                            <td>
                                                <a data-id="{{ $type->id }}" class="btn btn-sm btn-outline--primary updateBtn" >
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
                                            
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      

        @push('breadcrumb-plugins')
                @if ($section->element->modal)
                    <a class="btn btn-sm btn-outline--primary addBtn" href="#addModal" data-bs-toggle="modal"><i class="las la-plus"></i>@lang('Add New')</a>
                @else
                    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.frontend.sections.element', $key) }}"><i class="las la-plus"></i>@lang('Add New')</a>
                @endif
        @endpush
    @endif
    {{-- if section element end --}}

    @livewire('child.user-type')

    <x-confirmation-modal />

@endsection

@push('style-lib')
    <link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            // $('.addBtn').on('click', function() {
            //     var modal = $('#addModal');
            //     modal.modal('show');
            // });
            $('.updateBtn').on('click', function() {
                var id = $(this).data('id');
                console.log(id);


                Livewire.emit('edit',id);
                var modal = $('#addModal');
                modal.modal('show');
              
            });

            $('#updateBtn').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('#addModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
