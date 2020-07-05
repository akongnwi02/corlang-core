<div class="card-content">
    <div class="card-header">
        <h5 class="card-title">
            {{--@lang('labels.backend.companies.company.tabs.content.service.management')--}}
            <small class="text-muted">@lang('labels.backend.services.method.assign', ['method' => $method->name])</small>
        </h5>
    </div>
    <div class="modal-body">
        {{ html()->form('POST', route('admin.services.method.company.store', [$method->uuid]))->class('form-horizontal')->open() }}

        <div class="row mt-4">
            <div class="col">

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.services.method.companies'))
                        ->class('col-md-3 form-control-label')
                        ->for('company_ids') }}

                    <div class="col-md-9">
                        @if($companies->count())
                            @foreach($companies as $company)
                                <div class="checkbox d-flex align-items-center">
                                    {{ html()->label(
                                            html()->checkbox('company_ids[]', $method->companies->contains($company), $company->uuid)
                                                    ->class('switch-input')
                                                    ->id('permission-'.$company->uuid)
                                                . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                            ->class('switch switch-label switch-pill switch-primary mr-2')
                                        ->for('permission-'.$company->uuid) }}
                                    {!! $company->logo_label . '&nbsp;&nbsp;&nbsp;' !!}
                                    {{ html()->label($company->name)->for('permission-'.$company->uuid) }}
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
                    {!! count($companies) !!} {{ trans_choice('labels.backend.companies.company.table.total', count($companies)) }}
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
