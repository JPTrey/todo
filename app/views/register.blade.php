@extends('layouts.main_no_header')

@section('header')
@section('title') Signup @stop
@stop


@section('body')	
	
	@if (isset($message)) <!-- if: cookies aren't permitted, warn user -->
	<h4 style="color: red">{{ $message }}</h4>
	@endif

	<h1>Register <span style="font-size: .5em">(or <a href="{{ URL::to('/user/login') }}">Login</a> to an existing account)</span></h1>
	<div class="row">
		<div class="col-xs-9 col-xs-offset-1">
			{{ Form::open(array('url' => '/user/register')) }}
			{{ Form::label('email') }}
			<br>
			{{ Form::text('email', null, array('autofocus' => 'true')) }}
			<br>
			{{ Form::label('pass', 'Password') }}
			<br>
			{{ Form::password('pass') }}
			<br>
			{{ Form::checkbox('agree')}}
			{{ Form::label('agree', 'I permit cookies to be stored on my computer.')}}
			<br>
			<input class="btn btn-primary" type="submit" value="Submit">
			{{ Form::close() }}
		</div>
	</div>
@stop	
