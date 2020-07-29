@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.method.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    {{ html()->form('POST', route('admin.services.method.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.services.method.management')
                        <small class="text-muted">@lang('labels.backend.services.method.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.method.name'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.code'))->class('col-md-2 form-control-label required')->for('code') }}

                        <div class="col-md-10">
                            {{ html()->text('code')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.method.code'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.customercommission'))->class('col-md-2 form-control-label')->for('customercommission_id') }}

                        <div class="col-md-10">
                            {{ html()->select('customercommission_id', [null => null] + $commissions)
                                ->class('form-control')
                                }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.providercommission'))->class('col-md-2 form-control-label')->for('providercommission_id') }}

                        <div class="col-md-10">
                            {{ html()->select('providercommission_id', [null => null] + $commissions)
                                ->class('form-control')
                                }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.description_en'))->class('col-md-2 form-control-label required')->for('description_en') }}

                        <div class="col-md-10">
                            {{ html()->text('description_en')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.method.description_en'))}}
                        </div><!--col-->
                    </div><!--form-group-->


                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.description_fr'))->class('col-md-2 form-control-label required')->for('description_fr') }}

                        <div class="col-md-10">
                            {{ html()->text('description_fr')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.method.description_fr'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.realtime'))->class('col-md-2 form-control-label')->for('is_realtime') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('is_realtime', false, 1)->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.service'))->class('col-md-2 form-control-label')->for('service_id') }}

                        <div class="col-md-10">
                            {{ html()->select('service_id', [null => null] + $services)
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.method.logo'))->class('col-md-2 form-control-label')->for('logo') }}

                        <div class="col-md-10">
                            {{ html()->file('logo')->id('logo')->class('form-control-file') }}
                            <div class="preview">
                                {{ html()->img('#', __('validation.attributes.backend.services.service.logo'))->style('width:100px;height:100px;')->id('preview') }}
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.services.method.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.continue')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview').hide();
        }
    }

    $("#logo").change(function(){
        readURL(this);
    });
</script>
@endpush
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
