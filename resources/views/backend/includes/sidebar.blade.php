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
                <h6><b>@lang('menus.backend.sidebar.access')</b></h6>
            </li>

            @can(config('permission.permissions.read_users'))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="{{ route('admin.auth.user.index') }}">
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

            @if(Gate::check(config('permission.permissions.read_services'))
            || Gate::check(config('permission.permissions.read_commissions'))
            || Gate::check(config('permission.permissions.read_distributions'))
            || Gate::check(config('permission.permissions.read_payment_methods')))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/services*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/services*')) }}" href="{{ route('admin.services.service.index') }}">
                        <i class="nav-icon icon-grid"></i> @lang('menus.backend.services.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        @can(config('permission.permissions.read_commissions'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/commission*')) }}" href="{{ route('admin.services.commission.index') }}">
                                    @lang('labels.backend.services.commission.management')
                                </a>
                            </li>
                        @endcan
                        @can(config('permission.permissions.read_distributions'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/distribution*')) }}" href="{{ route('admin.services.distribution.index') }}">
                                    @lang('labels.backend.services.distribution.management')
                                </a>
                            </li>
                        @endcan
                        @can(config('permission.permissions.read_services'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/service*')) }}" href="{{ route('admin.services.service.index') }}">
                                    @lang('labels.backend.services.service.management')
                                </a>
                            </li>
                        @endcan
                        @can(config('permission.permissions.read_categories'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/category*')) }}" href="{{ route('admin.services.category.index') }}">
                                    @lang('labels.backend.services.category.management')
                                </a>
                            </li>
                        @endcan
                        @can(config('permission.permissions.read_payment_methods'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/services/method*')) }}" href="{{ route('admin.services.method.index') }}">
                                    @lang('labels.backend.services.method.management')
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @can(config('permission.permissions.read_accounts'))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/accounts*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/accounts*')) }}" href="{{ route('admin.account.deposit.index') }}">
                        <i class="nav-icon icon-drawer"></i> @lang('menus.backend.accounts.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/account/deposit*')) }}" href="{{ route('admin.account.deposit.index') }}">
                                @lang('menus.backend.accounts.deposit.management')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/account/umbrella*')) }}" href="{{ route('admin.account.umbrella.index') }}">
                                @lang('menus.backend.accounts.umbrella.management')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/account/payout*')) }}" href="{{ route('admin.account.payout.index') }}">
                                @lang('menus.backend.accounts.payout.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can(config('permission.permissions.read_provisions'))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/accounting*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/accounting*')) }}" href="{{ route('admin.accounting.provision.index') }}">
                        <i class="nav-icon icon-book-open"></i> @lang('menus.backend.accounting.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/accounting/provision*')) }}" href="{{ route('admin.accounting.provision.index') }}">
                                @lang('menus.backend.accounting.provisions.management')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/accounting/collection*')) }}" href="{{ route('admin.accounting.collection.index') }}">
                                @lang('menus.backend.accounting.collections.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/sales')) }}" href="{{ route('admin.sales.index') }}">
                    <i class="nav-icon icon-basket-loaded"></i> @lang('menus.backend.sidebar.sales')
                </a>
            </li>
            @if($logged_in_user->company->is_merchant)
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/orders')) }}" href="{{ route('admin.orders.index') }}">
                        <i class="nav-icon icon-basket-loaded"></i> @lang('menus.backend.sidebar.orders')
                    </a>
                </li>
            @endif
            <li class="nav-title">
                <h6><b>@lang('menus.backend.sidebar.system')</b></h6>
            </li>
            @if ($logged_in_user->isAdmin() && $logged_in_user->company->isDefault())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/administration*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/administration*')) }}" href="{{ route('admin.administration.currency.index') }}">
                        <i class="nav-icon icon-list"></i> @lang('menus.backend.administration.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        @can(config('permission.permissions.read_currencies'))
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/administration/currency*')) }}" href="{{ route('admin.administration.currency.index') }}">
                                    @lang('menus.backend.administration.currency.management')
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            @if ($logged_in_user->isAdmin() && $logged_in_user->company->isDefault())
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
            @endif
            <li class="divider"></li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
