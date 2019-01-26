@extends('template')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Idea Box</h1>
                <p class="lead text-muted">In this section, you'll be able to see all the different ideas that has been
                    proposed by our students.</p>
            </div>
            <a href='idea_box/create'>
                <button type="button" class="btn btn-dark">Add a new idea</button>
            </a>
        </section>
        <div class="container">
            <div class="row">
                @foreach($data as $key => $data)
                    @if(isset($data->id_image))

                        <?php
                        $image = DB::table('image')
                            ->join('ideas_box', 'image.id_image', '=', 'ideas_box.id_image')
                            ->where('image.id_image', $data->id_image)
                            ->select('url_image')
                            ->get();

                        $ok = false;
                        $tab = array();
                        $id_user = Auth::id();
                        $idea = DB::table('ideas_box')->where('id_idea', $data->id_idea)->get();
                        $current_value = $idea[0]->likes;
                        $tab = explode(';', $current_value);
                        for ($i = 0; $i < count($tab) - 1; $i++) {
                            if ($tab[$i] == $id_user) {
                                $ok = true;
                            }
                        }
                        $likes = count($tab) - 1;

                        ?>
                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 carouselGallery-carousel"
                             data-index="0"
                             data-title="{{$data->name}}"
                             data-description="{{$data->description}}"
                             data-date="Date : {{$data->creation_date}}"
                             data-price="Price : {{$data->price}}€"
                             data-likes="1234"
                             data-action="{{url('/activities')}}"
                             data-numberlike="{{$likes}}"
                             data-hasalreadylike="{{$ok}}"
                             data-perms="2"
                             data-imagepath="images/{{$image[0]->url_image}}"
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
    <script src="{{asset('js/displayIdeaBox')}}"></script>
@endsection
