@extends('layouts.master')

@section('title')
Login to your FuzzyBlog account
@stop

@section('main')
<div class="container">

	<div class="form-signin">
		
		{{ HTML::image('/img/logo.png') }}

		{{ Form::open(array('route' => 'sessions.store')) }}
	
			@if(Session::get('error'))
				<div class="alert alert-danger">{{Session::get('error')}}</div>
			@endif

			<p>Please sign in to your FuzzyBlog account here</p>

			{{ Form::token() }}

			{{ Form::text('username', null, array('placeholder' => 'Username', 'class' => 'form-control col-md-2')) }}

			{{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control col-md-2')) }}
			
			<button type="submit" class="btn btn-block btn-outline btn-site">Log In</button>

		{{ Form::close() }}

		{{ HTML::link('/', 'Get me out of here!', array('class' => 'btn btn-site btn-outline', 'style' => 'margin-top:10px;'))}}

	</div>
</div>
@stop