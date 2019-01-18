@extends('template')

@section('content')
<br>
@foreach($data as $key => $data)
<form action="{{ url('/idea_box/update')}}/{{$data->id_idea}}" method="POST" role="form">
@csrf
	<div class="form-group">
		<label for="Name">Name</label>
		<input  class="form-control" value="{{$data->name}}">
	</div>
	<div class="form-group">
		<label type="textarea" for="Description">Description</label>
		<input class="form-control" value="{{$data->description}}" >
	</div>
	<div class="form-group">
		<label type="number" for="Description">Price</label>
		<input class="form-control" value="{{$data->price}}" >
	</div>
	@endforeach
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection