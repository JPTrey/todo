@extends('layouts.main')

@section('header')
@section('title') My Lists @stop
@stop

@section('body')

@if (isset($message))
<h4 style="color: green">{{ $message }}</h4>
@endif

<a class="btn btn-default" href="{{ URL::to('task/list') }}"><span class="glyphicon glyphicon-menu-left"></span> All Tasks</a>

@if (sizeof($lists))
	<div class="row">
		<div class="col-sm-10">
			<h1>My Lists <a class="btn btn-primary pull-right" href="{{ URL::to('list/add') }}">+ List</a></h1>
			<ul>
				@foreach ($lists as $list)
				<li>
					{{ $list->name }} 
					<p class="pull-right"> <a style="color: red" href="{{ URL::to('list/remove/'.$list->id) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
					<p class="pull-right"> <a style="color: gray" href="{{ URL::to('list/edit/'.$list->id) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
				</li>
				<br>
				@endforeach
			</ul>
		</div>
	</div>

@else
	<h1>You don't have any lists setup.</h1>

@endif


@stop