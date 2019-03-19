@extends('layouts.master')
@section('content')
<div class="profile-page">
  <section class="section-profile-cover section-shaped my-0">
    <div class="shape shape-style-1 shape-primary alpha-4">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    
    <div class="separator separator-bottom separator-skew">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="card card-profile shadow mt--300">
        <div class="px-4">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="#">
                  <img src="/source/assets/img/theme/xoai-cat-chu-da-vang.png" class="rounded-circle">
                </a>
              </div>
            </div>
            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
              <div class="card-profile-actions py-4 mt-lg-0">
              </div>
            </div>
            <div class="col-lg-4 order-lg-1">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading">10</span>
                  <span class="description">Photos</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <h3>{{ __('Xoài cát chu') }}
              {{-- <span class="font-weight-light">, 27</span> --}}
            </h3>
            <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>{{ Session::get('currentUser')->email }}</div>
            <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Trang trại Vĩnh nông</div>
            <div><i class="ni education_hat mr-2"></i>Vĩnh Hà, Phú Xuyên</div>
          </div>
          <div class="mt-5 py-5 border-top text-center">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <p>Xoài cát chu (tên khoa học là Mangifera indica) vốn là giống xoài truyền thống ở Đồng Tháp biết bao đời nay, có thể nói nó thuần chủng 100%. Xoài được nhận xét là hoa quả rất ít xơ, hương thơm nồng nàn quyến rũ, vị ngọt đầm đà. </p>                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="container">
    <div class="card card-profile shadow">
        <div class="px-4">
          <div class="row justify-content-center">
          <div class="text-center mt-5 mb-3">
            <h3>{{ __('Thu hoạch') }}
            </h3>
          <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2 justify-content-center"></i>Ngày thu hoạch: {{ date('d-m-Y', strtotime($productResponse['createDate']))}}</div>
          <div><i class="ni education_hat mr-2 justify-content-center"></i>Trạng thái: </div>
          <div><i class="ni education_hat mr-2 justify-content-center"></i>Đơn giá: {{ $productResponse['unitPrice'] }}</div>
          <div><i class="ni education_hat mr-2 justify-content-center"></i>Người sản xuất: {{ $productResponse['farmer'] }}</div>

          </div>
        </div>
      </div>
    </div>
    @for ($i = 1; $i < sizeof($listPackageHistory); $i++)
      <div class="card card-profile shadow mt-3">
          <div class="px-4">
            <div class="row justify-content-center">
            <div class="text-center mt-5 mb-3">
              <h3>{{ __('Vận chuyển') }}</h3>
            <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2 justify-content-center"></i>Ngày bắt đầu: {{ date('d-m-Y', strtotime($listPackageHistory[$i]['transactionTimestamp'])) }}</div>
            <div><i class="ni education_hat mr-2 justify-content-center"></i>Người nhận: {{ $listPackageHistory[$i]['eventsEmitted'][0]['toId'] }}</div>
            </div>
          </div>
        </div>
      </div>
    @endfor
</div>
@endsection
