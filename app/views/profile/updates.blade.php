@extends('layouts.default')
@section('content')

<div class="qa-main">
<h1>
	No recent updates
</h1>
<div class="qa-part-q-list">
	<form action="./updates" method="post">
		<div class="qa-q-list">
			
		</div> <!-- END qa-q-list -->
		
		<div class="qa-q-list-form">
			<input type="hidden" value="1-1418306319-1057ae8a0b4f18782e7a955c07fc9ad57e1a9ce6" name="code">
		</div>
	</form>
</div>
<div class="qa-suggest-next">
	For more updates, add items to <a href="./favorites">your favorites</a>.
</div>
</div>

@stop
