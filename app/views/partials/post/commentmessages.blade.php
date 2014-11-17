@if(Session::get('errors'))
	
	<div class="alert alert-danger">
	
		@foreach(Session::get('errors')->all() as $error)
		
			{{$error}}<br>

		@endforeach
	
	</div>

@endif

@if(Session::get('confirmation'))

	<div class="alert alert-success">

		{{Session::get('confirmation')}}

	</div>
	
@endif