<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.code')</th>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.amount')</th>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.comment')</th>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.user')</th>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.account')</th>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.company')</th>
                    <th>@lang('labels.backend.account.umbrella.tabs.content.movements.table.date')</th>

                    {{--<th>@lang('labels.general.actions')</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($drains as $drain)
                    <tr>
                        <td>{{ $drain->code }}</td>
                        <td>{{ $drain->amount_label }}</td>
                        <td>{{ $drain->comment }}</td>
                        <td>{{ $drain->user->full_name }}</td>
                        <td>{{ $drain->account_label }}</td>
                        <td>{{ $drain->company->name }}</td>
                        <td>{{ $drain->created_at->toDatetimeString() }}</td>

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
            {!! $drains->total() !!} {{ trans_choice('labels.backend.account.deposit.tabs.content.movements.table.total', $drains->total()) }}
        </div>
    </div><!--col-->

    <div class="col-5">
        <div class="float-right">
            {!! $drains->render() !!}
        </div>
    </div><!--col-->
</div><!--row-->
