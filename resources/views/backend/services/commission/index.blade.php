@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.commission.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.services.commission.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.services.commission.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.services.commission.table.name')</th>
                                <th>@lang('labels.backend.services.commission.table.description')</th>
                                <th>@lang('labels.backend.services.commission.table.stack.title')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commissions as $commission)
                                <tr>
                                    <td>{{ $commission->name }}</td>
                                    <td>{{ $commission->description }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-info" role="button" data-toggle="collapse" href="#log-stack-{{ $commission->uuid }}" aria-expanded="false" aria-controls="log-stack-{{ $commission->uuid }}">
                                            <i class="fa fa-toggle-on"></i> Stack
                                        </a>
                                    </td>
                                    <td>{!! $commission->action_buttons  !!}</td>
                                </tr>
                                <tr class="stack-content collapse" id="log-stack-{{ $commission->uuid }}">
                                    @foreach($commission->pricings as $pricing)
                                        <tr colspan="5" class="stack">
                                            <th>@lang('labels.backend.services.commission.table.stack.from')</th>
                                            <th>@lang('labels.backend.services.commission.table.stack.to')</th>
                                            <th>@lang('labels.backend.services.commission.table.stack.fixed')</th>
                                            <th>@lang('labels.backend.services.commission.table.stack.percentage')</th>
                                            <th>@lang('labels.backend.services.commission.table.stack.currency')</th>
                                        </tr>
                                        <tr>
                                            <th>{{ $pricing->from }}</th>
                                            <th>{{ $pricing->to }}</th>
                                            <th>{{ $pricing->fixed }}</th>
                                            <th>{{ $pricing->percentage }}</th>
                                            <th>{{ $commission->currency->code }}</th>
                                        <tr>
                                    @endforeach
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
                        {!! $commissions->total() !!} {{ trans_choice('labels.backend.services.commission.table.total', $commissions->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $commissions->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
