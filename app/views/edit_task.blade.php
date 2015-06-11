@extends('layouts.main')

@if (isset($message)) 
<h5 style="color: green">{{ $message }}</h5>
@endif

@section('header')
@section('title') Edit Task @stop
@stop

@section('body')
<a class="btn btn-default" href="{{ URL::to('task/list/'.$list_id) }}"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>

{{ Form::open(array('url' => '/task/edit/'.$task->id.'/'.$list_id)) }}

{{ Form::label('name', 'Task Name') }}
<br>
{{ Form::text('name', $task->name) }}
<br>
{{ Form::label('list', 'Task List') }}
<br>
<select id="list" name="list">
	<option value="0">All Tasks</option>
	@if (sizeof($lists))
		@foreach ($lists as $list)
			@if ($list->id == $task->list_id)
				<option value="{{$list->id}}" selected="selected">{{$list->name}}</option>
			@else
				<option value="{{$list->id}}">{{$list->name}}</option>
			@endif
		@endforeach
	@endif
</select>
<br>
{{ Form::label('priority', 'Due')}}
<br>
{{ Form::select(
	'priority', 
	array(
		'today' => 'Today',
		'tomorrow' => 'Tomorrow',
		'week' => 'This Week',
		'two weeks' => 'Next Two Weeks',
		'month' => 'This Month',
		'year' => 'This Year',
		'someday' => 'Someday'
	), 
	$task->priority)
}}
<br>
{{ Form::checkbox('complete', $task->complete) }}
{{ Form::label('complete', 'Mark as Complete') }}
<br>
<br>
<input class="btn btn-primary" type="submit" value="Save Changes">
{{ Form::close() }}
@stop