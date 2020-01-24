<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                <h6><b>@lang('menus.backend.sidebar.general')</b></h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-title">
                <h6><b>@lang('menus.backend.sidebar.system')</b></h6>
            </li>

            @can(config('permission.permissions.read_users'))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="nav-icon icon-user"></i> @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        @if ($logged_in_user->id == 1)
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                    @lang('labels.backend.access.roles.management')
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endcan

            <li class="divider"></li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}" href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="divider"></li>

            <li class="nav-title">
                <h6><b>@lang('menus.backend.sidebar.business')</b></h6>
            </li>

            @can(config('permission.permissions.read_companies'))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/companies*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/companies*')) }}" href="{{ route('admin.companies.company.index') }}">
                        <i class="nav-icon icon-organization"></i> @lang('menus.backend.companies.title')
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/companies/company*')) }}" href="{{ route('admin.companies.company.index') }}">
                                @lang('labels.backend.companies.company.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @if(Gate::check(config('permission.permissions.read_services')) || Gate::check(config('permission.permissions.read_commissions')))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/services*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/services*')) }}" href="{{ route('admin.services.service.index') }}">
                        <i class="nav-icon icon-grid"></i> @lang('menus.backend.services.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        @can(config('permission.permissions.read_services'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/service*')) }}" href="{{ route('admin.services.service.index') }}">
                                    @lang('labels.backend.services.service.management')
                                </a>
                            </li>
                        @endcan
                        @can(config('permission.permissions.read_commissions'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/commission*')) }}" href="{{ route('admin.services.commission.index') }}">
                                    @lang('labels.backend.services.commission.management')
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
