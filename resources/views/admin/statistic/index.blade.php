@extends('adminlte::page')

@section('title', 'Admin | Thống kê')

@section('content_header')

    <h1>Thống kê</h1>

@stop

@section('content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê đơn hàng</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 15px">#</th>
                                <th>Trạng thái</th>
                                <th style="width: 100px">Số lượng</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->status_text }}</td>
                                    <td>{{ $order->order_count }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <th>Tổng</th>
                                <th>{{ $countOrder }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê doanh thu theo tháng</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Tháng</th>
                                <th style="width: 30%">Doanh thu (VNĐ)</th>
                            </tr>
                            @foreach ($revenues as $value)
                                <tr>
                                    <td>{{ $value->month }}</td>
                                    <td>{{ number_format($value->amount, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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