@extends('template')

{!! Html::style('css/style.css') !!}

@section('content')
<div class="container">
	@csrf
    {!!form($Itemform)!!}
</div>
<p>
    <br>
    <br>
</p>
@endsection
