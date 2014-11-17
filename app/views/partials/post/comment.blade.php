<a href="#" class="media-left">
	{{$comment->publicpresent()->gravatar}}
</a>
<div class="media-body">
	<h4 class="media-heading">{{$comment->publicpresent()->heading}}</h4>
	<p>{{$comment->content}}</p>
	@if( ! $comment->replies->isEmpty())
	<div class="media @if($comment->authorable->id == $post->id) author @endif">
		@foreach($comment->replies as $reply)
			@include('partials.post.comment', array('comment' => $reply))
		@endforeach
	</div>
	@endif
	<p><small>Comment submitted {{$comment->publicpresent()->created_at_human}}</small></p>
</div>