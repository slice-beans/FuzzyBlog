@extends('layouts.master')

@section('title')
FuzzyBlog | Welcome to FuzzyBlog
@stop

@section('bodyclass')
public
@stop

@section('main')
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
	        <a class="navbar-brand" href="{{URL::to('/')}}">{{ HTML::image('/img/logo.png') }}</a> <p class="siteTitle">{{ $site->site_title }}</p>
		</div>
		<div class="col-md-3 col-xs-12 pull-right">
			<a href="{{ URL::to('/login') }}" class="btn btn-site btn-outline btn-block" style="margin:8px 0;">Login to your account</a>
		</div>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-10">
			<div class="inner">
				@yield('publicmain')
			</div>
		</div>
		<div class="col-md-2 sidebar">
			<div class="inner">
				@yield('publicsidebar', \View::make('partials.publicsidebar'))
			</div>
		</div>
	</div>
</div>
@stop