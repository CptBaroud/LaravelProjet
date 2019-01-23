@extends('template')

@section('content')
<main role="main">
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Idea Box</h1>
			<p class="lead text-muted">In this section, you'll be able to see all the different ideas that has been proposed by our students.</p>
		</div>
		<a href= 'idea_box/create'> <button type="button" class="btn btn-dark">Add a new idea</button></a>
	</section>

	@foreach($data as $key => $data)


	@if(isset($data->id_image))

	<?php
	$image = DB::table('image')
	->join('ideas_box', 'image.id_image', '=', 'ideas_box.id_image')
	->where('image.id_image', $data->id_image)
	->select('url_image')
	->get();
	?>


	<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-12 shadow-sm">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" src="test.jpg"><title>Picture</title> <image xlink:href="images/{{$image[0]->url_image}}" height="100%" width="100%"/><text fill="RED" dy=".3em" x="50%" y="50%">{{$data->name}}</text></svg>
							<div class="card-body">

								<p class="card-text"><strong>Description : </strong> {{$data->description}} </p>

								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">


										@if($permission == '0')
										<a href ="idea_box\like\{{ $data->id_idea}}"><button type="button" class="btn btn-sm btn-outline-secondary">{{$data->nber_likes}} Like(s)</button></a>
										@endif

										@if($permission == '2')
										<a href ="idea_box\like\{{ $data->id_idea}}"><button type="button" class="btn btn-sm btn-outline-secondary">{{$data->nber_likes}} Like(s)</button></a>

										<a href ="idea_box\report\{{ $data->id_idea}}"><button type="button" class="btn btn-sm btn-outline-secondary">Report</button></a>
										@endif

										@if($permission == '1')

										<a href="idea_box\like\{{ $data->id_idea}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$data->nber_likes}} Like(s)</button></a>

										<a href="idea_box\edit\{{ $data->id_idea}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>

										<a href ="idea_box\save\{{ $data->id_idea}}"><button type="button" class="btn btn-sm btn-outline-secondary">Save</button></a>

										<a href="idea_box\delete\{{ $data->id_idea}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
										@endif

									</div>
									<small class="text-muted"> <strong>Created : </strong>{{$data->creation_date}}</small>
									<small class="text-muted"> <strong>Price : </strong>{{$data->price}}</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		@endif
		@endforeach



	</main>
	@endsection
