@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Users  </h1>
	<div class="qa-part-form">
					@if(isset($user))
					{{ Form::model($user, ['url' => 'admin/doUsers', 'method' => 'post']) }}
					<!--<form enctype="multipart/form-data" onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=users" method="post">-->
						<table class="qa-form-wide-table">
							<tbody id="show_notice_visitor">
							@if(Session::get('success'))
							<tr>
								<td class="qa-form-wide-ok" colspan="3">
									{{Session::get('success')}}
								</td>
							</tr>
							@endif
								<tr>
									<td colspan="3" class="qa-form-tall-label">
										<label>
											<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_show_notice_visitor" name="option_show_notice_visitor">-->
                                            {{ Form::checkbox('option_show_notice_visitor', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_notice_visitor']) }}
											<!--Notice at top for first time visitors - HTML allowed:-->
                      {{ Form::label('Notice_at_top_for_first_time_visitors_-_HTML_allowed', 'Notice at top for first time visitors - HTML allowed:') }}
										</label>
									</td>
								</tr>
							</tbody>
							<tbody id="notice_visitor" style="display: none;">
								<tr>
									<td colspan="3" class="qa-form-tall-data">
										<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_notice_visitor" name="option_notice_visitor"></textarea>-->
                                        {{ Form::textarea('option_notice_visitor', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_notice_visitor']) }}
									</td>
								</tr>
							</tbody>
							<tbody id="show_custom_register">
								<tr>
									<td colspan="3" class="qa-form-tall-label">
										<label>
											<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_show_custom_register" name="option_show_custom_register">-->
											{{ Form::checkbox('option_show_custom_register', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_custom_register']) }}
											<!--Custom message on register form - HTML allowed:-->
           {{ Form::label('Custom_message_on_register_form_-_HTML_allowed', 'Custom message on register form - HTML allowed:') }}
										</label>
									</td>
								</tr>
							</tbody>
							<tbody id="custom_register" style="display: none;">
								<tr>
									<td colspan="3" class="qa-form-tall-data">
										<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_custom_register" name="option_custom_register"></textarea>-->
										{{ Form::textarea('option_custom_register', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_custom_register']) }}
									</td>
								</tr>
							</tbody>
							<tbody id="show_notice_welcome">
								<tr>
									<td colspan="3" class="qa-form-tall-label">
										<label>
											<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_show_notice_welcome" name="option_show_notice_welcome">-->
                                       {{ Form::checkbox('option_show_notice_welcome', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_notice_welcome']) }} 
											<!--Notice at top for new registered users - HTML allowed:-->
                                        {{ Form::label('Notice_at_top_for_new_registered_users_-_HTML_allowed', 'Notice at top for new registered users - HTML allowed:') }}
										</label>
									</td>
								</tr>
							</tbody>
							<tbody id="notice_welcome" style="display: none;">
								<tr>
									<td colspan="3" class="qa-form-tall-data">
										<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_notice_welcome" name="option_notice_welcome"></textarea>-->
                                        {{ Form::textarea('option_notice_welcome', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_notice_welcome']) }}
									</td>
								</tr>
							</tbody>
							<tbody id="show_custom_welcome">
								<tr>
									<td colspan="3" class="qa-form-tall-label">
										<label>
											<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" id="option_show_custom_welcome" name="option_show_custom_welcome">-->
                                            {{ Form::checkbox('option_show_custom_welcome', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_custom_welcome']) }} 
											<!--Custom message in email sent to new registered users:-->
                                  {{ Form::label('Custom_message_in_email_sent_to_new_registered_users','Custom message in email sent to new registered users:') }}
										</label>
									</td>
								</tr>
							</tbody>
							<tbody id="custom_welcome">
								<tr>
									<td colspan="3" class="qa-form-tall-data">
									<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_custom_welcome" name="option_custom_welcome"></textarea>-->
                                         {{ Form::textarea('option_custom_welcome', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_custom_welcome']) }}
									</td>
								</tr>
							</tbody>
							<tbody><tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									
								</td>
							</tr>
							<tr id="allow_login_email_only">
								<td class="qa-form-wide-label">
									<!--Only log in by email address (not username):-->
           							{{ Form::label('Only_log_in_by_email_address_(not_username)','Only log in by email address (not username):') }}
           					   </td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_allow_login_email_only" name="option_allow_login_email_only">-->
                                     {{ Form::checkbox('option_allow_login_email_only', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_login_email_only']) }}
								</td>
							</tr>
							<tr id="allow_change_usernames">
								<td class="qa-form-wide-label">
									<!--Allow users with posts to change their username:-->
                           			{{ Form::label('Allow_users_with_posts_to_change_their_username','Allow users with posts to change their username:') }}
								</td>
								<td class="qa-form-wide-data">
								<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_change_usernames" name="option_allow_change_usernames">-->
                                    {{ Form::checkbox('option_allow_change_usernames', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_change_usernames']) }}
								</td>
							</tr>
							<tr id="allow_private_messages">
								<td class="qa-form-wide-label">
									<!--Enable private messaging between users:-->
          							{{ Form::label('Enable_private_messaging_between_users','Enable private messaging between users:') }}
								</td>
								<td class="qa-form-wide-data">
								<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_private_messages" name="option_allow_private_messages">-->
                                    {{ Form::checkbox('option_allow_private_messages', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_private_messages']) }}
								</td>
							</tr>
							<tr id="show_message_history">
								<td class="qa-form-wide-label">
									<!--Store and display private message history:-->
          							{{ Form::label('Store_and_display_private_message_history','Store and display private message history:') }}								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_show_message_history" name="option_show_message_history">-->
                                    {{ Form::checkbox('option_show_message_history', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_message_history']) }}
								</td>
							</tr>
							<tr id="allow_user_walls">
								<td class="qa-form-wide-label">
									<!--Enable wall posts on user profiles:-->
      								{{ Form::label('Enable_wall_posts_on_user_profiles','Enable wall posts on user profiles:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_user_walls" name="option_allow_user_walls">-->
                                    {{ Form::checkbox('option_allow_user_walls', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_user_walls']) }}
								</td>
							</tr>
							<tr id="page_size_wall">
								<td class="qa-form-wide-label">
									<!--Wall posts per page:-->
                                    {{ Form::label('Wall_posts_per_page', 'Wall posts per page:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="10" id="option_page_size_wall" name="option_page_size_wall">-->
                                     {{ Form::text('option_page_size_wall', Input::old('option_page_size_wall'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_wall')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_wall') }}</div> @endif
									<span class="qa-form-wide-note"> (max 20)</span>
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
								</td>
							</tr>
							<tr id="avatar_allow_gravatar">
								<td class="qa-form-wide-label">
									Allow <a target="_blank" href="http://www.gravatar.com/">Gravatar</a> avatars:								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_avatar_allow_gravatar" name="option_avatar_allow_gravatar">-->
                                    {{ Form::checkbox('option_avatar_allow_gravatar', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_avatar_allow_gravatar']) }}
								</td>
							</tr>
							<tr id="avatar_allow_upload">
								<td class="qa-form-wide-label">
									<!--Allow users to upload avatars:-->
                      {{ Form::label('Allow_users_to_upload_avatars', 'Allow users to upload avatars:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_avatar_allow_upload" name="option_avatar_allow_upload">-->
                                  {{ Form::checkbox('option_avatar_allow_upload', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_avatar_allow_upload']) }}   
								</td>
							</tr>
							<tr id="avatar_store_size">
								<td class="qa-form-wide-label">
									<!--Maximum size for storing avatars:-->
                     {{ Form::label('Maximum size for storing avatars', 'Maximum size for storing avatars:') }}                                </td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="400" id="option_avatar_store_size" name="option_avatar_store_size">-->
                                    {{ Form::text('option_avatar_store_size', Input::old('option_avatar_store_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_store_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_store_size') }}</div> @endif
									<span class="qa-form-wide-note">pixels</span>
								</td>
							</tr>
							<tr id="avatar_default_show">
								<td class="qa-form-wide-label">
									Default avatar: <span style="margin:2px 0; display:inline-block;"></span> <input type="file" style="width:16em;" name="avatar_default_file">
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_avatar_default_show" name="option_avatar_default_show">-->
                                         {{ Form::checkbox('option_avatar_default_show', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_avatar_default_show']) }}  
									</td>
								</tr>
								<tr>
									<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									</td>
								</tr>
								<tr id="avatar_profile_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on user profile page:-->
                     {{ Form::label('Avatar_size_on_user_profile_page','Avatar size on user profile page:') }}
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="200" id="option_avatar_profile_size" name="option_avatar_profile_size">-->
                                        {{ Form::text('option_avatar_profile_size', Input::old('option_avatar_profile_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_profile_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_profile_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr id="avatar_users_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on top users page:-->
                     {{ Form::label('Avatar_size_on_top_users_page','Avatar size on top users page:') }}
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="30" id="option_avatar_users_size" name="option_avatar_users_size">-->
                                        {{ Form::text('option_avatar_users_size', Input::old('option_avatar_users_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_users_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_users_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr id="avatar_q_page_q_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on questions:-->
              {{ Form::label('Avatar_size_on_top_users_page','Avatar size on top users page:') }}
                                    </td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="50" id="option_avatar_q_page_q_size" name="option_avatar_q_page_q_size">-->
                                         {{ Form::text('option_avatar_q_page_q_size', Input::old('option_avatar_q_page_q_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_q_page_q_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_q_page_q_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr id="avatar_q_page_a_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on answers:-->
                 {{ Form::label('Avatar_size_on_top_users_page','Avatar size on top users page:') }}
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="40" id="option_avatar_q_page_a_size" name="option_avatar_q_page_a_size">-->
                                         {{ Form::text('option_avatar_q_page_a_size', Input::old('option_avatar_q_page_a_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_q_page_a_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_q_page_a_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr id="avatar_q_page_c_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on comments:-->
                      {{ Form::label('Avatar_size_on_top_users_page','Avatar size on top users page:') }}
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="20" id="option_avatar_q_page_c_size" name="option_avatar_q_page_c_size">-->
                                        {{ Form::text('option_avatar_q_page_c_size', Input::old('option_avatar_q_page_c_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_q_page_c_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_q_page_c_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr id="avatar_q_list_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on question lists:-->
                        {{ Form::label('Avatar_size_on_question_lists','Avatar size on question lists:') }}
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="0" id="option_avatar_q_list_size" name="option_avatar_q_list_size">-->
                                        {{ Form::text('option_avatar_q_list_size', Input::old('option_avatar_q_list_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_q_list_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_q_list_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr id="avatar_message_list_size">
									<td class="qa-form-wide-label">
										<!--Avatar size on message lists:-->
                    {{ Form::label('Avatar_size_on_message_lists','Avatar size on message lists:') }}
									</td>
									<td class="qa-form-wide-data">
										<!--<input type="text" class="qa-form-wide-number" value="20" id="option_avatar_message_list_size" name="option_avatar_message_list_size">-->
                                         {{ Form::text('option_avatar_message_list_size', Input::old('option_avatar_message_list_size'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_avatar_message_list_size')) <div class="qa-form-tall-error">{{ $errors->first('option_avatar_message_list_size') }}</div> @endif
										<span class="qa-form-wide-note">pixels</span>
									</td>
								</tr>
								<tr>
									<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									</td>
								</tr>
								</tbody><tbody id="profile_fields">
									<tr>
										<td colspan="3" class="qa-form-tall-label">
											<!--Extra fields on user pages or registration form:-->
                             {{ Form::label('Extra_fields_on_user_pages_or_registration_form','Extra fields on user pages or registration form:') }}
										</td>
									</tr>
									<tr>
										<td colspan="3" class="qa-form-tall-data">
											<ul style="margin-bottom:0;">
												{{$userfields}}
												<li><b><a href="/admin/userfields">Add new field</a></b></li>
											</ul>
										</td>
									</tr>
								</tbody>
								<tbody><tr>
									<td class="qa-form-wide-spacer" colspan="3">&nbsp;
										
									</td>
								</tr>
								<tr>
									<td colspan="3" class="qa-form-tall-label">
										<!--User titles based on points:-->
                        				{{ Form::label('User_titles_based_on_points','User titles based on points:') }}
									</td>
								</tr>
								<tr>
									<td colspan="3" class="qa-form-tall-data">
										<ul style="margin-bottom:0;">
											{{$titlefields_html}}
											<li>
												<b><a href="/admin/usertitles">Add new title</a></b>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td class="qa-form-wide-buttons" colspan="3">
										<!--<input type="submit" class="qa-form-wide-button qa-form-wide-button-save" title="" value="Save Options" id="dosaveoptions">
										<input type="submit" class="qa-form-wide-button qa-form-wide-button-reset" title="" value="Reset to Defaults" name="doresetoptions">-->
                                        {{ Form::submit('Save Options', array('class' => 'qa-form-wide-button qa-form-wide-button-save','id' => 'dosaveoptions')) }}
										{{ Form::submit('Reset to Defaults', array('class' => 'qa-form-wide-button qa-form-wide-button-reset','name'=>'doresetoptions')) }}
									</td>
								</tr>
							</tbody></table>						
						
         {{ Form::close() }}
		@endif
					</div>
	<script type="text/javascript">
	$( document ).ready(function() {
		$("#option_show_notice_visitor").click(function(){
			if($(this).attr('checked')) {			
				$("#notice_visitor").fadeIn('slow');
			}
			else {
				$("#notice_visitor").fadeOut('slow');				
			}
		});
		$("#option_show_custom_register").click(function(){
			if($(this).attr('checked')) {			
				$("#custom_register").fadeIn('slow');
			}
			else {
				$("#custom_register").fadeOut('slow');				
			}
		});
		$("#option_show_notice_welcome").click(function(){
			if($(this).attr('checked')) {			
				$("#notice_welcome").fadeIn('slow');
			}
			else {
				$("#notice_welcome").fadeOut('slow');				
			}
		});
		$("#option_show_custom_welcome").click(function(){
			if($(this).attr('checked')) {			
				$("#custom_welcome").fadeIn('slow');
			}
			else {
				$("#custom_welcome").fadeOut('slow');				
			}
		});
		$("#option_allow_private_messages").click(function(){
			if($(this).attr('checked')) {			
				$("#show_message_history").fadeIn('slow');
			}
			else {
				$("#show_message_history").fadeOut('slow');				
			}
		});
		$("#option_allow_user_walls").click(function(){
			if($(this).attr('checked')) {			
				$("#page_size_wall").fadeIn('slow');
			}
			else {
				$("#page_size_wall").fadeOut('slow');				
			}
		});
		$("#option_avatar_allow_upload").click(function(){
			if($(this).attr('checked')) {			
				$("#avatar_store_size").fadeIn('slow');
			}
			else {
				$("#avatar_store_size").fadeOut('slow');				
			}
		});

		//All onload conditions.....
		if($("#option_show_notice_visitor").attr('checked')) {
			$("#notice_visitor").fadeIn('slow');
		}
		if($("#option_show_custom_register").attr('checked')) {
			$("#custom_register").fadeIn('slow');
		}
		if($("#option_show_notice_welcome").attr('checked')) {
			$("#notice_welcome").fadeIn('slow');
		}
		if($("#option_show_custom_welcome").attr('checked')) {
			$("#custom_welcome").fadeIn('slow');
		}
		if($("#option_allow_private_messages").attr('checked')) {
			$("#show_message_history").fadeIn('slow');
		}
		if($("#option_allow_user_walls").attr('checked')) {
			$("#page_size_wall").fadeIn('slow');
		}
		if($("#option_avatar_allow_upload").attr('checked')) {
			$("#avatar_store_size").fadeIn('slow');
		}
		
	});
</script>

</div>
@stop
