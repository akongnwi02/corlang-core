@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')

    <div class="app-body">
        <main class="main d-flex align-items-center">
            <div class="container">
                <div class="row  justify-content-center align-items-center">
                    <div class="col-md-8 mx-auto">
                        <div class="card-group">
                            <div class="card p-4">
                                <div class="card-body">
                                    {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                                        <h1>@lang('labels.frontend.auth.login_box_title')</h1>
                                        <p class="text-muted">@lang('labels.frontend.auth.login_to_account')</p>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            {{ html()->text('username')
                                                ->class('form-control')
                                                ->placeholder(__('validation.attributes.frontend.username'))
                                                ->attribute('maxlength', 191)
                                                ->required() }}
                                        </div><!--form-group-->

                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                                            </div>
                                            {{ html()->password('password')
                                                ->class('form-control')
                                                ->placeholder(__('validation.attributes.frontend.password'))
                                                ->required() }}
                                        </div><!--form-group-->

                                        <div class="input-group mb-4">
                                            <div class="checkbox">
                                                {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                            </div>
                                        </div><!--form-group-->



                                        <div class="row">
                                            <div class="col-6">
                                                {{ form_submit(__('labels.frontend.auth.login_button'), 'btn btn-primary px-4') }}
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('frontend.auth.password.reset.init.form') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                                            </div>
                                        </div>
                                    {{ html()->form()->close() }}
                                </div>
                            </div>
                            @if(config('access.registration'))
                                <div class="card text-white bg-primary py-5 d-md-down-none">
                                    <div class="card-body text-center">
                                        <div>
                                            <h2>Sign up</h2>
                                            <p>@lang('labels.frontend.auth.no_account')</p>
                                            <p>@lang('labels.frontend.auth.register_now')</p>
                                            <p>@lang('labels.frontend.auth.quick')</p>
                                            <a href="{{ route('frontend.auth.register') }}" type="button" class="btn btn-primary active mt-3">@lang('labels.frontend.auth.register_now')</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
