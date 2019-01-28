@extends('template')
@section('content')
<style style="text/css">
table{
	border: 1px solid black;
	border-collapse: collapse;
	table-layout: fixed;

}

th, td {
	border: 1px solid black;
	word-break: break-all;
}
@media (max-width: 768px){

	tr th:nth-child(3),tr td:nth-child(3){

		display:none;

	}
	.checkout
	{
		    float: right;
	}
	.updateArea
	{
		    float: left;
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
				<div class="col-xs-6">
					<CENTER>
						<div class="cart-info">
							<table class="table table-striped table-bordered table-sm table-md table-lg" width=60%  >
								<thead>
									<tr>
										<th width="11%" class="image">Image</th>
										<th width="30%" class="name">Product Name</th>
										<th width="34%"class="description" >Description</th>
										<th width="15%" class="quantity">Quantity</th>
										<th width="10%"class="price">Price</th>
									</tr>
								</thead>
								<tbody>
									<?php $price = 0;?>
									<div class="row">
										<div class="col-xs-6">
											@foreach($data as $key => $data)


											<?php
											$value = Auth::id().';'.$data->id_product;
											if (request()->session()->has($value)){
												?>

												<tr>
													<td class="image"><img title="product" alt="product" src="images/{{$data->url_image}}" width="100%"></td>
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
											<tr>
												<td></td>
												<td></td>
												<td></td>

												<td><strong>Total</strong></td>
												<td class="text-right"><strong>{{$price}} $ </strong></td>
											</tr>
										</div>
									</div>
								</tbody>
							</table>
						</div>
					</CENTER>
				</div>

				<div class="col mb-2">
					<div class="row">
						<div class="col-sm-12  col-md-6">
							<a href="/shop"><button class="btn btn-block btn-light">Continue Shopping</button></a>
						</div>
						<div class="col-sm-12 col-md-6 text-right">
							<a href="/shop/mail/{{$data->id_product}}"><button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button></a>
						</div>
					</div>
				</div>
				<div class="updateArea">
				<a href="/basket/delete">	<input type="button" value="Delete order" class="btn btn-success pull-right mr10"></a>
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
