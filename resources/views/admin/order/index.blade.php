@extends('adminlte::page')

@section('title', 'Admin | Quản lý đơn hàng')

@section('content_header')

    <h1>Quản lý đơn hàng</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">
        <form action="{{ route('products.index') }}">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Tìm kiếm</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Người order</label>
                            <input type="text" name="name" value="{{ $searchData && isset($searchData['name']) ? $searchData['name'] : '' }}" class="form-control">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group col-md-6">
                            <label>Số điện thoại</label>
                            <input type="text" id="js-search-phone" class="form-control" name="phone" value="{{ isset($searchData['phone']) ? $searchData['phone'] : '' }}">
                        </div>
                        <!-- /.form-group -->
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer" style="">
                    <button type="submit" class="btn btn-primary" id="js-search-button">Tìm kiếm</button>
                </div>
            </div>
        </form>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="box-header">
                <h3 class="box-title">Danh sách đơn hàng</h3>
            </div>
            <div class="panel-body table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th>No</th>
                        <th>Người đặt</th>
                        <th>Tổng tiền</th>
                        <th>Ngày order</th>
                        <th>Trạng thái</th>
                        <th width="10%" align="center">Chức năng</th>
                    </tr>
                    <tbody>
                    @foreach($orders as $key=>$value)
                        <tr>
                            <td>
                                {{ (($orders->currentPage() - 1 ) * $orders->perPage() ) + $loop->iteration }}
                            </td>
                            <td>
                                {{ $value->customer_name }}
                            </td>
                            <td>
                                {{ $value->amount }} đ
                            </td>
                            <td>
                                {{ $value->created_at }}
                            </td>
                            <td width="20%">
                                <span class="btn {{ 'btn-'.$value->status_class }}">{{ $value->status_text }}</span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', ['order'=> $value->id]) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
    <script>
    //  $('#confirmModal').on('show.bs.modal', function (event) {
    //         var button = $(event.relatedTarget);
    //         var url = button.data('url');
    //         var modal = $(this);
    //         $("#deleteForm").attr("action",url)
    //     });
    </script>
@stop
