@extends('template')

@section('content')
    <?php

    $images_activity = DB::table('image_activity')
        ->join('activities', 'image_activity.id_activity', '=', 'activities.id_activity')
        ->where('image_activity.id_activity', $data[0]->id_activity)
        ->select('image_activity.url_image', 'image_activity.id_image')
        ->get();

    $image = DB::table('image')->where('id_image', $data[0]->id_image)->select('url_image')->get();

    ?>
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">{{$data[0]->name}}</h1>
                <p class="lead text-muted">{{$data[0]->description}}</p>
                <img class="img-responsive"
                     src="/images/{{$image[0]->url_image}}"
                     height="50%"
                     width="50%" alt="">
            </div>
        </section>

        <div class="container">
            <div class="row">
                @foreach($images_activity as $key => $images_activity)

                <?php

                    $ok = false;
                    $tab = array();
                    $id_user = Auth::id();
                    $comment = DB::table('comments_image')->where('id_image', $images_activity->id_image)->get();

                    if(isset($comment[0])){
                      $current_value = $comment[0]->likes;
                      $tab = explode(';', $current_value);
                      for ($i = 0; $i < count($tab) - 1; $i++) {
                          if ($tab[$i] == $id_user) {
                              $ok = true;
                          }
                      }
                      $likes = count($tab) - 1;
                    } else
                    {
                      $likes = 0;
                    }


                ?>

                        @if($data[0]->recursivity == '1')
                            <?php
                            $date1 = new DateTime($data[0]->date);

                            $date2 = new DateTime(date('Y-m-d'));

                            while($date2->getTimestamp() - $date1->getTimestamp() > 0){
                              $date1->modify('+1 week');

                            }
                            ?>
                        @endif

                        @if($data[0]->recursivity == '2')
                            <?php
                            $date1 = new DateTime($data[0]->date);

                            $date2 = new DateTime(date('Y-m-d'));

                            while($date2->getTimestamp() - $date1->getTimestamp() > 0){
                              $date1->modify('+1 month');

                            }
                            ?>
                        @endif
                        @if($data[0]->recursivity == '3')
                            <?php
                            $date1 = new DateTime($data[0]->date);

                            $date2 = new DateTime(date('Y-m-d'));

                            while($date2->getTimestamp() - $date1->getTimestamp() > 0){
                              $date1->modify('+1 year');

                            }

                            ?>
                        @endif
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 carouselGallery-carousel"
                         data-title="{{$data[0]->name}}"
                         data-date="{{$date1->format('Y-m-d')}}"
                         data-id="{{$images_activity->id_image}}"
                         data-action="{{ csrf_token() }}"
                         data-numberlike="{{$likes}}"
                         data-hasalreadylike="{{$ok}}"
                         data-ida="{{$data[0]->id_activity}}"
                         data-perms="{{$permission}}"
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
            <?php
            $upload_images_right = false;
            if($data[0]->recursivity == 0){

              $date1 = new DateTime($data[0]->date);

              $date2 = new DateTime(date('Y-m-d'));
              if($date2->getTimestamp() - $date1->getTimestamp() > 0){
                $upload_images_right = true;
              }
            }
            ?>
            @if($data[0]->recursivity != 0 || $upload_images_right)
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
            @endif

        </div>
    </main>
@endsection

@section('script')
    <script src="{{asset('js/displayComment.js')}}"></script>
@endsection
