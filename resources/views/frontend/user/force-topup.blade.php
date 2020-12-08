@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.force_topup') )

@section('content')

    <div class="row">
        <!-- Section Titile -->
        <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
            <h4 class="section-title">@lang('strings.frontend.user.configure_topup')</h4>
        </div>
    </div>
    <div class="row">
        @component('frontend.user.account.tabs.topup')
        @endcomponent
    </div>
@endsection

<script>
    // get the user object from the backend
    // used to create a pusher channel connection
    window.user = {!! auth()->user() !!};
</script>

<style>
    .tab-pane {
        height: 100% !important;
    }
</style>
