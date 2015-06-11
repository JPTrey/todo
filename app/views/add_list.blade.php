@extends('layouts.main')

@if (isset($message)) 
<h5 style="color: green">{{ $message }}</h5>
@endif

@section('header')
@section('title') Add New List @stop
@stop

@section('body')
<a class="btn btn-default" href="{{ URL::to('/list') }}"><span class="glyphicon glyphicon-menu-left"></span> My Lists</a>

{{ Form::open(array('url' => '/list/add')) }}

{{ Form::label('name', 'List Name') }}
<br>
{{ Form::text('name', '', array(
	'placeholder' => 'e.g. Novel, Exercise Routine, etc.',
	'autofocus' => 'true'
	)) }}
<br>
<br>
<input class="btn btn-primary" type="submit" value="Add to Lists">
{{ Form::close() }}
@stop