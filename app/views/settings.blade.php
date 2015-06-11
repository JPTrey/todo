@extends('layouts.main')

@section('header')
@section('title') My Settings @stop
@stop

@section('body')
@if (isset($message))
<h3 style="color: green">{{ $message }}</h3>
@endif

<a class="btn btn-default" href="{{ URL::to('task/list') }}"><span class="glyphicon glyphicon-menu-left"></span> Back to List</a>

{{ Form::open(array('url' => URL::to('/user/settings'))) }}

{{ Form::checkbox('hide_empty', '1', $hide_empty) }}
{{ Form::label('hide_empty', 'Hide Empty Sections') }}
<br>

{{ Form::checkbox('fast_remove', '1', $fast_remove) }}
{{ Form::label('fast_remove', 'One-Click Delete') }}
<br>

<!-- {{ Form::checkbox('notify', '1', $notify) }}
{{ Form::label('notify', 'Send an Email Alert if a Task Due Today isn\'t Completed')}}
<br>

{{ Form::checkbox('auto_push', '1', $auto_push) }}
{{ Form::label('hide_empty', 'Push Tasks Upwards Automatically')}}
<br> -->
<br>
{{ Form::submit('Save Changes')}}
{{ Form::close() }}
@stop