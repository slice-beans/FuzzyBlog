	@extends('layouts.adminentitylist')

@section('title')
FuzzyBlog | Posts
@stop

@section('thead')

	<th>ID</th>
	<th>Title</th>
	<th>Slug</th>
	<th>Snippet</th>
	<th>Thumbnail</th>
	<th>Author</th>
	<th>Category</th>
	<th>Post Status</th>
	<th>Created</th>
	<th>Actions</th>

@stop

@section('tbody')

	@foreach($posts as $post)

		<tr>
			<td>{{$post->id}}</td>
			<td>{{$post->title}}</td>
			<td>{{$post->slug}}</td>
			<td>{{$post->adminpresent()->snippet}}</td>
			<td>{{$post->adminpresent()->thumbnail}}</td>
			<td>{{$post->author->username}}</td>
			<td>{{$post->category->name}}</td>
			<td>{{$post->adminpresent()->status}}</td>
			<td>{{$post->adminpresent()->created_at_human}}</td>
			<td>
				<!-- Split button -->
				<div class="btn-group">
				  <a type="button" href="{{ URL::to('/admin/posts/'.$post->id.'/edit/') }}" class="btn btn-info">Edit</a>
				  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="{{ URL::action('PostsController@show', array('id' => $post->id)) }}" target="_blank">View</a></li>
				    <li><a href="{{ URL::action('PostsController@switchStatus', array('id' => $post->id)) }}">Switch Status</a></li>
				    <li><a href="#" class="addNewComment" data-post="{{$post->id}}" data-route="{{URL::route('admin.comments.store')}}">Add New Comment</a></li>
				    <li class="divider"></li>
				    <li>{{ Form::open(array('route' => array('admin.posts.destroy', $post->id), 'method' => 'delete')) }}<button type="submit" class="btn btn-outline btn-site btn-block deleteResource">Delete</button>{{ Form::close() }}</li>
				  </ul>
				</div>
			</td>
		</tr>

	@endforeach

@stop