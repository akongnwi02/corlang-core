@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.method.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.payment-method.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.services.method.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.services.payment-method.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.services.method.table.name')</th>
                                <th>@lang('labels.backend.services.method.table.code')</th>
                                <th>@lang('labels.backend.services.method.table.logo')</th>
                                <th>@lang('labels.backend.services.method.table.service')</th>
                                <th>@lang('labels.backend.services.method.table.active')</th>
                                <th>@lang('labels.backend.services.method.table.description_en')</th>
                                <th>@lang('labels.backend.services.method.table.description_fr')</th>
                                <th>@lang('labels.backend.services.method.table.realtime')</th>
                                <th>@lang('labels.backend.services.method.table.customercommission')</th>
                                <th>@lang('labels.backend.services.method.table.providercommission')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($methods as $method)
                                <tr>
                                    <td>{{ $method->name }}</td>
                                    <td>{{ $method->code }}</td>
                                    <td>{!! @$method->logo_label !!}</td>
                                    <td>{{ @$method->service_name }}</td>
                                    <td>{!! $method->active_label !!}</td>
                                    <td>{{ $method->description_en }}</td>
                                    <td>{{ $method->description_fr}}</td>
                                    <td>{!! $method->payment_service_label !!}</td>
                                    <td>{{ @$method->customer_commission->name }}</td>
                                    <td>{{ @$method->provider_commission->name }}</td>
                                    <td>{!! $method->action_buttons  !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $methods->total() !!} {{ trans_choice('labels.backend.services.method.table.total', $methods->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $methods->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
