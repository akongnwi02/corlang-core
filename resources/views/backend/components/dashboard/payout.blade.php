<div class="modal fade" id="payoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle">
                    <span class="title-text"></span>
                    <br/>
                    <small class="text-muted">@lang('labels.backend.account.commission_balance'): <strong class="balance">{{ $companyCommissionBalance }}</strong></small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('buttons.general.cancel')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ html()->form('PATCH', route('admin.account.payout', $account->uuid))->class('form-horizontal')->open() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">{{ $default_currency->code }}</span>
                    </div>
                    <input name="amount" type="number" step="0.01" min="0" class="form-control" placeholder="@lang('validation.attributes.backend.account.amount')" required>
                    <input name="currency_id" type="hidden" value="{{ $default_currency->uuid }}">
                </div>
                <div>
                    {{ html()->select('paymentmethod_id' , [null => __(config('business.system.service.name'))] + $paymentMethods)
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.account.payment_method'))
                    }}
                </div>
                <br/>
                <div>
                    <input name="comment" type="text" class="form-control" placeholder="@lang('validation.attributes.backend.account.comment')">
                </div>
                <br/>
                <div>
                    <input name="account_number" type="text" class="form-control" placeholder="@lang('validation.attributes.backend.account.number')">
                </div>

                <div class="modal-footer">
                    <button type="button" class="'btn btn-secondary btn-sm" data-dismiss="modal">@lang('buttons.general.cancel')</button>
                    {{ form_submit(__('labels.backend.account.request_payout')) }}
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>

