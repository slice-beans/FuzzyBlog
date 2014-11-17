@extends('layouts.admin')

@section('title')
Add New Category
@stop

@section('adminmain')

	{{ Form::open(array('route' => 'admin.categories.store', 'id' => 'newcategory')) }}

		{{ Form::token() }}

		<h2>Add New Category</h2>

		<div class="form-group @if($errors->has('name')) has-error @endif">

			{{ Form::label('name', 'Name', array('class' => 'control-label')) }}

			{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'id' => 'name')) }}

		</div>

		<div class="form-group @if($errors->has('slug')) has-error @endif">

			{{ Form::label('slug', 'Slug', array('class' => 'control-label')) }}

			{{ Form::text('slug', Input::old('slug'), array('class' => 'form-control', 'id' => 'slug')) }}

		</div>

		<button type="submit" class="btn btn-outline btn-block btn-site">Create Category</button>

	{{ Form::close() }}
 
@stop