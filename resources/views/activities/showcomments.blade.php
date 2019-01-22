@extends('template')

@section('content')



    <main role="main">
      <div class="album py-5 bg-light">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card mb-12 shadow-sm">
                          <div class="card-body">
                          <image src="/images/{{$url}}" height="100%" width="100%"/>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-12 shadow-sm">
                                <div class="card-body">
                                  @foreach($comments as $key => $comments)
                                      <?php
                                      $pseudo = DB::table('users')->where('id', $comments->users)->select('last_name', 'first_name')->get();
                                      echo $pseudo[0]->first_name.' '.$pseudo[0]->last_name.' : ';
                                      ?>
                                      {{$comments->comment}}
                                      <br>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
    <hr>
    <div class='card'>
      <div class ='card-block'>


        <form action="{{ url('/activities')}}/comment/images/{{$id_image}}" method="post" enctype="multipart/form-data">

            <label  for="comment">Comment</label>
            <input type="text" name="comment" id="comment">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">

          <button type="submit" class="btn btn-primary"> Add Comment </button>

        </form>
      </div>
    </div>
@endsection
