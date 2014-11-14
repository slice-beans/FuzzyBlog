@extends('layouts.admin')

@section('title')
Edit Post
@stop

@section('adminmain')

	@if(Session::get('errors'))
		
		<div class="alert alert-danger">
		
			@foreach(Session::get('errors')->all() as $error)
			
				{{$error}}<br>

			@endforeach
		
		</div>

	@endif

	
	{{ Form::open(array('action' => array('PostsController@update', $post->id), 'method' => 'PUT', 'files' => true, 'id' => 'editpost')) }}

		{{ Form::token() }}

		<h2>Edit Post</h2>

		<div class="form-group @if($errors->has('status')) has-error @endif">

			{{ Form::label('post-status', 'Post Status', array('class' => 'control-label')) }}

			{{ Form::select('status', array(1 => 'Active', 2 => 'Draft'), 1, array('class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('title')) has-error @endif">

			{{ Form::label('post-title', 'Post Title', array('class' => 'control-label')) }}

			{{ Form::text('title', $post->title, array('class' => 'form-control', 'id' => 'post-title')) }}

		</div>

		<div class="form-group @if($errors->has('thumbnail')) has-error @endif">

			<div class="col-md-2 col-xs-2" id="postthumbnail">

				{{$post->adminpresent()->thumbnail}}

			</div>

			{{ Form::label('post-thumbnail', 'Post Thumbnail', array('class' => 'control-label')) }}

			<br>

			<button id="clearthumbnail" class="btn btn-warning">Clear Thumbnail</button>

			<button id="newthumbnail" class="btn btn-primary">Set New Thumbnail</button>

			{{ Form::file('thumbnail', array('id' => 'post-thumbnail', 'style' => 'opacity:0;')) }}

			{{ Form::hidden('thumbnailupdate', 'false', array('id' => 'thumbnailupdate')) }}

		</div>

		<div class="form-group @if($errors->has('slug')) has-error @endif" style="clear:both;">
			
			{{ Form::label('post-slug', 'Post Slug (will be generated from post title if this is omitted)', array('class' => 'control-label')) }}

			{{ Form::text('slug', $post->slug, array('class' => 'form-control', 'id' => 'post-slug')) }}

		</div>

		<div class="form-group @if($errors->has('post_type')) has-error @endif">
			
			{{ Form::label('content-type', 'Content Type', array('class' => 'control-label')) }}

			{{ Form::select('post_type', array('markdown' => 'Markdown', 'html' => 'HTML'), $post->post_type, array('id' => 'post-type', 'class' => 'form-control')) }}

		</div>

		<div class="form-group @if($errors->has('content[markdown]')) has-error @endif @if($errors->has('content[html]')) has-error @endif">

			{{ Form::label('Content', null, array('class' => 'control-label')) }}

			<div id="markdowncontainer" class="editor-container">
				
				@if($post->post_type !== 'markdown')
					{{ Form::textarea('content[markdown]', Input::old('content[markdown]'), array('class' => 'form-control')) }}
				@else
					{{ Form::textarea('content[markdown]', $post->content, array('class' => 'form-control')) }}
				@endif

			</div>

			<div id="htmlcontainer" class="editor-container">
				
				<div id="htmlwysiwyg"></div>

				@if($post->post_type !== 'html')
					{{ Form::hidden('content[html]', Input::old('content[html]'), array('class' => 'form-control')) }}
				@else
					{{ Form::hidden('content[html]', $post->content, array('class' => 'form-control')) }}
				@endif

			</div>

		</div>

		<div class="form-group @if($errors->has('snippet')) has-error @endif">
			
			{{ Form::label('Snippet', null, array('class' => 'control-label')) }}

			{{ Form::textarea('snippet', $post->snippet, array('class' => 'form-control')) }}

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


@if($post->post_type == 'html')

	@section('scripts')

		<script>

			jQuery(document).ready(function() {
				$('#htmlwysiwyg').code('{{$post->content}}');	
			});

		</script>

	@stop

@endif