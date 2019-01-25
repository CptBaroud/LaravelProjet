@extends('template')

@section('content')
<br>
@foreach($data as $key => $data)
<form action="{{ url('/shop/update')}}/{{$data->id_product}}" method="post" role="form" onsubmit="return verifForm(this)">
	@csrf
	<div class="form-group">
		<label for="Name">Name</label>
		<input  name="name" class="form-control" value="{{$data->product_name}}" onblur="verifName(this)">
	</div>
	<div class="form-group">
		<label type="textarea" for="Description">Description</label>
		<input name='description' class="form-control" value="{{$data->product_description}}" onblur="verifDescription(this)">
	</div>
		<div class="form-group">
		<input type='hidden' name='url_image' class="form-control" value="{{$data->url_image}}" >
		<img src="{{ url('/images')}}/{{$data->url_image}}" width="10%" height="10%" border="0" />
	</div>
	<div class="form-group">
		<label  for="Picture">Change Picture</label>
		<input type="file" name="file" class="form-control">
	</div>
	<div class="form-group">
		<label type="number" for="Description">Price</label>
		<input type="number" name='number' class="form-control" value="{{$data->price}}" onblur="verifNumber(this)">
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>


@endforeach

@endsection