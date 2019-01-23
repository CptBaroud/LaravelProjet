@extends('template')

@section('content')
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Activities</h1>
            <p class="lead text-muted">You will find the different activities there</p>
        </div>
        <a href= '/activities/create'> <button type="button" class="btn btn-dark">Add a new actvity</button></a>
    </section>
    @foreach($data as $key => $data)


    @if(isset($data->id_image))

    <?php
    $image = DB::table('image')
    ->join('activities', 'image.id_image', '=', 'activities.id_image')
    ->where('image.id_image', $data->id_image)
    ->select('url_image')
    ->get();
    ?>
    	<div class="album py-5 bg-light">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<div class="card mb-12 shadow-sm">
    						    <a href="\activities\{{$data->id_activity}}"><svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" src="test.jpg"><title>Picture</title> <image xlink:href="images/{{$image[0]->url_image}}" height="100%" width="100%"/><text fill="RED" dy=".3em" x="50%" y="50%">{{$data->name}}</text></svg>
    							    </a><div class="card-body">


    								<p class="card-text"><strong>Description : </strong> {{$data->description}} </p>

    								<div class="d-flex justify-content-between align-items-center">
    									<div class="btn-group">


    										@if($permission == '0')
    										<a href ="activities\like\{{ $data->id_activity}}"><button type="button" class="btn btn-sm btn-outline-secondary">{{$data->users_registered}} Like(s)</button></a>
    										@endif

    										@if($permission == '2')
    										<a href ="activities\like\{{ $data->id_activity}}"><button type="button" class="btn btn-sm btn-outline-secondary">{{$data->users_registered}} Like(s)</button></a>

    										<button type="button" class="btn btn-sm btn-outline-secondary">Report</button>
    										@endif

    										@if($permission == '1')

    										<a href="activities\like\{{ $data->id_activity}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$data->users_registered}} Like(s)</button></a>

    										<a href="activities\edit\{{ $data->id_activity}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>

    										<a href="activities\delete\{{$data->id_activity}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
    										@endif

    									</div>
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
