<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{__('labels.backend.sales.management') }}
            </h4>
        </div><!--col-->
    </div><!--row-->
    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr></tr>
                    <tr>
                        <th>@lang('labels.backend.sales.table.code')</th>
                        <th>@lang('labels.backend.sales.table.date')</th>
                        <th>@lang('labels.backend.sales.table.company')</th>
                        <th>@lang('labels.backend.sales.table.user')</th>
                        <th>@lang('labels.backend.sales.table.items')</th>
                        <th>@lang('labels.backend.sales.table.asset')</th>
                        <th>@lang('labels.backend.sales.table.service')</th>
                        <th>@lang('labels.backend.sales.table.destination')</th>
                        <th>@lang('labels.backend.sales.table.payment_account')</th>
                        <th>@lang('labels.backend.sales.table.amount')</th>
                        <th>@lang('labels.backend.sales.table.customer_fee')</th>
                        <th>@lang('labels.backend.sales.table.total_customer_amount')</th>
                        <th>@lang('labels.backend.sales.table.provider_fee')</th>
                        <th>@lang('labels.backend.sales.table.company_commission')</th>
                        <th>@lang('labels.backend.sales.table.agent_commission')</th>
                        <th>@lang('labels.backend.sales.table.external_commission')</th>
                        <th>@lang('labels.backend.sales.table.currency')</th>
                        <th>@lang('labels.backend.sales.table.actual_status')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->code }}</td>
                            <td>{{ $sale->created_at->toDatetimeString() }}</td>
                            <td>{{ @$sale->company->name }}</td>
                            <td>{{ $sale->user->username }}</td>
                            <td>{{ $sale->items }}</td>
                            <td>{{ $sale->asset }}</td>
                            <td>{{ $sale->service->name }}</td>
                            <td>{{ $sale->destination }}</td>
                            <td>{{ $sale->paymentaccount}}</td>
                            <td>{{ number_format($sale->amount, 2)}}</td>
                            <td>{{ number_format($sale->customer_service_fee, 2)}}</td>
                            <td>{{ number_format($sale->total_customer_amount, 2)}}</td>
                            <td>{{ number_format($sale->provider_service_fee, 2)}}</td>
                            <td>{{ number_format($sale->company_commission, 2) . ' ' . $sale->currency_code }}</td>
                            <td>{{ number_format($sale->agent_commission, 2) . ' ' . $sale->currency_code }}</td>
                            <td>{{ number_format($sale->external_commission, 2) . ' ' . $sale->currency_code }}</td>
                            <td>{{  $sale->currency_code  }}</td>
                            <td><span class="badge badge-{{ $sale->status_class_label }}">{{ __($sale->status) }}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--col-->
    </div><!--row-->
</div><!--card-body-->
