@extends('layouts.admin')

@section('title')
Edit Category
@stop

@section('adminmain')

	{{ Form::open(array('action' => array('CategoriesController@update', $category->id), 'method' => 'PUT', 'id' => 'editcategory')) }}

		{{ Form::token() }}

		<h2>Edit Category</h2>

		<div class="form-group @if($errors->has('name')) has-error @endif">

			{{ Form::label('name', 'Name', array('class' => 'control-label')) }}

			{{ Form::text('name', $category->name, array('class' => 'form-control', 'id' => 'name')) }}

		</div>

		<div class="form-group @if($errors->has('slug')) has-error @endif">

			{{ Form::label('slug', 'Slug', array('class' => 'control-label')) }}

			{{ Form::text('slug', $category->slug, array('class' => 'form-control', 'id' => 'slug')) }}

		</div>

		<button type="submit" class="btn btn-outline btn-block btn-site">Create Category</button>

	{{ Form::close() }}
 
@stop