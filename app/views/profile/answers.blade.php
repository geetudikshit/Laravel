@extends('layouts.default')
@section('content')

<div class="qa-main">
	{{$html}}

	<h1>No answers by {{Auth::user()->handle}}</h1>
</div>

@stop
