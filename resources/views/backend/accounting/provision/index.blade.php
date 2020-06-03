@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.accounting.provision.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')

    @include('backend.accounting.provision.includes.request')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.accounting.provision.management')
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
                                <th>@lang('labels.backend.accounting.provision.table.service')</th>
                                <th>@lang('labels.backend.accounting.provision.table.commission')</th>
                                <th>@lang('labels.backend.accounting.provision.table.last_request_date')</th>
                                <th>@lang('labels.backend.accounting.provision.table.number_requests')</th>

                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->commission_amount_label }}</td>
                                    <td>{{ @$service->provisions()->get()->last()->created_at ? @$service->provisions()->get()->last()->created_at->diffForHumans() : 'N/A' }}</td>
                                    <td>{{ $service->provisions()->count() }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="@lang('labels.backend.accounting.provision.actions')">
                                            @can(config('permission.permissions.read_accounting'))
                                                <a href="{{ route('admin.accounting.provision.show', $service->uuid) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can(config('permission.permissions.request_provision'))
                                                <button name="requestProvision" data-content="{{$service->name}}" id="{{ $service->uuid }}" title="@lang('labels.backend.accounting.request')" class="btn btn-success"><i class="fas fa-arrow-down"></i></button>
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
                        {!! $services->total() !!} {{ trans_choice('labels.backend.accounting.provision.table.total', $services->total()) }}
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
            $("button[name='requestProvision']").click(function () {
                let title = this.title;
                let id = this.id;

                $("#requestProvisionModal .title-text").html(title);
                $("#requestProvisionModal button[type='submit']").html(title);
                $("#requestProvisionModal form").attr('action', `/admin/accounting/provision/${id}/request`);

                $("#requestProvisionModal").modal("show");
            });
        });

    </script>
@endpush
