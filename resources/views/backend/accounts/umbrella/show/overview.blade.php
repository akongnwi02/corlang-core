<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.code')</th>
                <td>{{ $account->code }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.owner')</th>
                <td>{{ $account->owner_label }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.account.deposit.tabs.content.overview.balance')</th>
                <td>{{ $account->umbrella_balance_label }}</td>
            </tr>

        </table>
    </div>
</div><!--table-responsive-->
