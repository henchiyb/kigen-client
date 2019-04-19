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
                <h2>{{ __('transfer.transport_to') }}</h2>
              </div>
              <form id="transfer-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-app"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('transfer.product') }}" name="product" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="{{ __('transfer.receiver') }}" name="newHolder" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="{{ __('transfer.trans_date') }}" name="harvest" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-collection"></i></span>
                      </div>
                    <select name="type" class="form-control" required>
                      <option value="TRANSPORTATION" selected="selected">{{ __('transfer.transportation') }}</option>
                      <option value="STORED">{{ __('transfer.stored') }}</option>
                      <option value="RETAIL">{{ __('transfer.retailed') }}</option>
                    </select>
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
                  <input id="submit-handle" type="submit" style="display: none">
                  <button id="btnActive" type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">{{ __('transfer.transport') }}</button>
                </div>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('transfer.confirm') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{ __('transfer.confirm_content') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" onclick="onClickBtnSubmit()" class="btn btn-primary">OK</button>
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
@endsection
