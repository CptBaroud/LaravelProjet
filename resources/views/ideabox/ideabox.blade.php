@extends('template')

@section('content')
<div>
	<a href= 'idea_box/create'>
		<div class="btn-outline-dark">
		Create an idea </div>
	</a>
</div>
<main role="main">
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Idea Box</h1>
			<p class="lead text-muted">In this section, you'll be able to see all the different ideas that has been proposed by our students.</p>
		</div>
	</section>
	@foreach($data as $key => $data)
	<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-12 shadow-sm">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" src="test.jpg"><title>Picture</title><rect fill="#55595c" width="100%" height="100%"></rect><text fill="#eceeef" dy=".3em" x="50%" y="50%">{{$data->name}}</text></svg>
						<div class="card-body">
							<p class="card-text"><strong>Description : </strong> {{$data->description}}</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
									<button type="button" class="btn btn-sm btn-outline-secondary">Edited</button>
									<button type="button" class="btn btn-sm btn-outline-secondary">Save</button>
									<a href="idea_box\delete\{{ $data->id_idea}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
								</div>
								<small class="text-muted"> <strong>Created : </strong>{{$data->creation_date}}</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endforeach

</main>
@endsection