@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Lists </h1>
	<div class="qa-part-form">
		@if(isset($list))
			<!--<form onsubmit="document.forms.admin_form.has_js.value=1; return true;" name="admin_form" action="./index.php?qa=admin&amp;qa_1=lists" method="post">-->
				{{ Form::model($list, ['url' => 'admin/doList', 'method' => 'post']) }}
				<table class="qa-form-wide-table">
					<tbody>					
					@if(Session::get('success'))
					<tr>
						<td class="qa-form-wide-ok" colspan="3">
							{{Session::get('success')}}
						</td>
					</tr>
					@endif
					<tr id="page_size_home">
						<td class="qa-form-wide-label">
							<!--Length of Q&amp;A page:-->
                           {{ Form::label('Length_of_QA_page', 'Length of Q&amp;A page:') }}                           
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_home" name="option_page_size_home">-->
                     		{{ Form::text('option_page_size_home', Input::old('option_page_size_home'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_home')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_home') }}</div> @endif

							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr id="page_size_activity">
						<td class="qa-form-wide-label">
							<!--Length of All Activity page:-->
                    		{{ Form::label('Length_of_All_Activity_page', 'Length of All Activity page:') }}

						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_activity" name="option_page_size_activity">-->
                            {{ Form::text('option_page_size_activity', Input::old('option_page_size_activity'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_activity')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_activity') }}</div> @endif
							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr id="page_size_qs">
						<td class="qa-form-wide-label">
							<!--Length of Questions page:-->
            				{{ Form::label('Length_of_Questions_page', 'Length of Questions page:') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_qs" name="option_page_size_qs">-->
                            {{ Form::text('option_page_size_qs', Input::old('option_page_size_qs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_qs') }}</div> @endif
							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr id="page_size_hot_qs">
						<td class="qa-form-wide-label">
							<!--Length of Hot! page:-->
                  			{{ Form::label('Length_of_Hot!_page', 'Length of Hot! page') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_hot_qs" name="option_page_size_hot_qs">-->
	                        {{ Form::text('option_page_size_hot_qs', Input::old('option_page_size_hot_qs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_hot_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_hot_qs') }}</div> @endif
							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr id="page_size_una_qs">
						<td class="qa-form-wide-label">
							<!--Length of Unanswered page:-->
                   			{{ Form::label('Length_of_Unanswered_page', 'Length of Unanswered page') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_una_qs" name="option_page_size_una_qs">-->
                            {{ Form::text('option_page_size_una_qs', Input::old('option_page_size_una_qs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_una_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_una_qs') }}</div> @endif
							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr id="page_size_tag_qs">
						<td class="qa-form-wide-label">
							<!--Questions on each tag page:-->
                     		{{ Form::label('Questions_on_each_tag_page', 'Questions on each tag page') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_tag_qs" name="option_page_size_tag_qs">-->
                         	{{ Form::text('option_page_size_tag_qs', Input::old('option_page_size_tag_qs'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_tag_qs')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_tag_qs') }}</div> @endif
							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-spacer" colspan="3">&nbsp;</td>
					</tr>
					<tr id="page_size_tags">
						<td class="qa-form-wide-label">
							<!--Length of Tags page:-->
                  			{{ Form::label('Length_of_Tags_page', 'Length of Tags page') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="30" id="option_page_size_tags" name="option_page_size_tags">-->
                         	{{ Form::text('option_page_size_tags', Input::old('option_page_size_tags'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_tags')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_tags') }}</div> @endif
							<span class="qa-form-wide-note"> (max 200)</span>
						</td>
					</tr>
					<tr id="columns_tags">
						<td class="qa-form-wide-label">
							Columns on Tags page:
						</td>
						<td class="qa-form-wide-data">
							<select class="qa-form-wide-select" id="option_columns_tags" name="option_columns_tags">
								<option value="1">1</option>
								<option value="2">2</option>
								<option selected="" value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</td>
					</tr>
					<tr id="page_size_users">
						<td class="qa-form-wide-label">
							<!--Length of Users page:-->
                			{{ Form::label('Length_of_Users_page', 'Length of Users page') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="20" id="option_page_size_users" name="option_page_size_users">-->
                            {{ Form::text('option_page_size_users', Input::old('option_page_size_users'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_users')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_users') }}</div> @endif
							<span class="qa-form-wide-note"> (max 200)</span>
						</td>
					</tr>
					<tr id="columns_users">
						<td class="qa-form-wide-label">
							Columns on Users page:
						</td>
						<td class="qa-form-wide-data">
							<select class="qa-form-wide-select" id="option_columns_users" name="option_columns_users">
								<option value="1">1</option>
								<option selected="" value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-spacer" colspan="3">&nbsp;
							
						</td>
					</tr>
					<tr id="search_module">
						<td class="qa-form-wide-label">
							Use search module:
						</td>
						<td class="qa-form-wide-data">
							<select class="qa-form-wide-select" id="option_search_module" name="option_search_module">
								<option selected="" value="">Default</option>
							</select>
						</td>
					</tr>
					<tr id="page_size_search">
						<td class="qa-form-wide-label">
							<!--Search results per page:-->
                      {{ Form::label('Search_results_per_page', 'Search results per page') }}

                            
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="10" id="option_page_size_search" name="option_page_size_search">-->
                            {{ Form::text('option_page_size_search', Input::old('option_page_size_search'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_page_size_search')) <div class="qa-form-tall-error">{{ $errors->first('option_page_size_search') }}</div> @endif
							<span class="qa-form-wide-note"> (max 50)</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-spacer" colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							Relative importance for question hotness:
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-static"></span>
						</td>
					</tr>
					<tr id="hot_weight_q_age">
						<td class="qa-form-wide-label">
							<!--&ndash; Question is new:-->
                             {{ Form::label('Question_is_new', 'Question is new') }}

						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="100" id="option_hot_weight_q_age" name="option_hot_weight_q_age">-->
                            {{ Form::text('option_hot_weight_q_age', Input::old('option_hot_weight_q_age'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_hot_weight_q_age')) <div class="qa-form-tall-error">{{ $errors->first('option_hot_weight_q_age') }}</div> @endif
							<span class="qa-form-wide-note">/ 100</span>
						</td>
					</tr>
					<tr id="hot_weight_a_age">
						<td class="qa-form-wide-label">
							<!--&ndash; Question has a new answer:-->
                            {{ Form::label('Question_has_a_new_answer', 'Question has a new answer') }}

						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="100" id="option_hot_weight_a_age" name="option_hot_weight_a_age">-->
	                        {{ Form::text('option_hot_weight_a_age', Input::old('option_hot_weight_a_age'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_hot_weight_a_age')) <div class="qa-form-tall-error">{{ $errors->first('option_hot_weight_a_age') }}</div> @endif
							<span class="qa-form-wide-note">/ 100</span>
						</td>
					</tr>
					<tr id="hot_weight_answers">
						<td class="qa-form-wide-label">
							<!--&ndash; Question has many answers:-->
                     		{{ Form::label('Question_has_many_answers', 'Question has many answers') }}
						</td>
						<td class="qa-form-wide-data">
								<!--<input type="text" class="qa-form-wide-number" value="100" id="option_hot_weight_answers" name="option_hot_weight_answers">-->
	                            {{ Form::text('option_hot_weight_answers', Input::old('option_hot_weight_answers'),array('class'=>'qa-form-wide-number')) }}
								@if ($errors->has('option_hot_weight_answers')) <div class="qa-form-tall-error">{{ $errors->first('option_hot_weight_answers') }}</div> @endif
								<span class="qa-form-wide-note">/ 100</span>
						</td>
					</tr>
					<tr id="hot_weight_votes">
						<td class="qa-form-wide-label">
							<!--&ndash; Question has many up votes:-->
         					{{ Form::label(' Question_has_many_up_votes', ' Question has many up votes') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="100" id="option_hot_weight_votes" name="option_hot_weight_votes">-->
                         	{{ Form::text('option_hot_weight_votes', Input::old('option_hot_weight_votes'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_hot_weight_votes')) <div class="qa-form-tall-error">{{ $errors->first('option_hot_weight_votes') }}</div> @endif
							<span class="qa-form-wide-note">/ 100</span>
						</td>
					</tr>
					<tr id="hot_weight_views">
						<td class="qa-form-wide-label">
							<!--&ndash; Question has many views:-->
          					{{ Form::label(' Question_has_many_views', ' Question has many views') }}
						</td>
						<td class="qa-form-wide-data">
							<!--<input type="text" class="qa-form-wide-number" value="100" id="option_hot_weight_views" name="option_hot_weight_views">-->
	                        {{ Form::text('option_hot_weight_views', Input::old('option_hot_weight_views'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_hot_weight_views')) <div class="qa-form-tall-error">{{ $errors->first('option_hot_weight_views') }}</div> @endif
							<span class="qa-form-wide-note">/ 100</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-buttons" colspan="3">
							<input type="submit" class="qa-form-wide-button qa-form-wide-button-save" title="" value="Save Options" id="dosaveoptions">
							<input type="submit" class="qa-form-wide-button qa-form-wide-button-reset" title="" value="Reset to Defaults" name="doresetoptions">
						</td>
					</tr>
				</tbody></table>				
			{{ Form::close() }}
		@endif
		</div>
</div>
@stop
