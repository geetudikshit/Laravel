@extends('layouts.default')
@section('content')

<div class="qa-main">

<h1>My Account</h1> 
<div class="qa-part-form-profile">
	@if(isset($user))
		    {{ Form::model($user, ['url' => 'doAccount', 'method' => 'post']) }}
			<table class="qa-form-wide-table">
				<tbody>
				{{ $success = Session::get('success') }}
				@if($success)
				<tr>
					<td class="qa-form-wide-ok" colspan="3">
						Profile saved
					</td>
				</tr>
				@endif
				<tr>
					<td class="qa-form-wide-label">
						{{ Form::label('member_for', 'Member for:') }}
					</td>
					<td class="qa-form-wide-data">
						<span class="qa-form-wide-static">{{$time_str}}</span>
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-label">
						{{ Form::label('type', 'Type:') }}
					</td>
					<td class="qa-form-wide-data">
						<span class="qa-form-wide-static">{{$level}}</span>
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-label">
						{{ Form::label('username', 'Username:') }}
					</td>
					<td class="qa-form-wide-data">						
						{{ Form::text('handle', Input::old('handle'),array('placeholder' => 'User Name','class'=>'qa-form-wide-text')) }}
						@if ($errors->has('handle')) <div class="qa-form-tall-error">{{ $errors->first('handle') }}</div> @endif
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-label">
						{{ Form::label('email', 'Email:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-text" value="" name="email">-->
						{{ Form::text('email', Input::old('email'),array('placeholder' => 'Email','class'=>'qa-form-wide-text')) }}
						@if ($errors->has('email')) <div class="qa-form-tall-error">{{ $errors->first('email') }}</div> @endif
						<span class="qa-form-wide-error">Please <a href="./index.php?qa=confirm">confirm</a></span>
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-label">
						{{ Form::label('message', 'Private messages:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" name="messages">-->
						{{Form::checkbox('messages', '1', $message,['class' => 'qa-form-wide-checkbox'])}}
						<span class="qa-form-wide-note">Allow users to email you (without seeing your address)</span>
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-label">
						{{ Form::label('wall', 'Wall posts:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" name="wall">-->
						{{Form::checkbox('wall', '1', $wall,['class' => 'qa-form-wide-checkbox'])}}
						<span class="qa-form-wide-note">Allow users to post on your wall (you will also be emailed)</span>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top;" class="qa-form-wide-label">
						{{ Form::label('avatar', 'Avatar:') }}
					</td>
					<td class="qa-form-wide-data">
						<input type="radio" class="qa-form-wide-radio" value="" name="avatar"> None
						<br>
						<input type="radio" class="qa-form-wide-radio" value="gravatar" name="avatar"> <span style="margin:2px 0; display:inline-block;"><img width="32" height="32" alt="" class="qa-avatar-image" src="http://www.gravatar.com/avatar/5430cce2386123f3690c3263ae13d429?s=32"> Show my <a target="_blank" href="http://www.gravatar.com/">Gravatar</a></span>
						<br>
						<input type="radio" class="qa-form-wide-radio" checked="" value="uploaded" name="avatar"> <span style="margin:2px 0; display:inline-block;"><img width="32" height="32" alt="" class="qa-avatar-image" src="./?qa=image&amp;qa_blobid=16670737886495608739&amp;qa_size=32"></span><input type="file" name="file">
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							{{ Form::label('fullname', 'Full name:') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-text" value="" name="field_1">-->
							{{ Form::text('field_1', Input::old('field_1'),array('placeholder' => 'Full Name','class'=>'qa-form-wide-text')) }}
							@if ($errors->has('field_1')) <div class="qa-form-tall-error">{{ $errors->first('field_1') }}</div> @endif
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							Location:
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-text" value="" name="field_2">-->
							{{ Form::text('field_2', Input::old('field_2'),array('placeholder' => 'Full Name','class'=>'qa-form-wide-text')) }}
							@if ($errors->has('field_2')) <div class="qa-form-tall-error">{{ $errors->first('field_2') }}</div> @endif
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							Website:
						</td>
						<td class="qa-form-wide-data">
							{{ Form::text('field_3', Input::old('field_3'),array('placeholder' => 'Full Name','class'=>'qa-form-wide-text')) }}
							@if ($errors->has('field_3')) <div class="qa-form-tall-error">{{ $errors->first('field_3') }}</div> @endif
							<!--<input type="text" class="qa-form-wide-text" value="" name="field_3">-->
						</td>
					</tr>
					<tr>
						<td style="vertical-align:top;" class="qa-form-wide-label">
							About:
						</td>
						<td class="qa-form-wide-data">							
							<textarea class="qa-form-wide-text" cols="40" rows="8" name="field_4"></textarea>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-buttons" colspan="3">
							<input type="submit" class="qa-form-wide-button qa-form-wide-button-save" title="" value="Save Profile" onclick="qa_show_waiting_after(this, false);">
						</td>
					</tr>
				</tbody></table>
				<input type="hidden" value="1" name="dosaveprofile">
				<input type="hidden" value="1-1417770574-ff2fe6ef7c7843376151ac63e53c8f434485251a" name="code">
			{{ Form::close() }}
		@endif
					</div>
					<div class="qa-part-form-password">
						<h2>Change Password</h2>
						{{ Form::open(array('url' => 'doChangePassword')) }}
							<table class="qa-form-wide-table">
								<tbody><tr>
									<td class="qa-form-wide-label">
										Old password:
									</td>
									<td class="qa-form-wide-data">
									<!--	<input type="password" class="qa-form-wide-text" value="" name="oldpassword">-->
										{{ Form::password('oldpassword',array('class'=>'qa-form-wide-text')) }}
										@if ($errors->has('oldpassword')) <div class="qa-form-tall-error">{{ $errors->first('oldpassword') }}</div> @endif
									</td>
								</tr>
								<tr>
									<td class="qa-form-wide-label">
										New password:
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="password" class="qa-form-wide-text" value="" name="newpassword1">-->
										{{ Form::password('newpassword1',array('placeholder' => 'New Password','class'=>'qa-form-wide-text')) }}
										@if ($errors->has('newpassword1')) <div class="qa-form-tall-error">{{ $errors->first('newpassword1') }}</div> @endif
									</td>
								</tr>
								<tr>
									<td class="qa-form-wide-label">
										Retype new password:
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="password" class="qa-form-wide-text" value="" name="newpassword2">-->
										{{ Form::password('newpassword2',array('placeholder' => 'Retype Password','class'=>'qa-form-wide-text')) }}
										@if ($errors->has('newpassword2')) <div class="qa-form-tall-error">{{ $errors->first('newpassword2') }}</div> @endif
									</td>
								</tr>
								<tr>
									<td class="qa-form-wide-buttons" colspan="3">
										<input type="submit" class="qa-form-wide-button qa-form-wide-button-change" title="" value="Change Password">
									</td>
								</tr>
							</tbody></table>
							<input type="hidden" value="1" name="dochangepassword">
							<input type="hidden" value="1-1417770574-0e9a563429e631a833c70d03fdfa33d9ec12efe4" name="code">
						{{ Form::close() }}
					</div>
</div>

@stop
