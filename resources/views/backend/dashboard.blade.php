@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">

                <div class="cols-sm-4 col-lg-3">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header bg-light content-center">
                                    <div class="text-value-lg">{{ @$logged_in_user->company->name }}</div>
                                    <div>@lang('strings.backend.dashboard.company.number'): <strong>{{ @$logged_in_user->company->account->code }}</strong></div>

                                    <div class="c-icon c-icon-1xl text-white my-2">
                                        <img class="navbar-brand-minimized"
                                             src="{{ @$logged_in_user->company->full_logo }}"
                                             style="border-radius: 80%; max-width: 100%"
                                             alt="{{ @$logged_in_user->company->name }}">
                                    </div>

                                    @lang('strings.backend.dashboard.welcome') <strong> {{ $logged_in_user->name }}!</strong>

                                </div>
                                <div class="card-body row text-center">
                                    <div class="col">
                                        <div class="text-value-xl">{{ $numberOfUsers }}</div>
                                        <div
                                            class="text-uppercase text-muted small">{{trans_choice('strings.backend.dashboard.company.users', $numberOfUsers)}}</div>
                                    </div>
                                    <div class="c-vr"></div>
                                    {{--<div class="col">--}}
                                    {{--<div class="text-value-xl">459</div>--}}
                                    {{--<div class="text-uppercase text-muted small">@lang('strings.backend.dashboard.company.agents')</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div><!-- col-->
                    </div>
                </div>

                <div class="cols-sm-8 col-lg-8">
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-value-lg">{{ $companyTodayCommission . ' ' .$currency->code }}</div>
                                    <div>@lang('strings.backend.dashboard.company.commission_today')</div>
                                    {{--<div class="progress progress-xs my-2">--}}
                                    {{--<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                    {{--</div>--}}
                                    <small class="text-muted">@lang('strings.backend.dashboard.company.commission_today_help')</small>
                                </div>
                            </div>
                        </div><!--col-->
                        <div class="col-sm-4 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    @can(config('permission.permissions.request_payouts'))
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-transparent" data-toggle="modal" data-target="#requestPayout" title="@lang('labels.backend.account.payout')">
                                                <img src="{{ url('img/backend/brand/arrow-circle-bottom.svg') }}" alt="@lang('labels.backend.account.payout')">
                                            </button>
                                        </div>
                                    @endcan
                                    <div class="text-value-lg">{{ $companyCommission . ' ' . $currency->code }}</div>
                                    <div>@lang('strings.backend.dashboard.company.commission')</div>
                                    {{--<div class="progress progress-xs my-2">--}}
                                        {{--<div class="progress-bar bg-warning" role="progressbar" style="width: 25%"--}}
                                             {{--aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                    {{--</div>--}}
                                    <small class="text-muted">@lang('strings.backend.dashboard.company.commission_help')</small>
                                </div>
                            </div>
                        </div><!--col-->
                        <div class="col-sm-4 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    @can(config('permission.permissions.float_accounts'))
                                        <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                                            <button type="button" class="btn btn-transparent" data-toggle="modal" data-target="#floatAccount" title="@lang('labels.backend.account.float')">
                                                <img src="{{ url('img/backend/brand/arrow-circle-top.svg') }}" alt="@lang('labels.backend.account.float')">
                                            </button>
                                        </div><!--btn-toolbar-->
                                    @endif
                                    <div class="text-value-lg">{{ $companyBalance . ' ' . $currency->code }}</div>
                                    <div>@lang('strings.backend.dashboard.company.balance')</div>
                                    {{--<div class="progress progress-xs my-2">--}}
                                        {{--<div class="progress-bar bg-danger" role="progressbar" style="width: 25%"--}}
                                             {{--aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                    {{--</div>--}}
                                    <small class="text-muted">@lang('strings.backend.dashboard.company.balance_help')</small>
                                </div>
                            </div>
                        </div><!--col-->
                    </div>
                </div>
            </div><!--row-->
        </div>
    </div>
    @component('backend.components.dashboard.float', [
        'account' => $logged_in_user->company->account,
        'currency' => $currency
    ])
    @endcomponent

    @component('backend.components.dashboard.payout', [
        'account' => $logged_in_user->company->account,
        'currency' => $currency
    ])
    @endcomponent

@endsection

@section('javascript')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/widgets.js') }}"></script>
@endsection
