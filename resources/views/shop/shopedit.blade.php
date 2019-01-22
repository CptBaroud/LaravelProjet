@extends('template')

@section('content')
<br>
@foreach($data as $key => $data)
<form action="{{ url('/shop/update')}}/{{$data->id_product}}" method="post" role="form">
	@csrf
	<div class="form-group">
		<label for="Name">Name</label>
		<input  name="name" class="form-control" value="{{$data->product_name}}">
	</div>
	<div class="form-group">
		<label type="textarea" for="Description">Description</label>
		<input name='description' class="form-control" value="{{$data->product_description}}" >
	</div>
	<div class="form-group">
		<label type="number" for="Description">Price</label>
		<input name='number' class="form-control" value="{{$data->price}}" >
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endforeach

@endsection