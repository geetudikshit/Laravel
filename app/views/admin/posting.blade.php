@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1> Administration center - Posting </h1>
	<div class="qa-part-form">
		@if(isset($posting))
		{{ Form::model($posting, ['url' => 'admin/doPosting', 'method' => 'post']) }}
		<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=posting" method="post">-->
			<table class="qa-form-wide-table">
				<tbody>
				@if(Session::get('success'))
				<tr>
					<td class="qa-form-wide-ok" colspan="3">
						{{Session::get('success')}}
					</td>
				</tr>
				@endif
				<tr id="do_close_on_select">
					<td class="qa-form-wide-label">
						<!--Close questions with a selected answer:-->
         				{{ Form::label('Close_questions_with_a_selected_answer','Close questions with a selected answer:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_do_close_on_select" name="option_do_close_on_select">-->
                        {{ Form::checkbox('option_do_close_on_select', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_do_close_on_select']) }}
					</td>
				</tr>
				<tr id="allow_close_questions">
					<td class="qa-form-wide-label">
						<!--Allow questions to be manually closed:-->
           				{{ Form::label('Allow_questions_to_be_manually_closed','Allow questions to be manually closed:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_close_questions" name="option_allow_close_questions">-->
                        {{ Form::checkbox('option_allow_close_questions', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_close_questions']) }}
					</td>
				</tr>
				<tr id="allow_self_answer">
					<td class="qa-form-wide-label">
						<!--Allow users to answer their own question:-->
      					{{ Form::label('Allow_users_to_answer_their_own_question','Allow users to answer their own question:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_self_answer" name="option_allow_self_answer">-->
                        {{ Form::checkbox('option_allow_self_answer', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_self_answer']) }}
					</td>
				</tr>
				<tr id="allow_multi_answers">
					<td class="qa-form-wide-label">
						<!--Allow multiple answers per user:-->
                        {{ Form::label('Allow_multiple_answers_per_user','Allow multiple answers per user:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_allow_multi_answers" name="option_allow_multi_answers">-->
                        {{ Form::checkbox('option_allow_multi_answers', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_multi_answers']) }}
					</td>
				</tr>
				<tr id="follow_on_as">
					<td class="qa-form-wide-label">
						<!--Allow questions to be related to answers:-->
                       {{ Form::label('Allow_questions_to_be_related_to_answers','Allow questions to be related to answers:') }}</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_follow_on_as" name="option_follow_on_as">-->
                        {{ Form::checkbox('option_allow_multi_answers', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_allow_multi_answers']) }}
					</td>
				</tr>
				<!--<tr id="comment_on_qs">
					<td class="qa-form-wide-label">
						<!--Allow comments on questions:
                        {{ Form::label('Allow_comments_on_questions','Allow comments on questions:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_comment_on_qs" name="option_comment_on_qs">>
                         {{ Form::checkbox('option_comment_on_qs', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_comment_on_qs']) }}
					</td>
				</tr>-->
				<tr id="comment_on_as">
					<td class="qa-form-wide-label">
						<!--Allow comments on answers:-->
                       {{ Form::label('Allow_comments_on_answers','Allow comments on answers:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_comment_on_as" name="option_comment_on_as">-->
                         {{ Form::checkbox('option_comment_on_as', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_comment_on_as']) }}
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-spacer" colspan="3">&nbsp;
					</td>
				</tr>
				<tr id="editor_for_qs">
					<td class="qa-form-wide-label">
						<!--Default editor for questions:-->
               			{{ Form::label('Default_editor_for_questions','Default editor for questions:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<select class="qa-form-wide-select" id="option_editor_for_qs" name="option_editor_for_qs">
							<option value="">Basic Editor</option>
							<option selected="" value="WYSIWYG Editor">WYSIWYG Editor</option>
						</select>-->
                         {{ Form::select('option_editor_for_qs', [ '' => 'Basic Editor', 'WYSIWYG Editor' => 'WYSIWYG Editor'], null, ['class' => 'qa-form-wide-select','id'=>'option_editor_for_qs']) }}
					</td>
				</tr>
				<!--
				<tr id="editor_for_as">
					<td class="qa-form-wide-label">
						Default editor for answers:
                 		{{ Form::label('Default_editor_for_answers','Default editor for answers:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<select class="qa-form-wide-select" id="option_editor_for_as" name="option_editor_for_as">
							<option value="">Basic Editor</option>
							<option selected="" value="WYSIWYG Editor">WYSIWYG Editor</option>
						</select>
                        {{ Form::select('option_editor_for_as', [ '' => 'Basic Editor', 'WYSIWYG Editor' => 'WYSIWYG Editor'], null, ['class' => 'qa-form-wide-select','id'=>'option_editor_for_as']) }}
					</td>
				</tr>
				<tr id="editor_for_cs">
					<td class="qa-form-wide-label">
						<!--Default editor for comments:
                     {{ Form::label('Default_editor_for_comments','Default editor for comments:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<select class="qa-form-wide-select" id="option_editor_for_cs" name="option_editor_for_cs">
							<option selected="" value="">Basic Editor</option>
							<option value="WYSIWYG Editor">WYSIWYG Editor</option>
						</select>
                        {{ Form::select('option_editor_for_cs', ['' => 'Basic Editor', 'WYSIWYG Editor' => 'WYSIWYG Editor'], null, ['class' => 'qa-form-wide-select','id'=>'option_editor_for_cs']) }}
					</td>
				</tr>
				-->
				<tr>
					<td class="qa-form-wide-spacer" colspan="3">&nbsp;
						
					</td>
				</tr>
				</tbody><tbody id="show_custom_ask">
					<tr>
						<td colspan="3" class="qa-form-tall-label">
							<label>
								<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_show_custom_ask" name="option_show_custom_ask">-->
                                 {{ Form::checkbox('option_show_custom_ask', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_custom_ask']) }}
								<!--Custom message on ask form - HTML allowed:-->
                       			{{ Form::label('Custom_message_on_ask_form_-_HTML_allowed','Custom message on ask form - HTML allowed:') }}
							</label>
						</td>
					</tr>
				</tbody>
				<tbody id="custom_ask" style="display: none;">
					<tr>
						<td colspan="3" class="qa-form-tall-data">
							<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_custom_ask" name="option_custom_ask"></textarea>-->
                            {{ Form::textarea('option_custom_ask', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_custom_ask']) }}
						</td>
					</tr>
				</tbody>
				<tbody id="extra_field_active">
					<tr>
						<td colspan="3" class="qa-form-tall-label">
							<label>
								<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_extra_field_active" name="option_extra_field_active">-->
                             {{ Form::checkbox('option_extra_field_active', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_extra_field_active']) }}  
								<!--Custom field for extra information on ask form:-->
                                {{ Form::label('Custom_field_for_extra_information_on_ask_form','Custom field for extra information on ask form:') }}
							</label>
						</td>
					</tr>
				</tbody>
				<tbody id="extra_field_prompt" style="display: none;">
					<tr>
						<td colspan="3" class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="" id="option_extra_field_prompt" name="option_extra_field_prompt">-->
                            {{ Form::text('option_extra_field_prompt', Input::old('option_extra_field_prompt'),array('class'=>'qa-form-tall-text')) }}
							@if ($errors->has('option_extra_field_prompt')) <div class="qa-form-tall-error">{{ $errors->first('option_extra_field_prompt') }}</div> @endif
						</td>
					</tr>
				</tbody>
				<tbody id="extra_field_display" style="display: none;">
					<tr>
						<td colspan="3" class="qa-form-tall-label">
							<label>
								<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_extra_field_display" name="option_extra_field_display">-->
                                 {{ Form::checkbox('option_extra_field_display', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_extra_field_display']) }}  
								<span style="" id="extra_field_label_hidden">Show the extra information on question pages</span><span id="extra_field_label_shown" style="display: none;">Show the extra information on question pages with label:</span>
							</label>
						</td>
					</tr>
				</tbody>
				<tbody id="extra_field_label" style="display: none;">
					<tr>
						<td colspan="3" class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="" id="option_extra_field_label" name="option_extra_field_label">-->
                            {{ Form::text('option_extra_field_label', Input::old('option_extra_field_label'),array('class'=>'qa-form-tall-text')) }}
							@if ($errors->has('option_extra_field_label')) <div class="qa-form-tall-error">{{ $errors->first('option_extra_field_label') }}</div> @endif
						</td>
					</tr>
				</tbody>
				<tbody id="show_custom_answer">
					<tr>
						<td colspan="3" class="qa-form-tall-label">
							<label>
								<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_show_custom_answer" name="option_show_custom_answer">-->
                                 {{ Form::checkbox('option_show_custom_answer', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_custom_answer']) }}
								<!--Custom message on answer form - HTML allowed:-->
                               {{ Form::label('Custom_message_on_answer_form_-_HTML_allowed','Custom message on answer form - HTML allowed:') }}  
							</label>
						</td>
					</tr>
				</tbody>
				<tbody id="custom_answer" style="display: none;">
					<tr>
						<td colspan="3" class="qa-form-tall-data">
							<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_custom_answer" name="option_custom_answer"></textarea>-->
                             {{ Form::textarea('option_custom_answer', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_custom_answer']) }}
						</td>
					</tr>
				</tbody>
				<tbody id="show_custom_comment">
					<tr>
						<td colspan="3" class="qa-form-tall-label">
							<label>
								<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" id="option_show_custom_comment" name="option_show_custom_comment">-->
                                 {{ Form::checkbox('option_show_custom_comment', 1, null, ['class' => 'qa-form-tall-checkbox' , 'id' => 'option_show_custom_comment']) }}
								<!--Custom message on comment form - HTML allowed:-->
                                 {{ Form::label('Custom_message_on_comment_form_-_HTML_allowed','Custom message on comment form - HTML allowed:') }}
							</label>
						</td>
					</tr>
				</tbody>
				<tbody id="custom_comment" style="display: none;">
					<tr>
						<td colspan="3" class="qa-form-tall-data">
							<!--<textarea class="qa-form-tall-text" cols="40" rows="3" id="option_custom_comment" name="option_custom_comment"></textarea>-->
                            {{ Form::textarea('option_custom_comment', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_custom_comment']) }}
						</td>
					</tr>
				</tbody>
				<tbody><tr>
					<td class="qa-form-wide-spacer" colspan="3">&nbsp;
					</td>
				</tr>
				<tr id="min_len_q_title">
					<td class="qa-form-wide-label">
						<!--Minimum length of question title:-->
                   {{ Form::label('Minimum_length_of_question_title','Minimum length of question title:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="12" id="option_min_len_q_title" name="option_min_len_q_title">-->
                         {{ Form::text('option_min_len_q_title', Input::old('option_min_len_q_title'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_min_len_q_title')) <div class="qa-form-tall-error">{{ $errors->first('option_min_len_q_title') }}</div> @endif
						<span class="qa-form-wide-note">characters</span>
					</td>
				</tr>
				<tr id="max_len_q_title">
					<td class="qa-form-wide-label">
						<!--Maximum length of question title:-->
               			{{ Form::label('Maximum_length_of_question_title','Maximum length of question title:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="120" id="option_max_len_q_title" name="option_max_len_q_title">-->
                        {{ Form::text('option_max_len_q_title', Input::old('option_max_len_q_title'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_len_q_title')) <div class="qa-form-tall-error">{{ $errors->first('option_max_len_q_title') }}</div> @endif
						<span class="qa-form-wide-note"> (max 800)</span>
					</td>
				</tr>
				<tr id="min_len_q_content">
					<td class="qa-form-wide-label">
						<!--Minimum length of question body:-->
                      {{ Form::label('Minimum length of question body','Minimum length of question body:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="0" id="option_min_len_q_content" name="option_min_len_q_content">-->
                        {{ Form::text('option_min_len_q_content', Input::old('option_min_len_q_content'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_min_len_q_content')) <div class="qa-form-tall-error">{{ $errors->first('option_min_len_q_content') }}</div> @endif
						<span class="qa-form-wide-note">characters</span>
					</td>
				</tr>
				<tr id="min_num_q_tags">
					<td class="qa-form-wide-label">
						<!--Minimum number of tags:-->
                		{{ Form::label('Minimum_number_of_tags','Minimum number of tags:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="0" id="option_min_num_q_tags" name="option_min_num_q_tags">-->
                        {{ Form::text('option_min_num_q_tags', Input::old('option_min_num_q_tags'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_min_num_q_tags')) <div class="qa-form-tall-error">{{ $errors->first('option_min_num_q_tags') }}</div> @endif
						<span class="qa-form-wide-note"> tags</span>
					</td>
				</tr>
				<tr id="max_num_q_tags">
					<td class="qa-form-wide-label">
						<!--Maximum number of tags:-->
                          {{ Form::label('Maximum_number_of_tags','Maximum number of tags:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="5" id="option_max_num_q_tags" name="option_max_num_q_tags">-->
                         {{ Form::text('option_max_num_q_tags', Input::old('option_max_num_q_tags'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_max_num_q_tags')) <div class="qa-form-tall-error">{{ $errors->first('option_max_num_q_tags') }}</div> @endif
						<span class="qa-form-wide-note"> tags</span>
					</td>
				</tr>
				<tr id="tag_separator_comma">
					<td class="qa-form-wide-label">
						<!--Use comma as the only tag separator:-->
                {{ Form::label('Use_comma_as_the_only_tag_separator','Use comma as the only tag separator:') }}					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_tag_separator_comma" name="option_tag_separator_comma">-->
                        {{ Form::checkbox('option_tag_separator_comma', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_tag_separator_comma']) }}
					</td>
				</tr>
				<tr id="min_len_a_content">
					<td class="qa-form-wide-label">
						<!--Minimum length of answer:-->
               {{ Form::label('Minimum_length_of_answer','Minimum length of answer:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="12" id="option_min_len_a_content" name="option_min_len_a_content">-->
                        {{ Form::text('option_min_len_a_content', Input::old('option_min_len_a_content'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_min_len_a_content')) <div class="qa-form-tall-error">{{ $errors->first('option_min_len_a_content') }}</div> @endif
						<span class="qa-form-wide-note">characters</span>
					</td>
				</tr>
				<tr id="min_len_c_content">
					<td class="qa-form-wide-label">
						<!--Minimum length of comment:-->
                                    {{ Form::label('Minimum_length_of_comment','Minimum length of comment:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="12" id="option_min_len_c_content" name="option_min_len_c_content">-->
                        {{ Form::text('option_min_len_c_content', Input::old('option_min_len_c_content'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_min_len_c_content')) <div class="qa-form-tall-error">{{ $errors->first('option_min_len_c_content') }}</div> @endif
						<span class="qa-form-wide-note">characters</span>
					</td>
				</tr>
				<tr id="notify_users_default">
					<td class="qa-form-wide-label">
						<!--Check email notification box by default:-->
             			{{ Form::label('Check_email_notification_box_by_default','Check email notification box by default:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_notify_users_default" name="option_notify_users_default">-->
                         {{ Form::checkbox('option_notify_users_default', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_notify_users_default']) }}
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-spacer" colspan="3">&nbsp;
						
					</td>
				</tr>
				</tbody><tbody id="block_bad_words">
					<tr>
						<td colspan="3" class="qa-form-tall-label">
							<!--Censored words - separate by spaces or commas:-->
                           {{ Form::label('Censored_words_-_separate_by_spaces_or_commas','Censored words - separate by spaces or commas:') }}
						</td>
					</tr>
					<tr>
						<td colspan="3" class="qa-form-tall-data">
							<!--<textarea class="qa-form-tall-text" cols="40" rows="4" id="option_block_bad_words" name="option_block_bad_words"></textarea>-->
                            {{ Form::textarea('option_block_bad_words', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>3,'id'=>'option_block_bad_words']) }}
							<div class="qa-form-tall-note">Use a * to match any letters. Examples: doh (will only match exact word doh) , doh* (will match doh or dohno) , do*h (will match doh, dooh, dough).</div>
						</td>
					</tr>
				</tbody>
				<tbody><tr>
					<td class="qa-form-wide-spacer" colspan="3">&nbsp;
					</td>
				</tr>
				<tr id="do_ask_check_qs">
					<td class="qa-form-wide-label">
						<!--Check for similar questions when asking:-->
                        {{ Form::label('Censored_words_-_separate_by_spaces_or_commas','Censored words - separate by spaces or commas:') }}
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_do_ask_check_qs" name="option_do_ask_check_qs">-->
                        {{ Form::checkbox('option_do_ask_check_qs', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_do_ask_check_qs']) }}
					</td>
				</tr>
				<tr id="match_ask_check_qs" style="display: none;">
					<td class="qa-form-wide-label">
						<!--Similar questions matching:-->
                        {{ Form::label('Similar_questions_matching','Similar questions matching:') }}

					</td>
					<td class="qa-form-wide-data">
						<!--<select class="qa-form-wide-select" id="option_match_ask_check_qs" name="option_match_ask_check_qs">
							<option value="5">Widest</option>
							<option value="4">Wider</option>
							<option selected="" value="3">Default</option>
							<option value="2">Narrower</option>
							<option value="1">Narrowest</option>
						</select>-->
                         {{ Form::select('option_match_ask_check_qs', [5 => 'Widest', 4 => 'Wider', 3 => 'Default', 2 => 'Narrower', 1 => 'Narrowest'], null, ['class' => 'qa-form-wide-select','id'=>'option_match_ask_check_qs']) }}
					</td>
				</tr>
				<tr id="page_size_ask_check_qs" style="display: none;">
					<td class="qa-form-wide-label">
						<!--Maximum similar questions to show:-->
      					{{ Form::label('Maximum_similar_questions_to_show','Maximum similar questions to show:') }}					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="5" id="option_page_size_ask_check_qs" name="option_page_size_ask_check_qs">-->
                        {{ Form::text('option_page_size_ask_check_qs', Input::old('option_page_size_ask_check_qs'),array('class'=>'qa-form-wide-number')) }}
						@if ($errors->has('option_page_size_ask_check_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_ask_check_qs') }}</div> @endif
						<span class="qa-form-wide-note"> (max 50)</span>
					</td>
				</tr>
				<tr>
					<td class="qa-form-wide-spacer" colspan="3">&nbsp;
					</td>
				</tr>
				<tr id="do_example_tags">
					<td class="qa-form-wide-label">
						<!--Show example tags based on question:-->
                    {{ Form::label('Maximum_similar_questions_to_show','Maximum similar questions to show:') }}					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_do_example_tags" name="option_do_example_tags">-->
                     	{{ Form::checkbox('option_do_example_tags', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_do_example_tags']) }}
					</td>
				</tr>
				<tr id="match_example_tags">
					<td class="qa-form-wide-label">
						<!--Example tags matching:-->
                         {{ Form::label('Example_tags_matching','Example tags matching:') }}					</td>
					</td>
					<td class="qa-form-wide-data">
						<!--<select class="qa-form-wide-select" id="option_match_example_tags" name="option_match_example_tags">
							<option value="5">Widest</option>
							<option value="4">Wider</option>
							<option selected="" value="3">Default</option>
							<option value="2">Narrower</option>
							<option value="1">Narrowest</option>
						</select> -->
						{{ Form::select('option_match_example_tags', [5 => 'Widest', 4 => 'Wider', 3 => 'Default', 2 => 'Narrower', 1 => 'Narrowest'], null, ['class' => 'qa-form-wide-select','id'=>'option_match_example_tags']) }}
					</td>
				</tr>
				<tr id="do_complete_tags">
					<td class="qa-form-wide-label">
						<!--Show matching tags while typing:-->
                         {{ Form::label('Show_matching_tags_while_typing','Show matching tags while typing:') }}					</td>
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_do_complete_tags" name="option_do_complete_tags">-->
                        {{ Form::checkbox('option_do_complete_tags', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_do_complete_tags']) }}
					</td>
				</tr>
				<tr id="page_size_ask_tags">
					<td class="qa-form-wide-label">
						<!--Maximum tag hints to show:-->
                         {{ Form::label('Maximum_tag_hints_to_show','Maximum tag hints to show:') }}					</td>
					</td>
					<td class="qa-form-wide-data">
						<!--<input type="text" class="qa-form-wide-number" value="5" id="option_page_size_ask_tags" name="option_page_size_ask_tags">-->
                         {{ Form::text('option_page_size_ask_tags', Input::old('option_page_size_ask_tags'),array('class'=>'qa-form-wide-number')) }}
						@if ($errors->has('option_page_size_ask_tags')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_ask_tags') }}</div> @endif
						<span class="qa-form-wide-note"> (max 50)</span>
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