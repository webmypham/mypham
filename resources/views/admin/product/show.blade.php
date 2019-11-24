{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý sản phẩm')

@section('content_header')
    <h1> Quản lý sản phẩm </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Chỉnh sửa sản phẩm </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="input_name" name="name" placeholder="Tên sản phẩm" value="{{ $product->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Thuộc danh mục</label>
                        <select name="id_category" class="form-control" readonly>
                            <option value="">Chọn</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->id_category == $category->id ? "selected" : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Mô tả</label>
                        <input type="text" class="form-control" id="input_description" name="description" placeholder="Mô tả" value="{{ $product->description }}" readonly>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="input_quantity">Số lượng</label>
                            <input type="number" class="form-control" id="input_quantity" name="quantity" value="{{ $product->quantity }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="input_description">Giá nhập</label>
                            <input type="number" class="form-control"  name="input_price" id="input_price" placeholder="Giá nhập" value="{{ $product->input_price }}" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="input_description">Chi phí khác (%) + 10% (VAT)</label>
                            <input type="text" class="form-control"  id="vat" name="cost" placeholder="Chi phí khác" value="{{ $product->cost }}" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="input_quantity">Giá bán</label>
                            <input type="number" id="price" class="form-control"  name="price" value="{{ $product->price }}" readonly readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_detail">Chi tiết</label>
                        <textarea class="form-control" id="input_detail" name="detail" placeholder="" rows="10" cols="80" readonly>{{ $product->detail }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="input_sale_id">Chương trình huyến mãi</label>
                        <select name="sale_id" class="form-control" id="input_sale_id" disabled>
                            @foreach ($sales as $each)
                                <option value="{{ $each->id }}" {{ $product->sale_id == $each->id ? 'selected' : '' }}>{{ $each->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input_image">Hình ảnh</label><br />
                        @if (Storage::disk()->exists($product->image))
                        <img src="{{ asset('storage/'.$product->image) }}" style="width: 100%;max-width: 250px;">
                        @endif
                    </div>
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"><button type="button" class="btn btn-primary">Chỉnh sửa</button></a>
                    <a href="{{ url()->previous() }}"><button type="button" class="btn">Quay lại</button></a>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        $(function () {
            CKEDITOR.replace('input_detail',
            {
                filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });
        })
    </script>
@stop
