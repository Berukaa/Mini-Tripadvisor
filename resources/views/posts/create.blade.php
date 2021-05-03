@extends('layouts.home')
<title>Mini Tripadvisor - Nouvel établissement</title>
@section('content')
<div class="d-flex justify-content-around mx-auto" style="width:70%;margin-top:50px;margin-bottom:350px">
    <h1>Créer un nouvel établissement</h1>
    {!! Form::open(["action" => "BoxController@store", "method" => "POST", 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Nom')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nom de l établissement'])}}
        </div>
        <div class="form-group">
            {{Form::label('address', 'Adresse')}}
            {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Adresse'])}}
        </div>
        <div class="form-group">
            {{Form::label('city', 'Ville')}}
            {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'Ville'])}}
        </div>
        <div class="form-group">
            {{Form::label('postal', 'Code postal')}}
            {{Form::text('postal', '', ['class' => 'form-control', 'placeholder' => 'Code postal'])}}
        </div>
        <div class="form-group">
            {{Form::label('country', 'Pays')}}
            {{Form::text('country', '', ['class' => 'form-control', 'placeholder' => 'Pays'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-success'])}}
    {!! Form::close() !!}
</div>
@endsection