<header class="header-global">
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
          <div class="container">
            <a class="navbar-brand mr-lg-5" href="/">
                {{-- TODO: icon of page white --}}
              <img src="/source/assets/img/brand/white.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
              <div class="navbar-collapse-header">
                <div class="row">
                  <div class="col-6 collapse-brand">
                    <a href="#">
                        {{-- TODO: icon of page blue --}}
                      <img src="/source/assets/img/brand/blue.png">
                    </a>
                  </div>
                  <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                      <span></span>
                      <span></span>
                    </button>
                  </div>
                </div>
              </div>
              @if (Session::get('currentUser') == null)
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('header.account') }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-xl">
                    <div class="dropdown-menu-inner">
                    <a href="{{ route('register') }}" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                          <i class="ni ni-spaceship"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('header.account_create') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('header.account_create_inf') }}</p>
                        </div>
                      </a>
                      <a href="{{ route('login') }}" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                          <i class="ni ni-palette"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('header.login') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('header.login_inf') }}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                    <i class="ni ni-collection d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('header.introduce') }}</span>
                  </a>
                  <div class="dropdown-menu">
                    {{-- TODO: link to product information --}}
                    <a href="#" class="dropdown-item">{{ __('header.product') }}</a>
                    {{-- TODO: link to development team --}}
                    <a href="#" class="dropdown-item">{{ __('header.developer') }}</a>
                  </div>
                </li>
                
              </ul>
              <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" href="https://www.facebook.com/ngynducnhan" target="_blank" data-toggle="tooltip" title="Thích trang trên Facebook">
                    <i class="fa fa-facebook-square"></i>
                    <span class="nav-link-inner--text d-lg-none">Facebook</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" href="https://www.instagram.com/ducnhanyb" target="_blank" data-toggle="tooltip" title="Theo dõi trên Instagram">
                    <i class="fa fa-instagram"></i>
                    <span class="nav-link-inner--text d-lg-none">Instagram</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" href="https://twitter.com/ngynducnhan" target="_blank" data-toggle="tooltip" title="Theo dõi trên Twitter">
                    <i class="fa fa-twitter-square"></i>
                    <span class="nav-link-inner--text d-lg-none">Twitter</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" href="https://github.com/henchiyb" target="_blank" data-toggle="tooltip" title="Thích trên Github">
                    <i class="fa fa-github"></i>
                    <span class="nav-link-inner--text d-lg-none">Github</span>
                  </a>
                </li>
                <li class="nav-item d-none d-lg-block ml-lg-4">
                  <a href="/register" target="_blank" class="btn btn-neutral btn-icon">
                    <span class="btn-inner--icon">
                      <i class="ni ni-lock-circle-open mr-2"></i>
                    </span>
                    <span class="nav-link-inner--text">{{ __('header.register') }}</span>
                  </a>
                </li>
              </ul>
              @else
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                @if (\App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_EMPLOYER))
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('header.action') }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-xl">
                    <div class="dropdown-menu-inner">
                    @if (\App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_FARMER))
                    <a href="/create" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                          <i class="ni ni-spaceship"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('header.create_package') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('header.create_package_inf') }}</p>
                        </div>
                      </a>
                    @endif
                      <a href="/transfer" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                          <i class="ni ni-palette"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('header.transportation') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('header.transportation_inf') }}</p>
                        </div>
                      </a>
                      <a href="/products" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                          <i class="ni ni-palette"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('header.list_holding') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('header.list_holding_inf') }}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                @endif
                <li class="nav-item dropdown">
                  <a href="/profile" class="nav-link" role="button">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('header.personal') }}</span>
                  </a>
                </li>
                @if (\App\Role\RoleChecker::check(Session::get('currentUser'), \App\Role\Role::ROLE_MANAGER))
                <li class="nav-item dropdown">
                    <a href="/admin" class="nav-link" role="button">
                      <i class="ni ni-ui-04 d-lg-none"></i>
                      <span class="nav-link-inner--text">{{ __('header.management') }}</span>
                    </a>
                  </li>
                @endif
              </ul>
              <div class="dropdown align-items-lg-center ml-lg-auto">
                <a href="#" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                  <i class="fa fa-language"></i> {{ __('header.language') }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                    <li>
                        <a class="dropdown-item" href="/locale/en">
                           English(EN)
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/locale/vi">
                           Tiếng việt(VI)
                        </a>
                    </li>
                </ul>
              </div>
              <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" 
                    href="#" target="_blank"> {{ Session::get('currentUser')->username }}
                  </a>
                </li>
                <li class="nav-item d-none d-lg-block ml-lg-4">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-neutral btn-icon">
                        <span class="btn-inner--icon">
                          <i class="ni ni-lock-circle-open mr-2"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('header.logout') }}</span>
                      </button>
                    </form>
                </li>
              </ul>
              @endif
            </div>
          </div>
        </nav>
</header>