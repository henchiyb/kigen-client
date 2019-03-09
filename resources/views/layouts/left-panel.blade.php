<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href=""><i class="menu-icon fa fa-laptop"></i>{{ __('Dashboard') }} </a>
                    </li>
                    <li class="menu-title">Management</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Managers</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="">Farm Manager</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="">Transportation Manager</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="">Store Manager</a></li>
                            {{-- <li><i class="menu-icon fa fa-area-chart"></i><a href="{{ route('users.show', ['id' => 1]) }}">First user</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Employers</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="">Farm Employer</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="">Transportation Manager</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="">Store Manager</a></li>
                            {{-- <li><i class="menu-icon fa fa-area-chart"></i><a href="{{ route('users.show', ['id' => 1]) }}">First user</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Transactions</a>
                        <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-map-o"></i><a href="">Transaction</a></li>
                        {{-- <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Charts</a></li> --}}
                        </ul>
                    </li>
                    <li class="menu-title">Extras</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Account</a>
                        <ul class="sub-menu children dropdown-menu">
                            @guest
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="">Login</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="">Register</a></li>
                            @else
                            <li><i class="menu-icon fa fa-sign-in"></i><a onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a></li>
                            @endguest

                    <form id="logout-form" action="" method="POST" style="display: none;">
                        @csrf
                    </form>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
