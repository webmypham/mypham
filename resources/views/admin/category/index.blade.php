@extends('adminlte::page')

@section('title', 'Quản lý sản phẩm')

@section('content_header')

    <h1>Quản lý sản phẩm</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">

        {{-- @include('flash::message') --}}

        <div class="row form-group">
            {{-- <div class="col-md-4">
                <input type="text" placeholder="name" id="js-search-name" class="form-control" value="{{ $searchData && isset($searchData['name']) ? $searchData['name'] : '' }}">
            </div>
            <div class="col-md-4">
                <select name="parent_id" id="js-search-parent-id" class="form-control">
                    <option value="">Chọn</option>
                    @foreach ($categoriesParent as $each)
                        <option value="{{ $each->id }}">{{ $each->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" id="js-search-button">Tìm kiếm</button>
            </div> --}}
        </div>
        {{-- <div class="row form-group">
            <div class="col-md-8">
                <a href="{{ url('categories/create')}}"
                class="btn btn-info">Thêm</a>
            </div>
        </div> --}}

        <div class="message"></div>

        <div class="panel panel-default">
            <div class="box-header">
                <h3 class="box-title">Danh sách category</h3>
                <a href="{{ route('categories.create') }}" class="btn btn-info" style="float: right;">Thêm</a>
            </div>
            <div class="panel-body table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th width="50px">No</th>
                        <th>Tên</th>
                        <th>Thuộc category</th>
                        <th>Ngày tạo</th>
                        <th width="15%" align="center">Chức năng</th>
                    </tr>
                    <tbody>
                    @foreach($categories as $key=>$value)
                        <tr>
                            <td>
                                {{ (($categories->currentPage() - 1 ) * $categories->perPage() ) + $loop->iteration }}
                            </td>
                            <td>
                                <a href="/categories/{{ $value->id }}">{{ $value->name }}</a>
                            </td>
                            <td>{{ $value->parent_name }}</td>
                            <td>{{ date('d/m/Y: H:i', strtotime($value->created_at)) }}</td>
                            <td align="center">
                                <a class="btn btn-small btn-info" href="{{ route('categories.edit', $value->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-small btn-info" href=" {{ route('categories.show', $value->id) }}"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-small btn-danger remove" data-toggle="modal" data-target="#confirmModal" data-url="{{ route('categories.destroy', $value->id) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

<!-- modal confirm delete -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-modal-delete">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title" align="center">Confirmation</h2>
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
