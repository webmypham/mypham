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
                        <th>Khuyến mãi</th>
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
                            <td><span class="{{ config('const.sale_status_class.'.$item->status) }}">{{ config('const.sale_status.'.$item->status) }}</span></td>
                            <td>{{ $item->date_start }}</td>
                            <td>{{ $item->date_end }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        {{-- <tr>
                            <td>1</td>
                            <td>Giảm 15%</td>
                            <td><span class="btn btn-success">Đang áp dụng</span></td>
                            <td>2019-10-17 12:46:54</td>
                            <td>2019-10-17 12:46:54</td>
                            <td></td>
                        </tr> --}}
                    {{-- @foreach($categories as $key=>$value)
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
                                <a class="btn btn-small btn-info" href="{{ route('categories.edit', ['category' => $value->id]) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-small btn-info" href="/categories/{{ $value->id }}"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-small btn-danger remove" data-url="{{ url('categories/' . $value->id) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    <script></script>
@stop