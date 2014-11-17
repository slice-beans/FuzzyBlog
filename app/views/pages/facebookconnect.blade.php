@extends('layouts.admin')

@section('adminmain')

@if(\Session::get('confirmation'))
	
	<div class="alert alert-success">{{\Session::get('confirmation')}}</div>

@endif

<p>Connect your blog to Facebook to update your timeline with your blog posts</p>

<a href="{{$login}}" class="btn-facebook btn"><i class="fa fa-facebook-square"></i> Connect to Facebook</a>

@stop

