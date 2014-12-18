@extends('layouts.default')
@section('content')

<div class="qa-main">

@if (Session::has('message'))
 <div class="error">{{ Session::get('message') }}</div>
@endif

<h1>Log in </h1>
<div class="qa-part-form">
{{ Form::open(array('url' => 'doLogin')) }}
<table class="qa-form-tall-table">
	<tbody>
	@if(Session::get('error'))
		<tr>
			<td class="qa-form-wide-error" colspan="3">
				{{Session::get('error')}}
			</td>
		</tr>
	@endif
		<tr><td class="qa-form-tall-label">{{$label}}</td></tr>
		<tr>
			<td class="qa-form-tall-data">
				{{ Form::text('emailhandle', Input::old('emailhandle'), array('placeholder' => 'Username','class'=>'qa-form-tall-text')) }}
				@if ($errors->has('emailhandle')) <div class="qa-form-tall-error">{{ $errors->first('emailhandle') }}</div> @endif
			</td>
		</tr>
		<tr>
			<td class="qa-form-tall-label">Password:</td>
		</tr>
		<tr>
			<td class="qa-form-tall-data">
				{{ Form::password('password',array('placeholder' => 'Password','class'=>'qa-form-tall-text')) }}
				@if ($errors->has('password')) <div class="qa-form-tall-error">{{ $errors->first('password') }}</div> @endif
			</td>
		</tr>
		<tr>
			<td class="qa-form-tall-label">
				<label>
				<input class="qa-form-tall-checkbox" type="checkbox" name="remember" id="remember"/>Remember me on this computer
				</label>
			</td>
		</tr>
		<tr><td class="qa-form-tall-buttons"><input class="qa-form-tall-button qa-form-tall-button-login" type="submit" value="Log In"/></td></tr>

	</tbody>
</table>

{{ Form::close() }}
</div>


</div>

@stop