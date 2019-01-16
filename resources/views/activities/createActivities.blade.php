@extends('template')

@section('content')
    <div class="container">
        {!! form_start($form) !!}
        <div class="row">
            <div class="col-sm-6">
                {!! form_row($form->nom) !!}
            </div>
            <div class="col-sm-6">
                {!! form_row($form->content) !!}
            </div>
        </div>
        {!! form_rest($form) !!}
        {!! form_end($form) !!}
    </div>
@endsection

