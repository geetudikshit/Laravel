@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1>Administration center - Users</h1>
	<div class="qa-part-form">					
					{{ Form::model($userfield, ['url' => 'admin/doUserfields', 'method' => 'post']) }}
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
									{{ Form::label('Field_name','Field name:') }}
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-data">
									<!--<input type="text" class="qa-form-tall-text" value="" id="name" name="name">-->
									{{ Form::text('name', Input::old('name'),array('class'=>'qa-form-tall-text')) }}
									@if ($errors->has('name')) <div class="qa-form-tall-error">{{ $errors->first('name') }}</div> @endif
									
									{{ Form::hidden('fieldid', Input::old('fieldid')) }}
								</td>
							</tr>
							</tbody><tbody id="type_display">
								<tr>
									<td class="qa-form-tall-label">
										{{ Form::label('Content_type','Content type:') }}
										&nbsp;
										<!--<select class="qa-form-tall-select" name="type">
											<option selected="" value="0">Single line of text</option>
											<option value="1">Multiple lines of text</option>
											<option value="2">Linked URL</option>
										</select>-->
										{{ Form::select('type', [ 0 => 'Single line of text', 1 => 'Multiple lines of text' ,2 => 'Linked URL'], null, ['class' => 'qa-form-tall-select']) }}
									</td>
								</tr>
							</tbody>
							<tbody id="permit_display">
								<tr>
									<td class="qa-form-tall-label">
										{{ Form::label('Visible_for','Visible for:') }}
										&nbsp;
										<!--<select class="qa-form-tall-select" name="permit">
											<option value="150">Anybody</option>
											<option value="120">Registered users</option>
											<option value="100">Experts, Editors, Moderators, Admins</option>
											<option value="70">Editors, Moderators, Admins</option>
											<option value="40">Moderators and Admins</option>
											<option value="20">Administrators</option></select>-->
											{{ Form::select('permit', [ 150 => 'Anybody', 120 => 'Registered users' ,100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins',20 => 'Administrators'], null, ['class' => 'qa-form-tall-select']) }}
										
									</td>
								</tr>
							</tbody>
							<tbody id="position_display">
								<tr>
									<td class="qa-form-tall-label">
										{{ Form::label('Position','Position:') }}
										&nbsp;
										<!--<select class="qa-form-tall-select" name="position">
											<option value="1">First</option>
											<option value="2">After "Full name"</option>
											<option value="3">After "Location"</option>
											<option value="4">After "Website"</option>
											<option selected="" value="5">After "About"</option>
										</select>-->
										{{ Form::select('position',$position, null, ['class' => 'qa-form-tall-select']) }}
									</td>
								</tr>
							</tbody>
							<tbody id="register_display">
								<tr>
									<td class="qa-form-tall-label">
										<label>
											<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" name="onregister">-->
											{{ Form::checkbox('onregister', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_do_close_on_select']) }}
											Show field on user registration form
										</label>
									</td>
								</tr>
							</tbody>
							<tbody><tr>
								<td class="qa-form-tall-buttons" colspan="1">

									<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Add Field">
									<input type="submit" class="qa-form-tall-button qa-form-tall-button-cancel" title="" value="Cancel" name="docancel">-->
									{{ Form::submit('Add Field', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
						{{ Form::submit('Cancel', array('class' => 'qa-form-tall-button qa-form-tall-button-cancel','name'=>'docancel')) }}
								</td>
							</tr>
						</tbody></table>						
					{{ Form::close() }}
		
				</div>
</div>
@stop
