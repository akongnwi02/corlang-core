<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.code')</th>
                <td>{{ $account->code }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.type')</th>
                <td>{{ ucwords(__($account->type->name)) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.owner')</th>
                <td>{{ $account->owner_label }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.active')</th>
                <td>{!! $account->active_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.balance')</th>
                <td>{{ $account->account_balance_label }}</td>
            </tr>

        </table>
    </div>
</div><!--table-responsive-->
