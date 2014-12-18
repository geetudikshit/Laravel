@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1> Administration center - Viewing </h1>
	<div class="qa-part-form">
		@if(isset($viewing))
		{{ Form::model($viewing, ['url' => 'admin/doViewing', 'method' => 'post']) }}
		<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=viewing" method="post">-->
		<table class="qa-form-wide-table">
			<tbody>
			@if(Session::get('success'))
			<tr>
				<td class="qa-form-wide-ok" colspan="3">
					{{Session::get('success')}}
				</td>
			</tr>
			@endif
			<tr id="q_urls_title_length">
				<td class="qa-form-wide-label">
					<!--Question title length in URLs:-->
    				{{ Form::label('Question_title_length_in_URLs','Question title length in URLs:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-number" value="50" id="option_q_urls_title_length" name="option_q_urls_title_length">-->
                    {{ Form::text('option_q_urls_title_length', Input::old('option_q_urls_title_length'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_q_urls_title_length')) <div class="qa-form-tall-error">{{ $errors->first('option_q_urls_title_length') }}</div> @endif
					<span class="qa-form-wide-note">characters</span>
				</td>
			</tr>
			<tr id="q_urls_remove_accents">
				<td class="qa-form-wide-label">
					<!--Remove accents from question URLs:-->
  					{{ Form::label('Remove_accents_from_question_URLs','Remove accents from question URLs:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_q_urls_remove_accents" name="option_q_urls_remove_accents">-->
                    {{ Form::checkbox('option_q_urls_remove_accents', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_q_urls_remove_accents']) }} 
				</td>
			</tr>
			<tr id="do_count_q_views">
				<td class="qa-form-wide-label">
					<!--Count the number of question views:-->
					{{ Form::label('Count_the_number_of_question_views','Count the number of question views:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_do_count_q_views" name="option_do_count_q_views">--> 
                    {{ Form::checkbox('option_do_count_q_views', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_do_count_q_views']) }} 
				</td>
			</tr>
			<tr id="show_view_counts">
				<td class="qa-form-wide-label">
					<!--Show view count in question lists:-->
					{{ Form::label('Show_view_count_in_question_lists','Show view count in question lists:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_show_view_counts" name="option_show_view_counts">-->
                    {{ Form::checkbox('option_show_view_counts', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_view_counts']) }} 
				</td>
			</tr>
			<tr id="show_view_count_q_page">
				<td class="qa-form-wide-label">
					<!--Show view count on question:--> 
					{{ Form::label('Show_view_count_on_question','Show view count on question:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_show_view_count_q_page" name="option_show_view_count_q_page">-->
                    {{ Form::checkbox('option_show_view_count_q_page', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_view_count_q_page']) }} 
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-spacer" colspan="3">&nbsp;
				</td>
			</tr>
			<tr id="voting_on_qs">
				<td class="qa-form-wide-label">
					<!--Allow voting on questions:-->
      				{{ Form::label('Allow_voting_on_questions','Allow voting on questions:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_voting_on_qs" name="option_voting_on_qs">-->
                     {{ Form::checkbox('option_voting_on_qs', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_voting_on_qs']) }} 
				</td>
			</tr>
			<tr id="voting_on_q_page_only">
				<td class="qa-form-wide-label">
					<!--Allow voting on question page only:-->
 					{{ Form::label('Allow_voting_on_question_page_only','Allow voting on question page only:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_voting_on_q_page_only" name="option_voting_on_q_page_only">-->
                    {{ Form::checkbox('option_voting_on_q_page_only', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_voting_on_q_page_only']) }} 
				</td>
			</tr>
			<tr id="voting_on_as">
				<td class="qa-form-wide-label">
					<!--Allow voting on answers:-->
					{{ Form::label('Allow_voting_on_answers','Allow voting on answers:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_voting_on_as" name="option_voting_on_as">-->
                     {{ Form::checkbox('option_voting_on_as', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_voting_on_as']) }} 
				</td>
			</tr>
			<tr id="votes_separated">
				<td class="qa-form-wide-label">
					<!--Show separate up and down votes:-->
     				{{ Form::label('Show_separate_up_and_down_votes','Show separate up and down votes:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_votes_separated" name="option_votes_separated">-->
                    {{ Form::checkbox('option_votes_separated', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_votes_separated']) }} 
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-spacer" colspan="3">&nbsp;
				</td>
			</tr>
			<tr id="show_url_links">
				<td class="qa-form-wide-label">
					<!--Detect and link URLs in posts:-->
     				{{ Form::label('Detect_and_link_URLs_in_posts','Detect and link URLs in posts:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_show_url_links" name="option_show_url_links">-->
                    {{ Form::checkbox('option_show_url_links', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_url_links']) }} 
				</td>
			</tr>
			<tr id="links_in_new_window">
				<td class="qa-form-wide-label">
					<!--Open linked URLs in a new window:-->
   					{{ Form::label('Open_linked_URLs_in_a_new_window','Open linked URLs in a new window:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" value="1" id="option_links_in_new_window" name="option_links_in_new_window">-->
                    {{ Form::checkbox('option_links_in_new_window', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_links_in_new_window']) }} 
				</td>
			</tr>
			<tr id="show_when_created">
				<td class="qa-form-wide-label">
					<!--Show age of user posts:-->
					{{ Form::label('Open_linked_URLs_in_a_new_window','Open linked URLs in a new window:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_show_when_created" name="option_show_when_created">-->
                     {{ Form::checkbox('option_show_when_created', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_when_created']) }} 
				</td>
			</tr>
			<tr id="show_full_date_days">
				<td class="qa-form-wide-label">
					<!--Show full date after:-->
   					{{ Form::label('Show_full_date_after','Show full date after:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-number" value="7" id="option_show_full_date_days" name="option_show_full_date_days">-->
                     {{ Form::text('option_show_full_date_days', Input::old('option_show_full_date_days'),array('class'=>'qa-form-wide-number','id' => 'option_show_full_date_days')) }}
					<span class="qa-form-wide-note"> days</span>
				</td>
			</tr>
			<tr id="show_user_points">
				<td class="qa-form-wide-label">
					<!--Show points next to usernames:-->
 					{{ Form::label('Show_points_next_to_usernames','Show points next to usernames:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_show_user_points" name="option_show_user_points">-->
                    {{ Form::checkbox('option_show_user_points', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_user_points']) }} 
				</td>
			</tr>
			<tr>
				<td class="qa-form-wide-spacer" colspan="3">&nbsp;
				</td>
			</tr>
			<tr id="sort_answers_by">
				<td class="qa-form-wide-label">
					<!--Sort answers by:-->
 					{{ Form::label('Sort_answers_by','Sort answers by:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_sort_answers_by" name="option_sort_answers_by">
						<option selected="" value="created">Time</option>
						<option value="votes">Votes</option>
					</select>-->
                    {{ Form::select('option_sort_answers_by', ['created'=> 'Time', 'votes' => 'votes'], null, ['class' => 'qa-form-wide-select','id'=>'option_sort_answers_by']) }}
				</td>
			</tr>
			<tr id="show_selected_first">
				<td class="qa-form-wide-label">
					<!--Move selected answer to the top:-->
        			{{ Form::label('Move_selected_answer_to_the_top','Move selected answer to the top:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_show_selected_first" name="option_show_selected_first">-->
                     {{ Form::checkbox('option_show_selected_first', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_selected_first']) }} 
				</td>
			</tr>
			<tr id="page_size_q_as">
				<td class="qa-form-wide-label">
					<!--Maximum answers per page:-->
       				{{ Form::label('Maximum_answers_per_page','Maximum answers per page:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-number" value="10" id="option_page_size_q_as" name="option_page_size_q_as">-->
                     {{ Form::text('option_page_size_q_as', Input::old('option_page_size_q_as'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_page_size_q_as')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_q_as') }}</div> @endif
					<span class="qa-form-wide-note"> answers</span>
				</td>
			</tr>
			<tr id="show_a_form_immediate">
				<td class="qa-form-wide-label">
					<!--Show answer form immediately:-->
          			{{ Form::label('Show_answer_form_immediately','Show answer form immediately:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_show_a_form_immediate" name="option_show_a_form_immediate">
						<option value="always">Always</option>
						<option selected="" value="if_no_as">If no answers</option>
						<option value="never">Never</option>
					</select>-->
                    {{ Form::select('option_show_a_form_immediate', ['always' => 'Always','if_no_as' => 'If no answers', 'never' => 'Never'], null, ['class' => 'qa-form-wide-select','id'=>'option_show_a_form_immediate']) }}
				</td>
			</tr>
			<tr id="show_fewer_cs_from">
				<td class="qa-form-wide-label">
					<!--Partially hide comments if more than:-->
					{{ Form::label('Partially_hide_comments_if_more_than','Partially hide comments if more than:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-number" value="10" id="option_show_fewer_cs_from" name="option_show_fewer_cs_from">-->
                    {{ Form::text('option_show_fewer_cs_from', Input::old('option_show_fewer_cs_from'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_show_fewer_cs_from')) <div class="qa-form-tall-error">{{ $errors->first('option_show_fewer_cs_from') }}</div> @endif
					<span class="qa-form-wide-note"> comments</span>
				</td>
			</tr>
			<tr id="show_fewer_cs_count">
				<td class="qa-form-wide-label">
					<!--If partially hidden, show most recent:-->
					{{ Form::label('If_partially_hidden,_show_most_recent','If partially hidden, show most recent:') }}

				</td>
				<td class="qa-form-wide-data">
					<!--<input type="text" class="qa-form-wide-number" value="5" id="option_show_fewer_cs_count" name="option_show_fewer_cs_count">-->
                    {{ Form::text('option_show_fewer_cs_count', Input::old('option_show_fewer_cs_count'),array('class'=>'qa-form-wide-number')) }}
					@if ($errors->has('option_show_fewer_cs_count')) <div class="qa-form-tall-error">{{ $errors->first('option_show_fewer_cs_count') }}</div> @endif
					<span class="qa-form-wide-note"> comments</span>
				</td>
			</tr>
			<tr id="show_c_reply_buttons">
				<td class="qa-form-wide-label">
					<!--Show reply button on comments:-->
					{{ Form::label('If_partially_hidden,_show_most_recent','If partially hidden, show most recent:') }}
				</td>
				<td class="qa-form-wide-data">
					<!--<input type="checkbox" class="qa-form-wide-checkbox" checked="" value="1" id="option_show_c_reply_buttons" name="option_show_c_reply_buttons">-->
                    {{ Form::checkbox('option_show_c_reply_buttons', 1, null, ['class' => 'qa-form-wide-checkbox' , 'id' => 'option_show_c_reply_buttons']) }} 
				</td>
			</tr>
			<tr id="pages_prev_next">
				<td class="qa-form-wide-label">
					<!--Links to previous/next pages:-->
					{{ Form::label('Links_to_previous/next_pages','Links to previous/next pages:') }}

				</td>
				<td class="qa-form-wide-data">
					<!--<select class="qa-form-wide-select" id="option_pages_prev_next" name="option_pages_prev_next">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option selected="" value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>-->
                    {{ Form::select('option_pages_prev_next', [0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'], null, ['class' => 'qa-form-wide-select','id'=>'option_pages_prev_next']) }}
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
