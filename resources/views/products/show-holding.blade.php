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
  </section>
  <section class="section">
    <div class="container">
        <div class="card card-profile shadow mt--300">
            <div class="px-4">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{__('Product holding table')}}</strong>
                </div>
                <div class="card-body order-table">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="serial">{{ __('Index') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Create date') }}</th>
                                <th>{{ __('Farmer') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < sizeof($listProductPackage); $i++)
                            <tr>
                              <td class="serial">{{ $i + 1 }}</td>
                              <td>
                                  <a href="#"><img class="rounded-circle" src="/{{ $listProductPackage[$i]['imgLink'] }}" width="50" height="50"></a>
                              </td>
                              <td>  <span class="name">{{ $listProducts[$i]['name'] }}</span> </td>
                              <td>  <span class="id">{{ $listProductPackage[$i]['productSerial'] }}</span> </td>
                              <td>  <span class="date">{{ date('d/m/Y', strtotime($listProductPackage[$i]['createDate'])) }}</span> </td>
                              <td>  <span class="farmer">{{ $listProductPackage[$i]['farmer'] }}</span> </td>
                              <td>  <span class="price">{{ $listProductPackage[$i]['unitPrice'] }}</span> </td>
                              <td style="text-align: center;">
                                <button id="btnActive" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-key"></i></button>
                              </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
  </section>

    <script src="/source/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/source/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/source/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/source/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/source/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/source/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/source/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/source/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/source/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/source/assets/js/init/datatables-init.js"></script>
    <script>
        function onClickBtnActive(id){
            var oModalActive = $('#modalActive');
            oModalActive.find('input[name="activeUserId"]').val(id); 
        }

        function onClickBtnDelete(id){
            var oModalDelete = $('#modalDelete');
            oModalDelete.find('input[name="deleteUserId"]').val(id); 
        }      
    </script>
@endsection
