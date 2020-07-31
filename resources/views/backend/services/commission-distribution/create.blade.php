@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.distribution.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    {{ html()->form('POST', route('admin.services.distribution.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.services.distribution.management')
                        <small class="text-muted">@lang('labels.backend.services.distribution.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission_distribution.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.commission_distribution.name'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission_distribution.description'))->class('col-md-2 form-control-label required')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->text('description')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.commission_distribution.description'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission_distribution.agent_rate'))->class('col-md-2 form-control-label required')->for('agent_rate') }}

                        <div class="col-md-10">
                            {{ html()->input('number', 'agent_rate')
                                ->class('form-control')
                                ->required()
                                ->attribute('min', 0)
                                ->attribute('step', 0.01)
                                ->attribute('max', 100)
                                ->placeholder(__('validation.attributes.backend.services.commission_distribution.agent_rate'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission_distribution.company_rate'))->class('col-md-2 form-control-label required')->for('company_rate') }}

                        <div class="col-md-10">
                            {{ html()->input('number', 'company_rate')
                                ->class('form-control')
                                ->required()
                                ->attribute('min', 0)
                                ->attribute('step', 0.01)
                                ->attribute('max', 100)
                                ->placeholder(__('validation.attributes.backend.services.commission_distribution.company_rate'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission_distribution.external_rate'))->class('col-md-2 form-control-label required')->for('external_rate') }}

                        <div class="col-md-10">
                            {{ html()->text('external_rate')
                                ->class('form-control')
                                ->required()
                                 ->attribute('min', 0)
                                 ->attribute('step', 0.01)
                                ->attribute('max', 100)
                                ->placeholder(__('validation.attributes.backend.services.commission_distribution.external_rate'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.services.distribution.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.continue')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection

<style>
    .required:after{
        content:'*';
        color:red;
        padding-left:5px;
    }
</style>
