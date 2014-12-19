@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1>
		Browse categories
	</h1>
	<div class="qa-part-nav-list">
		<ul class="qa-browse-cat-list qa-browse-cat-list-1">
		@foreach ($categories as $key => $categorie)
			<li class="qa-browse-cat-item qa-browse-cat-first-category">
				<span title="this is my first category" class="qa-browse-cat-nolink">{{$categorie->title}}</span>
				<span class="qa-browse-cat-note"> - {{$categorie->qcount}} questions - {{$categorie->content}}</span>
			</li>
		@endforeach
		</ul>
	</div>
</div>
@stop
