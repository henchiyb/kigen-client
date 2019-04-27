@extends('layouts.master')
@section('content')
<style>
    body {
      font-family: Verdana, sans-serif;
      margin: 0;
    }
    
    * {
      box-sizing: border-box;
    }
    
    .row > .column {
      padding: 0 8px;
    }
    
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    
    .column {
      float: left;
      width: 25%;
    }
    
    /* The Modal (background) */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: black;
    }
    
    /* Modal Content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      width: 90%;
      max-width: 1200px;
    }
    
    /* The Close Button */
    .close {
      color: white;
      position: absolute;
      top: 10px;
      right: 25px;
      font-size: 35px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: #999;
      text-decoration: none;
      cursor: pointer;
    }
    
    .mySlides {
      display: none;
    }
    
    .cursor {
      cursor: pointer;
    }
    
    /* Next & previous buttons */
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      margin-top: -50px;
      color: white;
      font-weight: bold;
      font-size: 20px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }
    
    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    
    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
    
    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
    
    img {
      margin-bottom: -4px;
    }
    
    .caption-container {
      text-align: center;
      background-color: black;
      padding: 2px 16px;
      color: white;
    }
    
    .demo {
      opacity: 0.6;
    }
    
    .active,
    .demo:hover {
      opacity: 1;
    }
    
    img.hover-shadow {
      transition: 0.3s;
    }
