<div id="POItablediv">

    <div class="btn-toolbar" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
        <a href="{{ route('admin.companies.company.service.create', $company) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.add')"><i class="fas fa-plus-circle"></i></a>
    </div>

    <br/><br/>

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
            <tr>
                <td><input id="from" style="min-width:100px" width="50px" type="number" name="pricings[0][from]" step="0.01" class="form-control" required/></td>
                <td><input id="to" style="min-width:100px" type="number" name="pricings[0][to]" step="0.01" class="form-control" required/></td>
                <td><input id="fixed" style="min-width:100px" type="number" name="pricings[0][fixed]" step="0.01" class="form-control" required/></td>
                <td><input id="percentage" type="number" name="pricings[0][percentage]" step="0.01" class="form-control" min="0" max="100" required/></td>
                <td><button id="delPOIbutton" value="Delete" onclick="deleteRow(this)" class="btn btn-default btn-xs"><span class="fa fa-trash"></span></button></td>
            </tr>
        </tbody>
    </table>
</div><!--col-->
