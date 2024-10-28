@extends($activeTemplate . 'layouts.master')
@section('content')
<section class="message-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="show-filter text-end mb-3">
                    <button class="cmn-btn showFilterBtn btn-sm" type="button"><i class="las la-filter"></i> @lang('Filter')</button>
                </div>
                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <div class="message_content" data-aos="fade-up">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="flex-grow-1">
                                    <label>@lang('Transaction Number')</label>
                                    <input class="form_style" name="search" type="text" value="{{ request()->search }}">
                                </div>
                                <div class="flex-grow-1">
                                    <label>@lang('Type')</label>
                                    <select class="form-control select-option" name="trx_type">
                                        <option value="">@lang('All')</option>
                                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1">
                                    <label>@lang('Remark')</label>
                                    <select class="form-control select-option" name="remark">
                                        <option value="">@lang('Any')</option>
                                        @foreach ($remarks as $remark)
                                        <option value="{{ $remark->name }}" @selected(request()->remark == $remark->name)>{{ __(keyToTitle($remark->name)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow-1 align-self-end">
                                    <button class="submit"><i class="las la-filter"></i> @lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table--responsive">
                            <table class="style--two table">
                                <thead>
                                    <tr>
                                        <th>@lang('Trx')</th>
                                        <th>@lang('Transacted')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Post Balance')</th>
                                        <th>@lang('Detail')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $trx)
                                    <tr>
                                        <td>
                                            <strong>{{ $trx->trx }}</strong>
                                        </td>

                                        <td>
                                            {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                        </td>
                                        <td>
                                            <span class="badge badge-{{$trx->status != null ? $trx->status->message_color :"secondary" }}"> @lang($trx->status!=null? $trx->status->name:"Nill") </span>
                                        </td>

                                        <td class="budget">
                                            <span class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                                {{ $general->cur_sym }}{{ showAmount($trx->amount) }} 
                                            </span>
                                        </td>

                                        <td class="budget">
                                            {{ __($general->cur_sym) }}{{ showAmount($trx->post_balance) }} 
                                        </td>

                                        <td>{{ __($trx->details) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($transactions->hasPages())
                    <div class="card-footer">
                        {{ paginateLinks($transactions) }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection