qu@extends('template')

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



                                      $ok = false;
                                      $tab = array();
                                      $id_user = Auth::id();
                                        $comment = DB::table('comments_image')->where('id_comment', $comments->id_comment)->get();
                                        $current_value = $comments->likes;
                                        $tab = explode(';',$current_value);
                                        for($i = 0; $i < count($tab)-1; $i++){
                                          if($tab[$i] == $id_user) {
                                            $ok = true;
                                          }
                                        }
                                        $likes = count($tab)-1;

                                      $pseudo = DB::table('users')->where('id', $comments->users)->select('last_name', 'first_name')->get();
                                      echo $pseudo[0]->first_name.' '.$pseudo[0]->last_name.' : ';
                                      ?>
                                      {{$comments->comment}}
                                      <br>

                                      <div class="btn-group">


                                        @if($permission == '0')
                                          @if($ok)
                                          <a href="\activities\comment\like\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$likes}} Liked</button></a>
                                          @else
                                          <a href="\activities\comment\like\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$likes}} Like(s)</button></a>
                                          @endif
                                        @endif

                                        @if($permission == '2')
                                        @if($ok)
                                        <a href="\activities\comment\like\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$likes}} Liked</button></a>
                                        @else
                                        <a href="\activities\comment\like\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$likes}} Like(s)</button></a>
                                        @endif

                                        <a href="\activities\{{$activity[0]->id_activity}}\images\showComment\report\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Report</button></a>

                                        @endif

                                        @if($permission == '1')

                                        @if($ok)
                                        <a href="\activities\comment\like\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$likes}} Liked</button></a>
                                        @else
                                        <a href="\activities\comment\like\{{$comments->id_comment}}"> <button type="button" class="btn btn-sm btn-outline-secondary">{{$likes}} Like(s)</button></a>
                                        @endif

                                        <a href="\activities\comment\delete\{{$comments->id_comment}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
                                        @endif

                                      </div>
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
