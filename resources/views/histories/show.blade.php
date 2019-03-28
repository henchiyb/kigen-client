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
          </div>
          <div class="mt-4 py-5 border-top text-center">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <p> </p>                
              </div>
            </div>
            <div class="cd-horizontal-timeline">
            <div class="timeline">
                <div class="events-wrapper">
                  <div class="events">
                    <ol>
                      <li>
                        <a href="#0" data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[0]['transactionTimestamp']))}}" class="selected"><i class="fa fa-play" style="color:green;" aria-hidden="true"></i>
                          {{ date('d/m', strtotime($listProduct[0]['createDate'])) }}</a>
                      </li>
                      @for ($i = 1; $i < sizeof($listTransaction); $i++)
                          <li><a href="#0" data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                            @if ($listTransaction[$i]['transactionType'] == 'org.hyperledger.composer.system.UpdateAsset')
                            <i class="fa fa-exclamation-triangle" style="color:yellow;" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            @endif
                            {{ date('d/m', strtotime($listTransaction[$i]['transactionTimestamp']))}}</a>
                          </li>
                        @endfor
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
                    <li class="selected" data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[0]['transactionTimestamp']))}}">
                      <h3>{{ __('Thu hoạch') }}</h3>
                      <h5>Ngày thu hoạch: {{ date('d/m/Y H:m', strtotime($listProduct[0]['createDate']))}}</em>
                      <div><i class="ni education_hat mr-2 justify-content-center"></i>Người sản xuất: <a href="/users/{{ App\Card::where('name',preg_split('/#/', $listProduct[0]['farmer'])[1] . "@kigen")->first()->user->id }}">
                        {{ App\Card::where('name',preg_split('/#/', $listProduct[0]['farmer'])[1] . "@kigen")->first()->user->username }} </a> 
                      </div>
                      <img src= "/{{ $listProduct[0]['imgLink'] }}" width="200" height="200" alt="Card image cap" class="m-3">
                    </li>
                  @for ($i = 1; $i < sizeof($listProduct); $i++)
                      @if ($listTransaction[$i]['transactionType'] == 'org.hyperledger.composer.system.UpdateAsset')
                      <li data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                        <h3>{{ __('Thay đổi dữ liệu') }}</h3>
                        <h5>Ngày thay đổi: {{ date('d/m/Y H:m', strtotime($listProduct[$i]['createDate']))}}</em>
                        <div><i class="ni education_hat mr-2 justify-content-center"></i>Người thay đổi: {{ preg_split('/#/', $listTransaction[$i]['participantInvoking'])[1] }}</div>
                        <h5>Dữ liệu thay đổi từ {{ json_encode(array_diff($listProduct[$i - 1], $listProduct[$i])) }} sang 
                            {{ json_encode(array_diff($listProduct[$i], $listProduct[$i - 1])) }} </h5>
                      </li>    
                      @else
                        <li data-date="{{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                          @if ($listTransaction[$i]['eventsEmitted'][0]['type'] == 'TRANSPORTATION')
                          <h3>{{ __('Vận chuyển') }}</h3>
                          @elseif ($listTransaction[$i]['eventsEmitted'][0]['type'] == 'STORED')
                          <h3>{{ __('Lưu trữ') }}</h3>
                          @elseif ($listTransaction[$i]['eventsEmitted'][0]['type'] == 'RETAIL')
                          <h3>{{ __('Bán lẻ') }}</h3>
                          @endif
                          <h5>Ngày bắt đầu: {{ date('d/m/Y H:m', strtotime($listTransaction[$i]['transactionTimestamp'])) }}</em>
                          <div><i class="ni education_hat mr-2 justify-content-center"></i>Người nhận: {{ $listTransaction[$i]['eventsEmitted'][0]['toId'] }}</div>
                          <img src= "/{{$listTransaction[$i]["eventsEmitted"][0]["imgLink"]}}" width="200" height="200" alt="Card image cap" class="m-3">
                        </li>
                      @endif
                    @endfor
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
