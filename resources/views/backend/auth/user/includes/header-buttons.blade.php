<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <span onclick="showFilterPopup()" class="btn btn-{{ count(array_filter(request()->input('filter') ?: [], function($filter){return $filter !== null && $filter !== '';})) ?'primary':'light'}} ml-1" data-toggle="tooltip" title="@lang('labels.backend.meters.filter')"><i class="fas fa-filter"></i>
    @if(count(array_filter(request()->input('filter')?:[], function($filter){return $filter !== null && $filter !== '';})) && count(@request()->input()['filter']) > 0)
            <span class="badge badge-danger">{{ count(array_filter(request()->input('filter')?:[], function($filter){return $filter !== null && $filter !== '';})) }}</span>
    @endif
    </span>
    <a href="{{ route('admin.auth.user.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
</div><!--btn-toolbar-->

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle">
                    <span class="title-text"></span>
                    <br/>
                    <small class="text-muted">@lang('labels.backend.access.users.filter')</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('buttons.general.cancel')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ html()->form('GET')->class('form-horizontal')->id('filterForm')->open() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.access.users.table.username')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['username'] }}" name="filter[username]" type="text" class="form-control"/>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.access.users.table.name')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['user.full_name'] }}" name="filter[full_name]" type="text" class="form-control"/>

                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.access.users.table.company')</span>
                    </div>
                    {{ html()->select('filter[company_id]', [null => null] + $companies)
                        ->value(@request()->input()['filter']['company_id'])
                        ->class('form-control')
                    }}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.access.users.confirmed')</span>
                    </div>
                    {{ html()->select('filter[confirmed]', [null => null] + [0 => __('labels.general.no'), 1 => __('labels.general.yes')])
                        ->value(@request()->input()['filter']['confirmed'])
                        ->class('form-control')
                    }}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@lang('labels.backend.access.users.registered_at')</span>
                    </div>
                    <input value="{{ @request()->input()['filter']['created_at_start'] }}" name="filter[created_at_start]" type="date" class="form-control">

                    <input value="{{ @request()->input()['filter']['created_at_end'] }}" name="filter[created_at_end]" type="date" class="form-control">
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
