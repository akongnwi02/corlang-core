@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.category.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.services.category.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.services.category.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.services.category.table.name')</th>
                                <th>@lang('labels.backend.services.category.table.code')</th>
                                {{--<th>@lang('labels.backend.services.service.table.logo')</th>--}}
                                <th>@lang('labels.backend.services.category.table.active')</th>
                                <th>@lang('labels.backend.services.category.table.api_key')</th>
                                <th>@lang('labels.backend.services.category.table.api_url')</th>

                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->code }}</td>
                                    {{--<td>{!! $category->logo_label !!}</td>--}}
                                    <td>{!! $category->active_label !!}</td>
                                    <td>{{ $category->api_key }}</td>
                                    <td>{{ $category->api_url }}</td>

                                    <td>{!! $category->action_buttons  !!}</td>
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
                        {!! $categories->total() !!} {{ trans_choice('labels.backend.services.category.table.total', $categories->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $categories->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
