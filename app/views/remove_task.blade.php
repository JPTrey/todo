@extends('layouts.main')

@section('header')
@section('title') Remove Task @stop
@stop

@section('body')
<a class="btn btn-default" href="{{ URL::to('task/list/'.$list_id) }}"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>

{{ Form::open(array('url' => '/task/remove/'.$task->id.'/'.$list_id)) }}

<h3 style="color: red"><b>Are you sure you want to delete '{{ $task->name }}' permanently?</b></h3>
<br>
<br>
<input class="btn btn-danger" type="submit" value="Delete">
{{ Form::close() }}
@stop