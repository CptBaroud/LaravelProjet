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
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">{{$data[0]->name}}</h1>
                <p class="lead text-muted">{{$data[0]->description}}</p>
            </div>
        </section>

        <div class="container">
            <div class="row">
                @foreach($images_activity as $key => $images_activity)
                	<div class="card-body">
                                    @if($data[0]->recursivity == '0')
                                    <p class="card-footer">Date : {{$data[0]->date}} </p>
                                    @endif
                                    @if($data[0]->recursivity == '1')
                                    <?php
                                    $date1 = strtotime($data[0]->date);
                                    $date2 = time();

                                    $datediff = $date2 - $date1;
                                    $days_diff = round($datediff / (60 * 60 * 24));
                                    if($days_diff < 0){

                                      

                                    }
                                    ?>
                                    <p class="card-footer">Date : {{$data[0]->date}} </p>
                                    @endif

                                    @if($data[0]->recursivity == '2')
                                    <?php

                                    ?>
                                    <p class="card-footer">Date : {{$data[0]->date}} </p>
                                    @endif

                                    @if($data[0]->recursivity == '3')
                                    <?php

                                    ?>
                                    <p class="card-footer">Date : {{$data[0]->date}} </p>
                                    @endif


                                    <p class="card-footer">Description : {{$data[0]->description}} </p>


                                    @if($data[0]->recursivity == '1')
                                    <p class="card-footer">Recursivity Weekly</p>
                                    @endif
                                    @if($data[0]->recursivity == '2')
                                    <p class="card-footer">Recursivity Monthly</p>
                                    @endif
                                    @if($data[0]->recursivity == '3')
                                    <p class="card-footer">Recursivity Annual</p>
                                    @endif
                                    @if($permission == '2' || $permission == '1')
                                      <div class="btn-group">
                      										<a href ="\activities\download_users\{{ $data[0]->id_activity}}"><button type="button" class="btn btn-sm btn-outline-secondary">Download Users List</button></a>
                                      </div>
                                    @endif
                                  </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 carouselGallery-carousel"
                     data-title="{{$data[0]->name}}"
                     data-imagetext=""
                     data-date="{{$data[0]->date}}"
                     data-id="{{$images_activity->id_image}}"
                     data-action="{{url('/activities')}}"
                     data-ida="{{$data[0]->id_activity}}"
                     data-imagepath="/images/{{$images_activity->url_image}}">
                    <div class="hovereffect carouselGallery-item carouselGallery-item-meta">
                        <img class="img-responsive"
                             src="/images/{{$images_activity->url_image}}"
                             height="100%"
                             width="100%" alt="">
                        <div class="overlay">
                            <h2>{{$data[0]->name}}</h2>
                            <p class="card-text"><a id="showComment">View comments</a>
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>


            <div class='card'>
                <div class='card-block'>
                    <form action="{{ url('/activities')}}/{{$data[0]->id_activity}}" method="post"
                          enctype="multipart/form-data">

                        <label for="file">Picture</label>
                        <input type="file" name="file" id="file">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <button type="submit" class="btn btn-primary"> Add Pitcure</button>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{asset('js/displayComment.js')}}"></script>
@endsection
