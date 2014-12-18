@extends('layouts.default')
@section('content')

<div class="qa-main">
	{{$html}}
	<h1>My favorites</h1>
	<div class="qa-part-q-list">
					<h2>No favorite questions</h2>
					<div class="qa-q-list">
						
					</div> <!-- END qa-q-list -->
					
				</div>
	<div class="qa-part-ranking-users">
					<h2>Users</h2>
					<table class="qa-top-users-table">
						<tbody><tr>
							<td class="qa-top-users-label"><a class="qa-avatar-link" href="./index.php?qa=user&amp;qa_1=vikram123"><span style="display:inline-block; padding:0px 0px 0px 0px;"><img width="30" height="30" alt="" class="qa-avatar-image" src="./?qa=image&amp;qa_blobid=16670737886495608739&amp;qa_size=30"></span></a> <a class="qa-user-link qa-user-favorited" href="./index.php?qa=user&amp;qa_1=vikram123">{{Auth::user()->handle}}</a></td>
							<td class="qa-top-users-score">100</td>
						</tr>
					</tbody></table>
				</div>
				<div class="qa-part-ranking-tags">
					<h2>No favorite tags</h2>
				</div>
				<div class="qa-part-nav-list-categories">
					<h2>No favorite categories</h2>
					<ul class="qa-browse-cat-list qa-browse-cat-list-1">
					</ul>
				</div>
				<div class="qa-suggest-next">
					To add a question or other item to your favorites, click the <span class="qa-favorite-image">&nbsp;</span> at the top of its page.
				</div>
</div>

@stop
