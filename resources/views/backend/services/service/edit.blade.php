@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.service.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
    {{ html()->modelForm($service, 'PUT', route('admin.services.service.update', $service))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.services.service.management')
                        <small class="text-muted">@lang('labels.backend.services.service.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.name'))->class('col-md-2 form-control-label required')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.service.name'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.code'))->class('col-md-2 form-control-label required')->for('code') }}

                        <div class="col-md-10">
                            {{ html()->text('code')
                                ->class('form-control')
                                ->disabled()
                                ->attribute('maxlength', 191)
                                ->placeholder(__('validation.attributes.backend.services.service.code'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.category'))->class('col-md-2 form-control-label required')->for('category_id') }}

                        <div class="col-md-10">
                            {{ html()->select('category_id', [null => null] + $categories)
                                ->class('form-control')
                                ->required()}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.gateway'))->class('col-md-2 form-control-label')->for('gateway_id') }}

                        <div class="col-md-10">
                            {{ html()->select('gateway_id', [null => null] + $gateways)
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.agent_rate'))->class('col-md-2 form-control-label required')->for('agent_rate') }}

                        <div class="col-md-10">
                            {{ html()->text('agent_rate')
                                ->class('form-control')
                                ->required()
                                ->attribute('min', 0)
                                ->attribute('step', 0.01)
                                ->attribute('max', 100)
                                ->placeholder(__('validation.attributes.backend.services.service.agent_rate'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.company_rate'))->class('col-md-2 form-control-label required')->for('company_rate') }}

                        <div class="col-md-10">
                            {{ html()->text('company_rate')
                                ->class('form-control')
                                ->required()
                                 ->attribute('min', 0)
                                 ->attribute('step', 0.01)
                                ->attribute('max', 100)
                                ->placeholder(__('validation.attributes.backend.services.service.company_rate'))}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.providercommission'))->class('col-md-2 form-control-label')->for('providercommission_id') }}

                        <div class="col-md-10">
                            {{ html()->select('providercommission_id' , [null => null] + $commissions)
                                ->class('form-control')
                                }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.customercommission'))->class('col-md-2 form-control-label')->for('customercommission_id') }}

                        <div class="col-md-10">
                            {{ html()->select('customercommission_id', [null => null] + $commissions)
                                ->class('form-control')
                                }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.prepaid'))->class('col-md-2 form-control-label')->for('is_prepaid') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('is_prepaid', false, 1)->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.items'))->class('col-md-2 form-control-label')->for('has_items') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('has_items', false, 1)->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.services.service.logo'))->class('col-md-2 form-control-label')->for('logo') }}

                        <div class="col-md-10">
                            {{ html()->file('logo')->id('logo')->class('form-control-file') }}
                            <div class="preview">
                                {{ html()->img(url($service->service_logo), __('validation.attributes.backend.services.service.logo'))->style('width:100px;height:100px;')->id('preview') }}
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->
                    @if($service->has_items)
                        <div id="POItablediv">
                        <div class="btn-toolbar" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                            <button id="addPOIbutton" onclick="insRow()" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.add')"><i class="fas fa-plus-circle"></i></button>
                        </div>

                        <br/>

                        <table class="table table-responsive table-borderless" id="POITable">
                            <thead>
                            <tr>
                                <th>@lang('validation.attributes.backend.services.item.name')</th>
                                <th>@lang('validation.attributes.backend.services.item.code')</th>
                                <th>@lang('validation.attributes.backend.services.item.amount')</th>
                                <th>@lang('validation.attributes.backend.services.item.active')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($service->items as $key => $item)
                                <tr>
                                    <td><input id="name" style="min-width:100px" type="text" name="items[{{ $key }}][name]" class="form-control" value="{{ $item->name }}" max="191" required/></td>
                                    <td><input id="code" style="min-width:100px" type="text" name="items[{{ $key }}][code]" step="0.01" class="form-control" value="{{ $item->code }}" max="191" required/></td>
                                    <td><input id="amount" style="min-width:100px" size=25 type="number" name="items[{{ $key }}][amount]" step="0.01" class="form-control" value="{{ $item->amount }}" min="0" required/></td>
                                    <td>
                                        <label class="switch switch-label switch-pill switch-primary">
                                            {{ html()->checkbox("items[$key][is_active]", $item->is_active, 1)->class('switch-input') }}
                                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                        </label>
                                    </td>
                                    <td><button id="delPOIbutton" value="Delete" onclick="deleteRow(this)" class="btn btn-default btn-xs"><span class="fa fa-trash"></span></button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td><input id="name" style="min-width:100px" width="50px" type="text" name="items[0][name]" max="191" class="form-control" required/></td>
                                    <td><input id="code" style="min-width:100px" type="text" name="items[0][code]" max="191" class="form-control" required/></td>
                                    <td><input id="amount" style="min-width:100px" type="number" name="items[0][amount]" step="0.01" class="form-control" required/></td>
                                    <td>
                                        <label class="switch switch-label switch-pill switch-primary">
                                            {{ html()->checkbox('items[0][is_active]', $item->is_active, 1)->class('switch-input') }}
                                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                        </label>
                                    </td>
                                    <td><button id="delPOIbutton" value="Delete" onclick="deleteRow(this)" class="btn btn-default btn-xs"><span class="fa fa-trash"></span></button></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                            {{--<div>--}}
                                {{--<small class="text-muted">@lang('business.landlord.percentage_for_the_landlord')</small>--}}
                            {{--</div>--}}
                    </div><!--col-->
                    @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.services.service.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.continue')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $('#preview').hide();
            }
        }

        $("#logo").change(function(){
            readURL(this);
        });
    </script>
@endpush

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
            inp1.name = `items[${len}][name]`;

            let inp2 = new_row.cells[1].getElementsByTagName('input')[0];
            inp2.value = '';
            inp2.name = `items[${len}][code]`;

            let inp3 = new_row.cells[2].getElementsByTagName('input')[0];
            inp3.value = '';
            inp3.name = `items[${len}][amount]`;

            let inp4 = new_row.cells[3].getElementsByTagName('input')[0];
            inp4.value = '';
            inp4.name = `items[${len}][is_active]`;

            x.appendChild(new_row);
        }

    </script>
@endpush
