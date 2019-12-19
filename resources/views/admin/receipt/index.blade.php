@extends('adminlte::page')

@section('title', 'Quản lý phiếu nhập/xuất')

@section('content_header')

    <h1>Quản lý phiếu nhập/xuất</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">
        <form action="{{ route('receipts.index') }}">
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
                        <!-- /.form-group -->
                        <div class="form-group col-md-4">
                            <label>Sản phẩm</label>
                            <select class="form-control" style="width: 100%;" name="product_id">
                                <option value="">Chọn</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $searchData && isset($searchData['product_id']) &&  $searchData['product_id'] == $product->id ? "selected" : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                        <!-- /.form-group -->
                        <div class="form-group col-md-4">
                            <label>Loại phiếu</label>
                            <select class="form-control" style="width: 100%;" name="type">
                                <option value="">Chọn</option>
                                <option value="in" {{ $type == 'in' ? 'selected' : ''}}>Phiếu nhập</option>
                                <option value="out" {{ $type == 'out' ? 'selected' : ''}}>Phiếu xuất</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 input-group">
                            <label>Chọn tháng</label>
                            <div class="row">
                                <div class="col-md-6" style="padding-right: 5px">
                                    <select class="form-control" style="width: 100%;" name="month" id="month_picker">
                                        <option value="">Chọn tháng</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-md-5"  style="padding-left: 5px">
                                    <select class="form-control" style="width: 100%;" name="year" id="year_picker">
                                        <option value="">Chọn năm</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>


                        </div>


                        <!-- /.form-group -->
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

    <div class="row">

        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

            <div class="box-part"
                 style="background-color: #059AE3; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                <div class="title">
                    <h4 style="font-size: 26px;">{{ number_format($inQuantity, 0) }}</h4>
                </div>

                <div class="title">
                    <h4 style="font-size: 26px">Số lượng nhập</h4>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

            <div class="box-part"
                 style="background-color: #8AC24A; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                <div class="title">
                    <h4 style="font-size: 26px">{{ number_format($outQuantity, 0) }}</h4>
                </div>

                <div class="title">
                    <h4 style="font-size: 26px">Số lượng xuất</h4>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

            <div class="box-part"
                 style="background-color: #D32D2F; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                <div class="title">
                    <h4 style="font-size: 26px">{{ number_format($inAmount, 0) }}</h4>
                </div>

                <div class="title">
                    <h4 style="font-size: 26px">Số tiền nhập</h4>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

            <div class="box-part"
                 style="background-color: #FF8800; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                <div class="title">
                    <h4 style="font-size: 26px">{{ number_format($outAmount, 0) }}</h4>
                </div>

                <div class="title">
                    <h4 style="font-size: 26px">Số tiền xuất</h4>
                </div>

            </div>
        </div>
    </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="box-header">
                <h3 class="box-title">Danh sách phiếu nhập/xuất</h3>
                <a href="{{ route('receipts.create') }}" class="btn btn-info" style="float: right;">Thêm</a>
            </div>
            <div class="panel-body table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th>STT</th>
                        <th>Loại phiếu</th>
                        <th>Người tạo</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Nhà cung cấp</th>
                        <th>Ngày tạo</th>
                        <th width="15%" align="center">Chức năng</th>
                    </tr>
                    <tbody>
                    @foreach($receipts as $key=>$value)
                        <tr>
                            <td>{{ (($receipts->currentPage() - 1 ) * $receipts->perPage() ) + $loop->iteration }}</td>
                            <td>{{ $value->type == 'in' ? 'Nhập hàng' : 'Xuất hàng'}}</td>
                            <td>{{ $value->user_name ?? '' }}</td>
                            <td>{{ $value->product_name ?? '' }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>{{ number_format($value->total_amount, 0) }} đ</td>
                            <td>{{ $value->supplier }}</td>

                            <td>{{ date('d/m/Y: H:i', strtotime($value->created_at)) }}</td>
                            <td>
                                @if(Auth::user()->id_role == 0)
                                <a class="btn btn-small btn-info" href="{{ route('receipts.edit', ['receipt' => $value->id]) }}"><i class="fa fa-edit"></i></a>
                                @endif
                                <a class="btn btn-small btn-info" href="{{ route('receipts.show', ['receipt' => $value->id]) }}"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-small btn-danger remove" data-postid="{{ $value->id }}" data-toggle="modal" data-target="#confirmModal" data-url="{{ route('receipts.destroy', ['blog' => $value->id]) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                {{ $receipts->links() }}
            </div>
        </div>
    </div>
    <!-- modal confirm delete -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-modal-delete">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title" align="center">Thông báo</h2>
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
     $(document).ready(function () {
         var d = new Date();
         $('#month_picker').val({{ $month }});
         $('#year_picker').val({{ $year }});
     })
    </script>
@stop
