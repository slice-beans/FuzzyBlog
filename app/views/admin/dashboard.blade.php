@extends('layouts.admin')

@section('title')
FuzzyBlog | Admin Dashboard
@stop

@section('adminmain')

<div class="row">
	<div class="col-md-4">
		<p>Posts Last 7 Days</p>
		<div class="col-md-11">
			<canvas 
				id="postsChart"
				data-labels="{{ implode(',', array_reverse(array_keys($weekbyposts))) }}"
				data-chartdata="{{ implode(',', array_reverse(array_values($weekbyposts))) }}"
				data-type="Radar"
				class="dashboardChart"
			></canvas>
		</div>
	</div>
	<div class="col-md-4">
		<p>Comments Last 7 Days</p>
		<div class="col-md-11">
			<canvas 
				id="commentsChart"
				data-labels="{{ implode(',', array_reverse(array_keys($weekbycomments))) }}"
				data-chartdata="{{ implode(',', array_reverse(array_values($weekbycomments))) }}"
				data-type="Radar"
				class="dashboardChart"
			></canvas>
		</div>
	</div>
	<div class="col-md-4">
		<p>Most Commented Posts</p>
		<div class="col-md-11">
			<canvas 
				id="mostCommented"
				data-labels="{{ implode(',', array_keys($topcommented)) }}"
				data-chartdata="{{ implode(',', array_values($topcommented)) }}"
				data-type="Radar"
				class="dashboardChart"
			 ></canvas>
		</div>
	</div>
</div>

@stop