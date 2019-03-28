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
                    <span class="nav-link-inner--text">{{ __('Tài khoản') }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-xl">
                    <div class="dropdown-menu-inner">
                    <a href="{{ route('register') }}" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                          <i class="ni ni-spaceship"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('Tạo tài khoản') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('Tạo tài khoản mới để tham gia vào hệ thống') }}</p>
                        </div>
                      </a>
                      <a href="{{ route('login') }}" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                          <i class="ni ni-palette"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('Đăng nhập') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('Đăng nhập để sử dụng hệ thống') }}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                    <i class="ni ni-collection d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('Giới thiệu') }}</span>
                  </a>
                  <div class="dropdown-menu">
                    {{-- TODO: link to product information --}}
                    <a href="#" class="dropdown-item">{{ __('Sản phẩm') }}</a>
                    {{-- TODO: link to development team --}}
                    <a href="#" class="dropdown-item">{{ __('Đội ngũ phát triển') }}</a>
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
                    <span class="nav-link-inner--text">{{ __('Đăng ký') }}</span>
                  </a>
                </li>
              </ul>
              @else
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('Chức năng') }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-xl">
                    <div class="dropdown-menu-inner">
                    <a href="/create" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                          <i class="ni ni-spaceship"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('Tạo gói hàng mới') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('Tạo gói hàng mới được đóng gói') }}</p>
                        </div>
                      </a>
                      <a href="/transfer" class="media d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                          <i class="ni ni-palette"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="heading text-primary mb-md-1">{{ __('Chuyển giao') }}</h6>
                          <p class="description d-none d-md-inline-block mb-0">{{ __('Chuyển gói hàng cho nhân viên khác') }}</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a href="/profile" class="nav-link" role="button">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">{{ __('Thông tin cá nhân') }}</span>
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                  <a class="nav-link nav-link-icon" 
                    href="#" target="_blank"> {{ Session::get('currentUser')->name }}
                  </a>
                </li>
                <li class="nav-item d-none d-lg-block ml-lg-4">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-neutral btn-icon">
                        <span class="btn-inner--icon">
                          <i class="ni ni-lock-circle-open mr-2"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('Đăng xuất') }}</span>
                      </button>
                    </form>
                </li>
              </ul>
              @endif
            </div>
          </div>
        </nav>
</header>