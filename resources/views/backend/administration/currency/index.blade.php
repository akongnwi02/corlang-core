@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.administration.currency.management'))

@section('breadcrumb-links')
    {{--@include('backend.administration.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.administration.currency.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.administration.currency.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.administration.currency.table.name')</th>
                                <th>@lang('labels.backend.administration.currency.table.code')</th>
                                {{--<th>@lang('labels.backend.administration.service.table.logo')</th>--}}
                                <th>@lang('labels.backend.administration.currency.table.rate')</th>
                                <th>@lang('labels.backend.administration.currency.table.active')</th>
                                <th>@lang('labels.backend.administration.currency.table.default')</th>

                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                                <tr>
                                    <td>{{ $currency->name }}</td>
                                    <td>{{ $currency->code }}</td>
                                    {{--<td>{!! $currency->logo_label !!}</td>--}}
                                    <td>{{ $currency->rate }}</td>
                                    <td>{!! $currency->active_label !!}</td>
                                    <td>{!! $currency->default_label !!}</td>

                                    <td>{!! $currency->action_buttons  !!}</td>
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
                        {!! $currencies->total() !!} {{ trans_choice('labels.backend.administration.currency.table.total', $currencies->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $currencies->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
