@extends('template')

@section('content')

<form action="upload_image" method="post" enctype="multipart/form-data">
    <label for="image">Image</label>
    <input type="file" name="image"><br>

    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <input type="submit" name="submit" value="Submit">

</form>

@endsection
