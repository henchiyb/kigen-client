@extends('layouts.master')
@section('content')
<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 bg-gradient-default">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h2>{{ __('create_package.create_package') }}</h2>
              </div>
              <form id="create-form" method="POST" enctype="multipart/form-data" action="{{ route('post-create-package') }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group-alternative mb-3">
                    <select class="form-control productSelect" name="name" required></select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group-alternative mb-3">
                    <select class="form-control input-group-alternative farmSelect" name="farmId" required type="text"></select>
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="{{ __('create_package.harvest_date') }}" name="harvest" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-collection"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('create_package.number') }}" name="numberOf" type="number" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-collection"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('create_package.price') }}" name="unitPrice" type="number" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-collection"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('create_package.status') }}" name="status" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-collection"></i></span>
                      </div>
                      <input class="form-control" placeholder="Anh" type="file" name="upload-file" required>
                    </div>
                  </div>
                <div class="text-center">
                  <button id="btnActive" type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">{{ __('create_package.create') }}</button>
                </div>
                <input id="submit-handle" type="submit" style="display: none">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('create_package.confirm') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{ __('create_package.modal_content') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" onclick="onClickBtnSubmit()" class="btn btn-primary btn-submit-create">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('create_package.success') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! base64_encode(Session::get('success1')) !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
      function onClickBtnSubmit(){
        $('#submit-handle').click();
        $('#exampleModal').modal('toggle');
      } 
  </script>
  @if(!empty(Session::get('success1')))
  <script>
    $(function() {
        $('#successModal').modal('toggle');
    });
  </script>
  @endif
@endsection
