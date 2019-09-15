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
                <form role="form" action="{{ route('categories.store') }}" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name">Tên category</label>
                            <input type="text" class="form-control" id="input_name" name="name" placeholder="tên" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Category cha:</label>
                            <select name="id_parent" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($categoriesParent as $each)
                                    <option value="{{ $each->id }}">{{ $each->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Tạo category</button>
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