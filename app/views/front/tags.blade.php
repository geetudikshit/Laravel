@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1> Most popular tags  </h1>
	<div class="qa-part-q-list">
		<form action="index.php" method="post">
			<div class="qa-q-list">

				<!--Div starts for tags-->
				<div class="qa-part-ranking">
					<table class="qa-top-tags-table">
						<tbody>
						@foreach($data as $record)
						<tr>
							<td class="qa-top-tags-count">{{{$record['tagcount']}}} ×</td>
							<td class="qa-top-tags-label"><a class="qa-tag-link" href="./index.php?qa=tag&amp;qa_1=first-second-third">{{{$record['tags']}}}</a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>	
				<!--Div end for tags-->
				
				<div class="qa-suggest-next">
					Help get things started by <a href="./index.php?qa=ask">asking a question</a>.
				</div>
			</div>
		</form>
	</div>
</div>
@stop
