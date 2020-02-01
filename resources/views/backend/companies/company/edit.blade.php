@extends('backend.layouts.app')

@section('title', __('labels.backend.companies.company.management') . ' | ' . __('labels.backend.companies.company.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.companies.company.management')
                        <small class="text-muted">@lang('labels.backend.companies.company.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.companies.company.tabs.titles.profile')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-expanded="true"><i class="fas fa-cog"></i> @lang('labels.backend.companies.company.tabs.titles.setting')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel" aria-expanded="true">
                            @include('backend.companies.company.edit.tabs.profile')
                        </div><!--tab--><div class="tab-pane active" id="setting" role="tabpanel" aria-expanded="true">
                            @include('backend.companies.company.edit.tabs.setting')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

<style>
    .required:after{
        content:'*';
        color:red;
        padding-left:5px;
    }
</style>
