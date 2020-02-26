@extends('backend.layouts.app')

@section('title', __('labels.backend.companies.company.management') . ' | ' . __('labels.backend.companies.company.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.companies.company.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.companies.company.management')
                        <small class="text-muted">@lang('labels.backend.companies.company.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.phone'))->class('col-md-2 form-control-label required')->for('phone') }}

                        <div class="col-md-10">
                            {{ html()->text('phone')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.phone'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->text('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.email'))
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.address'))->class('col-md-2 form-control-label required')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->text('address')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.address'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.website'))->class('col-md-2 form-control-label')->for('website') }}

                        <div class="col-md-10">
                            {{ html()->text('website')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.website'))
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.street'))->class('col-md-2 form-control-label')->for('street') }}

                        <div class="col-md-10">
                            {{ html()->text('street')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.street'))
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.city'))->class('col-md-2 form-control-label required')->for('city') }}

                        <div class="col-md-10">
                            {{ html()->text('city')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.city'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.state'))->class('col-md-2 form-control-label required')->for('state') }}

                        <div class="col-md-10">
                            {{ html()->text('state')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.state'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.postal_code'))->class('col-md-2 form-control-label')->for('postal_code') }}

                        <div class="col-md-10">
                            {{ html()->text('postal_code')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.postal_code'))
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.size'))->class('col-md-2 form-control-label')->for('size') }}

                        <div class="col-md-10">
                            {{ html()->text('size')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.companies.company.size'))
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.country'))->class('col-md-2 form-control-label required')->for('country_id') }}

                        <div class="col-md-10">
                            {{ html()->select('country_id', $countries)
                                ->class('form-control')
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.provider'))->class('col-md-2 form-control-label')->for('is_provider') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('is_provider', false, 1)->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.companies.company.direct_polling'))->class('col-md-2 form-control-label')->for('direct_polling') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('direct_polling', true, 1)->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row ">
                        {{ html()->label(__('validation.attributes.backend.companies.company.type'))->class('col-md-2 form-control-label required')->for('type_id') }}

                        <div class="col-md-10">
                            @foreach($types as $type)
                                <div class="custom-control custom-radio custom-control-inline">

                                    {{ html()->radio('type_id', $type->name == config('business.company.type.informal'), $type->uuid)
                                        ->class('custom-control-input')
                                        ->id($type->uuid)
                                        ->checked()
                                        ->required()
                                     }}
                                    {{ html()->label(__($type->name))->for($type->uuid)->class('custom-control-label') }}
                                </div>
                            @endforeach
                        </div>
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.companies.company.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->form()->close() }}
@endsection

<style>
    .required:after{
        content:'*';
        color:red;
        padding-left:5px;
    }
</style>
