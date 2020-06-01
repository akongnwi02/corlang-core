@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.category.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    {{ html()->modelForm($category, 'PUT', route('admin.services.category.update', $category))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.services.category.management')
                        <small class="text-muted">@lang('labels.backend.services.category.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.category.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.category.name'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.category.code'))->class('col-md-2 form-control-label required')->for('code') }}

                        <div class="col-md-10">
                            {{ html()->text('code')
                                ->class('form-control')
                                ->disabled()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.category.code'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.category.api_key'))->class('col-md-2 form-control-label')->for('api_key') }}

                        <div class="col-md-10">
                            {{ html()->text('api_key')
                                ->class('form-control')
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.category.api_key'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.category.api_url'))->class('col-md-2 form-control-label required')->for('api_url') }}

                        <div class="col-md-10">
                            {{ html()->text('api_url')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.category.api_url'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.services.category.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.continue')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection

@push('after-styles')
    <style>
        .required:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }

        table {
            width: 70%;
            font: 17px Calibri;
        }

        table, th, td {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }
    </style>
@endpush
