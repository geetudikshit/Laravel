@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1>Administration center - General  </h1>
	<div class="qa-part-form">
		@if(isset($general))
		{{ Form::model($general, ['url' => '/admin/doGeneral', 'method' => 'post']) }}
		<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=general" method="post">-->
			<table class="qa-form-tall-table">
				<tbody id="site_title">
					{{ $success = Session::get('success') }}
					@if($success)
					<tr>
						<td class="qa-form-wide-ok" colspan="3">
							Profile saved
						</td>
					</tr>
					@endif
					<tr>
						<td class="qa-form-tall-label">
							<!--Q&amp;A site name:-->
							{{ Form::label('Q_A_site_name:', 'Q&amp;A site name:') }}
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="Localhost Q&amp;A" id="option_site_title" name="option_site_title">-->
							{{ Form::text('option_site_title', Input::old('option_site_title'),array('class'=>'qa-form-tall-text','id' => 'option_site_title')) }}
							@if ($errors->has('option_site_title')) <div class="qa-form-tall-error">{{ $errors->first('option_site_title') }}</div> @endif
						</td>
					</tr>
				</tbody>
				<tbody id="site_url">
					<tr>
						<td class="qa-form-tall-label">
							<!--Preferred site URL:-->
							{{ Form::label('Q_A_site_name:', 'Preferred site URL:') }}
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="http://localhost/Petric/question2answer/" id="option_site_url" name="option_site_url">-->
							{{ Form::text('option_site_url', Input::old('option_site_url'),array('class'=>'qa-form-tall-text','id' => 'option_site_url')) }}
							@if ($errors->has('option_site_url')) <div class="qa-form-tall-error">{{ $errors->first('option_site_url') }}</div> @endif
						</td>
					</tr>
				</tbody>			
				
				
				<tbody><tr>
					<td class="qa-form-tall-buttons" colspan="1">
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Save Options" id="dosaveoptions">-->
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-reset" title="" value="Reset to Defaults" name="doresetoptions">-->
						{{ Form::submit('Save Options', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
						{{ Form::submit('Reset to Defaults', array('class' => 'qa-form-tall-button qa-form-tall-button-reset','id' => 'doshowdefaults','name'=>'doresetoptions')) }}
					</td>
				</tr>
			</tbody></table>						
		{{ Form::close() }}
		@endif
	</div>
</div>
@stop
