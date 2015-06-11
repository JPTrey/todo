@extends('layouts.main')

@if (isset($message)) 
<h5 style="color: green">{{ $message }}</h5>
@endif

@section('header')
@section('title') Edit '{{ $list->name }}' @stop
@stop

@section('body')
<a class="btn btn-default" href="{{ URL::to('/list') }}"><span class="glyphicon glyphicon-menu-left"></span> My Lists</a>

{{ Form::open(array('url' => '/list/edit/' . $list->id)) }}

{{ Form::label('name', 'List Name') }}
<br>
{{ Form::text('name', $list->name) }}
<br>
<br>
<input class="btn btn-primary" type="submit" value="Save Changes">
{{ Form::close() }}
@stop