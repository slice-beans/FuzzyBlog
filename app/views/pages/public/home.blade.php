@extends('layouts.public')

@section('meta')
@include('partials.defaultmeta')
@stop

@section('publicmain')

<div class="pills-container text-center">

	<ul class="nav nav-pills center-pills" id="wookmarkfilters">

		@foreach($categories as $cat)
		
			<li data-filter="{{ $cat->slug }}"><a href="#">{{ $cat->name }}</a></li>

		@endforeach

	</ul>

</div>

<div id="wookmarkcontainer">
	
	<div class="wookmark">
		
		@foreach($posts as $post)
	
			<div class="grid-item @if( ! empty($post->thumbnail) ) hasthumb @endif {{$post->category->slug}}" data-filter-class='["{{$post->category->slug}}"]'>
		
				@include('partials.post.postcatinner')

			</div>

		@endforeach

	</div>

</div>

@stop