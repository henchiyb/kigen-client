<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href=""><i class="menu-icon fa fa-laptop"></i>{{ __('Dashboard') }} </a>
                    </li>
                    <li class="menu-title">{{ __('admin_header.HRM') }}</li><!-- /.menu-title -->

                    {{-- <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Cấp quyền</a>
                            <ul class="sub-menu children dropdown-menu">
                                @if (Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_MAIN_MANAGER) || 
                                    Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_ADMIN))
                                <li><i class="menu-icon fa fa-area-chart"></i><a href="{{ route('all-managers') }}">Cấp quyền quản lý</a></li>
                                @endif
                                <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('farmer-managers') }}">Cấp quyền nhân viên</a></li>
                            </ul>
                    </li> --}}
                    @if (Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_MAIN_MANAGER) || 
                        Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_ADMIN))
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>{{ __('admin_header.manager') }}</a>
                        <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="{{ route('all-managers') }}">{{ __('admin_header.all_manager') }}</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('farmer-managers') }}">{{ __('admin_header.farm_manager') }}</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('transportation-managers') }}">{{ __('admin_header.transportation_manager') }}</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('store-managers') }}">{{ __('admin_header.store_manager') }}</a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>{{ __('admin_header.employer') }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="{{ route('all-employers') }}">{{ __('admin_header.all_employers') }}</a></li>
                            @if (Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_MAIN_MANAGER) || 
                                Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_FARM_MANAGER))
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('farmer-employers') }}">{{ __('admin_header.farm_employer') }}</a></li>
                            @elseif (Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_MAIN_MANAGER) || 
                                Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_TRANSPORTATION_MANAGER))
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('transportation-employers') }}">{{ __('admin_header.transportation_employer') }}</a></li>
                            @elseif (Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_MAIN_MANAGER) || 
                                Session::get('currentUser')->hasRole(\App\Role\Role::ROLE_STORE_MANAGER))
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('store-employers') }}">{{ __('admin_header.store_employer') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="menu-title">Quản lý hệ thống</li>
                    @if (\App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_FARM_MANAGER)
                        || \App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_STORE_MANAGER))
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>{{ __('admin_header.list_of_farm_store') }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if (\App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_FARM_MANAGER))
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="/farms">{{ __('admin_header.farms') }}</a></li>
                            @elseif (\App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_FARM_MANAGER))
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="/stores">{{ __('admin_header.stores') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>{{ __('admin_header.products') }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="/admin/products">{{ __('admin_header.all_products') }}</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">{{ __('admin_header.bonus') }}</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>{{ __('admin_header.account') }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if (Session::get('currentUser') == null)
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="">{{ __('admin_header.register') }}</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="">{{ __('admin_header.login') }}</a></li>
                            @else
                            <li><i class="menu-icon fa fa-sign-in"></i><a onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('admin_header.logout') }}</a></li>
                            @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
