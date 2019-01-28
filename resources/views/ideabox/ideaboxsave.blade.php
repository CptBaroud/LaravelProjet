@extends('template')

@section('content')
<br>
@foreach($data as $key => $data)
<form action="{{ url('/idea_box/savetodb')}}/{{$data->id}}" method="post" role="form" enctype="multipart/form-data" onsubmit="return verifForm(this)" >
	@csrf
	<div class="form-group">
		<label for="Name">Title</label>
		<input  name="name" class="form-control" value="{{$data->name}}" onblur="verifName(this)">
	</div>
	<div class="form-group">
		<label type="textarea" for="Description">Description</label>
		<input name="description" class="form-control" value="{{$data->description}}" onblur="verifDescription(this)">
	</div>
	<div class="form-group">
		<input type="hidden" name="id_image" class="form-control" value="{{$data->id_image}}" >
		<input type="hidden" name="id_idea" class="form-control" value="{{$id}}">
		<img src="{{url('/images')}}/{{$url_image[0]->url_image}}" width="10%" height="10%" border="0" />
	</div>
	<div class="form-group">
		<label  for="Picture">Change Picture</label>
		<input type="file" name="file" class="form-control">
	</div>
	<div class="form-group">
		<label  for="Picture">Change Date</label>
		<input type="date" name="date" class="form-control" value="{{$data->creation_date}}">
	</div>
	<div class="form-group">
		<label type="number" for="Description">Price</label>
		<input name='number' class="form-control" value="{{$data->price}}" onblur="verifNumber(this)">
	</div>

	<div class="form-group">
		<label  for="Picture">Recursivity</label>
		<select name="recursivity" class="form-control">
				<option value="0"></option>
			  <option value="1">weekly</option>
			  <option value="2">monthly</option>
			  <option value="3">annual</option>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Save to activities</button>
</form>

@endforeach

@endsection
