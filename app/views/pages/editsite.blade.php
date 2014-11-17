@extends('layouts.admin')

@section('title')
Update Site Details
@stop

@section('adminmain')

	@if(Session::get('confirmation'))
		<div class="alert alert-success">{{Session::get('confirmation')}}</div>
	@endif

	{{ Form::open(array('action' => array('SiteController@update'), 'method' => 'POST', 'id' => 'editsite')) }}

		{{ Form::token() }}

		<h2>Update Site Details</h2>

		<div class="form-group @if($errors->has('site_name')) has-error @endif">

			{{ Form::label('site_name', 'Site Name', array('class' => 'control-label')) }}

			{{ Form::text('site_name', $site->site_name, array('class' => 'form-control', 'id' => 'site_name')) }}

		</div>


		<div class="form-group @if($errors->has('site_title')) has-error @endif">

			{{ Form::label('site_title', 'Site Title', array('class' => 'control-label')) }}

			{{ Form::text('site_title', $site->site_title, array('class' => 'form-control', 'id' => 'site_title')) }}

		</div>

		<div class="form-group @if($errors->has('description')) has-error @endif">

			{{ Form::label('description', 'Site Description', array('class' => 'control-label')) }}

			{{ Form::textarea('description', $site->description, array('class' => 'form-control', 'id' => 'description')) }}

		</div>

		<button type="submit" class="btn btn-outline btn-block btn-site">Update Site Details</button>

	{{ Form::close() }}
 
@stop