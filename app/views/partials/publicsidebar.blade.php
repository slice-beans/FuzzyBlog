<h2>Categories</h2>

<ul class="sidebarcats nav nav-pills nav-stacked">
	
	@foreach($sidebar as $sidecat)
	
		<li role="presentation"><a href="/category/{{$sidecat->slug}}">{{$sidecat->name}}</a></li>

	@endforeach

</ul>

<h2>Archives</h2>

<ul class="sidebarcats nav nav-pills nav-stacked">
	
	@foreach($archives as $archive)

		<li role="presentation"><a href="{{$archive['slug']}}">{{$archive['text']}}</a></li>

	@endforeach

</ul>

<h2>Latest</h2>

<ul class="sidebarcats nav nav-pills nav-stacked">

		<li role="presentation"><a href="/{{$latest->slug}}">{{$latest->title}}</a></li>

</ul>
