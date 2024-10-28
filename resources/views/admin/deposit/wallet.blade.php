@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        @if (request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.users.deposits.method'))
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--success has-link">
                    <a class="item-link" href="{{ route('admin.deposit.successful') }}"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($successful) }}</h2>
                        <p class="text-white">@lang('Successful Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--6 has-link">
                    <a class="item-link" href="{{ route('admin.deposit.pending') }}"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($pending) }}</h2>
                        <p class="text-white">@lang('Pending Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 has-link b-radius--5 bg--pink">
                    <a class="item-link" href="{{ route('admin.deposit.rejected') }}"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                        <p class="text-white">@lang('Rejected Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 has-link b-radius--5 bg--dark">
                    <a class="item-link" href="{{ route('admin.deposit.initiated') }}"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($initiated) }}</h2>
                        <p class="text-white">@lang('Initiated Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
        @endif

        <div class="col-md-12">
            <a href="#addwallet" data-toggle="modal" class="btn my-2 btn--dark btn-rounded addwallet">Add Wallet</a>
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('S/N')</th>
                                    <th>@lang('Network')</th>
                                    <th>@lang('Wallet')</th>
                                    <th>@lang('Amount')</th>

                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($wallets as $key=> $wallet)

                                    <tr>
                                        <td>
                                            {{ $key+1 }}
                                        </td>

                                        <td>
                                            {{ $wallet->network }}
                                        </td>
                                        <td>
                                           {{ $wallet->wallet }}
                                        </td>
                                        <td>
                                            {{ $wallet->amount }}
                                        </td>


                                        <td>
                                            <a class="btn btn-sm btn-outline--primary edit" network="{{ $wallet->network }}" amount="{{ $wallet->amount }}" wallet="{{ $wallet->wallet }}" url="{{ route('admin.deposit.editwallet', $wallet->id) }}">
                                                <i class="la la-pencil"></i> @lang('Edit')
                                            </a>

                                            <button class="btn btn-sm btn-outline--danger ms-1 deleconfirmationBtn"  data-action="{{ route('admin.deposit.delwallet', $wallet->id) }}" data-question="@lang('Are you sure to delete this game '.  $wallet->network .'?')" type="button">
                                                <i class="la la-eye"></i> @lang('Delete')
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

            </div><!-- card end -->
        </div>

        <div class="modal fade" id="addwallet" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">@lang('Create New Wallet')</h5>
                        <span class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></span>
                    </div>
                    <div class="modal-body">
                            <form action="addwallet" method="post" enctype="multipart/form-data">
                                @csrf
                                <label class="font-weight-bold text-black">@lang('Network')</label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg  copytextcontent"  name="network" type="text" value=" {{ old('network')  }}">
                                </div>


                                <label class="font-weight-bold text-black">@lang('Address')</label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg copytextcontent"  name="wallet" type="text" value=" {{ old('address') }}">
                                </div>

                                <label class="font-weight-bold text-black">@lang('Amount')</label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg copytextcontent"  name="amount" type="number" value=" {{ old('address') }}">
                                </div>



                                <div class="text-center">
                                    <button type="submit"  class="btn input-group-text copytext btn--primary mt-4">Create New Wallet</button>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="editwallet" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">@lang('Edit Wallet')</h5>
                        <span class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></span>
                    </div>
                    <div class="modal-body">
                            <form id="editwallets" action="addwallet" method="post" enctype="multipart/form-data">
                                @csrf
                                <label class="font-weight-bold text-black">@lang('Network')</label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg" id="enetwork"  name="network" type="text" >
                                </div>


                                <label class="font-weight-bold text-black">@lang('Address')</label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg" id="ewallet"  name="wallet" type="text" >
                                </div>

                                <label class="font-weight-bold text-black">@lang('Amount')</label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg" id="eamount"  name="amount" type="number" >
                                </div>



                                <div class="text-center">
                                    <button type="submit"  class="btn input-group-text copytext btn--primary mt-4">Update Wallet</button>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="deletewallet" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><span id="walletdelete"></span></h5>
                        <span class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></span>
                    </div>
                    <div class="modal-body">




                                <div class="text-center">
                                    <a href="submit" id="deletewallets"  class="btn input-group-text copytext btn--danger mt-4">Delete Wallet</a>
                                </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form dateSearch='yes' />
@endpush

@push('script')
<script>
$(document).ready(function(){
    $(".addwallet").click(function(){
        $("#addwallet").modal('show')

    })


    $(document).on('click', '.edit', function(){
        var url = $(this).attr('url');
        var wallet = $(this).attr('wallet');
        // console.log(wallet);
        var network = $(this).attr('network');
        var amount = $(this).attr('amount');
        $("#ewallet").val(wallet)
        // console.log($("#wallet").val());
        $("#editwallets").attr('action', url);
        $("#enetwork").val(network)
        $("#eamount").val(amount)
        $('#editwallet').modal('show');


    })



    $(document).on('click', '.deleconfirmationBtn', function(){
        var url = $(this).attr('data-action');
        $("#deletewallets").attr('href', url);
        $('#walletdelete').text($(this).attr('data-question'));
        $('#deletewallet').modal('show');

    })
}
    )
</script>

@endpush
