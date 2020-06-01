@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.companies.company.management'))

@section('breadcrumb-links')
    @include('backend.companies.company.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.companies.company.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.companies.company.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.companies.company.table.name')</th>
                                <th>@lang('labels.backend.companies.company.table.phone')</th>
                                <th>@lang('labels.backend.companies.company.table.address')</th>
                                <th>@lang('labels.backend.companies.company.table.city')</th>
                                <th>@lang('labels.backend.companies.company.table.state')</th>
                                <th>@lang('labels.backend.companies.company.table.country')</th>
                                <th>@lang('labels.backend.companies.company.table.type')</th>
                                <th>@lang('labels.backend.companies.company.table.active')</th>
                                <th>@lang('labels.backend.access.users.table.last_updated')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td><address>{{ $company->address }}</address></td>
                                    <td>{{ $company->city }}</td>
                                    <td>{{ $company->state }}</td>
                                    <td>{{ __($company->country->name) }}</td>
                                    <td>{{ __($company->type->name) }}</td>
                                    <td>{!! $company->active_label !!}</td>
                                    <td>{{ $company->updated_at->diffForHumans() }}</td>
                                    <td>{!! $company->action_buttons  !!}</td>
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
                        {!! $companies->total() !!} {{ trans_choice('labels.backend.companies.company.table.total', $companies->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $companies->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
