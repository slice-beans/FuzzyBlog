<div class="imgbg" style="background:url({{ URL::asset('img/thumbs/'.$post->thumbnail) }});">
	<div class="col-md-4">
		<h1 class="posttitle">{{$post->title}}</h1>
		<img class="img-thumbnail" src="{{ URL::asset('img/thumbs/'.$post->thumbnail) }}">
	</div>
</div>