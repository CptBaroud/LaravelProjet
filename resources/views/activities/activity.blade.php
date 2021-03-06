@extends('template')
@section('content')
    <main role="main" id="body">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Activities</h1>
                <p class="lead text-muted">You will find the different activities here</p>
            </div>
            @if($user_connected)
            <a href='/activities/create'>
                <button type="button" class="btn btn-dark">Add a new activity</button>
            </a>
            @endif
        </section>

        <div class="container">
            <div class="row">
                @foreach($data as $key => $data)
                    @if(isset($data->id_image))
                        <?php
                        $image = DB::table('image')
                            ->join('activities', 'image.id_image', '=', 'activities.id_image')
                            ->where('image.id_image', $data->id_image)
                            ->select('url_image')
                            ->get();

                            $ok = false;
                            $tab = array();
                            $id_user = Auth::id();
                            $activity = DB::table('activities')->where('id_activity', $data->id_activity)->get();
                            $current_value = $activity[0]->users_registered;
                            $tab = explode(';', $current_value);
                            for ($i = 0; $i < count($tab) - 1; $i++) {
                            if ($tab[$i] == $id_user) {
                            $ok = true;
                            }
                            }
                            $likes = count($tab) - 1;
                            ?>

                            @if($activity[0]->recursivity == '1')
                                <?php
                                $date1 = new DateTime($activity[0]->date);

                                $date2 = new DateTime(date('Y-m-d'));

                                while($date2->getTimestamp() - $date1->getTimestamp() > 0){
                                  $date1->modify('+1 week');

                                }
                                ?>
                            @endif

                            @if($activity[0]->recursivity == '2')
                                <?php
                                $date1 = new DateTime($activity[0]->date);

                                $date2 = new DateTime(date('Y-m-d'));

                                while($date2->getTimestamp() - $date1->getTimestamp() > 0){
                                  $date1->modify('+1 month');

                                }
                                ?>
                            @endif
                            @if($activity[0]->recursivity == '3')
                                <?php
                                $date1 = new DateTime($activity[0]->date);

                                $date2 = new DateTime(date('Y-m-d'));

                                while($date2->getTimestamp() - $date1->getTimestamp() > 0){
                                  $date1->modify('+1 year');

                                }

                                ?>
                            @endif
                               @if($activity[0]->recursivity == '0')
                                <?php
                                $date1 = new DateTime($activity[0]->date);

                                ?>
                            @endif

                            <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 carouselGallery-carousel"
                                 data-index="0"
                                 data-username="{{$data->name}}"
                                 data-imagetext="{{$data->description}}"
                                 data-location="Date : {{$date1->format('Y-m-d')}}"
                                 data-price="Price : {{$data->price}}€"
                                 data-likes="1234"
                                 data-action="{{url('/activities')}}"
                                 data-numberlike="{{$likes}}"
                                 data-hasalreadylike="{{$ok}}"
                                 data-id="{{$data->id_activity}}"
                                 data-imagepath="images/{{$image[0]->url_image}}"
                                 data-perms="{{$permission}}"
                                 data-posturl="">
                                <div class="hovereffect carouselGallery-item carouselGallery-item-meta">
                                    <img class="img-responsive" src="images/{{$image[0]->url_image}}"
                                         height="100%"
                                         width="100%" alt="">
                                    <div class="overlay ">
                                        <h2>{{$data->name}}</h2>
                                        <p class="card-text"><a id="showActivity">View More</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            @endif
                        @endforeach
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{asset('js/displayphoto.js')}}"></script>
@endsection
