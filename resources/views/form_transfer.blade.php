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
                <h2>Chuyển hàng cho nhân viên </h2>
              </div>
              <form id="transfer-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-app"></i></span>
                    </div>
                    <input class="form-control" placeholder="Sản phẩm" name="product" type="text">
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Người nhận" name="newHolder" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Ngày chuyển" name="harvest" type="text">
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-collection"></i></span>
                      </div>
                    <select name="type" class="form-control">
                      <option value="TRANSPORTATION" selected="selected">Vận chuyển</option>
                      <option value="STORED">Lưu trữ</option>
                      <option value="RETAIL">Bán hàng</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-collection"></i></span>
                    </div>
                    <input class="form-control" placeholder="Anh" type="file" name="upload-file">
                  </div>
                </div>

                <div class="text-center">
                  <button type="button submit" class="btn btn-primary mt-4">Chuyển giao</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

<script>
  $(document).ready(function(){
  
   $('#transfer-form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
     url:"{{ route('post-transfer') }}",
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