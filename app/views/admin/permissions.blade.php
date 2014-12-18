@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Permissions  </h1>
	<div class="qa-part-form">
		@if(isset($permissions))
		{{ Form::model($permissions, ['url' => 'admin/doPermission', 'method' => 'post']) }}
					<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=permissions" method="post">-->
		<table class="qa-form-wide-table">
			<tbody>
			@if(Session::get('success'))
			<tr>
				<td class="qa-form-wide-ok" colspan="3">
					{{Session::get('success')}}
				</td>
			</tr>
			@endif
			<tr id="permit_view_q_page">
				<td class="qa-form-wide-label">
					<!--Viewing question pages:-->
             {{ Form::label('Viewing_question_pages','Viewing question pages:') }}				
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_view_q_page" name="option_permit_view_q_page">
						<option selected="" value="150">Anybody</option>
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
					</select>-->
                    {{ Form::select('option_permit_view_q_page', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_view_q_page']) }}
				</td>
			</tr>
			<tr id="allow_view_q_bots" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_view_q_bots" name="option_allow_view_q_bots">-->
                     {{ Form::checkbox('option_allow_view_q_bots', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_view_q_bots']) }}
					<span class="qa-form-wide-note">Allow search engines to view question pages</span>
				</td>
			</tr>
			<tr id="permit_post_q">
				<td class="qa-form-wide-label">
					<!--Asking questions:-->
                    {{ Form::label('Viewing_question_pages','Viewing question pages:') }}			
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_post_q" name="option_permit_post_q">
						<option selected="" value="150">Anybody</option>
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
					</select>-->
                     {{ Form::select('option_permit_post_q', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_post_q']) }}
				</td>
			</tr>
			<tr id="permit_post_q_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_post_q_points" name="option_permit_post_q_points">-->
                    {{ Form::text('option_permit_post_q_points', Input::old('option_permit_post_q_points'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_permit_post_q_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_post_q_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_post_a">
				<td class="qa-form-wide-label">
					<!--Answering questions:-->
                     {{ Form::label('Answering_questions','Answering questions:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_post_a" name="option_permit_post_a">
						<option value="150">Anybody</option>
						<option selected="" value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
					</select>-->
                    {{ Form::select('option_permit_post_a', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_post_a']) }}
				</td>
			</tr>
			<tr id="permit_post_a_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_post_a_points" name="option_permit_post_a_points">-->
                    {{ Form::text('option_permit_post_a_points', Input::old('option_permit_post_a_points'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_permit_post_a_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_post_a_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_post_c">
				<td class="qa-form-wide-label">
					<!--Adding comments:-->
                    {{ Form::label('Answering_comments','Answering comments:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_post_c" name="option_permit_post_c">
						<option selected="" value="150">Anybody</option>
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
					</select>-->
                    {{ Form::select('option_permit_post_c', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_post_c']) }}
				</td>
			</tr>
			<tr id="permit_post_c_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_post_c_points" name="option_permit_post_c_points">-->
                    {{ Form::text('option_permit_post_c_points', Input::old('option_permit_post_c_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_post_c_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_post_c_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_vote_q">
				<td class="qa-form-wide-label">
					<!--Voting on questions:-->
                      {{ Form::label('Voting_on_questions','Voting on questions:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_vote_q" name="option_permit_vote_q">
						<option selected="" value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
					</select>-->
                    {{ Form::select('option_permit_vote_q', [120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_vote_q']) }}
				</td>
			</tr>
			<tr id="permit_vote_q_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_vote_q_points" name="option_permit_vote_q_points">-->
                    {{ Form::text('option_permit_vote_q_points', Input::old('option_permit_vote_q_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_vote_q_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_vote_q_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			
			<tr id="permit_vote_a">
				<td class="qa-form-wide-label">
					<!--Voting on answers:-->
                    {{ Form::label('Voting_on_answers','Voting on answers:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_vote_a" name="option_permit_vote_a">
						<option selected="" value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
					</select>-->
                    {{ Form::select('option_permit_vote_a', [120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_vote_a']) }}
				</td>
			</tr>
			<tr id="permit_vote_a_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_vote_a_points" name="option_permit_vote_a_points">-->
                    {{ Form::text('option_permit_vote_a_points', Input::old('option_permit_vote_a_points'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_permit_vote_a_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_vote_a_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_vote_down">
				<td class="qa-form-wide-label">
					<!--Voting posts down:-->
                    {{ Form::label('Voting_posts_down','Voting posts down:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_vote_down" name="option_permit_vote_down">
						<option selected="" value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
					</select>-->
                    {{ Form::select('option_permit_vote_down', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_vote_down']) }}
				</td>
			</tr>
			<tr id="permit_vote_down_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_vote_down_points" name="option_permit_vote_down_points">-->
                     {{ Form::text('option_permit_vote_down_points', Input::old('option_permit_vote_down_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_vote_down_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_vote_down_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_retag_cat">
				<td class="qa-form-wide-label">
					<!--Recategorizing any question:-->
                    {{ Form::label('Recategorizing_any_question','Recategorizing any question:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_retag_cat" name="option_permit_retag_cat">
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option selected="" value="70">Editors, Moderators, Admins</option>
					</select>-->
                    {{ Form::select('option_permit_retag_cat', [120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_retag_cat']) }}
				</td>
			</tr>
			<tr id="permit_retag_cat_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_retag_cat_points" name="option_permit_retag_cat_points">-->
                    {{ Form::text('option_permit_retag_cat_points', Input::old('option_permit_retag_cat_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_retag_cat_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_retag_cat_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_edit_q">
				<td class="qa-form-wide-label">
					<!--Editing any question:-->
                    {{ Form::label('Editing_any_question','Editing any question:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_edit_q" name="option_permit_edit_q">
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option selected="" value="70">Editors, Moderators, Admins</option>
					</select>-->
                     {{ Form::select('option_permit_edit_q', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_edit_q']) }}
				</td>
			</tr>
			<tr id="permit_edit_q_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_edit_q_points" name="option_permit_edit_q_points">-->
                    {{ Form::text('option_permit_edit_q_points', Input::old('option_permit_edit_q_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_edit_q_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_edit_q_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_edit_a">
				<td class="qa-form-wide-label">
					<!--Editing any answer:-->
                    {{ Form::label('Editing_any_answer','Editing any answer:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_edit_a" name="option_permit_edit_a">
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option selected="" value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
					</select>-->
                     {{ Form::select('option_permit_edit_a', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_edit_a']) }}
				</td>
			</tr>
			<tr id="permit_edit_a_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_edit_a_points" name="option_permit_edit_a_points">-->
                    {{ Form::text('option_permit_edit_a_points', Input::old('option_permit_edit_a_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_edit_a_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_edit_a_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_edit_c">
				<td class="qa-form-wide-label">
					<!--Editing any comment:-->
                    {{ Form::label('Editing_any_comment','Editing any comment:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_edit_c" name="option_permit_edit_c">
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option selected="" value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
					</select>-->
                     {{ Form::select('option_permit_edit_c', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_edit_c']) }}
				</td>
			</tr>
			<tr id="permit_edit_c_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_edit_c_points" name="option_permit_edit_c_points">-->
                    {{ Form::text('option_permit_edit_c_points', Input::old('option_permit_edit_c_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_edit_c_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_edit_c_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_edit_silent">
				<td class="qa-form-wide-label">
					<!--Editing posts silently:-->
                    {{ Form::label('Editing_posts_silently','Editing posts silently:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_edit_silent" name="option_permit_edit_silent">
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
						<option selected="" value="40">Moderators and Admins</option>
						<option value="20">Administrators</option>
					</select>-->
                    {{ Form::select('option_permit_edit_silent',[100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins',20 => 'Administrators'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_edit_silent']) }}
				</td>
			</tr>
			<tr id="permit_edit_silent_points" style="display: none;">
				<td class="qa-form-wide-label">
					[options/permit_edit_silent_points]
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-text" value="" id="option_permit_edit_silent_points" name="option_permit_edit_silent_points">-->
                     {{ Form::text('option_permit_edit_silent_points', Input::old('option_permit_edit_silent_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_edit_silent_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_edit_silent_points') }}</div> @endif
				</td>
			</tr>
			<tr id="permit_close_q">
				<td class="qa-form-wide-label">
					<!--Closing any question:-->
                    {{ Form::label('Closing_any_question','Closing any question:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_close_q" name="option_permit_close_q">
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option selected="" value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
					</select>-->
                    {{ Form::select('option_permit_close_q', [106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_close_q']) }}
				</td>
			</tr>
			<tr id="permit_close_q_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_close_q_points" name="option_permit_close_q_points">-->
                    {{ Form::text('option_permit_close_q_points', Input::old('option_permit_close_q_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_close_q_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_close_q_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_select_a">
				<td class="qa-form-wide-label">
					<!--Selecting answer for any question:-->
                {{ Form::label('Selecting_answer_for_any_question','Selecting answer for any question:') }}    
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_select_a" name="option_permit_select_a">
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option selected="" value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
					</select>-->
                    {{ Form::select('option_permit_select_a', [106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_select_a']) }}
				</td>
			</tr>
			<tr id="permit_select_a_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_select_a_points" name="option_permit_select_a_points">-->
                     {{ Form::text('option_permit_select_a_points', Input::old('option_permit_select_a_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_select_a_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_select_a_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_anon_view_ips">
				<td class="qa-form-wide-label">
					<!--Viewing IPs of anonymous posts:-->
                {{ Form::label('Viewing_IPs_of_anonymous_posts','Viewing IPs of anonymous posts:') }}         
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_anon_view_ips" name="option_permit_anon_view_ips">
						<option value="150">Anybody</option>
						<option value="120">Registered users</option>
						<option value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option selected="" value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
					</select>-->
                    {{ Form::select('option_permit_anon_view_ips', [150 => 'Anybody',120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_anon_view_ips']) }}
				</td>
			</tr>
			<tr id="permit_anon_view_ips_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_anon_view_ips_points" name="option_permit_anon_view_ips_points">-->
                    {{ Form::text('option_permit_anon_view_ips_points', Input::old('option_permit_anon_view_ips_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_anon_view_ips_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_anon_view_ips_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_view_voters_flaggers">
				<td class="qa-form-wide-label">
					<!--Viewing who voted or flagged posts:-->
                    {{ Form::label('Viewing_who_voted_or_flagged_posts','Viewing IPs of anonymous posts:') }}         
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_view_voters_flaggers" name="option_permit_view_voters_flaggers">
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
						<option selected="" value="20">Administrators</option>
						<option value="0">Super Administrators</option>
					</select>-->
                    {{ Form::select('option_permit_view_voters_flaggers',[100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins',20 => 'Administrators',0 => 'Super Administrators'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_view_voters_flaggers']) }}
				</td>
			</tr>
			<tr id="permit_view_voters_flaggers_points" style="display: none;">
				<td class="qa-form-wide-label">
					[options/permit_view_voters_flaggers_points]
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-text" value="" id="option_permit_view_voters_flaggers_points" name="option_permit_view_voters_flaggers_points">-->
                     {{ Form::text('option_permit_view_voters_flaggers_points', Input::old('option_permit_view_voters_flaggers_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_view_voters_flaggers_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_view_voters_flaggers_points') }}</div> @endif
				</td>
			</tr>
			<tr id="permit_flag">
				<td class="qa-form-wide-label">
					<!--Flagging posts:-->
         {{ Form::label('Flagging_posts','Flagging posts:') }}                    
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_flag" name="option_permit_flag">
						<option value="120">Registered users</option>
						<option selected="" value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
					</select>-->
                    {{ Form::select('option_permit_flag',[120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_flag']) }}
				</td>
			</tr>
			<tr id="permit_flag_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_flag_points" name="option_permit_flag_points">-->
                    {{ Form::text('option_permit_flag_points', Input::old('option_permit_flag_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_flag_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_flag_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_moderate">
				<td class="qa-form-wide-label">
					<!--Approving or rejecting posts:-->
                {{ Form::label('Approving_or_rejecting_posts','Approving or rejecting posts:') }}    
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_moderate" name="option_permit_moderate">
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option selected="" value="100">Experts, Editors, Moderators, Admins</option>
						<option value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
					</select>-->
                     {{ Form::select('option_permit_moderate',[106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_moderate']) }}
				</td>
			</tr>
			<tr id="permit_moderate_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_moderate_points" name="option_permit_moderate_points">-->
                     {{ Form::text('option_permit_moderate_points', Input::old('option_permit_moderate_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_moderate_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_moderate_points') }}</div> @endif
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_hide_show">
				<td class="qa-form-wide-label">
					<!--Hiding or showing any post:-->
                 {{ Form::label('Hiding_or_showing_any_post','Hiding or showing any post:') }}								</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_hide_show" name="option_permit_hide_show">
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
						<option value="100">Experts, Editors, Moderators, Admins</option>
						<option selected="" value="70">Editors, Moderators, Admins</option>
						<option value="40">Moderators and Admins</option>
					</select>-->
                    {{ Form::select('option_permit_hide_show',[106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points',100 => 'Experts, Editors, Moderators, Admins',70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_hide_show']) }}
				</td>
			</tr>
			<tr id="permit_hide_show_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_hide_show_points" name="option_permit_hide_show_points">-->
                    {{ Form::text('option_permit_hide_show_points', Input::old('option_permit_hide_show_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_hide_show_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_hide_show_points') }}</div> @endif 
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_delete_hidden">
				<td class="qa-form-wide-label">
					<!--Deleting hidden posts:-->
                   {{ Form::label('Deleting_hidden_posts','Deleting hidden posts:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_delete_hidden" name="option_permit_delete_hidden">
						<option value="70">Editors, Moderators, Admins</option>
						<option selected="" value="40">Moderators and Admins</option>
						<option value="20">Administrators</option>
					</select>-->
                     {{ Form::select('option_permit_delete_hidden',[70 => 'Editors, Moderators, Admins',40 => 'Moderators and Admins'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_delete_hidden']) }}
				</td>
			</tr>
			<tr id="permit_delete_hidden_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_delete_hidden_points" name="option_permit_delete_hidden_points">-->
                     {{ Form::text('option_permit_delete_hidden_points', Input::old('option_permit_delete_hidden_points'),array('class'=>'qa-form-wide-number')) }}
			@if ($errors->has('option_permit_delete_hidden_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_delete_hidden_points') }}</div> @endif 
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr id="permit_post_wall">
				<td class="qa-form-wide-label">
					<!--Posting on user walls:-->
          {{ Form::label('Posting_on_user_walls','Posting on user walls:') }}           
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_permit_post_wall" name="option_permit_post_wall">
						<option value="120">Registered users</option>
						<option selected="" value="110">Registered users with email confirmed</option>
						<option value="106">Registered users with enough points</option>
						<option value="104">Registered &amp; email confirmed &amp; enough points</option>
					</select>-->
                    {{ Form::select('option_permit_post_wall',[120 => 'Registered users',110 => 'Registered users with email confirmed',106 => 'Registered users with enough points',104 => 'Registered &amp; email confirmed &amp; enough points'], null, ['class' => 'qa-form-wide-select','id'=>'option_permit_post_wall']) }}
				</td>
			</tr>
			<tr id="permit_post_wall_points" style="display: none;">
				<td class="qa-form-wide-label">
					
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-prefix">Users must have&nbsp;</span>
					<!--<input type="text" class="qa-form-wide-number" value="" id="option_permit_post_wall_points" name="option_permit_post_wall_points">-->
                    {{ Form::text('option_permit_post_wall_points', Input::old('option_permit_post_wall_points'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_permit_post_wall_points')) <div class="qa-form-tall-error">{{ $errors->first('option_permit_post_wall_points') }}</div> @endif 
					<span class="qa-form-wide-note">points</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Blocking or unblocking user or IPs:-->
                 {{ Form::label('Blocking_or_unblocking_user_or_IPs','Blocking or unblocking user or IPs:') }}      
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Moderators and Admins</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Approving registered users:-->
                  {{ Form::label('Approving_registered_users','Approving registered users:') }}   
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Moderators and Admins</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Creating experts:-->
      {{ Form::label('Creating_experts','Creating experts:') }}   
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Moderators and Admins</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Viewing user email addresses:-->
              {{ Form::label('Viewing_user_email_addresses','Viewing user email addresses:') }}								</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Administrators</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Deleting users:-->
          {{ Form::label('Deleting_users','Deleting users:') }}								
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Administrators</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Creating editors and moderators:-->
             {{ Form::label('Creating_editors_and_moderators','Creating editors and moderators:') }}								
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Administrators</span>
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-label">
					<!--Creating administrators:-->
               {{ Form::label('Creating_administrators','Creating administrators:') }}								
				</td>
				<td class="qa-form-wide-data">
					<span class="qa-form-wide-static">Super Administrators</span>
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
<script type="text/javascript">
	$( document ).ready(function() {
		$("#option_permit_view_q_page").change(function(){
			if($(this).val()<150){
				$("#allow_view_q_bots").show('slow');
			}
			else {
				$("#allow_view_q_bots").hide('slow');				
			}
		});

		$("#option_permit_post_q").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_post_q_points").show('slow');
			}
			else {
				$("#permit_post_q_points").hide('slow');
			}
		});

		$("#option_permit_post_a").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_post_a_points").show('slow');
			}
			else {
				$("#permit_post_a_points").hide('slow');
			}
		});

		$("#option_permit_post_c").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_post_c_points").show('slow');
			}
			else {
				$("#permit_post_c_points").hide('slow');
			}
		});

		$("#option_permit_vote_q").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_vote_q_points").show('slow');
			}
			else {
				$("#permit_vote_q_points").hide('slow');
			}
		});
		$("#option_permit_vote_a").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_vote_a_points").show('slow');
			}
			else {
				$("#permit_vote_a_points").hide('slow');
			}
		});

		$("#option_permit_vote_down").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_vote_down_points").show('slow');
			}
			else {
				$("#permit_vote_down_points").hide('slow');
			}
		});
		$("#option_permit_retag_cat").change(function(){
			var current_val = $(this).val();
			console.log(current_val);
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_retag_cat_points").show('slow');
			}
			else {
				$("#permit_retag_cat_points").hide('slow');
			}
		});
		$("#option_permit_edit_q").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_edit_q_points").show('slow');
			}
			else {
				$("#permit_edit_q_points").hide('slow');
			}
		});
		$("#option_permit_edit_a").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_edit_a_points").show('slow');
			}
			else {
				$("#permit_edit_a_points").hide('slow');
			}
		});
		$("#option_permit_edit_c").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_edit_c_points").show('slow');
			}
			else {
				$("#permit_edit_c_points").hide('slow');
			}
		});
		$("#option_permit_edit_silent").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_edit_silent_points").show('slow');
			}
			else {
				$("#permit_edit_silent_points").hide('slow');
			}
		});
		$("#option_permit_close_q").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_close_q_points").show('slow');
			}
			else {
				$("#permit_close_q_points").hide('slow');
			}
		});
		$("#option_permit_select_a").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_select_a_points").show('slow');
			}
			else {
				$("#permit_select_a_points").hide('slow');
			}
		});
		$("#option_permit_anon_view_ips").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_anon_view_ips_points").show('slow');
			}
			else {
				$("#permit_anon_view_ips_points").hide('slow');
			}
		});
		$("#option_permit_view_voters_flaggers").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_view_voters_flaggers_points").fadeIn('slow');
			}
			else {
				$("#permit_view_voters_flaggers_points").hide('slow');
			}
		});
		$("#option_permit_flag").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_flag_points").fadeIn('slow');
			}
			else {
				$("#permit_flag_points").hide('slow');
			}
		});
		$("#option_permit_moderate").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_moderate_points").fadeIn('slow');
			}
			else {
				$("#permit_moderate_points").hide('slow');
			}
		});
		$("#option_permit_hide_show").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_hide_show").fadeIn('slow');
			}
			else {
				$("#permit_hide_show").hide('slow');
			}
		});
		$("#option_permit_delete_hidden").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_delete_hidden_points").fadeIn('slow');
			}
			else {
				$("#permit_delete_hidden_points").hide('slow');
			}
		});
		$("#option_permit_post_wall").change(function(){
			var current_val = $(this).val();
			if(current_val==106 || current_val==104 || current_val==102){
				$("#permit_post_wall_points").fadeIn('slow');
			}
			else {
				$("#permit_post_wall_points").hide('slow');
			}
		});

		// This is default selection....
		if($("#option_permit_view_q_page").val()<150){
			$("#allow_view_q_bots").fadeIn('slow');
		}
		if(($("#option_permit_post_q").val()==106) || ($("#option_permit_post_q").val()==104) || ($("#option_permit_post_q").val()==102)){
			$("#permit_post_q_points").fadeIn('slow');
		}
		if(($("#option_permit_post_a").val()==106) || ($("#option_permit_post_a").val()==104) || ($("#option_permit_post_a").val()==102)){
			$("#permit_post_a_points").fadeIn('slow');
		}
		if(($("#option_permit_post_c").val()==106) || ($("#option_permit_post_c").val()==104) || ($("#option_permit_post_c").val()==102)){
			$("#permit_post_c_points").fadeIn('slow');
		}
		if(($("#option_permit_vote_q").val()==106) || ($("#option_permit_vote_q").val()==104) || ($("#option_permit_vote_q").val()==102)){
			$("#permit_vote_q_points").fadeIn('slow');
		}
		if(($("#option_permit_vote_a").val()==106) || ($("#option_permit_vote_a").val()==104) || ($("#option_permit_vote_a").val()==102)){
			$("#permit_vote_a_points").fadeIn('slow');
		}
		if(($("#option_permit_vote_down").val()==106) || ($("#option_permit_vote_down").val()==104) || ($("#option_permit_vote_down").val()==102)){
			$("#permit_vote_down_points").fadeIn('slow');
		}
		if(($("#option_permit_retag_cat").val()==106) || ($("#option_permit_retag_cat").val()==104) || ($("#option_permit_retag_cat").val()==102)){
			$("#permit_retag_cat_points").fadeIn('slow');
		}
		if(($("#option_permit_edit_q").val()==106) || ($("#option_permit_edit_q").val()==104) || ($("#option_permit_edit_q").val()==102)){
			$("#permit_edit_q_points").fadeIn('slow');
		}
		if(($("#option_permit_edit_a").val()==106) || ($("#option_permit_edit_a").val()==104) || ($("#option_permit_edit_a").val()==102)){
			$("#permit_edit_a_points").fadeIn('slow');
		}
		if(($("#option_permit_edit_c").val()==106) || ($("#option_permit_edit_c").val()==104) || ($("#option_permit_edit_c").val()==102)){
			$("#permit_edit_c_points").fadeIn('slow');
		}
		if(($("#option_permit_edit_silent").val()==106) || ($("#option_permit_edit_silent").val()==104) || ($("#option_permit_edit_silent").val()==102)){
			$("#permit_edit_silent_points").fadeIn('slow');
		}
		if(($("#option_permit_close_q").val()==106) || ($("#option_permit_close_q").val()==104) || ($("#option_permit_close_q").val()==102)){
			$("#permit_close_q_points").fadeIn('slow');
		}
		if(($("#option_permit_select_a").val()==106) || ($("#option_permit_select_a").val()==104) || ($("#option_permit_select_a").val()==102)){
			$("#permit_select_a_points").fadeIn('slow');
		}
		if(($("#option_permit_anon_view_ips").val()==106) || ($("#option_permit_anon_view_ips").val()==104) || ($("#option_permit_anon_view_ips").val()==102)){
			$("#permit_anon_view_ips_points").fadeIn('slow');
		}
		if(($("#option_permit_view_voters_flaggers").val()==106) || ($("#option_permit_view_voters_flaggers").val()==104) || ($("#option_permit_view_voters_flaggers").val()==102)){
			$("#permit_view_voters_flaggers_points").fadeIn('slow');
		}
		if(($("#option_permit_flag").val()==106) || ($("#option_permit_flag").val()==104) || ($("#option_permit_flag").val()==102)){
			$("#permit_flag_points").fadeIn('slow');
		}
		if(($("#option_permit_moderate").val()==106) || ($("#option_permit_moderate").val()==104) || ($("#option_permit_moderate").val()==102)){
			$("#permit_moderate_points").fadeIn('slow');
		}
		if(($("#option_permit_hide_show").val()==106) || ($("#option_permit_hide_show").val()==104) || ($("#option_permit_hide_show").val()==102)){
			$("#permit_hide_show").fadeIn('slow');
		}
		if(($("#option_permit_delete_hidden").val()==106) || ($("#option_permit_delete_hidden").val()==104) || ($("#option_permit_delete_hidden").val()==102)){
			$("#permit_delete_hidden_points").fadeIn('slow');
		}
		if(($("#option_permit_post_wall").val()==106) || ($("#option_permit_post_wall").val()==104) || ($("#option_permit_post_wall").val()==102)){
			$("#permit_post_wall_points").fadeIn('slow');
		}
		
		
		
		
		
		
		
	});
</script>
	</div>
</div>
@stop
