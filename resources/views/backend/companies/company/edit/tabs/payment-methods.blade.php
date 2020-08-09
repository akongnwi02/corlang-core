<div class="row">
    <div class="col-sm-5">
        <h4 class="card-title mb-0">
            @lang('labels.backend.services.method.management')
        </h4>
    </div><!--col-->

    <div class="col-sm-7">
        @can(config('permission.permissions.create_company_services'))
            <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#addMethods" title="@lang('labels.general.toggle')">
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </div><!--btn-toolbar-->
        @endcan
    </div><!--col-->
</div><!--row-->

<div class="row mt-4">
    <div class="col">
        <div>
            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th>@lang('labels.backend.companies.company.tabs.content.paymentmethod.table.name')</th>
                    <th>@lang('labels.backend.companies.company.tabs.content.paymentmethod.table.code')</th>
                    {{--<th>@lang('labels.backend.companies.company.tabs.content.paymentmethod.table.logo')</th>--}}
                    <th>@lang('labels.backend.companies.company.tabs.content.paymentmethod.table.active')</th>
                    <th>@lang('labels.backend.companies.company.tabs.content.paymentmethod.table.customercommission')</th>
                    <th>@lang('labels.backend.companies.company.tabs.content.paymentmethod.table.providercommission')</th>
                    <th>@lang('labels.general.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companyMethods as $method)
                    <tr>
                        <td>{!! @$method->logo_label !!} {{ $method->name }}</td>
                        <td>{{ $method->code }}</td>
                        {{--<td>{!! @$method->logo_label !!}</td>--}}
                        <td>{!! $method->specific->active_label !!}</td>
                        <td>{{ ! is_null($method->specific->customercommission_id) ? @$method->specific->customer_commission->name : @$method->customer_commission->name }}</td>
                        <td>{{ ! is_null($method->specific->providercommission_id) ? @$method->specific->provider_commission->name : @$method->provider_commission->name }}</td>
                        <td>
                            @can(config('permission.permissions.update_company_services'))
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#method-{{ $method->uuid }}" data-placement="top" title="@lang('buttons.general.crud.edit')"><i class="fas fa-edit"></i></button>
                            @endcan
                        </td>
                    </tr>
                    <div class="modal fade" id="method-{{ $method->uuid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalCenterTitle">
                                        @lang('labels.backend.companies.company.tabs.content.paymentmethod.management')
                                        <small class="text-muted">@lang('labels.backend.companies.company.tabs.content.paymentmethod.edit', ['company' => $company->name])</small>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('buttons.general.cancel')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ html()->form('PUT', route('admin.companies.company.method.update', [$company->uuid, $method->uuid]))->class('form-horizontal')->open() }}

                                    <div class="form-group">
                                        <label for="customercommission_id" class="col-form-label">@lang('validation.attributes.backend.companies.paymentmethod.customercommission')</label>
                                        <div class="form-check mb-2 mr-sm-2">
                                            <label class="form-check-label" ><input type="checkbox" name="customer-default" class="form-check-input" id="{{ $method->uuid }}"/> @lang('validation.attributes.backend.companies.paymentmethod.default_setting') ({{ @$method->customer_commission->name ?: '-'.__('labels.general.none'). '-' }})</label>
                                        </div>
                                        {{ html()->select('customercommission_id' , [null => null ] + $commissions)
                                            ->class('form-control')
                                            ->value($method->specific->customercommission_id)
                                         }}
                                    </div>

                                    <div class="form-group">
                                        <label for="providercommission_id" class="col-form-label">@lang('validation.attributes.backend.companies.paymentmethod.providercommission')</label>
                                        <div class="form-check mb-2 mr-sm-2">
                                            <label class="form-check-label" ><input type="checkbox" name="provider-default" class="form-check-input" id="{{ $method->uuid }}"/> @lang('validation.attributes.backend.companies.paymentmethod.default_setting') ({{ @$method->provider_commission->name ?: '-'.__('labels.general.none'). '-' }})</label>
                                        </div>
                                        {{ html()->select('providercommission_id' , [null => null ] + $commissions)
                                            ->class('form-control')
                                            ->value($method->specific->providercommission_id)
                                        }}
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="'btn btn-secondary btn-sm" data-dismiss="modal">@lang('buttons.general.cancel')</button>
                                        {{ form_submit(__('buttons.general.crud.update')) }}
                                    </div>

                                    {{ html()->form()->close() }}
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!--col-->
</div><!--row-->
<div class="row">
    <div class="col-12">
        <div class="float-left">
            {!! count($companyMethods) !!} {{ trans_choice('labels.backend.companies.company.tabs.content.paymentmethod.table.total', count($companyMethods)) }}
        </div>
    </div><!--col-->
</div><!--row-->



<!-- Modal -->
<div class="modal fade" id="addMethods" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMethods">
                    {{--@lang('labels.backend.companies.company.tabs.content.service.management')--}}
                    <small class="text-muted">@lang('labels.backend.companies.company.tabs.content.paymentmethod.add', ['company' => $company->name])</small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ html()->form('POST', route('admin.companies.company.method.store', [$company->uuid]))->class('form-horizontal')->open() }}

                <div class="row mt-4">
                    <div class="col">

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.companies.paymentmethod.methods'))
                                ->class('col-md-3 form-control-label')
                                ->for('method_ids') }}

                            <div class="col-md-9">
                                @if($paymentMethods->count())
                                    @foreach($paymentMethods as $method)
                                        <div class="checkbox d-flex align-items-center">
                                            {{ html()->label(
                                                    html()->checkbox('method_ids[]', $company->methods->contains($method), $method->uuid)
                                                            ->class('switch-input')
                                                            ->id('permission-'.$method->uuid)
                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                ->for('permission-'.$method->uuid) }}
                                            {!! $method->logo_label . '&nbsp;&nbsp;&nbsp;' !!}
                                            {{ html()->label($method->name)->for('permission-'.$method->uuid) }}
                                        </div>
                                    @endforeach
                                @endif
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->

                </div><!--row-->
                <div class="row">
                    <div class="col-12">
                        <div class="float-left">
                            {!! count($paymentMethods) !!} {{ trans_choice('labels.backend.services.method.table.total', count($paymentMethods)) }}
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--modal-body-->
            <div class="modal-footer">
                <button type="button" class="'btn btn-secondary btn-sm" data-dismiss="modal">@lang('buttons.general.cancel')</button>
                {{ form_submit(__('buttons.general.crud.update')) }}
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@push('after-scripts')
    <script>
        $('input[name="customer-default"]').click(function(){
            let id = $(this).attr('id');
            $('select[name="customercommission_id"][id="customercommission_id"]').attr('disabled', this.checked).val('')
        });

        $('input[name="provider-default"]').click(function(){
            let id = $(this).attr('id');
            $('select[name="providercommission_id"][id="providercommission_id"]').attr('disabled', this.checked).val('')
        });
    </script>
@endpush
