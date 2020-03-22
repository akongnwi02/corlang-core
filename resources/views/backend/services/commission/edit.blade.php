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
                        <div class="btn-toolbar" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                            <span id="addPOIbutton" onclick="insRow()" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.add')"><i class="fas fa-plus-circle"></i></span>
                        </div>

                        <br/>

                        <table class="table table-responsive table-borderless" id="POITable">
                            <thead>
                            <tr>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.from')</th>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.to')</th>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.fixed')</th>
                                <th>@lang('validation.attributes.backend.services.commission.pricing.percentage')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($commission->pricings as $key => $pricing)
                                <tr>
                                    <td><input id="from" style="min-width:100px" size=25 type="number" name="pricings[{{ $key }}][from]" step="0.01" class="form-control" value="{{ $pricing->from }}" min="0" required/></td>
                                    <td><input id="to" style="min-width:100px" size=25 type="number" name="pricings[{{ $key }}][to]" step="0.01" class="form-control" value="{{ $pricing->to }}" min="0" required/></td>
                                    <td><input id="fixed" style="min-width:100px" size=25 type="number" name="pricings[{{ $key }}][fixed]" step="0.01" class="form-control" value="{{ $pricing->fixed }}" min="0" required/></td>
                                    <td><input id="percentage" size=25 type="number" name="pricings[{{ $key }}][percentage]" step="0.01" class="form-control" min="0" max="100" value="{{ $pricing->percentage }}" required/></td>
                                    <td><button id="delPOIbutton" value="Delete" onclick="deleteRow(this)" class="btn btn-default btn-xs"><span class="fa fa-trash"></span></button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td><input id="from" style="min-width:100px" width="50px" type="number" name="pricings[0][from]" step="0.01" class="form-control" required/></td>
                                    <td><input id="to" style="min-width:100px" type="number" name="pricings[0][to]" step="0.01" class="form-control" required/></td>
                                    <td><input id="fixed" style="min-width:100px" type="number" name="pricings[0][fixed]" step="0.01" class="form-control" required/></td>
                                    <td><input id="percentage" type="number" name="pricings[0][percentage]" step="0.01" class="form-control" min="0" max="100" required/></td>
                                    <td><button id="delPOIbutton" value="Delete" onclick="deleteRow(this)" class="btn btn-default btn-xs"><span class="fa fa-trash"></span></button></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.services.commission.index'), __('buttons.general.back')) }}
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
                function deleteRow(row) {

                    let x = document.getElementById('POITable');
                    let len = x.rows.length;
                    if (len <= 2) {
                        event.preventDefault();
                        return;
                    }

                    let i = row.parentNode.parentNode.rowIndex;
                    document.getElementById('POITable').deleteRow(i);
                }

                function insRow() {
                    let x = document.getElementById('POITable');

                    let new_row = x.rows[1].cloneNode(true);
                    let len = x.rows.length;

                    let inp1 = new_row.cells[0].getElementsByTagName('input')[0];
                    inp1.value = '';
                    inp1.name = `pricings[${len}][from]`;

                    let inp2 = new_row.cells[1].getElementsByTagName('input')[0];
                    inp2.value = '';
                    inp2.name = `pricings[${len}][to]`;

                    let inp3 = new_row.cells[2].getElementsByTagName('input')[0];
                    inp3.value = '';
                    inp3.name = `pricings[${len}][fixed]`;

                    let inp4 = new_row.cells[3].getElementsByTagName('input')[0];
                    inp4.value = '';
                    inp4.name = `pricings[${len}][percentage]`;

                    x.appendChild(new_row);
                }

            </script>
    @endpush
