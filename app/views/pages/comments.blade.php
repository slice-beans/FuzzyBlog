@extends('layouts.adminentitylist')

@section('title')
FuzzyBlog | Comments
@stop

@section('thead')

	<th>ID</th>
	<th>Post</th>
	<th>Content</th>
	<th>Reply To</th>
	<th>Author</th>
	<th>Status</th>
	<th>Added</th>
	<th>Actions</th>

@stop

@section('tbody')
	
	@foreach($comments as $comment)

		<tr>
				
			<td>{{$comment->id}}</td>
			<td>{{$comment->post->title}}</td>
			<td>{{str_limit($comment->content, 30)}}</td>
			<td>{{$comment->adminpresent()->parent}}</td>
			<td>{{$comment->authorable->username}}</td>
			<td>{{$comment->adminpresent()->status}}</td>
			<td>{{$comment->adminpresent()->created_at_human}}</td>
			<td>
				<!-- Split button -->
				<div class="btn-group">
				  <a type="button" href="{{ URL::route('admin.posts.show', array('id' => $comment->post->id)) }}" class="btn btn-info">View Post</a>
				  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="{{ URL::action('CommentsController@switchStatus', array('id' => $comment->id)) }}">SWitch Status</a></li>
				    <li><a href="#" class="commentReply" data-route="{{ URL::action('CommentsController@newReply') }}" data-comment="{{$comment->id}}" data-post="{{$comment->post->id}}">Reply</a></li>
				    <li class="divider"></li>
				    <li>{{ Form::open(array('route' => array('admin.comments.destroy', $comment->id), 'method' => 'delete')) }}<button type="submit" class="btn btn-outline btn-site btn-block deleteResource">Delete</button>{{ Form::close() }}</li>
				  </ul>
				</div>
			</td>

		</tr>

	@endforeach

@stop