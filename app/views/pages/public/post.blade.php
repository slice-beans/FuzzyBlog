@extends('layouts.public')

@section('meta')
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:site_name" content="FuzzyBlog" />
<meta property="og:url" content="{{ URL::to('/'.$post->slug) }}" />
<meta property="og:description" content="{{ $post->snippet }}" />
<meta property="og:image" content="{{ URL::asset('img/thumbs/'.$post->thumbnail) }}" />
<meta property="og:type" content="article" />
<meta name="description" content="{{ $post->snippet }}" />
@stop

@section('publicmain')

<div class="post @if( ! empty($post->thumbnail)) hasthumb @endif row">
	
	@if(\Auth::check())

		<div class="col-md-4 pull-left" style="padding:0; margin:10px 0;">
		
			<div class="btn-group" role="group" aria-label="...">
			  <a href="{{URL::route('admin.posts.index')}}" class="btn btn-default">View all posts</a>
			</div>

		</div>

	@endif
	
	<div class="posttop col-md-12">

		@if( ! empty($post->thumbnail))

			@include('partials.post.topthumb')

		@else

			@include('partials.post.top')

		@endif

	</div>

	<div class="postmeta col-md-12">

		<p><i class="fa fa-tag"></i> <a href="/category/{{$post->category->slug}}">{{$post->category->name}}</a></p>

		<p class="pull-right" style="margin:0 10px;"><i class="fa fa-user"></i> {{$post->author->username}}</p>

		<p class="pull-right"><i class="fa fa-calendar"></i> {{$post->publicpresent()->created_at_human}}</p>

	</div>

	<div class="postcontent col-md-12">

		{{$post->publicpresent()->content}}

	</div>

	<div class="comments col-md-12">
		
		@include('partials.post.commentmessages')

		<h3>Post a comment on {{$post->title}}</h3>
		
		@if(\Auth::check())

			@include('partials.post.commentloggedin')

		@else 

			@include('partials.post.commentnotloggedin')

		@endif

		@if($post->comments->isEmpty())
			
			<h3>No comments yet on {{$post->title}}

		@else
			
			<h3>Comments on {{$post->title}}</h3>

			<ul class="media-list">

				@foreach($post->comments as $comment)

					@if(is_null($comment->parent_id))

					<li class="media @if($comment->authorable->id == $post->id) author @endif">

						@include('partials.post.comment', array('comment' => $comment))

					</li>

					@endif

				@endforeach

			</ul>

		@endif
		
	</div>

</div>

@stop