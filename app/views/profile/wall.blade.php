@extends('layouts.default')
@section('content')

<div class="qa-main">
	{{$html}}	
	<h1>Wall for {{Auth::user()->handle}}</h1>
	<div class="qa-part-message-list">
					<div class="qa-error">
						Please <a href="./index.php?qa=confirm">confirm your email address</a> to post on this wall.
					</div>
					<form action="./index.php?qa=user&amp;qa_1=vikram123&amp;qa_2=wall" method="post" name="wallpost">
						<div class="qa-message-list-form">
							<input type="hidden" value="" name="qa_click">
							<input type="hidden" value="vikram123" name="handle">
							<input type="hidden" value="0" name="start">
							<input type="hidden" value="1-1417771383-5a5d5a7e686644784e89293a7f4e3cafac7297c0" name="code">
						</div>
						<div id="wallmessages" class="qa-message-list">
						</div> <!-- END qa-message-list -->
						
					</form>
				</div>
</div>

@stop
