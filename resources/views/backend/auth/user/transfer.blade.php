@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.edit'))

@section('content')
    {{ html()->form('PATCH', route('admin.auth.user.transfer.post', $user))->class('form-horizontal')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.transfer')</small>
                    </h4>
                    <div class="small text-muted">
                        @lang('labels.backend.access.users.transfer_user', ['user' => $user->name])
                    </div>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('full_names')
                                ->class('form-control')
                                ->value($user->name)
                                ->disabled() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.company'))->class('col-md-2 form-control-label required')->for('company_id') }}

                        <div class="col-md-10">
                            {{ html()->select('company_id', $companies)
                                ->class('form-control')
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.access.users.table.abilities'))->class('col-md-2 form-control-label') }}

                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        {{--<th>@lang('labels.backend.access.users.table.permissions')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox d-flex align-items-center">
                                                                {{ html()->label(
                                                                        html()->checkbox('roles[]', old('roles') && in_array($role->name, old('roles')) ? true : false, $role->name)
                                                                              ->class('switch-input')
                                                                              ->id('role-'.$role->id)
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                    ->for('role-'.$role->id) }}
                                                                {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                        {{--<div class="card-body">--}}
                                                        {{--@if($role->id != 1)--}}
                                                        {{--@if($role->permissions->count())--}}
                                                        {{--@foreach($role->permissions as $permission)--}}
                                                        {{--<i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}--}}
                                                        {{--@endforeach--}}
                                                        {{--@else--}}
                                                        {{--@lang('labels.general.none')--}}
                                                        {{--@endif--}}
                                                        {{--@else--}}
                                                        {{--@lang('labels.backend.access.users.all_permissions')--}}
                                                        {{--@endif--}}
                                                        {{--</div>--}}
                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        {{--<td>--}}
                                        {{--@if($permissions->count())--}}
                                        {{--@foreach($permissions as $permission)--}}
                                        {{--<div class="checkbox d-flex align-items-center">--}}
                                        {{--{{ html()->label(--}}
                                        {{--html()->checkbox('permissions[]', old('permissions') && in_array($permission->name, old('permissions')) ? true : false, $permission->name)--}}
                                        {{--->class('switch-input')--}}
                                        {{--->id('permission-'.$permission->id)--}}
                                        {{--. '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')--}}
                                        {{--->class('switch switch-label switch-pill switch-primary mr-2')--}}
                                        {{--->for('permission-'.$permission->id) }}--}}
                                        {{--{{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}--}}
                                        {{--</div>--}}
                                        {{--@endforeach--}}
                                        {{--@endif--}}
                                        {{--</td>--}}
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.role.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
