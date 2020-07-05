@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.services.service.management'))

@section('breadcrumb-links')
    {{--@include('backend.services.service.includes.breadcrumb-links')--}}
@endsection

@section('content')
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

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="serviceTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="true"><i class="fas fa-info"></i> @lang('labels.backend.services.service.tabs.titles.profile')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#companies" role="tab" aria-controls="services" aria-expanded="true"><i class="fas fa-cog"></i> @lang('labels.backend.services.service.tabs.titles.companies')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel" aria-expanded="true">
                            @include('backend.services.service.edit.tabs.overview')
                        </div><!--tab-->
                        <div class="tab-pane fade" id="companies" role="tabpanel" aria-expanded="true">
                            @include('backend.services.service.edit.tabs.companies')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
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

        $("#logo").change(function () {
            readURL(this);
        });


        // switch to active tab on page reload
        $('a[data-toggle="tab"]').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            let id = $(e.target).attr("href");
            localStorage.setItem('selectedTab', id)
        });

        let selectedTab = localStorage.getItem('selectedTab');

        if (selectedTab != null) {
            $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
        }

    </script>
@endpush
