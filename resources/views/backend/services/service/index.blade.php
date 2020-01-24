@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.service.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.services.service.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    {{--@include('backend.services.service.includes.header-buttons')--}}
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.services.service.table.name')</th>
                                <th>@lang('labels.backend.services.service.table.code')</th>
                                <th>@lang('labels.backend.services.service.table.active')</th>
                                <th>@lang('labels.backend.services.service.table.gateway')</th>
                                <th>@lang('labels.backend.services.service.table.category')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->code }}</td>
                                    <td>{!! $service->active_label !!}</td>
                                    <td>{{ $service->gateway->name }}</td>
                                    <td>{{ $service->category->name }}</td>
                                    <td>{!! $service->action_buttons  !!}</td>
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
                        {!! $services->total() !!} {{ trans_choice('labels.backend.services.service.table.total', $services->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $services->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
