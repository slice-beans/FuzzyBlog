
{{ Form::open(array('action' => array('CommentsController@publicStoreNew', $post->id), 'class' => 'form-horizontal row')) }}

	{{ Form::token() }}

	<div class="control-group col-md-6">

		{{ Form::label('comment-name', 'Name:', array('class' => 'control-label')) }}

		{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'id' => 'comment-name'))}}

	</div>

	<div class="control-group col-md-6">

		{{ Form::label('comment-email', 'Email:', array('class' => 'control-label')) }}

		{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'id' => 'comment-email'))}}

	</div>

	<div class="control-group col-md-12">

		{{ Form::label('content', 'Content', array('class' => 'control-label')) }}

		{{ Form::textarea('content', Input::old('content'), array('class' => 'form-control'))}}

		<button type="submit" class="btn btn-lg btn-block btn-outline btn-site">Submit Comment</button>

	</div>

{{ Form::close() }}