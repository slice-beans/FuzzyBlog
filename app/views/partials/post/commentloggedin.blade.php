<p>You are logged in as {{\Auth::user()->username}}, not you? Then <a href="{{URL::to('/logout')}}">logout!</a></p>

{{ Form::open(array('action' => array('CommentsController@publicStoreNew', $post->id), 'class' => 'form-horizontal')) }}

	{{ Form::token() }}

	<div class="control-group">

		{{ Form::label('content', 'Content', array('class' => 'control-label')) }}

		{{ Form::textarea('content', Input::old('content'), array('class' => 'form-control'))}}

		<button type="submit" class="btn btn-lg btn-block btn-outline btn-site">Submit Comment</button>

	</div>

{{ Form::close() }}