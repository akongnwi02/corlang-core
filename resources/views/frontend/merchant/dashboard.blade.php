@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.merchant_dashboard') )

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-shopping-cart"></i> @lang('navs.frontend.merchant_dashboard')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <merchant :methods="{{ json_encode($methods, true) }}" :order="{{ json_encode($order, true) }}"></merchant>
                    </div>
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection

<style>
    .tab-pane {
        height: 100% !important;
    }
</style>
