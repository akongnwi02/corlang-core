@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <balance-bar></balance-bar>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <layout></layout>
                    </div>
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
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
