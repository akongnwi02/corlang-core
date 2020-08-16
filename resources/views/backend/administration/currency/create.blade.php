@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.administration.currency.management'))

@section('breadcrumb-links')
    {{--@include('backend.administration.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    {{ html()->form('POST', route('admin.administration.currency.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.administration.currency.management')
                        <small class="text-muted">@lang('labels.backend.administration.currency.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.administration.currency.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.administration.currency.name'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.administration.currency.code'))->class('col-md-2 form-control-label required')->for('code') }}

                        <div class="col-md-10">
                            {{ html()->text('code')
                                ->class('form-control')
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.administration.currency.code'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.administration.currency.rate'))->class('col-md-2 form-control-label required')->for('rate') }}

                        <div class="col-md-10">
                            {{ html()->text('rate')
                                ->class('form-control')
                                ->attribute('maxlength', 191)
                                ->required()
                                ->placeholder(__('validation.attributes.backend.administration.currency.rate'))}}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.administration.currency.index'), __('buttons.general.cancel')) }}
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
