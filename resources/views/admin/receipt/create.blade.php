{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý nhập xuất')

@section('content_header')
    <h1> Quản lý nhập xuất </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thêm phiếu nhập/xuất</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Loại phiếu</label>
                            <select name="type" class="form-control" id="type">
                                <option value="">Chọn</option>
                                <option value="in">Phiếu nhập</option>
                                <option value="out">Phiếu xuất</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="product_id" class="form-control" id="product">
                                <option value="">Chọn</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->input_price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_quantity">Số lượng</label>
                                <input type="number" id="quantity" class="form-control"  name="quantity" value="{{ old('quantity') }}">
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_description">Nhà cung cấp</label>
                                <input type="text" class="form-control"  name="supplier" placeholder="Nhà cung cấp" value="{{ old('supplier') }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="input_description">Giá nhập</label>
                                <input type="number" class="form-control"  name="input_price" id="input_price" placeholder="Giá nhập" value="{{ old('supplier') }}" >
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="input_description">Chi phí khác</label>
                                <input type="text" class="form-control"  name="vat" placeholder="Chi phí khác" value="10%" readonly>
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_quantity">Tổng tiền hàng</label>
                                <input type="number" id="total_amount" class="form-control"  name="total_amount" value="{{ old('total_amount') }}">
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Tạo phiếu</button>
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
        $(function () {
            $('#input_price').on('input', function() {
                var amount = (parseInt($(this).val()) + (parseInt($(this).val()) * 10 / 100)) * parseInt($('#quantity').val());
                if (!isNaN(amount)) {
                    $('#total_amount').val(amount);
                }
            });

            $('#quantity').on('input', function() {
                var amount = (parseInt($('#input_price').val()) + (parseInt($('#input_price').val()) * 10 / 100)) * parseInt($(this).val());
                if (!isNaN(amount)) {
                    $('#total_amount').val(amount);
                }

            });

            $('#type').on('change', function () {
                console.log('type', $(this).val());
                if ($(this).val() == 'in') {
                    $('#input_price').attr('readonly', false);
                    $('#total_amount').attr('readonly', false);
                } else if ($(this).val() == 'out') {
                    $('#input_price').attr('readonly', 'true');
                    $('#total_amount').attr('readonly', 'true');
                }
            })
            
            $('#product').on('change', function () {
                console.log('change', $(this).children("option:selected").data('price'));
                if ($(this).children("option:selected").data('price') > 0) {
                    $('#input_price').val($(this).children("option:selected").data('price'));
                    var amount = (parseInt($('#input_price').val()) + (parseInt($('#input_price').val()) * 10 / 100)) * parseInt($('#quantity').val());
                    if (!isNaN(amount)) {
                        $('#total_amount').val(amount);
                    }
                }

            })
        })
    </script>
@stop
