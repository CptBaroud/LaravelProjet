@extends('template')

@section('content')

@foreach($data as $key => $data)

<img src="{{ url('/img')}}/{{$data->url_image}}" width="500" height="500" border="0" />


@endforeach

@endsection
