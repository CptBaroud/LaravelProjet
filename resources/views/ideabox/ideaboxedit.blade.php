@extends('template')

{!! Html::style('css/style.css') !!}

@section('content')
    <div class="container" style="margin-bottom: 35px; margin-top: 75px">
        @foreach($data as $key => $data)

            <form action="{{ url('/idea_box/update')}}/{{$data->id_idea}}" method="post" role="form"
                  enctype="multipart/form-data" onsubmit="return verifForm(this)">
                @csrf
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input name="name" class="form-control" value="{{$data->name}}" onblur="verifName(this)">
                </div>
                <div class="form-group">
                    <label type="textarea" for="Description">Description</label>
                    <input name='description' class="form-control" value="{{$data->description}}"
                           onblur="verifDescription(this)">
                </div>
                <div class="form-group">
                    <input type='hidden' name='id_image' class="form-control" value="{{$data->id_image}}">
                    <img src="{{ url('/images')}}/{{$url_image[0]->url_image}}" width="10%" height="10%" border="0"/>
                </div>
                <div class="form-group">
                    <label for="Picture">Change Picture</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="form-group">
                    <label type="number" for="Description">Price</label>
                    <input name='number' class="form-control" value="{{$data->price}}" onblur="verifNumber(this)">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endforeach
    </div>
@endsection
