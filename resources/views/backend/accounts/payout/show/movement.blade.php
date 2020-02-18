<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.code')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.amount')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.comment')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.user')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.account')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.company')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.status')</th>
                    <th>@lang('labels.backend.account.payout.tabs.content.movements.table.date')</th>

                    {{--<th>@lang('labels.general.actions')</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($payouts as $payout)
                    <tr>
                        <td>{{ $payout->code }}</td>
                        <td>{{ $payout->amount_label }}</td>
                        <td>{{ $payout->comment }}</td>
                        <td>{{ $payout->user->full_name }}</td>
                        <td>{{ $payout->account_label }}</td>
                        <td>{{ $payout->company->name }}</td>
                        <td>{{ $payout->status_label }}</td>
                        <td>{{ $payout->created_at->toDatetimeString() }}</td>

                        {{--<td>{!! $movement->action_buttons  !!}</td>--}}
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