</style>
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
                <a href="/products/{{ $listProduct[0]['productSerial'] }}">
                  <img src="/{{ App\Product::find($listProduct[0]['productSerial'])->images->first()->img_link }}" class="rounded-circle">
                </a>
              </div>
            </div>
            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
              <div class="card-profile-actions py-4 mt-lg-0">
                  <div class="visible-print text-center">
                    <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate(Request::url())) !!}" download>
                      <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate(Request::url())) !!}" >
                    </a>
                      {{-- {!! QrCode::size(100)->generate(Request::url()) !!} --}}
                      <p>Quét để vào trang thông tin này</p>
                  </div>
              </div>
            </div>
            <div class="col-lg-4 order-lg-1">
              <div class="card-profile-stats d-flex justify-content-center">
                <div class="text-center">
                    <a onclick="openModal();currentSlide(1)">
                        @for ($i = 0; $i < sizeof(App\Farm::find($listProduct[0]['farmId'])->images); $i++)
                        <img class="mySlides w3-animate-fading rounded-circle" style="margin-left: auto; margin-right: auto" width="80" height="80" src="/{{ App\Farm::find($listProduct[0]['farmId'])->images[$i]->img_link }}">
                        @endfor
                    </a>
                  <div class="mt-2"><a href="/farms/{{ $listProduct[0]['farmId'] }}">{{ App\Farm::find($listProduct[0]['farmId'])->name }}</a></div>
                  <div>{{ App\Farm::find($listProduct[0]['farmId'])->address }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <h3>{{ App\Product::find($listProduct[0]['productSerial'])->name }}
            </h3>
          </div>
          <div class="mt-4 py-5 border-top text-center">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <p> {{ App\Product::find($listProduct[0]['productSerial'])->description }}</p>                
              </div>
            </div>
            <div class="cd-horizontal-timeline">
            <div class="timeline">
                <div class="events-wrapper">
                  <div class="events">
                    <ol>
                      <li>
                        <a href="#0" data-date="{{ date('d/m/Y H:i:s', strtotime($listTransaction[0]['transactionTimestamp']))}}" class="selected"><i class="fa fa-play" style="color:green;" aria-hidden="true"></i>
                          {{ date('d/m', strtotime($listProduct[0]['createDate'])) }}</a>
                      </li>
                      @for ($i = 1; $i < sizeof($listTransaction); $i++)
                            @if ($listTransaction[$i]['transactionType'] == 'org.hyperledger.composer.system.UpdateAsset')
                            <li><a href="#0" data-date="{{ date('d/m/Y H:i:s', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                            <i class="fa fa-exclamation-triangle" style="color:yellow;" aria-hidden="true"></i>
                            {{ date('d/m', strtotime($listTransaction[$i]['transactionTimestamp']))}}</a>
                            @else
                            <li><a href="#0" data-date="{{ date('d/m/Y H:i:s', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            {{ date('d/m', strtotime($listTransaction[$i]['transactionTimestamp']))}}</a>
                            @endif
                            
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
                    <li class="selected" data-date="{{ date('d/m/Y H:i:s', strtotime($listTransaction[0]['transactionTimestamp']))}}">
                      <h3>{{ __('Thu hoạch') }}</h3>
                      <h5>Ngày thu hoạch: {{ date('d/m/Y H:i:s', strtotime($listProduct[0]['createDate']))}}</em>
                      <div><i class="ni education_hat mr-2 justify-content-center"></i>Người sản xuất: <a href="/users/{{ App\Card::where('name',preg_split('/#/', $listProduct[0]['farmer'])[1] . "@kigen")->first()->user->id }}">
                        {{ App\Card::where('name',preg_split('/#/', $listProduct[0]['farmer'])[1] . "@kigen")->first()->user->username }} </a> 
                      </div>
                      <img src= "/{{ $listProduct[0]['imgLink'] }}" width="200" height="200" alt="Card image cap" class="m-3">
                    </li>
                    @for ($i = 1; $i < sizeof($listProduct); $i++)
                      @if ($listTransaction[$i]['transactionType'] == 'org.hyperledger.composer.system.UpdateAsset')
                      <li data-date="{{ date('d/m/Y H:i:s', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                        <h3>{{ __('Thay đổi dữ liệu') }}</h3>
                        <h5>Ngày thay đổi: {{ date('d/m/Y H:i:s', strtotime($listTransaction[$i]['transactionTimestamp']))}}</em>
                        <div><i class="ni education_hat mr-2 justify-content-center"></i>Người thay đổi: {{ preg_split('/#/', $listTransaction[$i]['participantInvoking'])[1] }}</div>
                        <h5>Dữ liệu thay đổi từ {{ json_encode(array_diff($listProduct[$i - 1], $listProduct[$i])) }} sang 
                            {{ json_encode(array_diff($listProduct[$i], $listProduct[$i - 1])) }} </h5>
                      </li>    
                      @else
                        <li data-date="{{ date('d/m/Y H:i:s', strtotime($listTransaction[$i]['transactionTimestamp'])) }}">
                          @if ($listTransaction[$i]['eventsEmitted'][0]['type'] == 'TRANSPORTATION')
                          <h3>{{ __('Vận chuyển') }}</h3>
                          @elseif ($listTransaction[$i]['eventsEmitted'][0]['type'] == 'STORED')
                          <h3>{{ __('Lưu trữ') }}</h3>
                          @elseif ($listTransaction[$i]['eventsEmitted'][0]['type'] == 'RETAIL')
                          <h3>{{ __('Bán lẻ') }}</h3>
                          @endif
                          <h5>Ngày bắt đầu: {{ date('d/m/Y H:i:s', strtotime($listTransaction[$i]['transactionTimestamp'])) }}</em>
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
  <div id="myModal" class="modal">
      <span class="close cursor" onclick="closeModal()">&times;</span>
      <div class="modal-content">
        @for ($i = 0; $i < sizeof(App\Farm::find($listProduct[0]['farmId'])->images); $i++)
          <div class="myModalSlides">
            <img src="/{{ App\Farm::find($listProduct[0]['farmId'])->images[$i]->img_link }}" style="width:100%">
          </div>              
        @endfor
        
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
    </div>
    <script>
        var myIndex = 0;
        carousel();
        
        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 3000);
        }
      
        function openModal() {
        document.getElementById('myModal').style.display = "block";
        }
      
        function closeModal() {
          document.getElementById('myModal').style.display = "none";
        }
      
        var slideIndex = 1;
        showSlides(slideIndex);
      
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
      
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
      
        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("myModalSlides");
          var dots = document.getElementsByClassName("demo");
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
        }
        </script>
<script src="/source/assets/js/jquery-2.1.4.js"></script>
<script src="/source/assets/js/jquery.mobile.custom.min.js"></script>
<script src="/source/assets/js/main.js"></script>
@endsection
