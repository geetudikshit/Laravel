@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1> Ask a question </h1>
	<div class="qa-part-form">
		{{ Form::open(array('url' => 'doEdit')) }}
                {{ Form::hidden('postid',$data['postid'])}}
			<table class="qa-form-tall-table">
				<tbody>
				
					<tr><td class="qa-form-tall-label">The question in one sentence:</td></tr>
					<tr>
						<td class="qa-form-tall-data">
							{{ Form::text('title',$data['title'], array('placeholder' => 'Title','class'=>'qa-form-tall-text')) }}
							@if ($errors->has('title')) <div class="qa-form-tall-error">{{ $errors->first('title') }}</div> @endif
						</td>
					</tr>
					<tr><td class="qa-form-tall-label"> More information for the question: </td></tr>
					<tr>
						<td class="qa-form-tall-data">
							{{ Form::textarea('content', $data['content'], array('placeholder' => 'Content','class'=>'qa-form-tall-text')) }}
							@if ($errors->has('content')) <div class="qa-form-tall-error">{{ $errors->first('content') }}</div> @endif
						</td>
					</tr>
					<tr><td class="qa-form-tall-label"> Tags - use hyphens to combine words: </td></tr>
					<tr>
						<td class="qa-form-tall-data">
							{{ Form::text('tags', $data['tags'], array('placeholder' => 'tags','class'=>'qa-form-tall-text')) }}
							@if ($errors->has('tags')) <div class="qa-form-tall-error">{{ $errors->first('tags') }}</div> @endif
						</td>
					</tr>
					<tr><td class="qa-form-tall-label"> Your name to display (optional):</td></tr>
					<tr>
						<td class="qa-form-tall-data">
							{{ Form::text('name', $data['name'], array('placeholder' => 'name','class'=>'qa-form-tall-text')) }}
							@if ($errors->has('name')) <div class="qa-form-tall-error">{{ $errors->first('name') }}</div> @endif
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-label">
							<label>
								<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" onclick="if (document.getElementById(\'notify\').checked) document.getElementById(\'email\').focus();" id="notify" name="notify">
								<span id="email_shown" style="">Email me at this address if my question is answered or commented on:</span>
								<span style="display: none;" id="email_hidden">Email me if my question is answered or commented on</span>
							</label>
						</td>
					</tr>
				</tbody>
				<tbody id="email_display" style="display: table-row-group;">
					<tr>
						<td class="qa-form-tall-data">
							<input type="text" class="qa-form-tall-text" value="" id="email" name="email">
							<div class="qa-form-tall-note">Privacy: Your email address will only be used for sending these notifications.</div>
						</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td class="qa-form-tall-buttons">
							<input class="qa-form-tall-button qa-form-tall-button-login" type="submit" value="Ask the Question"/>
						</td>
					</tr>
				</tbody>
			</table>
		{{ Form::close() }}
	</div>
</div>

@stop
