@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Points </h1>
	<div class="qa-part-form">
		@if(isset($point))
			<!--<form onsubmit="document.forms.points_form.has_js.value=1; return true;" name="points_form" action="./index.php?qa=admin&amp;qa_1=points" method="post">-->
				{{ Form::model($point, ['url' => 'admin/dopoints', 'method' => 'post']) }}
				<table class="qa-form-wide-table">
					<tbody>					
					@if(Session::get('success'))
					<tr>
						<td class="qa-form-wide-ok" colspan="3">
							{{Session::get('success')}}
						</td>
					</tr>
					@endif
					<tr>
						<td class="qa-form-wide-label">
							<!--Posting a question:-->
							{{ Form::label('posting_a_question', 'Posting a question:') }}
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="2" name="option_points_post_q">-->
							{{ Form::text('option_points_post_q', Input::old('option_points_post_q'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_post_q')) <div class="qa-form-tall-error">{{ $errors->first('option_points_post_q') }}</div> @endif
							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Selecting an answer for your question:-->
                            {{ Form::label('Selecting_an_answer_for_your_question', 'Selecting an answer for your question:') }}
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="3" name="option_points_select_a"> -->
                            {{ Form::text('option_points_select_a', Input::old('option_points_select_a'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_select_a')) <div class="qa-form-tall-error">{{ $errors->first('option_points_select_a') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Per up vote on your question:-->
                           {{ Form::label('Per_up_vote_on_your_question', 'Per up vote on your question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">+</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="1" name="option_points_per_q_voted_up">-->
                              {{ Form::text('option_points_per_q_voted_up', Input::old('option_points_per_q_voted_up'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_per_q_voted_up')) <div class="qa-form-tall-error">{{ $errors->first('option_points_per_q_voted_up') }}</div> @endif
							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Per down vote on your question:-->
                         {{ Form::label('Per_down_vote_on_your_question', 'Per up vote on your question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">&ndash;</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="1" name="option_points_per_q_voted_down">-->
                             {{ Form::text('option_points_per_q_voted_down', Input::old('option_points_per_q_voted_down'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_per_q_voted_down')) <div class="qa-form-tall-error">{{ $errors->first('option_points_per_q_voted_down') }}</div> @endif
							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Limit from up votes on each question:-->
                      {{ Form::label('Limit_from_up_votes_on_each_question', 'Limit from up votes on each question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">+</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="10" name="option_points_q_voted_max_gain">-->
                               {{ Form::text('option_points_q_voted_max_gain', Input::old('option_points_q_voted_max_gain'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_q_voted_max_gain')) <div class="qa-form-tall-error">{{ $errors->first('option_points_q_voted_max_gain') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Limit from down votes on each question:-->
                            {{ Form::label('Limit_from_down_votes_on_each_question', 'Limit from down votes on each question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">&ndash;</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="3" name="option_points_q_voted_max_loss">-->
                            {{ Form::text('option_points_q_voted_max_loss', Input::old('option_points_q_voted_max_loss'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_q_voted_max_loss')) <div class="qa-form-tall-error">{{ $errors->first('option_points_q_voted_max_loss') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-spacer" colspan="3">&nbsp;
							
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Posting an answer:-->
                       {{ Form::label('Posting_an_answer', 'Posting an answer:') }}
  
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="4" name="option_points_post_a">-->
                              {{ Form::text('option_points_post_a', Input::old('option_points_post_a'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_post_a')) <div class="qa-form-tall-error">{{ $errors->first('option_points_post_a') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Having your answer selected as the best:-->
                            {{ Form::label('Having_your_answer_selected_as_the_best', 'Having your answer selected as the best:') }}
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="30" name="option_points_a_selected">-->
                             {{ Form::text('option_points_a_selected', Input::old('option_points_a_selected'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_a_selected')) <div class="qa-form-tall-error">{{ $errors->first('option_points_a_selected') }}</div> @endif
							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Per up vote on your answer:-->
                         {{ Form::label('Per_up_vote_on_your_answer', 'Per up vote on your answer:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">+</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="2" name="option_points_per_a_voted_up">-->
                              {{ Form::text('option_points_per_a_voted_up', Input::old('option_points_per_a_voted_up'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_per_a_voted_up')) <div class="qa-form-tall-error">{{ $errors->first('option_points_per_a_voted_up') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Per down vote on your answer:-->
                         {{ Form::label('Per_down_vote_on_your_answer', 'Per down vote on your answer:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">&ndash;</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="2" name="option_points_per_a_voted_down">-->
                             {{ Form::text('option_points_per_a_voted_down', Input::old('option_points_per_a_voted_down'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_per_a_voted_down')) <div class="qa-form-tall-error">{{ $errors->first('option_points_per_a_voted_down') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Limit from up votes on each answer:-->
                 {{ Form::label('Limit_from_up_votes_on_each_answer', 'Limit from up votes on each answer:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">+</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="20" name="option_points_a_voted_max_gain">-->
                            {{ Form::text('option_points_a_voted_max_gain', Input::old('option_points_a_voted_max_gain'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_a_voted_max_gain')) <div class="qa-form-tall-error">{{ $errors->first('option_points_a_voted_max_gain') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Limit from down votes on each answer:-->
                      {{ Form::label('Limit_from_down_votes_on_each_answer', 'Limit from down votes on each answer:') }}
 
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">&ndash;</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="5" name="option_points_a_voted_max_loss">-->
                            {{ Form::text('option_points_a_voted_max_loss', Input::old('option_points_a_voted_max_loss'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_a_voted_max_loss')) <div class="qa-form-tall-error">{{ $errors->first('option_points_a_voted_max_loss') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-spacer" colspan="3">&nbsp;
							
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Voting up a question:-->
                {{ Form::label('Voting_up_a_question', 'Voting up a question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="1" name="option_points_vote_up_q">-->
                             {{ Form::text('option_points_vote_up_q', Input::old('option_points_vote_up_q'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_vote_up_q')) <div class="qa-form-tall-error">{{ $errors->first('option_points_vote_up_q') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Voting down a question:-->
                          {{ Form::label('Voting_down_a_question', 'Voting down a question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="1" name="option_points_vote_down_q">-->
                             {{ Form::text('option_points_vote_down_q', Input::old('option_points_vote_down_q'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_vote_down_q')) <div class="qa-form-tall-error">{{ $errors->first('option_points_vote_down_q') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Voting up an answer:-->
                       {{ Form::label('Voting_up_an_answer', 'Voting up an question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="1" name="option_points_vote_up_a">-->
                             {{ Form::text('option_points_vote_up_a', Input::old('option_points_vote_up_a'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_vote_up_a')) <div class="qa-form-tall-error">{{ $errors->first('option_points_vote_up_a') }}</div> @endif

							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Voting down an answer:-->
                 {{ Form::label('Voting_down_an_answer', 'Voting down an question:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;"><span style="visibility:hidden;">+</span></span></span>
							<!--<input type="text" class="qa-form-wide-number" value="1" name="option_points_vote_down_a">-->
                           {{ Form::text('option_points_vote_down_a', Input::old('option_points_vote_down_a'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_vote_down_a')) <div class="qa-form-tall-error">{{ $errors->first('option_points_vote_down_a') }}</div> @endif
 
							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-spacer" colspan="3">&nbsp;
							
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Multiply all points:-->
                 {{ Form::label('Multiply_all_points', 'Multiply all points:') }}

						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">×</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="10" name="option_points_multiple">-->
                             {{ Form::text('option_points_multiple', Input::old('option_points_multiple'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_multiple')) <div class="qa-form-tall-error">{{ $errors->first('option_points_multiple') }}</div> @endif
 
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-label">
							<!--Add for all users:-->
                    {{ Form::label('Add_for_all_users', 'Add for all users:') }}
 
						</td>
						<td class="qa-form-wide-data">
							<span class="qa-form-wide-prefix"><span style="width:1em; display:inline-block; display:-moz-inline-stack;">+</span></span>
							<!--<input type="text" class="qa-form-wide-number" value="100" name="option_points_base">-->
                            {{ Form::text('option_points_base', Input::old('option_points_base'),array('class'=>'qa-form-wide-number')) }}
							@if ($errors->has('option_points_base')) <div class="qa-form-tall-error">{{ $errors->first('option_points_base') }}</div> @endif
 
							<span class="qa-form-wide-note">points</span>
						</td>
					</tr>
					<tr>
						<td class="qa-form-wide-buttons" colspan="3">
							<!--<input type="submit" class="qa-form-wide-button qa-form-wide-button-saverecalc" title="" value="Save and Recalculate" id="dosaverecalc">-->
							{{ Form::submit('Save and Recalculate', array('class' => 'qa-form-wide-button qa-form-wide-button-saverecalc','id' => 'dosaverecalc')) }}
							{{ Form::submit('Show Defaults', array('class' => 'qa-form-wide-button qa-form-wide-button-showdefaults','id' => 'doshowdefaults','name'=>'doshowdefaults')) }}
							<!--<input type="submit" class="qa-form-wide-button qa-form-wide-button-showdefaults" title="" value="Show Defaults" name="doshowdefaults">-->
						</td>
					</tr>
				</tbody>
			</table>								
			{{ Form::close() }}
		@endif
		</div>

</div>
@stop
