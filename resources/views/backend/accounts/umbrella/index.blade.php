@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.account.umbrella.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')

    @include('backend.accounts.umbrella.includes.drain')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.account.umbrella.management')
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.accounts.umbrella.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.account.umbrella.table.code')</th>
                                <th>@lang('labels.backend.account.umbrella.table.user')</th>
                                {{--<th>@lang('labels.backend.account.umbrella.table.active')</th>--}}
                                <th>@lang('labels.backend.account.umbrella.table.balance')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td>{{ $account->code }}</td>
                                    <td>{{ $account->owner_label }}</td>
                                    {{--<td>{!! $account->active_label !!}</td>--}}
                                    <td class="balance" id="{{ $account->uuid }}">{{ $account->umbrella_balance_label }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="@lang('labels.backend.account.umbrella.actions')">
                                            @can(config('permission.permissions.read_accounts'))
                                                <a href="{{ route('admin.account.umbrella.show', $account->uuid) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can(config('permission.permissions.debit_accounts'))
                                                <button name="drainPopup" id="{{ $account->uuid }}" title="@lang('labels.backend.account.transfer_to_strongbox')" class="btn btn-danger"><i class="fas fa-arrow-down"></i></button>
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
                        {!! $accounts->total() !!} {{ trans_choice('labels.backend.account.umbrella.table.total', $accounts->total()) }}
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
            $("button[name='drainPopup']").click(function () {
                let title = this.title;
                let id = this.id;
                let balance = $(`td[id='${id}']`).html();

                $("#drainModal .title-text").html(title);
                $("#drainModal button[type='submit']").html(title);
                $("#drainModal strong[class='balance']").html(balance);
                $("#drainModal form").attr('action', `/admin/account/${id}/drain`);

                $("#drainModal").modal("show");
            });
        });

    </script>
@endpush
