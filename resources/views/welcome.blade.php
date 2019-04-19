@extends('layouts.master')
@section('content')
        <div class="position-relative">
          <!-- shape Hero -->
          <section class="section section-lg section-shaped pb-250">
            <div class="shape shape-style-1 shape-default">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
            <div class="container py-lg-md d-flex">
              <div class="col px-0">
                <div class="row">
                  <div class="col-lg-6">
                    <h1 class="display-3 text-white">{{ __('welcome.traceability') }}
                      <span>{{ __('welcome.product') }}</span>
                    </h1>
                    <p class="lead  text-white">{{ __('welcome.system') }}</p>
                    <div class="btn-wrapper">
                        {{-- TODO link to guide  --}}
                      <a href="#" class="btn btn-info btn-icon mb-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="fa fa-book"></i></span>
                        <span class="btn-inner--text">{{ __('welcome.guide') }}</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew">
              <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
              </svg>
            </div>
          </section>
          <!-- 1st Hero Variation -->
        </div>
@endsection