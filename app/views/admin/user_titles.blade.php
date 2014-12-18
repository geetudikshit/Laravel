@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1>Administration center - Users</h1>
	<div class="qa-part-form">
		{{ Form::model($usertitles, ['url' => 'admin/doUsertitles', 'method' => 'post']) }}
			<table class="qa-form-tall-table">
				<tbody>
				@if(Session::get('success'))
				<tr>
					<td class="qa-form-wide-ok" colspan="3">
						{{Session::get('success')}}
					</td>
				</tr>
				@endif
				<tr>
					<td class="qa-form-tall-label">
						User title - HTML allowed:
					</td>
				</tr>
				<tr>
					<td class="qa-form-tall-data">
						<!--<input type="text" class="qa-form-tall-text" value="" id="title" name="title">-->
						{{ Form::text('title', Input::old('title'),array('class'=>'qa-form-tall-text')) }}
						@if ($errors->has('title')) <div class="qa-form-tall-error">{{ $errors->first('title') }}</div> @endif
					</td>
				</tr>
				</tbody><tbody id="points_display">
					<tr>
						<td class="qa-form-tall-label">							
							{{ Form::label('Points_required_to_receive_title','Points required to receive title:') }}
							&nbsp;
							<!--<input type="text" class="qa-form-tall-number" value="" name="points">-->
							{{ Form::text('points', Input::old('points'),array('class'=>'qa-form-tall-number')) }}
							@if ($errors->has('points')) <div class="qa-form-tall-error">{{ $errors->first('points') }}</div> @endif
						</td>
					</tr>
				</tbody>
				<tbody><tr>
					<td class="qa-form-tall-buttons" colspan="1">
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Add Title">
						<input type="submit" class="qa-form-tall-button qa-form-tall-button-cancel" title="" value="Cancel" name="docancel">-->
						{{ Form::submit('Add Title', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
						{{ Form::submit('Cancel', array('class' => 'qa-form-tall-button qa-form-tall-button-cancel','name'=>'docancel')) }}
					</td>
				</tr>
			</tbody>
		</table>
			
		{{ Form::close() }}
	</div>
</div>
@stop
