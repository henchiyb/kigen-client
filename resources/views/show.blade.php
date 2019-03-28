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
      <svg x="0" y="0" viewBox="0 0 2000 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-white" points="2000 0 2000 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="card card-profile shadow mt--450">
        <div class="px-4">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="#">
                  <img src="/{{ App\Product::find(1)->images->first()->img_link }}" class="rounded-circle">
                </a>
              </div>
            </div>
            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
              <div class="card-profile-actions py-4 mt-lg-0">
                  <div class="visible-print text-center">
                      {!! QrCode::size(100)->generate('https://google.com') !!}
                      <p>Quét để vào trang thông tin này</p>
                  </div>
              </div>
            </div>
            <div class="col-lg-4 order-lg-1">
              <div class="card-profile-stats d-flex justify-content-center">
                <div class="text-center">
                  <div>
                    <a href="#">
                      <img width="80" height="80" src="/{{ App\Product::find(1)->images->first()->img_link }}" class="rounded-circle">
                    </a>
                  </div>
                  <div class="mt-2"><p>Trang trại Vĩnh nông</p></div>
                  <div>Vĩnh Hà, Phú Xuyên</div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <h3>{{ App\Product::find(1)->name }}
            </h3>
            <div class="h6"><i class="ni business_briefcase-24 mr-2"></i>Trang trại Vĩnh nông</div>
            <div><i class="ni education_hat mr-2"></i>Vĩnh Hà, Phú Xuyên</div>
          </div>
          <div class="mt-4 py-5 border-top text-center">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <p>Xoài cát chu (tên khoa học là Mangifera indica) vốn là giống xoài truyền thống ở Đồng Tháp biết bao đời nay, có thể nói nó thuần chủng 100%. Xoài được nhận xét là hoa quả rất ít xơ, hương thơm nồng nàn quyến rũ, vị ngọt đầm đà. </p>                </div>
            </div>
            <div class="cd-horizontal-timeline">
              <div class="timeline">
                  <div class="events-wrapper">
                    <div class="events">
                      <ol>
                          <li><a href="#0" data-date="25/03/2019">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            25/03/2019</a>
                          </li>
                        {{-- @for ($i = 0; $i < sizeof($listTransaction); $i++)
                          
                          <li><a href="#0" data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            {{ date('d/m', strtotime($listTransaction[$i]['transactionTimestamp']))}}</a>
                          </li>
                        @endfor --}}
                      </ol>
                      <span class="filling-line" aria-hidden="true"></span>
                    </div> <!-- .events -->
                  </div> <!-- .events-wrapper -->
                    
                  <ul class="cd-timeline-navigation">
                    <li><a href="#0" class="prev inactive">Prev</a></li>
                    <li><a href="#0" class="next">Next</a></li>
                  </ul> <!-- .cd-timeline-navigation -->
              </div> <!-- .timeline -->
          
              <div class="events-content">
                  <ol>
                    <li data-date="25/03/2019">
                        <h2>Event title here</h2>
                        <em>March 3rd, 2015</em>
                        <p>	
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                        </p>
                      </li>
                    {{-- @for ($i = 0; $i < sizeof($listProduct); $i++)
                      @if ($listTransaction[$i]['transactionType'] == 'kigen.transactions.CreatePackageTransaction')
                        <li class="selected" data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp']))}}">
                          <h3>{{ __('Thu hoạch') }}</h3>
                          <h5>Ngày thu hoạch: {{ date('d/m/Y H:m', strtotime($listProduct[$i]['createDate']))}}</em>
                          <div><i class="ni education_hat mr-2 justify-content-center"></i>Người sản xuất: <a href="/users/{{ App\Card::where('name',preg_split('/#/', $listProduct[$i]['farmer'])[1] . "@kigen")->first()->user->id }}">
                            {{ App\Card::where('name',preg_split('/#/', $listProduct[$i]['farmer'])[1] . "@kigen")->first()->user->username }} </a> 
                          </div>
                          <img src= "/{{ $listProduct[$i]['imgLink'] }}" width="200" height="200" alt="Card image cap" class="m-3">
                        </li>
                      @elseif ($listTransaction[$i]['transactionType'] == 'org.hyperledger.composer.system.UpdateAsset')
                        <p>aa</p>
                      @else
                        <li data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                          <h3>{{ __('Thu hoạch') }}</h3>
                          <h5>Ngày bắt đầu: {{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}</em>
                          <div><i class="ni education_hat mr-2 justify-content-center"></i>Người nhận: {{ $listTransaction[$i]['eventsEmitted'][0]['toId'] }}</div>
                          <img src= "/{{$listTransaction[$i]["eventsEmitted"][0]["imgLink"]}}" width="200" height="200" alt="Card image cap" class="m-3">
                        </li>
                      @endif
                    @endfor --}}
                  </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<script src="/source/assets/js/jquery-2.1.4.js"></script>
<script src="/source/assets/js/jquery.mobile.custom.min.js"></script>
<script src="/source/assets/js/main.js"></script>
@endsection
