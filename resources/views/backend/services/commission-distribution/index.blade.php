@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.distribution.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.services.distribution.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.services.commission-distribution.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.services.distribution.table.name')</th>
                                <th>@lang('labels.backend.services.distribution.table.description')</th>
                                <th>@lang('labels.backend.services.distribution.table.agent_rate')</th>
                                <th>@lang('labels.backend.services.distribution.table.company_rate')</th>
                                <th>@lang('labels.backend.services.distribution.table.external_rate')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($distributions as $distribution)
                                <tr>
                                    <td>{{ $distribution->name }}</td>
                                    <td>{{ $distribution->description }}</td>
                                    <td>{!! $distribution->agent_rate_label !!}</td>
                                    <td>{!! $distribution->company_rate_label !!}</td>
                                    <td>{!! $distribution->external_rate_label !!}</td>
                                    <td>{!! $distribution->action_buttons  !!}</td>
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
                        {!! $distributions->total() !!} {{ trans_choice('labels.backend.services.distribution.table.total', $distributions->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $distributions->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
