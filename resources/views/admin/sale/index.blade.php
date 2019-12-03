@extends('adminlte::page')

@section('title', 'Quản lý khuyến mãi')

@section('content_header')

    <h1>Quản lý khuyến mãi</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">

        {{-- @include('flash::message') --}}

        <div class="row form-group">
        </div>

        <div class="message"></div>

        <div class="panel panel-default">
            <div class="box-header">
                <h3 class="box-title">Danh sách khuyến mãi</h3>
                <a href="{{ route('sale.create') }}" class="btn btn-info" style="float: right;">Thêm</a>
            </div>
            <div class="panel-body table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th width="50px">No</th>
                        <th>Chương trình khuyến mãi</th>
                        <th>Giá trị khuyến mãi</th>
                        <th>Trạng thái</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th width="15%" align="center">Chức năng</th>
                    </tr>
                    <tbody>
                        @foreach ($sales as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->sale_type_id == 1 ? ($item->value . '%') : ($item->value . 'đ')}}</td>
                            <td><span class="{{ config('const.sale_status_class.'.$item->isActive) }}">{{ config('const.sale_status.'.$item->isActive) }}</span></td>
                            <td>{{ $item->date_start }}</td>
                            <td>{{ $item->date_end }}</td>
                            <td>
                                <a class="btn btn-small btn-info" href="{{ route('sale.edit', ['sale' => $item->id]) }}"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-small btn-danger remove" data-postid="{{ $item->id }}" data-toggle="modal" data-target="#confirmModal" data-url="{{ route('sale.destroy', ['sale' => $item->id]) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>
    <!-- modal confirm delete -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-modal-delete">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title" align="center">Thông báo</h2>
                </div>
                    
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Bạn có muốn xoá dữ liệu này không?</h4>
                </div>
                <div class="modal-footer">
                    <form method="POST" id="deleteForm">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">YES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal confirm delete -->
@stop

@section('css')
    
@stop

@section('js')
    <script>
        $('#confirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var modal = $(this);
            $("#deleteForm").attr("action",url)
        });
    </script>
@stop
