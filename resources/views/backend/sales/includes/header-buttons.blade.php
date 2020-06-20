@can(config('permission.permissions.read_sales'))
    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
        <span id="addPOIbutton" onclick="showFilterPopup()" class="btn btn-{{ count(array_filter(request()->input('filter') ?: [], function($filter){return $filter !== null && $filter !== '';})) ?'primary':'dark'}} ml-1" data-toggle="tooltip" title="@lang('labels.backend.sales.filter.title')"><i class="fas fa-filter"></i>
            @if(count(array_filter(request()->input('filter')?:[], function($filter){return $filter !== null && $filter !== '';})) && count(@request()->input()['filter']) > 0)
                <span class="badge badge-danger">{{ count(array_filter(request()->input('filter')?:[], function($filter){return $filter !== null && $filter !== '';})) }}</span>
            @endif
        </span>
    </div><!--btn-toolbar-->
@endcan


<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle">
                    <span class="title-text"></span>
                    <br/>
                    <small class="text-muted">@lang('labels.backend.sales.filter.title')</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('buttons.general.cancel')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ html()->form('GET')->class('form-horizontal')->id('filterForm')->open() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.reference')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['code'] }}" name="filter[code]" type="text" class="form-control">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.service')</span>
                    </div>
                    {{ html()->select('filter[service_id]', [null => null] + $services)
                        ->value(@request()->input()['filter']['service_id'])
                        ->class('form-control')
                    }}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.company')</span>
                    </div>
                    {{ html()->select('filter[company_id]', [null => null] + $companies)
                        ->value(@request()->input()['filter']['company_id'])
                        ->class('form-control')
                    }}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.status')</span>
                    </div>
                    {{ html()->select('filter[status]', [null => null] + array_map(function($status){return __($status);}, $statuses))
                        ->value(@request()->input()['filter']['status'])
                        ->class('form-control')
                    }}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.agent')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['user.username'] }}" name="filter[user.username]" type="text" class="form-control">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.from')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['start_date'] }}" name="filter[start_date]" type="date" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.sales.filter.to')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['end_date'] }}" name="filter[end_date]" type="date" class="form-control">
                </div>


                <div class="modal-footer">
                    <button type="button" class="'btn btn-secondary btn-sm" onclick="clearFilters()">@lang('buttons.general.filter.clear')</button>

                    {{ form_submit(__('buttons.general.filter.filter')) }}
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>

<script>
    function showFilterPopup() {
        $("#filterModal").modal("show");
    }

    function clearFilters() {
        // $('input[name="filter[code]"]').val("");

        $(':input','#filterForm')
            .not(':button, :submit, :reset, :hidden')
            .val(null)
            .prop('checked', false)
            .prop('selected', false);

    }
</script>
