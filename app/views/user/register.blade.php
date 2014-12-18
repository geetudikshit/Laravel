@extends('layouts.default')
@section('content')

<div class="qa-main">

<h1> Register as a new user  </h1>
<div class="qa-part-form">
	{{ Form::open(array('url' => 'doRegister')) }}

	<table class="qa-form-tall-table">
		<tr><td class="qa-form-tall-label">Username:</td></tr>
		<tr>
			<td class="qa-form-tall-data">
				{{ Form::text('handle', Input::old('handle'), array('placeholder' => 'Handle','class'=>'qa-form-tall-text')) }}
				@if ($errors->has('handle')) <div class="qa-form-tall-error">{{ $errors->first('handle') }}</div> @endif
			</td>
		</tr>
		<tr><td class="qa-form-tall-label">Password:</td></tr>
		<tr>
			<td class="qa-form-tall-data">
				{{ Form::password('password',array('placeholder' => 'Password','class'=>'qa-form-tall-text')) }}
				@if ($errors->has('password')) <div class="qa-form-tall-error">{{ $errors->first('password') }}</div> @endif
			</td>
		</tr>
		<tr><td class="qa-form-tall-label">Email:</td></tr>
		<tr>
			<td class="qa-form-tall-data">
				{{ Form::text('email', Input::old('email'), array('placeholder' => 'Email','class'=>'qa-form-tall-text')) }}
				@if ($errors->has('email')) <div class="qa-form-tall-error">{{ $errors->first('email') }}</div> @endif
				<div class="qa-form-tall-note">Privacy: Your email address will not be shared or sold to third parties.</div>
			</td>
		</tr>
		<tr><td class="qa-form-tall-buttons"><input class="qa-form-tall-button qa-form-tall-button-login" type="submit" value="Register"/></td></tr>
	</table>

	{{ Form::close() }}
</div>
</div>
@stop