@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.account.payout.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')

    @include('backend.accounts.payout.includes.request-payout')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.account.payout.management')
                    </h4>
                </div><!--col-->

                {{--<div class="col-sm-7">--}}
                {{--@include('backend.services.service.includes.header-buttons')--}}
                {{--</div><!--col-->--}}
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.account.payout.table.code')</th>
                                <th>@lang('labels.backend.account.payout.table.type')</th>
                                <th>@lang('labels.backend.account.payout.table.owner')</th>
                                <th>@lang('labels.backend.account.payout.table.balance')</th>
                                <th>@lang('labels.backend.account.payout.table.pending')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td>{{ $account->code }}</td>
                                    <td>{{ __($account->type->name) }}</td>
                                    <td>{{ $account->owner_label }}</td>
                                    {{--<td>{!! $account->active_label !!}</td>--}}
                                    <td class="balance" id="{{ $account->uuid }}">{{ $account->commission_balance_label }}</td>
                                    <td>{{ $account->pending_payouts }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="@lang('labels.backend.account.payout.actions')">
                                            @can(config('permission.permissions.read_accounts'))
                                                <a href="{{ route('admin.account.payout.show', $account->uuid) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can(config('permission.permissions.request_payouts'))
                                                <button name="payoutPopup" id="{{ $account->uuid }}" title="@lang('labels.backend.account.request_payout')" class="btn btn-danger"><i class="fas fa-arrow-down"></i></button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $accounts->total() !!} {{ trans_choice('labels.backend.account.payout.table.total', $accounts->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $accounts->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

@push('after-scripts')
    <script>

        $(function () {
            $("button[name='payoutPopup']").click(function () {
                let title = this.title;
                let id = this.id;
                let balance = $(`td[id='${id}']`).html();

                $("#payoutModal .title-text").html(title);
                $("#payoutModal button[type='submit']").html(title);
                $("#payoutModal strong[class='balance']").html(balance);
                $("#payoutModal form").attr('action', `/admin/account/${id}/payout`);

                $("#payoutModal").modal("show");
            });
        });

    </script>
@endpush
