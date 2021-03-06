@extends('layouts.admin-master')
@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{ __('products_package') }}</strong>
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
                                      <a href="{{ route('history', (int) $listProductPackage[$i]['productPackId']) }}"><img class="rounded-circle" src="/{{ $listProductPackage[$i]['imgLink'] }}" width="50" height="50"></a>
                                  </td>
                                  <td>  <span class="name">{{ $listProducts[$i]['name'] }}</span> </td>
                                <td>  <span class="id">{{ $listProductPackage[$i]['productSerial'] }}</span> </td>
                                  <td>  <span class="date">{{ date('d/m/Y', strtotime($listProductPackage[$i]['createDate'])) }}</span> </td>
                                  <td>  <span class="farmer">{{ $listProductPackage[$i]['farmer'] }}</span> </td>
                                  <td>  <span class="price">{{ $listProductPackage[$i]['unitPrice'] }}</span> </td>
                                  <td style="text-align: center;">
                                    <button id="btnActive" onclick="onClickBtnActive({{ $listProductPackage[$i]['productSerial'] }})" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalActive"><i class="fa fa-key"></i></button>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">Xác nhận</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="form-delete" action="{{ route('delete-store-employer') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="userId">
                    <div class="modal-body">
                        <p>
                            Bạn muốn xóa nhân viên này khỏi nhóm chứ ?
                          </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      
                      <button type="button submit" class="btn btn-primary">OK</button>
                    </div>
                    </form>
            </div>
          </div>
        </div>
    
        <div class="modal fade" id="modalActive" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">Xác nhận</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('active-store-employer') }}">
                      {{ csrf_field() }}
                    <div class="modal-body">
                          <p>
                            Chọn quyền cấp cho nhân viên:
                          </p>
                        <input type="hidden" name="activeUserId">
                          <div class="form-group">
                              <div class="input-group-alternative mb-3">
                                  <select name="type" class="form-control">
                                      <option value="Farmer">Nhân viên nông trại</option>
                                      <option value="Transportation">Nhân viên vận chuyển</option>
                                      <option value="Store">Nhân viên cửa hàng</option>
                                    </select>                            
                              </div>
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      
                      <button type="button submit" class="btn btn-primary">OK</button>
                    </div>
                    </form>
            </div>
          </div>
        </div>
        </div>
</div><!-- .content -->
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
    