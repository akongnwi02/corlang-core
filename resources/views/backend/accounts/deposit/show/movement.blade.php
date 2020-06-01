<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.code')</th>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.amount')</th>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.type')</th>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.user')</th>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.source')</th>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.destination')</th>
                    <th>@lang('labels.backend.account.deposit.tabs.content.movements.table.date')</th>

                    {{--<th>@lang('labels.general.actions')</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($movements as $movement)
                    <tr>
                        <td>{{ $movement->code }}</td>
                        <td>{{ $movement->amount_label }}</td>
                        <td><span class="badge badge-{{ $movement->class_label }}">{{ $movement->is_reversed ? __('labels.backend.account.deposit.tabs.content.movements.table.cancelled') : __($movement->type->name) }}</span></td>
                        <td>{{ $movement->user->full_name }}</td>
                        <td>{{ $movement->sourceaccount_id ? $movement->source_label : '-'}}</td>
                        <td>{{ $movement->destination_label }}</td>
                        <td>{{ $movement->created_at->toDatetimeString() }}</td>
                        <td>{!! $movement->action_buttons  !!}</td>
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
            {!! $movements->total() !!} {{ trans_choice('labels.backend.account.deposit.tabs.content.movements.table.total', $movements->total()) }}
        </div>
    </div><!--col-->

    <div class="col-5">
        <div class="float-right">
            {!! $movements->render() !!}
        </div>
    </div><!--col-->
</div><!--row-->
