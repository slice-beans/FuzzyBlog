@extends('layouts.admin')

@section('title')
Add New Post
@stop

@section('adminmain')
	
	{{ Form::open(array('route' => 'admin.posts.store', 'files' => true, 'id' => 'newpost')) }}

		{{ Form::token() }}

		<h2>Add New Post</h2>

		<div class="form-group @if($errors->has('status')) has-error @endif">

			{{ Form::label('Post Status', null, array('class' => 'control-label')) }}

			{{ Form::select('status', array(1 => 'Active', 2 => 'Draft'), 1, array('class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('title')) has-error @endif">

			{{ Form::label('Post Title', null, array('class' => 'control-label')) }}

			{{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('thumbnail')) has-error @endif">

			<div class="col-md-2 col-xs-2" id="postthumbnail">

				<p>No thumbnail set.</p>

			</div>

			{{ Form::label('post-thumbnail', 'Post Thumbnail', array('class' => 'control-label')) }}

			<br>

			<button id="clearthumbnail" class="btn btn-warning">Clear Thumbnail</button>

			<button id="newthumbnail" class="btn btn-primary">Set Thumbnail</button>

			{{ Form::file('thumbnail', array('id' => 'post-thumbnail', 'style' => 'opacity:0;')) }}

		</div>

		<div class="form-group @if($errors->has('slug')) has-error @endif">
			
			{{ Form::label('Post Slug (will be generated from post title if this is omitted)', null, array('class' => 'control-label')) }}

			{{ Form::text('slug', Input::old('slug'), array('class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('post_type')) has-error @endif">
			
			{{ Form::label('Content Type', null, array('class' => 'control-label')) }}

			{{ Form::select('post_type', array('markdown' => 'Markdown', 'html' => 'HTML'), 'markdown', array('id' => 'post-type', 'class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('content[markdown]')) has-error @endif @if($errors->has('content[html]')) has-error @endif">

			{{ Form::label('Content', null, array('class' => 'control-label')) }}

			<div id="markdowncontainer" class="editor-container">

				{{ Form::textarea('content[markdown]', Input::old('content[markdown]'), array('class' => 'form-control')) }}

			</div>

			<div id="htmlcontainer" class="editor-container">
				
				<div id="htmlwysiwyg"></div>
			
				{{ Form::hidden('content[html]', Input::old('content[html]'), array('class' => 'form-control')) }}

			</div>

		</div>

		<div class="form-group @if($errors->has('snippet')) has-error @endif">
			
			{{ Form::label('Snippet', null, array('class' => 'control-label')) }}

			{{ Form::textarea('snippet', Input::old('snippet'), array('class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('category_id')) has-error @endif">

			{{ Form::label('Choose a Category', null, array('class' => 'control-label')) }}

			{{ Form::select('category_id', $categories, Input::old('category_id'), array('class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('parent_id')) has-error @endif">

			{{ Form::label('Post Parent', null, array('class' => 'control-label')) }}

			{{ Form::select('parent_id', $posts, Input::old('parent_id'), array('class' => 'form-control')) }}

		</div>

		<button type="submit" class="btn btn-outline btn-block btn-site">Create Post</button>

	{{ Form::close() }}

@stop