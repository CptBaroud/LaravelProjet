@extends('template')

@section('content')

<?php
$image = DB::table('image')
->join('activities', 'image.id_image', '=', 'activities.id_image')
->where('image.id_image', $data[0]->id_image)
->select('url_image')
->get();

$images_activity = DB::table('image_activity')
->join('activities', 'image_activity.id_activity', '=', 'activities.id_activity')
->where('image_activity.id_activity', $data[0]->id_activity)
->select('image_activity.url_image', 'image_activity.id_image')
->get();

?>
    <main role="main">
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-12 shadow-sm">
                                <div class="card-body">
                                    <p class="card-header"><strong>Title : </strong> {{$data[0]->name}}</p>
                                    <p class="card-img"><image src="/images/{{$image[0]->url_image}}" height="100%" width="100%"/></p>
                                    <p class="card-text">Price : {{$data[0]->price}} €</p>
                                    <p class="card-footer">Date : {{$data[0]->date}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($images_activity as $key => $images_activity)
                    <a href="\activities\{{$data[0]->id_activity}}\images\{{$images_activity->id_image}}">
                        <image src="/images/{{$images_activity->url_image}}" height="10%" width="10%"/>
                    </a>
                    @endforeach
                </div>
    </main>
    <hr>
    <div class='card'>
      <div class ='card-block'>


        <form action="{{ url('/activities')}}/{{$data[0]->id_activity}}" method="post" enctype="multipart/form-data">

            <label  for="file">Picture</label>
            <input type="file" name="file" id="file">

            <input type="hidden" value="{{ csrf_token() }}" name="_token">

          <button type="submit" class="btn btn-primary"> Add Pitcure</button>

        </form>
      </div>
    </div>
@endsection
