@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.account.deposit.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.account.deposit.management')
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
                                <th>@lang('labels.backend.account.deposit.table.code')</th>
                                <th>@lang('labels.backend.account.deposit.table.type')</th>
                                <th>@lang('labels.backend.account.deposit.table.owner')</th>
                                <th>@lang('labels.backend.account.deposit.table.active')</th>
                                <th>@lang('labels.backend.account.deposit.table.balance')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td>{{ $account->code }}</td>
                                    <td>{{ ucwords(__($account->type->name)) }}</td>
                                    <td>{{ $account->owner_label }}</td>
                                    <td>{!! $account->active_label !!}</td>
                                    <td>{{ $account->account_balance_label }}</td>
                                    <td>{!! $account->action_buttons  !!}</td>
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
                        {!! $accounts->total() !!} {{ trans_choice('labels.backend.services.service.table.total', $accounts->total()) }}
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
