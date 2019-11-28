{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Quản lý khuyến mãi </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm chương trình khuyến mãi</h3>
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
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Chọn sản phẩm áp dụng</button>
                        </div>
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                        
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Chọn sản phẩm áp dụng</h4>
                                    </div>
                        
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên sản phẩm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td scope="row">
                                                        <input type="checkbox" value="{{ $product->id }}" name="products[]">
                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                <tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                        
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="select_categories">Chọn</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                        
                                    </div>
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
        // $('#sale_apply').change(function() {
        //     var sale_apply_type = $('#sale_apply').val();
        //     $('#myModal').modal();
        // });

        // $('#select_categories').click(function() {

        // });
    </script>
@stop