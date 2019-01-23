@extends('template')
@section('content')

<?php

?>

<div class="container">
	<div class="row">
		<div class="col-xs-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-6">
								<h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
							</div>
							<div class="col-xs-6">
								<a href='/shop'><button type="button" class="btn btn-primary btn-sm btn-block">
									<span class="glyphicon glyphicon-share-alt"></span> Continue shopping
								</button></a>
							</div>
						</div>
					</div>
				</div>


<?php $price = 0;?>
				@foreach($data as $key => $data)


				<?php

				if (request()->session()->has($data->id_product)){

				 ?>

				<div class="panel-body">
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" height="70" width="100" src="images/{{$data->url_image}}">

						</div>
						<div class="col-xs-4">
							<h4 class="product-name"><strong>{{$data->product_name}}</strong></h4><h4><small>{{$data->product_description}}</small></h4>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h6><strong>{{$data->price}} <span class="text-muted">x</span></strong></h6>
							</div>
							<div class="col-xs-4">
								<input type="text" onchange="changePrice(this)" name="{{$data->id_product}}" id="{{$data->id_product}}" class="form-control input-sm" value="{{request()->session()->get($data->id_product)}}">
							</div>
							<div class="col-xs-2">
								<button type="button" class="btn btn-link btn-xs">
									<span class="glyphicon glyphicon-trash"> </span>
								</button>
							</div>
						</div>
					</div>

<?php
$price += $data->price * request()->session()->get($data->id_product);

} ?>


					@endforeach
					<hr>
					<div class="row">
						<div class="text-center">
							<div class="col-xs-9">
								<h6 class="text-right">Added items?</h6>
							</div>
							<div class="col-xs-3">
								<button type="button" class="btn btn-default btn-sm btn-block">
									Update cart
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total <strong> {{$price}} $ </strong></h4>
						</div>
						<div class="col-xs-3">
							<button type="button" class="btn btn-success btn-block">
								Checkout
							</button>
							<a href="/basket/delete"><button type="button" class="btn btn-success btn-block">
								Delete Orders
							</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function changePrice(val) {
			let product_id = val.id;
			let product_value = val.value;

			let url1 = "/basket/change/";
			let url2 = "/value/";

			let url = url1 + product_id + url2 + product_value;
		document.location.href=url;
}
</script>



@endsection
