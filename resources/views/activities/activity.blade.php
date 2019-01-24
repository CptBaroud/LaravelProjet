@extends('template')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Activities</h1>
                <p class="lead text-muted">You will find the different activities there</p>
            </div>
            <a href='/activities/create'>
                <button type="button" class="btn btn-dark">Add a new actvity</button>
            </a>
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
                            if ($tab[$i] === $id_user) {
                                $ok = true;
                            }
                        }
                        $likes = count($tab) - 1;
                        ?>

                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="hovereffect">
                                <img class="img-responsive" src="images/{{$image[0]->url_image}}" height="100%"
                                     width="100%" alt="">
                                <div class="overlay">
                                    <h2>{{$data->name}}</h2>
                                    <p class="card-text"><a href="\activities\{{$data->id_activity}}">View More</a>
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
