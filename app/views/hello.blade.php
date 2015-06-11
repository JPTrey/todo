@extends('layouts.main_no_header')

@section('header')
@section('title') Todo @stop
@stop

@section('body')
<div class="row">
    <div class="col-sm-5 col-sm-offset-1">
        <h2 class="text-center project-title">Todo</h2>
        <h3 class="text-center project-tagline">Be organized, not overwhelmed.</h3>
        <p class="text-center project-info">
             Always on hand and never lets you lose perspective, use <em>Todo</em> to break down big projects into small tasks, or just to plan your day. 
            <em>Todo</em> helps you organize your life without requiring specific, tedious planning.
        </p>
    </div>
    <div class="col-sm-5 col-sm-offset-1">
        <img class="img img-responsive thumbnail" src="{{asset('todo.PNG')}}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h2 class="text-center">Free to Use. Period.</h2>
        <p class="text-center">Todo is free to use, and always will be.  We do not collect cookies or private information.</p>
        <p class="text-center"><a class="btn btn-default" href="/user/register" id="registerLink">Register</a></p>
    </div>
    <div class="col-md-6">
        <h2 class="text-center">Always Available, On Any Device</h2>
        <p class="text-center">Already registered? You can login from either your desktop and portable devices.</p>
        <p class="text-center"><a class="btn btn-default" href="/user/login" id="loginLink">Log in</a></p>
    </div>
</div>

    </div>
@stop