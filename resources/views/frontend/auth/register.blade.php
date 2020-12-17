@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-body p-4">
                        {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}

                            <h1>@lang('labels.frontend.auth.register_box_title')</h1>
                            <p class="text-muted">@lang('labels.frontend.auth.create_account')</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                {{ html()->text('first_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.first_name'))
                                    ->attribute('maxlength', 191) }}
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                {{ html()->text('last_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.last_name'))
                                    ->attribute('maxlength', 191) }}
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                {{ html()->text('username')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.phone_or_email'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                {{ html()->password('password')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.password'))
                                    ->required() }}
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                {{ html()->password('password_confirmation')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                    ->required() }}
                            </div>
                        @if(config('access.captcha.registration'))
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"></span>
                                </div>
                                {!! Captcha::display() !!}
                                {{ html()->hidden('captcha_status', 'true') }}
                            </div>
                        @endif

                        {{ form_submit(__('labels.frontend.auth.register_button'), 'btn btn-block btn-success') }}
                    </div>
                        {{--<div class="card-footer p-4">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-6">--}}
                                    {{--{{ form_submit(__('labels.frontend.auth.register_button')) }}--}}
                                {{--</div>--}}
                                {{--<div class="col-6">--}}
                                    {{--<button class="btn btn-block btn-twitter" type="button">--}}
                                        {{--<span>twitter</span>--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endpush
