@extends('layouts.master')
@section('content')
<div class="profile-page">
<section class="section-profile-cover section-shaped my-0">
    <!-- Circles background -->
    <div class="shape shape-style-1 shape-primary alpha-4">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <!-- SVG separator -->
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
                  <img src="/{{ $qryResponse['img_link'] }}" width="150" height="150" class="rounded-circle">
                  </a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                  <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-actions py-4 mt-lg-0">
                  @if ($isPermissioned)
                    {{ __('profile.position') }}{{ $role }}
                  @else
                    <form id="permission-form" method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <div class="card-profile-actions py-4 mt-lg-0 text-center">
                        <input type="file" name="upload-file">
                        <button type="submit" class="btn btn-default mr-4 mt-2">
                          <small>Submit</small>
                        </button>
                      </div>                                                        
                    </form>
                  @endif
                </div>
              </div>
            </div>
            <div class="text-center mt-5">
              <h3>{{ Session::get('currentUser')->username }}
                <span class="font-weight-light"></span>
              </h3>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>Email: {{ Session::get('currentUser')->email }}</div>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>{{ __('profile.birthday') }}{{ date('d/m/Y', strtotime($qryResponse['birthday'])) }}</div>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>{{ __('profile.phone') }}{{ $qryResponse['phone'] }}</div>
              <div><i class="ni education_hat mr-2"></i>{{ __('profile.address') }}{{ $qryResponse['address'] }}</div>
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  {{-- <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection

  <script>
    $(document).ready(function(){
    
     $('#permission-form').on('submit', function(event){
      event.preventDefault();
      $.ajax({
       url:"{{ route('upload-permission') }}",
       method:"POST",
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
       }
      })
     });
    
    });
    </script>