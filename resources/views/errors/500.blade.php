@extends('frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h1 class="float-left display-3 mr-4">500</h1>
                    <h4 class="pt-3">@lang('http.500.title')</h4>
                    <p class="text-muted">@lang('http.500.description')</p>
                </div>
                <div class="input-prepend input-group">
                    <div class="input-group-prepend"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

@endsection
