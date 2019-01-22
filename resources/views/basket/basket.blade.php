@extends('template')
@section('content')



@foreach($data as $key => $data)

@if(isset($data->id_product))

<?php
$product = DB::table('product')
->join('basket', 'product.id_product', '=', 'basket.id_product')
->where('basket.id_product', $data->id_product)
->select('*')
->get();
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
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" height="70" width="100" src="images/{{$product[0]->url_image}}">
						</div>
						<div class="col-xs-4">
							<h4 class="product-name"><strong>{{$product[0]->product_name}}</strong></h4><h4><small>{{$product[0]->product_description}}</small></h4>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h6><strong>{{$product[0]->price}} <span class="text-muted">x</span></strong></h6>
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control input-sm" value="{{$data->quantity}}">
							</div>
							<div class="col-xs-2">
								<button type="button" class="btn btn-link btn-xs">
									<span class="glyphicon glyphicon-trash"> </span>
								</button>
							</div>
						</div>
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
				</div>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total <strong>{{$product[0]->price * $data->quantity}} $ </strong></h4>
						</div>
						<div class="col-xs-3">
							<button type="button" class="btn btn-success btn-block">
								Checkout
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endif
@endforeach
@endsection