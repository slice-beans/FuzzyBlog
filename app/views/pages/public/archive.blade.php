@extends('layouts.public')

@section('meta')
@include('partials.defaultmeta')
@stop

@section('publicmain')

@if($posts->isEmpty())

	@include('partials.nopostsfound')

@else

<div class="pills-container text-center">

	<h2>Post Archive</h2>

</div>

<div id="wookmarkcontainer">
	
	<div class="wookmark">
		
		@foreach($posts as $post)
	
			<div class="grid-item @if( ! empty($post->thumbnail) ) hasthumb @endif {{$post->publicpresent()->archive_date}}" data-filter-class='["{{$post->publicpresent()->archive_date}}"]'>
		
				@include('partials.post.postcatinner')

			</div>

		@endforeach

	</div>

</div>

@endif

@stop