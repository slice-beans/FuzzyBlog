@extends('layouts.admin')

@section('adminmain')

	@if(Session::get('confirmation'))
		<div class="alert alert-success">{{Session::get('confirmation')}}</div>
	@endif
	
	<table id="entityDT" class="table table-striped table-hover">

		<thead>
			<tr>
			@yield('thead')
			</tr>
		</thead>

		<tbody>

			@yield('tbody')

		</tbody>

	</table>

	

@stop