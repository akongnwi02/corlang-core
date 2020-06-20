@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.sales.management'))

@section('breadcrumb-links')
    @include('backend.sales.includes.breadcrumb-links')
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
                    @include('backend.sales.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.sales.table.code')</th>
                                <th>@lang('labels.backend.sales.table.date')</th>
                                <th>@lang('labels.backend.sales.table.company')</th>
                                <th>@lang('labels.backend.sales.table.user')</th>
                                <th>@lang('labels.backend.sales.table.items')</th>
                                <th>@lang('labels.backend.sales.table.asset')</th>
                                <th>@lang('labels.backend.sales.table.service')</th>
                                <th>@lang('labels.backend.sales.table.total_customer_amount')</th>
                                <th>@lang('labels.backend.sales.table.destination')</th>
                                <th>@lang('labels.backend.sales.table.payment_account')</th>
                                <th>@lang('labels.backend.sales.table.company_commission')</th>
                                <th>@lang('labels.backend.sales.table.agent_commission')</th>
                                <th>@lang('labels.backend.sales.table.external_commission')</th>
                                <th>@lang('labels.backend.sales.table.actual_status')</th>
                                <th>@lang('labels.backend.sales.table.to_be_verified')</th>

                                {{--<th>@lang('labels.general.actions')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->code }}</td>
                                    <td>{{ $sale->created_at->diffForHumans() }}</td>
                                    <td>{{ @$sale->company->name }}</td>
                                    <td>{{ $sale->user->username }}</td>
                                    <td>{{ $sale->items }}</td>
                                    <td>{{ $sale->asset }}</td>
                                    <td>{!! @$sale->service->logo_label !!} <span> {{ $sale->service->name }}</span></td>
                                    <td>{{ number_format($sale->total_customer_amount, 2) . ' ' . $sale->currency_code }}</td>
                                    <td>{{ $sale->destination }}</td>
                                    <td>{{ $sale->paymentaccount}}</td>
                                    <td>{{ number_format($sale->company_commission, 2) . ' ' . $sale->currency_code }}</td>
                                    <td>{{ number_format($sale->agent_commission, 2) . ' ' . $sale->currency_code }}</td>
                                    <td>{{ number_format($sale->external_commission, 2) . ' ' . $sale->currency_code }}</td>
                                    <td><span class="badge badge-{{ $sale->status_class_label }}">{{ __($sale->status) }}</span></td>
                                    @if($sale->to_be_verified)
                                        <td><span class='badge badge-danger'>@lang('labels.general.yes')</span></td>
                                    @else
                                        <td><span class='badge badge-success'>@lang('labels.general.no')</span></td>
                                    @endif
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
                        {!! $sales->appends(request()->except('page'))->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

@push('after-scripts')
    <script>

        $(function () {
            $("button[name='creditPopup']").click(function () {
                let title = this.title;
                let direction = "IN";
                let id = this.id;

                $("#creditModal .title-text").html(title);
                $("#creditModal button[type='submit']").html(title);
                $("#creditModal input[name='direction']").val(direction);
                $("#creditModal form").attr('action', `/admin/account/${id}/credit`);

                $("#creditModal").modal("show");
            });

            $("button[name='debitPopup']").click(function () {
                let title = this.title;
                let direction = "OUT";
                let id = this.id;

                $("#creditModal .title-text").html(title);
                $("#creditModal button[type='submit']").html(title);
                $("#creditModal input[name='direction']").val(direction);
                $("#creditModal form").attr('action', `/admin/account/${id}/credit`);

                $("#creditModal").modal("show");
            });

        });

    </script>
@endpush
