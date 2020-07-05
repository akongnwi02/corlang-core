@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.method.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.services.method.management')
                        <small class="text-muted">@lang('labels.backend.services.method.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="methodTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="true"><i class="fas fa-info"></i> @lang('labels.backend.services.method.tabs.titles.profile')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#companies" role="tab" aria-controls="services" aria-expanded="true"><i class="fas fa-cog"></i> @lang('labels.backend.services.method.tabs.titles.companies')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel" aria-expanded="true">
                            @include('backend.services.payment-method.edit.tabs.overview')
                        </div><!--tab-->
                        <div class="tab-pane fade" id="companies" role="tabpanel" aria-expanded="true">
                            @include('backend.services.payment-method.edit.tabs.companies')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

@endsection

@push('after-styles')
    <style>
        .required:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }

        table {
            width: 70%;
            font: 17px Calibri;
        }

        table, th, td {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }
    </style>
@endpush
@push('after-scripts')
    <script>
        // switch to active tab on page reload
        $('a[data-toggle="tab"]').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            let id = $(e.target).attr("href");
            localStorage.setItem('selectedTab', id)
        });

        let selectedTab = localStorage.getItem('selectedTab');

        if (selectedTab != null) {
            $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
        }
    </script>
@endpush
