@extends('layouts.main')

@if (isset($message)) 
<h5 style="color: green">{{ $message }}</h5>
@endif

@section('header')
@section('title') Add New Task @stop
@stop

@section('body')
<a class="btn btn-default" href="{{ URL::to('task/list/'.$list_id) }}"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>

{{ Form::open(array('url' => '/task/add'.'/'.$list_id)) }}

{{ Form::label('name', 'Task Name') }}
<br>
{{ Form::text('name', '', array(
	'placeholder' => 'e.g. Clean Room, Finish Ch. 1, Weekly Jog',
	'autofocus' => 'true'
	)) }}
<br>
<br>
{{ Form::label('list', 'Task List') }}
<br>

<select id="list" name="list">
	@if ($list_id == 0)
		<option value="0" selected="selected">All Tasks</option>
	@else
		<option value="0">All Tasks</option>
	@endif

	@if (sizeof($lists))
		@foreach ($lists as $list)
			@if ($list_id == $list->id)
				<option value="{{$list->id}}" selected="selected">{{$list->name}}</option>
			@else
				<option value="{{$list->id}}">{{$list->name}}</option>
			@endif		
		@endforeach
	@endif
</select>
<br>
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
	$section
)}}
<br>
<br>
{{ Form::checkbox('complete', true, $marked) }}
{{ Form::label('complete', 'Mark as Complete') }}
<br>
<br>
<input class="btn btn-primary" type="submit" value="Add to List">
{{ Form::close() }}
@stop