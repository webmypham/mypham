@extends('adminlte::page')

@section('title', 'Quản lý tin tức')

@section('content_header')

    <h1>Quản lý tin tức</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">
        <form action="{{ route('news.index') }}">
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
                            <label>Tên</label>
                            <input type="text" name="title" value="{{ $searchData && isset($searchData['title']) ? $searchData['title'] : '' }}" class="form-control">
                        </div>

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
                <h3 class="box-title">Danh sách tin tức</h3>
                <a href="{{ route('news.create') }}" class="btn btn-info" style="float: right;">Thêm</a>
            </div>
            <div class="panel-body table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th>No</th>
                        <th>Tiêu dề</th>
                        <th>Mô tả</th>
                        <th>Ngày tạo</th>
                        <th width="15%" align="center">Chức năng</th>
                    </tr>
                    <tbody>
                    @foreach($news as $key=>$value)
                        <tr>
                            <td>{{ (($news->currentPage() - 1 ) * $news->perPage() ) + $loop->iteration }}</td>
                            <td>
                                <a href="/news/{{$value->id}}">{{ Str::limit($value->title, 50) }}</a>
                            </td>
                            <td>{{ Str::limit($value->description, 50) }}</td>

                            <td>{{ date('d/m/Y: H:i', strtotime($value->created_at)) }}</td>
                            <td>
                                <a class="btn btn-small btn-info" href="{{ route('news.edit', ['news' => $value->id]) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-small btn-info" href="{{ route('news.show', ['news' => $value->id]) }}"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-small btn-danger remove" data-postid="{{ $value->id }}" data-toggle="modal" data-target="#confirmModal" data-url="{{ route('news.destroy', ['blog' => $value->id]) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                {{ $news->links() }}
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

    <link rel="stylesheet" href="/css/admin_custom.css">

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
