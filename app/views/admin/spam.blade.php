@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1> Administration center - Spam  </h1>	
	<div class="qa-part-form">
					@if(isset($spam))
					{{ Form::model($spam, ['url' => 'admin/doSpam', 'method' => 'post']) }}
					<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=spam" method="post">-->
						<table class="qa-form-wide-table">
							<tbody>
							@if(Session::get('success'))
							<tr>
								<td class="qa-form-wide-ok" colspan="3">
									{{Session::get('success')}}
								</td>
							</tr>
							@endif
							<tr id="confirm_user_emails">
								<td class="qa-form-wide-label">
									<!--Request confirmation of user emails:-->
                                {{ Form::label('Request_confirmation_of_user_emails','Request confirmation of user emails:') }}					
								</td>
								<td class="qa-form-wide-data">
								<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_confirm_user_emails" name="option_confirm_user_emails">-->
                                     {{ Form::checkbox('option_confirm_user_emails', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_confirm_user_emails']) }}
								</td>
							</tr>
							<tr id="confirm_user_required">
								<td class="qa-form-wide-label">
									<!--All new users must confirm their email:-->
                                  {{ Form::label('All_new_users_must_confirm_their_email','All new users must confirm their email:') }}					
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_confirm_user_required" name="option_confirm_user_required">-->
                                     {{ Form::checkbox('option_confirm_user_required', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_confirm_user_required']) }}
								</td>
							</tr>
							<tr id="moderate_users">
								<td class="qa-form-wide-label">
									<!--Enable moderation (approval) of users:-->
                                    {{ Form::label('Enable_moderation_(approval)_of_users','Enable moderation (approval) of users:') }} 
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_moderate_users" name="option_moderate_users">-->
                                    {{ Form::checkbox('option_moderate_users', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_users']) }}
									<span class="qa-form-wide-note"><a href="/admin/users">add registration fields</a></span>
								</td>
							</tr>
							<tr id="approve_user_required" style="display: none;">
								<td class="qa-form-wide-label">
									<!--All new users must be approved:-->
                             {{ Form::label('All_new_users_must_be_approved','All new users must be approved:') }}          
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_approve_user_required" name="option_approve_user_required">-->
                                    {{ Form::checkbox('option_approve_user_required', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_approve_user_required']) }}
								</td>
							</tr>
							<tr id="register_notify_admin">
								<td class="qa-form-wide-label">
									<!--Email me when a new user registers:-->
                                    {{ Form::label('Email_me_when_a_new_user_registers','Email me when a new user registers:') }}          
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_register_notify_admin" name="option_register_notify_admin">-->
                                    {{ Form::checkbox('option_register_notify_admin', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_register_notify_admin']) }}
								</td>
							</tr>
							<tr id="suspend_register_users">
								<td class="qa-form-wide-label">
									<!--Temporarily suspend new user registrations:-->
                              {{ Form::label('Temporarily_suspend_new_user_registrations','Temporarily suspend new user registrations:') }}      
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_suspend_register_users" name="option_suspend_register_users">-->
                                     {{ Form::checkbox('option_suspend_register_users', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_suspend_register_users']) }}
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									
								</td>
							</tr>
							<tr id="captcha_on_register">
								<td class="qa-form-wide-label">
									<!--Use captcha for user registration:-->
                                    {{ Form::label('Use_captcha_for_user_registration','Use captcha for user registration:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_captcha_on_register" name="option_captcha_on_register">-->
                                     {{ Form::checkbox('option_captcha_on_register', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_captcha_on_register']) }}
								</td>
							</tr>
							<tr id="captcha_on_reset_password">
								<td class="qa-form-wide-label">
									<!--Use captcha on reset password form:-->
                                  {{ Form::label('Use_captcha_on_reset_password_form','Use captcha on reset password form:') }}  
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_captcha_on_reset_password" name="option_captcha_on_reset_password">-->
                                    {{ Form::checkbox('option_captcha_on_reset_password', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_captcha_on_reset_password']) }}
								</td>
							</tr>
							<tr id="captcha_on_anon_post">
								<td class="qa-form-wide-label">
									<!--Use captcha for anonymous posts:-->
                                    {{ Form::label('Use_captcha_for_anonymous_posts','Use captcha for anonymous posts:') }}  
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_captcha_on_anon_post" name="option_captcha_on_anon_post">-->
                                     {{ Form::checkbox('option_captcha_on_anon_post', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_captcha_on_anon_post']) }}
								</td>
							</tr>
							<tr id="captcha_on_unapproved" style="display: none;">
								<td class="qa-form-wide-label">
									<!--Use captcha if user not yet approved:-->
                                    {{ Form::label('Use_captcha_if_user_not_yet_approved','Use captcha if user not yet approved:') }}  
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_captcha_on_unapproved" name="option_captcha_on_unapproved">-->
                                     {{ Form::checkbox('option_captcha_on_unapproved', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_captcha_on_unapproved']) }}
								</td>
							</tr>
							<tr id="captcha_on_unconfirmed">
								<td class="qa-form-wide-label">
									<!--Use captcha if email not confirmed:-->
                               {{ Form::label('Use_captcha_if_email_not_confirmed','Use captcha if email not confirmed:') }}  
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_captcha_on_unconfirmed" name="option_captcha_on_unconfirmed">-->
                                    {{ Form::checkbox('option_captcha_on_unconfirmed', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_captcha_on_unconfirmed']) }}
								</td>
							</tr>
							<tr id="captcha_on_feedback">
								<td class="qa-form-wide-label">
									<!--Use captcha on feedback form:-->
                                     {{ Form::label('Use_captcha_on_feedback_form','Use captcha on feedback form:') }}  
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_captcha_on_feedback" name="option_captcha_on_feedback">-->
                                    {{ Form::checkbox('option_captcha_on_feedback', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_captcha_on_feedback']) }}
								</td>
							</tr>
							<tr id="captcha_module">
								<td class="qa-form-wide-label">
									<!--Use captcha module:-->
                                   {{ Form::label('Use_captcha_module','Use captcha module:') }}    
								</td>
								<td class="qa-form-wide-data">
									<!--<select class="qa-form-wide-select" id="option_captcha_module" name="option_captcha_module">
										<option selected="" value="reCAPTCHA">reCAPTCHA</option>
									</select>-->
                                    {{ Form::select('option_captcha_module', ['reCAPTCHA' => 'reCAPTCHA'], null, ['class' => 'qa-form-wide-select','id'=>'option_captcha_module']) }}
									<span class="qa-form-wide-note"><a href="./index.php?qa=admin&amp;qa_1=plugins&amp;show=e4a783e78e73d8a81f6c96851eca3488#e4a783e78e73d8a81f6c96851eca3488">options</a></span>
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									
								</td>
							</tr>
							<tr id="moderate_anon_post">
								<td class="qa-form-wide-label">
									<!--Use moderation for anonymous posts:-->
                                  {{ Form::label('Use_moderation_for_anonymous_posts','Use moderation for anonymous posts:') }}    
         
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_moderate_anon_post" name="option_moderate_anon_post">-->
                                     {{ Form::checkbox('option_moderate_anon_post', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_anon_post']) }}
								</td>
							</tr>
							<tr id="moderate_unapproved" style="display: none;">
								<td class="qa-form-wide-label">
									<!--Use moderation if user not yet approved:-->
                                   {{ Form::label('Use_moderation_if_user_not_yet_approved','Use moderation if user not yet approved:') }}     
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_moderate_unapproved" name="option_moderate_unapproved">-->
                                    {{ Form::checkbox('option_moderate_unapproved', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_unapproved']) }}
								</td>
							</tr>
							<tr id="moderate_unconfirmed">
								<td class="qa-form-wide-label">
									<!--Use moderation if email not confirmed:-->
                          {{ Form::label('Use_moderation_if_email_not_approved','Use moderation if email not approved:') }}               
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_moderate_unconfirmed" name="option_moderate_unconfirmed">-->
                                    {{ Form::checkbox('option_moderate_unconfirmed', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_unconfirmed']) }}
								</td>
							</tr>
							<tr id="moderate_by_points">
								<td class="qa-form-wide-label">
									<span style="" id="moderate_points_label_off">Use moderation for users with few points:</span><span id="moderate_points_label_on" style="display: none;">Use moderation for users with less than:</span>
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_moderate_by_points" name="option_moderate_by_points">-->
                                  {{ Form::checkbox('option_moderate_by_points', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_by_points']) }} 
								</td>
							</tr>
							<tr id="moderate_points_limit" style="display: none;">
								<td class="qa-form-wide-label">
									
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="150" id="option_moderate_points_limit" name="option_moderate_points_limit">-->
                                    {{ Form::text('option_moderate_points_limit', Input::old('option_moderate_points_limit'),array('class'=>'qa-form-wide-number')) }}
									@if ($errors->has('option_moderate_points_limit')) <div class="qa-form-tall-error">{{ $errors->first('option_moderate_points_limit') }}</div> @endif
									<span class="qa-form-wide-note">points</span>
								</td>
							</tr>
							<tr id="moderate_edited_again" style="display: none;">
								<td class="qa-form-wide-label">
									<!--Re-moderate posts after editing:-->
                                    {{ Form::label('Re-moderate_posts_after_editing','Re-moderate posts after editing:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_moderate_edited_again" name="option_moderate_edited_again">-->
                                    {{ Form::checkbox('option_moderate_edited_again', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_edited_again']) }}
								</td>
							</tr>
							<tr id="moderate_notify_admin" style="display: none;">
								<td class="qa-form-wide-label">
									<!--Email me when a post needs moderation:-->
                                    {{ Form::label('Email_me_when_a_post_needs_moderation','Email me when a post needs moderation:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_moderate_notify_admin" name="option_moderate_notify_admin">-->
                                    {{ Form::checkbox('option_moderate_notify_admin', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_moderate_notify_admin']) }} 
								</td>
							</tr>
							<tr id="moderate_update_time" style="display: none;">
								<td class="qa-form-wide-label">
									<!--Time to show on moderated posts:-->
                                  {{ Form::label('Time_to_show_on_moderated_posts','Time to show on moderated posts:') }}  
								</td>
								<td class="qa-form-wide-data">
									<!--<select class="qa-form-wide-select" id="option_moderate_update_time" name="option_moderate_update_time">
										<option value="0">Time written</option>
										<option selected="" value="1">Time approved</option>
									</select>-->
                                    {{ Form::select('option_moderate_update_time', [0 => 'Time written',1 => 'Time approved'], null, ['class' => 'qa-form-wide-select','id'=>'option_moderate_update_time']) }}
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									
								</td>
							</tr>
							<tr id="flagging_of_posts">
								<td class="qa-form-wide-label">
									<!--Allow posts to be flagged:-->
                                  {{ Form::label('Allow_posts_to_be_flagged','Allow posts to be flagged:') }}								</td>
								<td class="qa-form-wide-data">
									<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_flagging_of_posts" name="option_flagging_of_posts">-->
                                    {{ Form::checkbox('option_flagging_of_posts', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_flagging_of_posts']) }}  
								</td>
							</tr>
							<tr id="flagging_notify_first">
								<td class="qa-form-wide-label">
									<!--Email me if a post receives:-->
                                {{ Form::label('Email_me_if_a_post_receives','Email me if a post receives:') }}								
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="1" id="option_flagging_notify_first" name="option_flagging_notify_first">-->
                                    {{ Form::text('option_flagging_notify_first', Input::old('option_flagging_notify_first'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_flagging_notify_first')) <div class="qa-form-tall-error">{{ $errors->first('option_flagging_notify_first') }}</div> @endif
									<span class="qa-form-wide-note"> flags</span>
								</td>
							</tr>
							<tr id="flagging_notify_every">
								<td class="qa-form-wide-label">
									<!--Email me again after every additional:-->
                                {{ Form::label('Email_me_if_a_post_receives','Email me if a post receives:') }}								
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="2" id="option_flagging_notify_every" name="option_flagging_notify_every">-->
                                    {{ Form::text('option_flagging_notify_every', Input::old('option_flagging_notify_every'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_flagging_notify_every')) <div class="qa-form-tall-error">{{ $errors->first('option_flagging_notify_every') }}</div> @endif
									<span class="qa-form-wide-note"> flags</span>
								</td>
							</tr>
							<tr id="flagging_hide_after">
								<td class="qa-form-wide-label">
									<!--Automatically hide posts which reach:-->
                              {{ Form::label('Automatically_hide_posts_which_reach','Automatically hide posts which reach:') }}								
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="5" id="option_flagging_hide_after" name="option_flagging_hide_after">-->
                                    {{ Form::text('option_flagging_hide_after', Input::old('option_flagging_hide_after'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_flagging_hide_after')) <div class="qa-form-tall-error">{{ $errors->first('option_flagging_hide_after') }}</div> @endif
									<span class="qa-form-wide-note"> flags</span>
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									
								</td>
							</tr>
							</tbody><tbody id="block_ips_write">
								<tr>
									<td colspan="3" class="qa-form-tall-label">
										<!--Blocked IP addresses - separate by spaces or commas:-->
                            {{ Form::label('Blocked_IP_addresses_-_separate_by_spaces_or_commas','Blocked IP addresses - separate by spaces or commas:') }}			
									</td>
								</tr>
								<tr>
									<td colspan="3" class="qa-form-tall-data">
										<!--<textarea class="qa-form-tall-text" cols="40" rows="4" id="option_block_ips_write" name="option_block_ips_write"></textarea>-->
                                        {{ Form::textarea('option_block_ips_write', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>4,'id'=>'option_block_ips_write']) }}
										<div class="qa-form-tall-note">Use a hyphen for ranges or * to match any number. Examples: 192.168.0.4 , 192.168.0.0-192.168.0.31 , 192.168.0.*</div>
									</td>
								</tr>
							</tbody>
							<tbody><tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
									
								</td>
							</tr>
							<tr id="max_rate_ip_registers">
								<td class="qa-form-wide-label">
									<!--Rate limit for user registrations:-->
                     {{ Form::label('Rate_limit_for_user_registrations','Rate limit for user registrations:') }}                
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="5" id="option_max_rate_ip_registers" name="option_max_rate_ip_registers">-->
                                    {{ Form::text('option_max_rate_ip_registers', Input::old('option_max_rate_ip_registers'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_registers')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_registers') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_ip_logins">
								<td class="qa-form-wide-label">
									<!--Rate limit for logging in:-->
                                    {{ Form::label('Rate_limit_for_logging_in','Rate limit for user registrations:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="20" id="option_max_rate_ip_logins" name="option_max_rate_ip_logins">-->
                                     {{ Form::text('option_max_rate_ip_logins', Input::old('option_max_rate_ip_logins'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_logins')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_logins') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
								</td>
							</tr>
							<tr id="max_rate_ip_qs">
								<td class="qa-form-wide-label">
									<!--Rate limit for asking questions:-->
                                    {{ Form::label('Rate_limit_for_asking_questions','Rate limit for asking questions:') }}								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="20" id="option_max_rate_ip_qs" name="option_max_rate_ip_qs">-->
                                    {{ Form::text('option_max_rate_ip_qs', Input::old('option_max_rate_ip_qs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_qs') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_qs">
								<td class="qa-form-wide-label">
									
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="10" id="option_max_rate_user_qs" name="option_max_rate_user_qs">-->
                                    {{ Form::text('option_max_rate_user_qs', Input::old('option_max_rate_user_qs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_qs') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
								</td>
							</tr>
							<tr id="max_rate_ip_as">
								<td class="qa-form-wide-label">
									<!--Rate limit for adding answers:-->
                      {{ Form::label('Rate_limit_for_adding_answers','Rate limit for adding answers:') }}								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="50" id="option_max_rate_ip_as" name="option_max_rate_ip_as">-->
                                     {{ Form::text('option_max_rate_ip_as', Input::old('option_max_rate_ip_as'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_as')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_as') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_as">
								<td class="qa-form-wide-label">
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="25" id="option_max_rate_user_as" name="option_max_rate_user_as">-->
                                    {{ Form::text('option_max_rate_user_as', Input::old('option_max_rate_user_as'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_as')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_as') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
								</td>
							</tr>
							<tr id="max_rate_ip_cs">
								<td class="qa-form-wide-label">
									<!--Rate limit for posting comments:-->
                              {{ Form::label('Rate_limit_for_posting_comments','Rate limit for posting comments:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="40" id="option_max_rate_ip_cs" name="option_max_rate_ip_cs">-->
                                     {{ Form::text('option_max_rate_ip_cs', Input::old('option_max_rate_ip_cs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_cs')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_cs') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_cs">
								<td class="qa-form-wide-label">
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="20" id="option_max_rate_user_cs" name="option_max_rate_user_cs">-->
                                    {{ Form::text('option_max_rate_user_cs', Input::old('option_max_rate_user_cs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_cs')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_cs') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
								</td>
							</tr>
							<tr>
								<td class="qa-form-wide-spacer" colspan="3">&nbsp;
								</td>
							</tr>
							<tr id="max_rate_ip_votes">
								<td class="qa-form-wide-label">
									<!--Rate limit for voting:-->
                                    {{ Form::label('Rate_limit_for_voting','Rate limit for voting:') }}
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="600" id="option_max_rate_ip_votes" name="option_max_rate_ip_votes">-->
                                     {{ Form::text('option_max_rate_ip_votes', Input::old('option_max_rate_ip_votes'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_votes')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_votes') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_votes">
								<td class="qa-form-wide-label">
									
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="300" id="option_max_rate_user_votes" name="option_max_rate_user_votes">-->
                                    {{ Form::text('option_max_rate_user_votes', Input::old('option_max_rate_user_votes'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_votes')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_votes') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
								</td>
							</tr>
							<tr id="max_rate_ip_flags">
								<td class="qa-form-wide-label">
									<!--Rate limit for flagging posts:-->
                             {{ Form::label('Rate_limit_for_flagging_posts','Rate limit for flagging posts:') }}        
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="10" id="option_max_rate_ip_flags" name="option_max_rate_ip_flags">-->
                                    {{ Form::text('option_max_rate_ip_flags', Input::old('option_max_rate_ip_flags'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_flags')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_flags') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_flags">
								<td class="qa-form-wide-label">
									
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="5" id="option_max_rate_user_flags" name="option_max_rate_user_flags">-->
                                     {{ Form::text('option_max_rate_user_flags', Input::old('option_max_rate_user_flags'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_flags')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_flags') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
								</td>
							</tr>
							<tr id="max_rate_ip_uploads">
								<td class="qa-form-wide-label">
									<!--Rate limit for uploading files:-->
                {{ Form::label('Rate_limit_for_uploading_files','Rate limit for uploading files:') }}                     
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="20" id="option_max_rate_ip_uploads" name="option_max_rate_ip_uploads">-->
                                    {{ Form::text('option_max_rate_ip_uploads', Input::old('option_max_rate_ip_uploads'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_uploads')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_uploads') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_uploads">
								<td class="qa-form-wide-label">
									
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="10" id="option_max_rate_user_uploads" name="option_max_rate_user_uploads">-->
                                    {{ Form::text('option_max_rate_user_uploads', Input::old('option_max_rate_user_uploads'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_uploads')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_uploads') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
								</td>
							</tr>
							<tr id="max_rate_ip_messages">
								<td class="qa-form-wide-label">
									<!--Rate limit for private and wall messages:-->
                             {{ Form::label('Rate_limit_for_private_and_wall_messages','Rate limit for private and wall messages:') }}                     

								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="10" id="option_max_rate_ip_messages" name="option_max_rate_ip_messages">-->
                                     {{ Form::text('option_max_rate_ip_messages', Input::old('option_max_rate_ip_messages'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_ip_messages')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_ip_messages') }}</div> @endif
									<span class="qa-form-wide-note">per IP/hour</span>
								</td>
							</tr>
							<tr id="max_rate_user_messages">
								<td class="qa-form-wide-label">
									
								</td>
								<td class="qa-form-wide-data">
									<!--<input type="text" class="qa-form-wide-number" value="5" id="option_max_rate_user_messages" name="option_max_rate_user_messages">-->
                                    {{ Form::text('option_max_rate_user_messages', Input::old('option_max_rate_user_messages'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_rate_user_messages')) <div class="qa-form-tall-error">{{ $errors->first('option_max_rate_user_messages') }}</div> @endif
									<span class="qa-form-wide-note">per user/hour</span>
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
</div>
@stop
