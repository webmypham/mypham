@extends('adminlte::page')

@section('title', 'Admin | Báo cáo bán hàng')

@section('content_header')

    @if (\Carbon\Carbon::parse($from_date)->eq(\Carbon\Carbon::parse($to_date)))
        <h1>Báo cáo thống kê bán hàng ngày {{ \Carbon\Carbon::parse($from_date)->format('d/m/Y') }}</h1>
    @else
        <h1>Báo cáo thống kê bán hàng từ ngày {{ \Carbon\Carbon::parse($from_date)->format('d/m/Y') }} đến ngày {{ \Carbon\Carbon::parse($to_date)->format('d/m/Y') }}</h1>
    @endif


@stop

@section('content')
    {{--<div class="container-fluid spark-screen">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-6">--}}
    {{--<div class="box">--}}
    {{--<div class="box-header with-border">--}}
    {{--<h3 class="box-title">Thống kê đơn hàng</h3>--}}
    {{--</div>--}}
    {{--<div class="box-body">--}}
    {{--<table class="table table-bordered">--}}
    {{--<tbody>--}}
    {{--<tr>--}}
    {{--<th style="width: 15px">#</th>--}}
    {{--<th>Trạng thái</th>--}}
    {{--<th style="width: 100px">Số lượng</th>--}}
    {{--</tr>--}}
    {{--@foreach ($orders as $order)--}}
    {{--<tr>--}}
    {{--<td>{{ $loop->iteration }}</td>--}}
    {{--<td>{{ $order->status_text }}</td>--}}
    {{--<td>{{ $order->order_count }}</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--<tr>--}}
    {{--<td></td>--}}
    {{--<th>Tổng</th>--}}
    {{--<th>{{ $countOrder }}</th>--}}
    {{--</tr>--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-md-6">--}}
    {{--<div class="box">--}}
    {{--<div class="box-header with-border">--}}
    {{--<h3 class="box-title">Thống kê doanh thu theo tháng</h3>--}}
    {{--</div>--}}
    {{--<div class="box-body">--}}
    {{--<table class="table table-bordered">--}}
    {{--<tbody>--}}
    {{--<tr>--}}
    {{--<th>Tháng</th>--}}
    {{--<th style="width: 30%">Doanh thu (VNĐ)</th>--}}
    {{--</tr>--}}
    {{--@foreach ($revenues as $value)--}}
    {{--<tr>--}}
    {{--<td>{{ $value->month }}</td>--}}
    {{--<td>{{ number_format($value->amount, 0) }}</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="container-fluid spark-screen">

        <form action="{{ route('admin.statistic') }}">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Lọc</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Từ ngày</label>
                            <input id="input_date_start" class="form-control" type="date" dateFormat="d/M/y" name="from_date" value="{{ $from_date }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Đến ngày</label>
                            <input id="input_date_end" class="form-control" type="date" name="to_date" value="{{ $to_date }}">
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer" style="">
                    <button type="submit" class="btn btn-primary" id="js-search-button">Thống kê</button>
                </div>
            </div>
        </form>

        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

                <div class="box-part"
                     style="background-color: #059AE3; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                    <div class="title">
                        <h4 style="font-size: 30px;">{{ number_format($revenues, 0) }}</h4>
                    </div>

                    <div class="title">
                        <h4 style="font-size: 30px;">Doanh số</h4>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

                <div class="box-part"
                     style="background-color: #8AC24A; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                    <div class="title">
                        <h4 style="font-size: 30px;">{{ number_format($sale, 0) }}</h4>
                    </div>

                    <div class="title">
                        <h4 style="font-size: 30px;">Số đơn hàng</h4>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

                <div class="box-part"
                     style="background-color: #D32D2F; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                    <div class="title">
                        <h4 style="font-size: 30px;">{{ number_format($return, 0) }}</h4>
                    </div>

                    <div class="title">
                        <h4 style="font-size: 30px;">Trả hàng</h4>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">

                <div class="box-part"
                     style="background-color: #FF8800; height: 150px; color: #fff; padding-top: 20px; padding-left: 20px">

                    <div class="title">
                        <h4 style="font-size: 30px;">{{ number_format($cancel, 0) }}</h4>
                    </div>

                    <div class="title">
                        <h4 style="font-size: 30px;">Hủy</h4>
                    </div>

                </div>
            </div>
        </div>

        <div class="nav-tabs-custom" style="margin-top: 20px">
            <ul class="nav nav-tabs tb">
                <li class="active">
                    <a href="#header" data-toggle="tab">Bán hàng
                    </a>
                </li>

                <li>
                    <a href="#shipping" data-toggle="tab">Trả hàng
                    </a>
                </li>
                <li>
                    <a href="#cancel" data-toggle="tab">Huỷ đơn hàng
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="min-height: 758px">

                <div class="tab-pane active" id="header">
                    <div class="panel panel-default">

                        <div class="panel-body table-responsive">
                            <!-- Table -->
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày tạo đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Số lượng</th>
                                    <th>Doanh số</th>
                                </tr>
                                <tbody>
                                @foreach($saleData as $key=>$value)
                                    <tr>
                                        <td>{{ $value->id }}
                                        </td>
                                        <td>{{ date('d/m/Y: H:i', strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->customer ?? '' }}</td>
                                        <td>{{ number_format($value->quantity, 0) ?? '' }}</td>
                                        <td>{{ number_format($value->amount, 0) ?? '' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer clearfix">
                            {{ $saleData->links() }}
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="shipping">
                    <div class="panel panel-default">

                        <div class="panel-body table-responsive">
                            <!-- Table -->
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày tạo đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Số lượng</th>
                                    <th>Tiền trả hàng</th>
                                </tr>
                                <tbody>
                                @foreach($returnData as $key=>$value)
                                    <tr>
                                        <td>{{ $value->id }}
                                        </td>
                                        <td>{{ date('d/m/Y: H:i', strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->customer ?? '' }}</td>
                                        <td>{{ number_format($value->quantity, 0) ?? '' }}</td>
                                        <td>{{ number_format($value->amount, 0) ?? '' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer clearfix">
                            {{ $returnData->links() }}
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="cancel">
                    <div class="panel panel-default">

                        <div class="panel-body table-responsive">
                            <!-- Table -->
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày tạo đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Số lượng</th>
                                    <th>Tiền trả hàng</th>
                                </tr>
                                <tbody>
                                @foreach($cancelData as $key=>$value)
                                    <tr>
                                        <td>{{ $value->id }}
                                        </td>
                                        <td>{{ date('d/m/Y: H:i', strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->customer ?? '' }}</td>
                                        <td>{{ number_format($value->quantity, 0) ?? '' }}</td>
                                        <td>{{ number_format($value->amount, 0) ?? '' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer clearfix">
                            {{ $cancelData->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @stop

        @section('css')

            <link rel="stylesheet" href="/css/admin_custom.css">
            <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css">
        @stop

        @section('js')
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script type="text/javascript"
                    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
            <script type="text/javascript"
                    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
            <script>
                $(function () {
                    $('#datetimepicker1').datepicker({
                        format: "dd/mm/yyyy",
                        language: "es",
                        autoclose: true,
                        todayHighlight: true
                    });

                    $('#datetimepicker2').datepicker({
                        format: "dd/mm/yyyy",
                        language: "es",
                        autoclose: true,
                        todayHighlight: true
                    });
                });
            </script>
            <script>
                //  $('#confirmModal').on('show.bs.modal', function (event) {
                //         var button = $(event.relatedTarget);
                //         var url = button.data('url');
                //         var modal = $(this);
                //         $("#deleteForm").attr("action",url)
                //     });
                $(document).ready(function () {
                    $('#input_date_end').attr('min', $('#input_date_start').val());
                    $('#input_date_start').attr('max', $('#input_date_end').val());
                    $('#input_date_start').on('change', function () {
                        $('#input_date_end').attr('min',  $(this).val())
                    });

                    $('#input_date_end').on('change', function () {
                        $('#input_date_start').attr('max', $(this).val())
                    })
                })
            </script>
@stop
