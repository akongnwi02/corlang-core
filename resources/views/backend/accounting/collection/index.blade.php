@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.accounting.collection.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')

    @include('backend.accounts.deposit.includes.credit')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.accounting.collection.management')
                    </h4>
                </div><!--col-->

                {{--<div class="col-sm-7">--}}
                {{--@include('backend.services.service.includes.header-buttons')--}}
                {{--</div><!--col-->--}}
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.accounting.collection.table.service')</th>
                                <th>@lang('labels.backend.accounting.collection.table.amount')</th>
                                <th>@lang('labels.backend.accounting.collection.table.last_payout_date')</th>

                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->collected_amount_label }}</td>
                                    <td>{{ $service->last_payout_date ? $service->last_payout_date->toDatetimeString() : 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="@lang('labels.backend.accounting.collection.actions')">
                                            @can(config('permission.permissions.read_accounting'))
                                                <a href="{{ route('admin.accounting.collection.show', $service->uuid) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can(config('permission.permissions.pay_collection'))
                                                <button name="creditPopup" id="{{ $service->uuid }}" title="@lang('labels.backend.accounting.pay')" class="btn btn-success"><i class="fas fa-plus-circle"></i></button>
                                            @endcan
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
                        {!! $accounts->total() !!} {{ trans_choice('labels.backend.account.deposit.table.total', $accounts->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $accounts->render() !!}
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
