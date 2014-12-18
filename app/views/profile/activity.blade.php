@extends('layouts.default')
@section('content')

<div class="qa-main">
	{{$html}}

	<h1>No posts by {{Auth::user()->handle}}</h1>
	<div class="qa-part-q-list">
					<form action="./index.php?qa=user&amp;qa_1=vikram123&amp;qa_2=activity" method="post">
						<div class="qa-q-list">
							
						</div> <!-- END qa-q-list -->
						
						<div class="qa-q-list-form">
							<input type="hidden" value="1-1417771809-4e9c6cd32f07d1c1400433b13f6ac7deda094b59" name="code">
						</div>
					</form>
				</div>
</div>

@stop
