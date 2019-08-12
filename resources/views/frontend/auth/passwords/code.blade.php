@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.passwords.reset_password_box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">

                    {{ html()->form('POST', route('frontend.auth.password.reset.code.confirm', $uuid))->class('form-horizontal')->open() }}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.code'))->for('code') }}

                                {{ html()->text('code')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.code'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                                {{ form_submit(__('labels.frontend.passwords.confirm_code_button')) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-6 -->
    </div><!-- row -->
@endsection
