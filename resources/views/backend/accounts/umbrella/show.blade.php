@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.account.umbrella.management'))

{{--@section('breadcrumb-links')--}}
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.account.umbrella.management')
                        <small class="text-muted">@lang('labels.backend.account.umbrella.view')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="companyTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-info"></i> @lang('labels.backend.account.umbrella.tabs.titles.overview')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#movements" role="tab" aria-controls="movements" aria-expanded="true"><i class="fas fa-list"></i> @lang('labels.backend.account.umbrella.tabs.titles.movements')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.accounts.umbrella.show.overview')
                        </div><!--tab-->
                        <div class="tab-pane fade" id="movements" role="tabpanel" aria-expanded="true">
                            @include('backend.accounts.umbrella.show.movement')
                        </div><!--tab-->
                    </div><!--tab-content-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection


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
