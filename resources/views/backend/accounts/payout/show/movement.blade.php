<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.code')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.amount')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.method')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.number')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.name')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.user')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.account')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.company')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.status')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.date')</th>

                    <th>@lang('labels.general.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payouts as $payout)
                    <tr>
                        <td>{{ $payout->code }}</td>
                        <td>{{ $payout->amount_label }}</td>
                        <td>{{ @$payout->method->name ?: config('business.system.service.name') }}</td>
                        <td>{{ $payout->account_number }}</td>
                        <td>{{ $payout->account_name }}</td>
                        <td>{{ $payout->user->full_name }}</td>
                        <td>{{ $payout->account_label }}</td>
                        <td>{{ $payout->company->name }}</td>
                        <td>{!! $payout->status_label !!}</td>
                        <td>{{ $payout->created_at->toDatetimeString() }}</td>
                        <td>
                            @if($payout->status == config('business.payout.status.pending'))
                                <div class="btn-group" role="group" aria-label="@lang('labels.backend.account.payout.actions')">
                                    @can(config('permission.permissions.cancel_payouts'))
                                        <a href="{{ route('admin.payout.mark', [$payout, config('business.payout.status.cancelled')]) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.payout.cancel')" class="btn btn-dark"><i class="fas fa-ban"></i></a>
                                    @endcan
                                    @can(config('permission.permissions.reject_payouts'))
                                        <a href="{{ route('admin.payout.mark', [$payout, config('business.payout.status.rejected')]) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.payout.reject')" class="btn btn-danger"><i class="fas fa-times"></i></a>
                                    @endcan
                                    @can(config('permission.permissions.approve_payouts'))
                                        <a href="{{ route('admin.payout.mark', [$payout, config('business.payout.status.approved')]) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.payout.approve')" class="btn btn-success"><i class="fas fa-check"></i></a>
                                    @endcan
                                </div>
                            @endif
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
            {!! $payouts->total() !!} {{ trans_choice('labels.backend.account.deposit.tabs.content.movements.table.total', $payouts->total()) }}
        </div>
    </div><!--col-->

    <div class="col-5">
        <div class="float-right">
            {!! $payouts->render() !!}
        </div>
    </div><!--col-->
</div><!--row-->
