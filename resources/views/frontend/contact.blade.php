@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
    <div class="container">
        <div class="row">
            <!-- Section Titile -->
            <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                <h1 class="section-title">@lang('strings.frontend.contact_us.title')</h1>
            </div>
        </div>
        <div class="row">
            <!-- Section Titile -->
            <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                <p>@lang('strings.frontend.contact_us.text')</p>

                <div class="find-widget">
                    @lang('strings.frontend.contact_us.company'):  <a href="https://corlang.com">Corlang Limited</a>
                </div>
                <div class="find-widget">
                    @lang('strings.frontend.contact_us.address'): <a href="#">Cassava Farms, Limbe, South West</a>
                </div>
                <div class="find-widget">
                    @lang('strings.frontend.contact_us.phone'):  <a href="#">+237 650 380 012</a>
                </div>
                <div class="find-widget">
                    @lang('strings.frontend.contact_us.email'):  <a href="#">contact@corlang.com</a>
                </div>

                <div class="find-widget">
                    @lang('strings.frontend.contact_us.website'):  <a href="https://corlang.com">www.corlang.com</a>
                </div>
                <div class="find-widget">
                    @lang('strings.frontend.contact_us.work_hours'): <a href="#">@lang('strings.frontend.contact_us.monday') @lang('strings.frontend.contact_us.to') @lang('strings.frontend.contact_us.saturday'): 08:30 - 22:30</a>
                </div>
            </div>
            <!-- contact form -->
            <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                <div class="card">
                <div class="card-body">
                    {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.email'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

                                {{ html()->text('phone')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.phone'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.subject'))->for('subject') }}

                                {{ html()->text('subject')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.subject'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.message'))->for('message') }}

                                {{ html()->textarea('message')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.message'))
                                    ->attribute('rows', 3) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                                {{ form_submit(__('labels.frontend.contact.button')) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!--card-body-->
                </div><!--card-->
            </div>
        </div>
    </div>
@endsection
