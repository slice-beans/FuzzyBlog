@extends('layouts.adminentitylist')

@section('title')
FuzzyBlog | Categories
@stop

@section('thead')

	<th>ID</th>
	<th>Name</th>
	<th>Slug</th>
	<th>Created</th>
	<th>Actions

@stop

@section('tbody')

	@foreach($categories as $cat)

		<tr>
			<td>{{$cat->id}}</td>
			<td>{{$cat->adminpresent()->name}}</td>
			<td>{{$cat->slug}}</td>
			<td>{{$cat->adminpresent()->created_at_human}}</td>
			<td>
				<!-- Split button -->
				<div class="btn-group">
				  <a type="button" href="{{ URL::to('/admin/categories/'.$cat->id.'/edit/') }}" class="btn btn-info">Edit</a>
				  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    <li class="divider"></li>
				    <li>{{ Form::open(array('route' => array('admin.categories.destroy', $cat->id), 'method' => 'delete')) }}<button type="submit" class="btn btn-outline btn-site btn-block deleteResource">Delete</button>{{ Form::close() }}</li>
				  </ul>
				</div>
			</td>
		</tr>

	@endforeach

@stop