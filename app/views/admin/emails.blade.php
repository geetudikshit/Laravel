@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Emails  </h1>
	<div class="qa-part-form">
		@if(isset($email))
		{{ Form::model($email, ['url' => 'admin/doEmails', 'method' => 'post']) }}
		<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=emails" method="post">-->
			<table class="qa-form-tall-table">
				<tbody id="from_email">					
					@if(Session::get('success'))
					<tr>
						<td class="qa-form-wide-ok" colspan="3">
							{{Session::get('success')}}
						</td>
					</tr>
					@endif
					<tr>
						<td class="qa-form-tall-label">
							<!--Sender address for messages from site:-->
           					{{ Form::label('Sender_address_for_messages_from_site','Sender address for messages from site:') }}
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="no-reply@example.com" id="option_from_email" name="option_from_email">-->
                         {{ Form::text('option_from_email', Input::old('option_from_email'),array('class'=>'qa-form-tall-text')) }}@if ($errors->has('option_from_email')) <div class="qa-form-tall-error">{{ $errors->first('option_from_email') }}</div> @endif
						</td>
					</tr>
				</tbody>
				<tbody id="feedback_email">
					<tr>
						<td class="qa-form-tall-label">
							<!--Email address for admin messages - not shown to users:-->
           					{{ Form::label('Email_address_for_admin_messages_-_not_shown_to_users','Email address for admin messages - not shown to users:') }}
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="geetudikshit@gmail.com" id="option_feedback_email" name="option_feedback_email">-->
                             {{ Form::text('option_feedback_email', Input::old('option_feedback_email'),array('class'=>'qa-form-tall-text')) }}@if ($errors->has('option_feedback_email')) <div class="qa-form-tall-error">{{ $errors->first('option_feedback_email') }}</div> @endif
						</td>
					</tr>
				</tbody>						
				<tbody><tr>
					<td class="qa-form-tall-buttons" colspan="1">
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Save Options" id="dosaveoptions">-->
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-reset" title="" value="Reset to Defaults" name="doresetoptions">-->
                        {{ Form::submit('Save Options', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
						{{ Form::submit('Reset to Defaults', array('class' => 'qa-form-tall-button qa-form-tall-button-reset','name'=>'doresetoptions')) }}
					</td>
				</tr>
			</tbody></table>
			{{ Form::close() }}
		@endif
	</div>
</div>
@stop
