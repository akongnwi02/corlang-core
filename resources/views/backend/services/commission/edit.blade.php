@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.commission.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
{{ html()->modelForm($commission, 'PUT', route('admin.services.commission.update', $commission))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.services.commission.management')
                        <small class="text-muted">@lang('labels.backend.services.commission.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.commission.name'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission.description'))->class('col-md-2 form-control-label required')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->text('description')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.commission.description'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.commission.currency'))->class('col-md-2 form-control-label required')->for('currency_id') }}

                        <div class="col-md-10">
                            {{ html()->select('currency_id', $currencies)
                                ->class('form-control')
                                ->value($commission->currency->name) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div id="POItablediv">
                        <input type="button" id="addPOIbutton" value="Add POIs" onclick="insRow()"/><br/><br/>
                        {{--<table id="POITable" border="1">--}}
                            {{--<tr>--}}
                                {{--<td>From</td>--}}
                                {{--<td>To</td>--}}
                                {{--<td>Fixed</td>--}}
                            {{--</tr>--}}

                        {{--</table>--}}



                        <table class="table" id="POITable">
                            <thead>
                            <tr>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.from')</th>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.to')</th>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.fixed')</th>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.percentage')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commission->pricings as $pricing)
                                <tr>
                                    <td><input size=25 type="text" id="latbox" class="form-control"/></td>
                                    <td><input size=25 type="text" id="lngbox" /></td>
                                    <td><input type="button" id="delPOIbutton" value="Delete" onclick="deleteRow(this)" /></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.services.commission.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
@push('after-styles')
<style>
    .required:after{
        content:'*';
        color:red;
        padding-left:5px;
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
    function deleteRow(row) {
        let i = row.parentNode.parentNode.rowIndex;
        document.getElementById('POITable').deleteRow(i);
    }


    function insRow() {
        console.log('hi');
        let x = document.getElementById('POITable');
        let new_row = x.rows[1].cloneNode(true);
        let len = x.rows.length;
        new_row.cells[0].innerHTML = len;

        let inp1 = new_row.cells[1].getElementsByTagName('input')[0];
        inp1.id += len;
        inp1.value = '';
        let inp2 = new_row.cells[2].getElementsByTagName('input')[0];
        inp2.id += len;
        inp2.value = '';
        x.appendChild(new_row);
    }
    </script>
@endpush
