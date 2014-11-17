{{ $post->publicpresent()->cat_thumbnail }}

<div class="title"><h2><a href="{{URL::to('/'.$post->slug)}}">{{$post->title}}</a></h2></div>

<div class="snippet">
	<p>{{$post->publicpresent()->snippet}}</p>
</div>

<div class="postmeta">
	<p class="pull-left"><i class="fa fa-tag"></i> <a href="/category/{{$post->category->slug}}">{{$post->category->name}}</a></p>
	<p class="pull-right" style="margin:0 10px;"><i class="fa fa-user"></i> {{$post->author->username}}</p>
	<p class="pull-right"><i class="fa fa-calendar"></i> {{$post->publicpresent()->created_at_human}}</p>
</div>