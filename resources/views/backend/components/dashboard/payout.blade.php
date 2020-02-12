<div class="modal fade" id="requestPayout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle">
                    @lang('labels.backend.account.payout')
                    {{--<small class="text-muted">@lang('labels.backend.account.payout')</small>--}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('buttons.general.cancel')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ html()->form('PATCH', route('admin.account.payout', [$account->uuid]))->class('form-horizontal')->open() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">{{ $currency->code }}</span>
                    </div>
                    <input name="amount" type="number" step="0.01" min="0" class="form-control" placeholder="@lang('validation.attributes.backend.account.amount')" required>
                    <input name="currency_id" type="hidden" value="{{ $currency->uuid }}">

                </div>

                <div class="modal-footer">
                    <button type="button" class="'btn btn-secondary btn-sm" data-dismiss="modal">@lang('buttons.general.cancel')</button>
                    {{ form_submit(__('buttons.backend.account.payout')) }}
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>
