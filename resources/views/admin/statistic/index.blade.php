@extends('adminlte::page')

@section('title', 'Admin | Báo cáo bán hàng')

@section('content_header')

    <h1>Báo cáo bán hàng {{ $month }}/{{ $year }}</h1>

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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Chọn tháng</label>
                            <select class="form-control" style="width: 100%;" name="month">
                                <option value="">--</option>
                                <option value="1" {{ $month && isset($month) &&  $month == '1' ? "selected" : '' }}>1</option>
                                <option value="2" {{ $month && isset($month) &&  $month == '2' ? "selected" : '' }}>2</option>
                                <option value="3" {{ $month && isset($month) &&  $month == '3' ? "selected" : '' }}>3</option>
                                <option value="4" {{ $month && isset($month) &&  $month == '4' ? "selected" : '' }}>4</option>
                                <option value="5" {{ $month && isset($month) &&  $month == '5' ? "selected" : '' }}>5</option>
                                <option value="6" {{ $month && isset($month) &&  $month == '6' ? "selected" : '' }}>6</option>
                                <option value="7" {{ $month && isset($month) &&  $month == '7' ? "selected" : '' }}>7</option>
                                <option value="8" {{ $month && isset($month) &&  $month == '8' ? "selected" : '' }}>8</option>
                                <option value="9" {{ $month && isset($month) &&  $month == '9' ? "selected" : '' }}>9</option>
                                <option value="10" {{ $month && isset($month) &&  $month == '10' ? "selected" : '' }}>10</option>
                                <option value="11" {{ $month && isset($month) &&  $month == '11' ? "selected" : '' }}>11</option>
                                <option value="12" {{ $month && isset($month) &&  $month == '12' ? "selected" : '' }}>12</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group col-md-6">
                            <label>Chọn năm</label>
                            <select class="form-control" style="width: 100%;" name="year">
                                <option value="2015" {{ $year && isset($year) &&  $year == '2015' ? "selected" : '' }}>2015</option>
                                <option value="2016" {{ $year && isset($year) &&  $year == '2016' ? "selected" : '' }}>2016</option>
                                <option value="2017" {{ $year && isset($year) &&  $year == '2017' ? "selected" : '' }}>2017</option>
                                <option value="2018" {{ $year && isset($year) &&  $year == '2018' ? "selected" : '' }}>2018</option>
                                <option value="2019" {{ $year && isset($year) &&  $year == '2019' ? "selected" : '' }}>2019</option>
                                <option value="2020" {{ $year && isset($year) &&  $year == '2020' ? "selected" : '' }}>2020</option>
                                <option value="2021" {{ $year && isset($year) &&  $year == '2021' ? "selected" : '' }}>2021</option>
                                <option value="2022" {{ $year && isset($year) &&  $year == '2022' ? "selected" : '' }}>2022</option>
                                <option value="2023" {{ $year && isset($year) &&  $year == '2023' ? "selected" : '' }}>2023</option>
                                <option value="2024" {{ $year && isset($year) &&  $year == '2024' ? "selected" : '' }}>2024</option>
                                <option value="2025" {{ $year && isset($year) &&  $year == '2025' ? "selected" : '' }}>2025</option>
                                <option value="2026" {{ $year && isset($year) &&  $year == '2026' ? "selected" : '' }}>2026</option>
                                <option value="2027" {{ $year && isset($year) &&  $year == '2027' ? "selected" : '' }}>2027</option>
                                <option value="2028" {{ $year && isset($year) &&  $year == '2028' ? "selected" : '' }}>2028</option>
                                <option value="2029" {{ $year && isset($year) &&  $year == '2029' ? "selected" : '' }}>2029</option>
                                <option value="2030" {{ $year && isset($year) &&  $year == '2030' ? "selected" : '' }}>2030</option>


                            </select>
                        </div>
                        <!-- /.form-group -->
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

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

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

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

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

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

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
            </ul>
            <div class="tab-content" style="min-height: 758px">

                <div class="tab-pane active" id="header">
                    <div class="panel panel-default">

                        <div class="panel-body table-responsive">
                            <!-- Table -->
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày bán</th>
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
                                    <th>Ngày bán</th>
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
            </div>
        </div>

        @stop

        @section('css')

            <link rel="stylesheet" href="/css/admin_custom.css">

        @stop

        @section('js')
            <script>
                //  $('#confirmModal').on('show.bs.modal', function (event) {
                //         var button = $(event.relatedTarget);
                //         var url = button.data('url');
                //         var modal = $(this);
                //         $("#deleteForm").attr("action",url)
                //     });
            </script>
@stop
