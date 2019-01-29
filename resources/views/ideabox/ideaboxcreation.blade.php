@extends('template')
@section('content')
<div class="container" style="margin-top: 75px; margin-bottom: 25px">
	@csrf
	{!!form($Formular)!!}
</div>
@endsection
