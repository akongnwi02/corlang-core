@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.accounting.collection.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')

    @include('backend.accounting.collection.includes.pay')

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
                                <th>@lang('labels.backend.accounting.collection.table.number_payments')</th>

                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{!! @$service->logo_label !!} {{ $service->name }}</td>
                                    <td>{{ $service->collected_amount_label }}</td>
                                    <td>{{ @$service->collections()->get()->last()->created_at ? @$service->collections()->get()->last()->created_at->diffForHumans() : 'N/A' }}</td>
                                    <td>{{ $service->collections()->count() }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="@lang('labels.backend.accounting.collection.actions')">
                                            @can(config('permission.permissions.read_accounting'))
                                                <a href="{{ route('admin.accounting.collection.show', $service->uuid) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can(config('permission.permissions.pay_collection'))
                                                <button name="payCollection" data-content="{{$service->name}}" id="{{ $service->uuid }}" title="@lang('labels.backend.accounting.pay')" class="btn btn-success"><i class="fas fa-arrow-down"></i></button>
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
                        {!! $services->total() !!} {{ trans_choice('labels.backend.accounting.collection.table.total', $services->total()) }}
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

@push('after-scripts')
    <script>

        $(function () {
            $("button[name='payCollection']").click(function () {
                let title = this.title;
                let id = this.id;

                $("#payCollectionModal .title-text").html(title);
                $("#payCollectionModal button[type='submit']").html(title);
                $("#payCollectionModal form").attr('action', `/admin/accounting/collection/${id}/pay`);

                $("#payCollectionModal").modal("show");
            });
        });

    </script>
@endpush
