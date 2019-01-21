@extends('template')

@section('content')
    <div class="container">
        {!! form_start($form) !!}
        <div class="row">
            <div class="col-sm-3">
                {!! form_row($form->nom) !!}
            </div>
            <div class="col-sm-3">
                {!! form_row($form->date) !!}
            </div>
            <div class="col-sm-6">
                {!! form_row($form->content) !!}
            </div>
        </div>
        {!! form_rest($form) !!}
        {!! form_end($form) !!}
        <div>
            {!! Form::open(array('route' => 'activitiesStoreImage','files'=>true)) !!}
            <div class="col-md-6">
                {!! Form::file('image', array('class' => 'form-control')) !!}
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

