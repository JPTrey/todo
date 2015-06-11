@extends('layouts.main')

@section('header')
@section('title') Remove List @stop
@stop

@section('body')
<a class="btn btn-default" href="{{ URL::to('/list') }}"><span class="glyphicon glyphicon-menu-left"></span> My Lists</a>

{{ Form::open(array('url' => '/list/remove/'.$list->id)) }}

<h3 style="color: red"><b>Are you sure you want to delete '{{ $list->name }}' permanently?</b></h3>
<br>
<br>
<input class="btn btn-danger" type="submit" value="Delete">
{{ Form::close() }}
@stop