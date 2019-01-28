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
										</div>
									</div>
								</tbody>
							</table>
						</div>
					</CENTER>
				</div>
				
				<div class="row">
					<div class="pull-right">
						<div class="span4 pull-right">
							<table align="right" class="table table-striped table-bordered " width="20%">
								<tr>
									<td><span class="extra bold">Total :</span></td>
									<td><span class="bold"><strong> {{$price}} $ </strong></span></td>
								</tr>
							</table>
							<div class="updateArea">		
								<input href="/basket/delete" type="submit" value="Delete order" class="btn btn-success pull-right mr10">
							
								<a href="/shop/mail"  class="btn btn-primary btn-default">checkout<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
							</div>
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
