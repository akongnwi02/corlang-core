@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.accounting.collection.view'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.accounting.collection.movements.code')</th>
                                <th>@lang('labels.backend.accounting.collection.movements.amount')</th>
                                <th>@lang('labels.backend.accounting.collection.movements.user')</th>
                                <th>@lang('labels.backend.accounting.collection.movements.comment')</th>
                                <th>@lang('labels.backend.accounting.collection.movements.date')</th>

                                {{--<th>@lang('labels.general.actions')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movements as $movement)
                                <tr>
                                    <td>{{ $movement->code }}</td>
                                    <td>{{ $movement->amount_label }}</td>
                                    <td>{{ @$movement->user->full_name }}</td>
                                    <td>{{ $movement->comment }}</td>
                                    <td>{{ $movement->created_at->toDatetimeString() }}</td>
                                    {{--<td>{!! $movement->action_buttons  !!}</td>--}}
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
                        {!! $movements->total() !!} {{ trans_choice('labels.backend.accounting.collection.movements.total', $movements->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $movements->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

@push('after-scripts')
    <script>

        $(function () {
            $("button[name='creditPopup']").click(function () {
                let title = this.title;
                let direction = "IN";
                let id = this.id;

                $("#creditModal .title-text").html(title);
                $("#creditModal button[type='submit']").html(title);
                $("#creditModal input[name='direction']").val(direction);
                $("#creditModal form").attr('action', `/admin/account/${id}/credit`);

                $("#creditModal").modal("show");
            });

            $("button[name='debitPopup']").click(function () {
                let title = this.title;
                let direction = "OUT";
                let id = this.id;

                $("#creditModal .title-text").html(title);
                $("#creditModal button[type='submit']").html(title);
                $("#creditModal input[name='direction']").val(direction);
                $("#creditModal form").attr('action', `/admin/account/${id}/credit`);

                $("#creditModal").modal("show");
            });

        });

    </script>
@endpush

