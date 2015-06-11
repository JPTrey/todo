@extends('layouts.main_no_header')

@section('header')
@section('title') Login @stop
@stop

@section('body')	
	@if (isset($message)) 
	<h3 style="color: red">{{ $message }}</h3>
	@endif

	<h1>Login <span style="font-size: .5em">(or <a href="{{ URL::to('/user/register') }}">Register</a> a new account)</span></h1>
	<div class="row">
		<div class="col-xs-9 col-xs-offset-1">
			{{ Form::open(array('url' => URL::to('/user/login'))) }}
			{{ Form::label('email') }}
			<br>
			{{ Form::text('email', null, array('autofocus' => 'true')) }}
			<br>
			{{ Form::label('pass', 'Password') }}
			<br>
			{{ Form::password('pass') }}
			<br>
			{{ Form::checkbox('remember', false) }}
			{{ Form::label('remember', 'Keep me logged in') }}
			<br>
			<input class="btn btn-primary" type="submit" value="Login">
			{{ Form::close() }}
		</div>
	</div>
@stop	
