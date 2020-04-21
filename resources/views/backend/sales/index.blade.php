@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.sales.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.sales.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    {{--@include('backend.services.service.includes.header-buttons')--}}
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.sales.table.code')</th>
                                <th>@lang('labels.backend.sales.table.company')</th>
                                <th>@lang('labels.backend.sales.table.user')</th>
                                <th>@lang('labels.backend.sales.table.items')</th>
                                <th>@lang('labels.backend.sales.table.service')</th>
                                <th>@lang('labels.backend.sales.table.total')</th>
                                <th>@lang('labels.backend.sales.table.destination')</th>
                                <th>@lang('labels.backend.sales.table.payment_account')</th>
                                <th>@lang('labels.backend.sales.table.company_commission')</th>
                                <th>@lang('labels.backend.sales.table.agent_commission')</th>
                                <th>@lang('labels.backend.sales.table.user_status')</th>
                                <th>@lang('labels.backend.sales.table.actual_status')</th>

                                {{--<th>@lang('labels.general.actions')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->code }}</td>
                                    <td>{{ @$sale->company->name }}</td>
                                    <td>{{ $sale->user->full_name }}</td>
                                    <td>{{ $sale->items }}</td>
                                    <td>{{ $sale->service->name }}</td>
                                    <td>{{ number_format($sale->total_customer_amount, 2) . ' ' . $sale->currency_code }}</td>
                                    <td>{{ $sale->destination }}</td>
                                    <td>{{ $sale->paymentaccount}}</td>
                                    <td>{{ number_format($sale->company_commission, 2) . ' ' . $sale->currency_code }}</td>
                                    <td>{{ number_format($sale->agent_commission, 2) . ' ' . $sale->currency_code }}</td>
                                    <td><span class="badge badge-{{ $sale->status_class_label }}">{{ $sale->status }}</span></td>
                                    <td><span class="badge badge-{{ $sale->user_status_class_label }}">{{ $sale->user_status }}</span></td>
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
                        {!! $sales->total() !!} {{ trans_choice('labels.backend.sales.table.total_sales', $sales->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $sales->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
