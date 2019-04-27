@extends('layouts.admin-master')
@section('content')
{{-- <div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Nông trại / Trang trại</strong>
                    </div>
                    <div class="card-body order-table">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="serial">STT</th>
                                    <th class="avatar">Ảnh</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < sizeof($products); $i++)
                                <tr>
                                    <td class="serial">{{ $i+1 }}</td>
                                    <td class="avatar">
                                        <div class="round-img">
                                    
                                        <a href="#"><img class="rounded-circle" src="/{{ $products[$i]->images[0] }}" width="50" height="50" alt=""></a>
                                        </div>
                                    </td>
                                    <td>  <span class="name">{{ $products[$i]['name'] }}</span> </td>
                                    <td><span style="white-space: nowrap;" class="">{{ $products[$i]['description'] }}</span></td>
                                  
                                </tr> 
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div><!-- .content --> --}}
On progress ...
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
@endsection
    