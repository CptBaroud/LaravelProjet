@extends('template')

{!! Html::style('css/style.css') !!}

@section('content')
    <div class="container">
    	@csrf
        {!! form($form) !!}
    </div>
@endsection

