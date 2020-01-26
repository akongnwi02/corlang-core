@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.commission.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row" style="width: 100%">
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.services.commission.table.view')</th>
                                <th>@lang('labels.backend.services.commission.table.name')</th>
                                <th>@lang('labels.backend.services.commission.table.description')</th>
                                <th>@lang('labels.backend.services.commission.table.currency')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commissions as $commission)
                                <tr>
                                    <td
                                        data-placement="top"
                                        title="@lang('buttons.general.crud.view')"
                                        data-toggle="collapse"
                                        data-target="#pricings-{{ $commission->uuid }}"
                                        class="accordion-toggle"><button class="btn btn-default btn-xs"><span class="fa fa-eye"></span></button>
                                    </td>
                                    <td>{{ $commission->name }}</td>
                                    <td>{{ $commission->description }}</td>
                                    <td>{{ $commission->currency->name }}</td>
                                    <td>{!! $commission->action_buttons  !!}</td>
                                </tr>
                                <tr class="child">
                                    <td colspan="5" align="center" class="hiddenRowtable collapse" id="pricings-{{ $commission->uuid }}">
                                        <div >
                                            @if($commission->pricings->count())
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('labels.backend.services.commission.table.stack.from')</th>
                                                        <th>@lang('labels.backend.services.commission.table.stack.to')</th>
                                                        <th>@lang('labels.backend.services.commission.table.stack.fixed')</th>
                                                        <th>@lang('labels.backend.services.commission.table.stack.percentage')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($commission->pricings as $pricing)
                                                        <tr>
                                                            <td>{{ $pricing->from_label }}</td>
                                                            <td>{{ $pricing->to_label }}</td>
                                                            <td>{{ $pricing->fixed_label }}</td>
                                                            <td>{{ $pricing->percentage_label }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <table class="table table-responsive table-borderless">
                                                    <tbody>
                                                    <tr>
                                                        <td>@lang('labels.backend.services.commission.table.stack.no_result')</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </td>
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

