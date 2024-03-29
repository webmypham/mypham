{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý nhập/xuất')

@section('content_header')
    <h1> Quản lý nhập/xuất </h1>
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
                    <h3 class="box-title"> Chỉnh sửa phiếu nhập/xuất </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('receipts.update', ['receipt' => $receipt->id]) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <input type="hidden" name="type"  value="{{ $receipt->type }}"/>
                        <div class="form-group">
                            <label>Loại phiếu</label>
                            <input type="text" class="form-control" value="{{ $receipt->type == 'in' ? 'Phiếu nhập' : 'Phiếu xuất' }}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <input type="text" class="form-control" id="product_id" data-quantity="{{ $receipt->product->quantity ?? '' }}" value="{{ $receipt->product->name ?? ''}}" readonly />
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_price">Số lượng <span id="quantity-remain"></span></label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $receipt->quantity }}">
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_description">Nhà cung cấp</label>
                                <input type="text" class="form-control" name="supplier" value="{{ $receipt->supplier }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="input_description">Giá nhập</label>
                                <input type="number" class="form-control"  name="input_price" id="input_price" placeholder="Giá nhập" value="{{ $receipt->product->input_price ?? '' }}" >
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="input_description">Chi phí khác</label>
                                <input type="text" class="form-control"  name="vat" placeholder="Chi phí khác" value="10%" readonly>
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_quantity">Tổng tiền</label>
                                <input type="number" class="form-control" id="total_amount" name="total_amount" value="{{ $receipt->total_amount }}" readonly>
                            </div>
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
    <script>
        $(function () {
            $('#input_price').on('input', function() {
                var amount = (parseInt($(this).val()) + (Math.round(parseInt($(this).val()) * 10 / 100))) * parseInt($('#quantity').val());
                $('#total_amount').val(amount);
            });

            $('#quantity').on('input', function() {
                var amount = (parseInt($('#input_price').val()) + (Math.round(parseInt($('#input_price').val()) * 10 / 100))) * parseInt($(this).val());
                $('#total_amount').val(amount);

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
            });

            @if ($receipt->type =='out')
                $('#input_price').attr('readonly', 'true');
                $('#total_amount').attr('readonly', 'true');
            @endif

            $('#product').on('change', function () {
                $('#input_price').val($(this).children("option:selected").data('price'));
                var amount = (parseInt($('#input_price').val()) + (Math.round(parseInt($('#input_price').val()) * 10 / 100))) * parseInt($('#quantity').val());
                $('#total_amount').val(amount);

                if (parseInt($(this).children("option:selected").data('quantity')) >= 0 ) {
                    $('#quantity-remain').text('( Số lượng còn lại: ' + parseInt($(this).children("option:selected").data('quantity')) + ' )');
                } else {
                    $('#quantity-remain').text('');
                }
            })

            if (parseInt($('#product_id').data('quantity')) >= 0 ) {
                $('#quantity-remain').text('( Số lượng còn lại: ' + parseInt($('#product_id').data('quantity')) + ' )');
            } else {
                $('#quantity-remain').text('');
            }
        })
    </script>
@stop
