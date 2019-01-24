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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 carouselGallery-carousel"
                     data-title="{{$data[0]->name}}"
                     data-imagetext=""
                     data-date="{{$data[0]->date}}"
                     data-id="{{$data[0]->id_activity}}"
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

