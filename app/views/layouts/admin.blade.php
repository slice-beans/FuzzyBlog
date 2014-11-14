@extends('layouts.master')

@section('bodyclass')
admin
@stop

@section('main')

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="#">{{ HTML::image('/img/logo.png') }}</a>
		</div>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 col-md-2 sidebar">
			<div class="inner">
				<h2 class="title">Navigation</h2>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="{{ URL::route('admin') }}"><i class="fa fa-home"></i> Dashboard</a></li>
					<li class="nav-parent">
						<a href="#"><i class="fa fa-tags"></i> Categories <i class="fa fa-plus pull-right"></i></a>
						<ul class="children">
							<li><a href="{{ URL::action('CategoriesController@index') }}"><i class="fa fa-list"></i> View All</a></li>
							<li><a href="{{ URL::action('CategoriesController@create') }}"><i class="fa fa-tag"></i> Add New</a></li>
						</ul>
					</li>
					<li class="nav-parent">
						<a href="#"><i class="fa fa-book"></i> Posts <i class="fa fa-plus pull-right"></i></a>
						<ul class="children">
							<li><a href="{{ URL::action('PostsController@index') }}"><i class="fa fa-list"></i> View All</a></li>
							<li><a href="{{ URL::action('PostsController@create') }}"><i class="fa fa-pencil"></i> Add New</a></li>
						</ul>
					</li>
					<li class="nav-parent">
						<a href="#"><i class="fa fa-comments"></i> Comments <i class="fa fa-plus pull-right"></i></a>
						<ul class="children">
							<li><a href="{{ URL::action('PostsController@index') }}"><i class="fa fa-list"></i> View All</a></li>
						</ul>
					</li>			
				</ul>
			</div>
		</div>

		<div class="col-sm-8 col-md-10 main">
			<div class="inner">
				@include('partials.adminerror')
				@yield('adminmain')
			</div>
		</div>
	</div>
</div>

@stop