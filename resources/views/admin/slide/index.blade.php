@extends('adminlte::page')

@section('title', 'Quản lý slide')

@section('content_header')

    <h1>Quản lý slide</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="box-header">
                <h3 class="box-title">Danh sách slide</h3>
                <a href="{{ route('slides.create') }}" class="btn btn-info" style="float: right;">Thêm</a>
            </div>
            <div class="panel-body table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th>No</th>
                        <th>Tiêu dề</th>
                        <th>Thứ tự</th>
                        <th>Ảnh</th>
                        <th width="15%" align="center">Chức năng</th>
                    </tr>
                    <tbody>
                    @foreach($slides as $key=>$value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="/news/{{$value->id}}">{{ Str::limit($value->name, 50) }}</a>
                            </td>
                            <td>{{ $value->order  }}</td>

                            <td>
                                @if (Storage::disk()->exists($value->image))
                                    <img class="avatar" src="{{ asset('storage/'.$value->image) }}" width="80px;">
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-small btn-info" href="{{ route('slides.edit', ['slides' => $value->id]) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-small btn-info" href="{{ route('slides.show', ['slides' => $value->id]) }}"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-small btn-danger remove" data-postid="{{ $value->id }}" data-toggle="modal" data-target="#confirmModal" data-url="{{ route('slides.destroy', ['blog' => $value->id]) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
