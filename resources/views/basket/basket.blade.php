@extends('template')
@section('content')
<style style="text/css">
table{
	border: 1px solid black;
	border-collapse: collapse;
	table-layout: fixed;
	width: 560px;  
}

th, td {
	border: 1px solid black;
	word-break: break-all;
}
</style>
<?php

?>
<section class="jumbotron text-center">
	<div class="container">
		<h1 class="jumbotron-heading">Basket</h1>
		<p class="lead text-muted">You will find your basket there</p>
	</div>

</section>
<div id="maincontainer">
	<section id="checkout">
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
						<div class="col-xs-6">
							<CENTER>
								<div class="cart-info">
									<table class="table table-striped table-bordered" width=60%  >
										<tr>
											<th width="19%" class="image">Image</th>
											<th width="19%" class="name">Name</th>
											<th width="33%"class="description" >Description</th>
											<th width="17%" class="quantity">Quantity</th>
											<th width="17%"class="price">Price</th>

										</tr>
										<?php $price = 0;?>
										<div class="row">
											<div class="col-xs-6">
												@foreach($data as $key => $data)


												<?php
												$value = Auth::id().';'.$data->id_product;
												if (request()->session()->has($value)){
													?>

													<tr>
														<td class="image"><span class="cartImage" alt="product" src="images/{{$data->url_image}}" ></span></td>
														<td class="name"><a href="#"><strong>{{$data->product_name}}</strong></a></td>
														<td class="description"><small>{{$data->product_description}}</small></td>
														<td class="quantity"><input type="text" onchange="changePrice(this)" name="{{$data->id_product}}" id="{{$data->id_product}}" class="form-control input-sm" value="{{request()->session()->get($value)}}"></td>
														&nbsp;
														<td class="price"><strong>{{$data->price}} <span class="text-muted">$</span></strong></td>
													</tr>

													<?php
													$price += $data->price * request()->session()->get($value);

												} ?>

												@endforeach
											</div>
										</div>
									</table>
								</div>
							</CENTER>
						</div>
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
									<a href='/shop/mail'><button type="button" class="btn btn-success btn-block">
									PURCHASE</button></a>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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
