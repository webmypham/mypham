@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container mb-20">
		<div class="container j-container">
			<div class="row product-content">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 news_post_loop">
                    <div class="panel-body table-responsive">
                        <!-- Table -->
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>No</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th width="10%" align="center">Chức năng</th>
                            </tr>
                            <tbody>
                            @foreach($orders as $key=>$value)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $value->amount }} đ
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($value->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td width="20%">
                                        <span class="btn {{ 'btn-'.$value->status_class }}">{{ $value->status_text }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.orderDetail', ['id'=> $value->id]) }}" class="btn btn-info">Xem chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links('vendor.pagination.right') }}
                    </div>
                </div>
                <div class="col-md-3 hidden-sm hidden-xs side-column mt-20 left-sidebar">
                    <div class="categories">
                        <h4 class="title">Danh mục </h4>
                        <ul class="nav navbar-nav">
                            @foreach($categories as $category)
                                <li class="active dropdown">
                                    <a class="dropdown-toggle" href="{{ route('category', ['slug' => str_slug(trim($category->name), '-'), 'id' => $category->id ]) }}">
                                        <i class="fa fa-circle"></i> {{$category->name}}
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach ($category->subCat as $subCat)
                                            <li><a href="{{ route('category', ['slug' => str_slug(trim($subCat->name), '-'), 'id' => $subCat->id ]) }}">{{ $subCat->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
			</div>
        </div>


    </div>
</section>
@endsection

@section('script')
	<script>
		function addToCart(id) {
			var quantity = $('#quantity').val();
			$.ajax({
				url: "{{ route('addToCart') }}",
				type: 'GET',
				data: {
					id: id,
					quantity: quantity
				},
				success: function(data) {
					$('#list-cart').html(data);
                    $.ajax({
                        url: "{{ route('cartCount') }}",
                        success: function( response ) {
                            console.log(response);
                            $('#cart-count').text(response);
                        }
                    });
				}
			});
		}
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 5000
            })
        });
	</script>
@endsection
