{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Quản lý danh mục </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm danh mục</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('sale.store') }}" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name">Tên chương trình khuyến mãi</label>
                            <input type="text" class="form-control" id="input_name" name="name" placeholder="tên" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Loại khuyến mãi</label>
                            <select name="sale_type_id" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($saleTypes as $each)
                                    <option value="{{ $each->id }}">{{ $each->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input_value">Giá trị</label>
                            <input type="number" name="value" id="input_value" class="form-control">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input_date_start">Ngày bắt đầu</label>
                                <input id="input_date_start" class="form-control" type="date" name="date_start">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input_date_end">Ngày kết thúc</label>
                                <input id="input_date_end" class="form-control" type="date" name="date_end">
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
    </script>
@stop