@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.orders.management'))

@section('breadcrumb-links')
    @include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.orders.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    {{--@include('backend.orders.includes.header-buttons')--}}
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.orders.table.code')</th>
                                <th>@lang('labels.backend.orders.table.description')</th>
                                <th>@lang('labels.backend.orders.table.external_id')</th>
                                <th>@lang('labels.backend.orders.table.company')</th>
                                <th>@lang('labels.backend.orders.table.date')</th>
                                <th>@lang('labels.backend.orders.table.customer_name')</th>
                                <th>@lang('labels.backend.orders.table.method')</th>
                                <th>@lang('labels.backend.orders.table.partner_ref')</th>
                                <th>@lang('labels.backend.orders.table.payment_account')</th>
                                <th>@lang('labels.backend.orders.table.amount')</th>
                                <th>@lang('labels.backend.orders.table.customer_fee')</th>
                                <th>@lang('labels.backend.orders.table.total_customer_amount')</th>
                                <th>@lang('labels.backend.orders.table.merchant_fee')</th>
                                <th>@lang('labels.backend.orders.table.merchant_amount_net')</th>
                                <th>@lang('labels.backend.orders.table.status')</th>
                                <th>@lang('labels.backend.orders.table.transaction_ref')</th>
                                <th>@lang('labels.backend.orders.table.completed_at')</th>

                                {{--<th>@lang('labels.general.actions')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->description }}</td>
                                    <td>{{ $order->external_id }}</td>
                                    <td>{{ $order->company->name }}</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->paymentmethod }}</td>
                                    <td>{{ @$order->transaction->asset }}</td>
                                    <td>{{ $order->paymentaccount }}</td>
                                    <td>{{ number_format($order->total_amount, 2) . ' ' . $order->currency_code }}</td>
                                    <td>{{ number_format($order->customer_fee, 2) . ' ' . $order->currency_code }}</td>
                                    <td>{{ number_format($order->customer_fee + $order->total_amount, 2) . ' ' . $order->currency_code }}</td>
                                    <td>{{ number_format($order->merchant_fee, 2) . ' ' . $order->currency_code }}</td>
                                    <td>{{ number_format($order->total_amount - $order->merchant_fee, 2) . ' ' . $order->currency_code }}</td>
                                    <td><span class="badge badge-{{ $order->status_class_label }}">{{ __($order->status) }}</span></td>
                                    <td>{{ @$order->transaction->code }}</td>
                                    <td>{{ @$order->completed_at ? @$order->completed_at->toDatetimeString() : null}}</td>
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
                        {!! $orders->total() !!} {{ trans_choice('labels.backend.orders.table.total_orders', $orders->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $orders->appends(request()->except('page'))->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
