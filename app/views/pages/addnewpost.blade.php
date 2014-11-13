@extends('layouts.admin')

@section('title')
Add New Post
@stop

@section('adminmain')
	
	{{ Form::open(array('route' => 'admin.posts.store', 'files' => true)) }}

		{{ Form::token() }}

		<h2>Add New Post</h2>

		<div class="form-group">

			{{ Form::label('Post Title', null, array('class' => 'control-label')) }}

			{{ Form::text('title', Input::old('title'), array('class' => 'form-control' . ($errors->has('title') ? ' error' : '' ) )) }}

		</div>

		<div class="form-group">

			{{ Form::label('Post Thumbnail', null, array('class' => 'control-label')) }}

			{{ Form::file('thumbnail', array('class' => ($errors->has('title') ? ' error' : '' ) )) }}

		</div>

		<div class="form-group">
			
			{{ Form::label('Post Slug (will be generated from post title if this is omitted)', null, array('class' => 'control-label')) }}

			{{ Form::text('slug', Input::old('slug'), array('class' => 'form-control' . ($errors->has('slug') ? ' error' : '' ) )) }}

		</div>

		<div class="form-group">
			
			{{ Form::label('Content Type', null, array('class' => 'control-label')) }}

			{{ Form::select('post_type', array('markdown' => 'Markdown', 'html' => 'HTML'), 'markdown', array('id' => 'post-type', 'class' => 'form-control' . ($errors->has('post_type') ? ' error' : '' ) )) }}

		</div>

		<div class="form-group">

			{{ Form::label('Content', null, array('class' => 'control-label')) }}

			<div id="markdowncontainer" class="editor-container">
				
				{{ Form::textarea('content[markdown]', Input::old('content[markdown]'), array('class' => 'form-control' . ($errors->has('content[markdown]') ? ' error' : '' ) )) }}

			</div>

			<div id="htmlcontainer" class="editor-container">
				
				<div id="htmlwysiwyg"></div>

				{{ Form::hidden('content[html]', Input::old('content[html]'), array('class' => 'form-control' . ($errors->has('slug') ? ' error' : '' ) )) }}

			</div>

		</div>

		<div class="form-group">
			
			{{ Form::label('Snippet', null, array('class' => 'control-label')) }}

			{{ Form::textarea('snippet', Input::old('snippet'), array('class' => 'form-control' . ($errors->has('snippet') ? ' error' : '' ) )) }}

		</div>

		<div class="form-group">

			{{ Form::label('Choose a Category', null, array('class' => 'control-label')) }}

			{{ Form::select('category_id', $categories, Input::old('category_id'), array('class' => 'form-control' . ($errors->has('category_id') ? ' error' : '' ) )) }}

		</div>

		<div class="form-group">

			{{ Form::label('Post Parent', null, array('class' => 'control-label')) }}

			{{ Form::select('parent_id', $posts, Input::old('parent_id'), array('class' => 'form-control' . ($errors->has('parent_id') ? ' error' : '' ) )) }}

		</div>

		<button type="submit" class="btn btn-outline btn-block btn-site">Create Post</button>

	{{ Form::close() }}

@stop