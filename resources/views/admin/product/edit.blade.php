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
                    <h3 class="box-title"> Xem chi tiết sản phẩm </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="input_name" name="name" placeholder="Tên sản phẩm" value="{{ $product->name }}" >
                        </div>
                        <div class="form-group">
                            <label>Thuộc danh mục</label>
                            <select name="id_category" class="form-control" >
                                <option value="">Chọn</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->id_category == $category->id ? "selected" : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input_description">Mô tả</label>
                            <input type="text" class="form-control" id="input_description" name="description" placeholder="Mô tả" value="{{ $product->description }}" >
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="input_description">Giá nhập</label>
                                <input type="number" class="form-control"  name="input_price" id="input_price" placeholder="Giá nhập" value="{{ $product->input_price }}" readonly>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="input_description">Chi phí khác (%)</label>
                                <input type="text" class="form-control"  id="vat" name="cost" placeholder="Chi phí khác" value="{{ $product->cost }}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="input_description">VAT</label>
                                <input type="text" class="form-control"  name="vat" placeholder="Vat" value="10%" readonly>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="input_quantity">Giá bán</label>
                                <input type="number" id="price" class="form-control"  name="price" value="{{ $product->price }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_detail">Chi tiết</label>
                            <textarea class="form-control" id="input_detail" name="detail" placeholder="" rows="10" cols="80" >{{ $product->detail }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="input_sale_id">Chọn chương trình khuyến mãi</label>
                            <select name="sale_id" class="form-control" id="input_sale_id">
                                <option value="">Chọn</option>
                                @foreach ($sales as $each)
                                    <option value="{{ $each->id }}" {{ $product->sale_id == $each->id ? 'selected' : '' }}>{{ $each->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input_image">Hình ảnh</label>
                            <input type="file" id="input_image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="input_image">Hình ảnh cũ</label><br />
                            @if (Storage::disk()->exists($product->image))
                            <img src="{{ asset('storage/'.$product->image) }}" style="width: 100%;max-width: 250px;">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{ url()->previous() }}"><button type="button" class="btn">Quay lại</button></a>
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
            $('#vat').on('input', function () {
                var input_price = parseInt($('#input_price').val());
                var cost = parseInt($(this).val());
                if (!isNaN(input_price) && !isNaN(cost)) {
                    console.log(input_price, cost)
                    $('#price').val(input_price + (input_price * cost / 100) + (input_price * 10 / 100));
                }

            })
        })
    </script>
@stop
