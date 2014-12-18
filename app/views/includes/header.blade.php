<div class="qa-header">
@if(Auth::check())
	{{Navigation::header(Auth::user()->handle)}}
@elseif(isset($handle))
	{{Navigation::header($handle)}}
@else
	{{Navigation::header(null)}}
@endif

</div>
{{Navigation::sidepanel()}}

