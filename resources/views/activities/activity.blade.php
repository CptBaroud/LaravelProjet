@extends('template')

@section('content')
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Activities</h1>
            <p class="lead text-muted">You will find the different activities there</p>
        </div>
        <a href= 'activities/create'> <button type="button" class="btn btn-dark">Add a new actvities</button></a>
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
                        <div class="card-body">
                            <p class="card-header"><strong>Title : </strong> {{$data->name}}</p>
                            <p class="card-img"><image src="images/{{$image[0]->url_image}}" height="50%" width="50%"/></p>
                                <p class="card-text">Price : {{$data->price}} €</p>
                                <p class="card-footer">Date : {{$data->date}}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <button type="button" class="btn btn-sm btn-outline-secondary">Report</button>

                                    <a href="idea_box\like\{{ $data->id_activity}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Register</button></a>

                                    <a href="activities\edit\{{ $data->id_activity}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>

                                    <a href="activities\delete\{{ $data->id_activity}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <image source="images/{{$image[0]->url_image}}" height="100%" width="100%"/>
                    @endif
                    @endforeach



                </main>
                @endsection
