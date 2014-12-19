@extends('layouts.default')
@section('content')
<div class="qa-main">
	<h1>
		<span class="entry-title">{{$data['question']['title']}}</span>
	</h1>
	<div class="qa-part-q-view">
	<!--Error if user try to vote without login-->
	@if ((Session::has('logintovote') && Session::get('logintovote')==$data['question']['postid']) || (Session::has('logintoflag') && Session::get('logintoflag')==$data['question']['postid']))
	<div id="errorbox" class="qa-error" style="">Please <a href="{{URL::to('/login')}}">log in</a> or <a href="{{URL::to('/register')}}">register</a> to vote.</div>
	@else
	<div id="errorbox" class="qa-error" style="display:none">Please <a href="">log in</a> or <a href="">register</a> to vote.</div>
	@endif
		<div id="q11" class="qa-q-view  hentry question">
			{{ Form::open(array('url' => URL::to('/votes'))) }}
			{{ Form::hidden('current_url',Request::url()) }}
			{{ Form::hidden('postid',$data['question']['postid']) }}
				<div class="qa-q-view-stats">
					<div id="voting_11" class="qa-voting qa-voting-net">
						{{Votes::vote_buttons(with(new VotesModel)->getVotes($data['question']))}}
						<div class="qa-vote-count qa-vote-count-net">
							<span class="qa-netvote-count">
								<span class="qa-netvote-count-data">{{$data['question']['netvotes']}}<span class="votes-up"><span title="0" class="value-title"></span></span><span class="votes-down"><span title="0" class="value-title"></span></span></span><span class="qa-netvote-count-pad"> votes</span>
							</span>
						</div>
						<div class="qa-vote-clear">
						</div>
					</div>
				</div>
				<input type="hidden" value="0-1417695874-b22f2c297205a49aa4112f4074cc159ccb10b6fd" name="code">
			</form>
			<div class="qa-q-view-main">
				{{ Form::open(array('url' => URL::to('/button'))) }}
				{{ Form::hidden('current_url',Request::url()) }}
				{{ Form::hidden('postid',$data['question']['postid']) }}
					<div class="qa-q-view-content">
						<a name="11"></a><div class="entry-content">{{{$data['question']['content']}}}</div>
					</div>
					<div class="qa-q-view-tags">
						<ul class="qa-q-view-tag-list">
							<li class="qa-q-view-tag-item"><a class="qa-tag-link" rel="tag" href="./index.php?qa=tag&amp;qa_1=first-second-third">{{{$data['question']['tags']}}}</a></li>
						</ul>
					</div>
					<span class="qa-q-view-avatar-meta">
						<span class="qa-q-view-meta">
							asked
							<span class="qa-q-view-when">
								<span class="qa-q-view-when-data"><span class="published"><span title="2014-12-04T09:50:31+0000" class="value-title"></span>2 hours</span></span><span class="qa-q-view-when-pad"> ago</span>
							</span>
							<span class="qa-q-view-who">
								<span class="qa-q-view-who-pad">by </span>
								<span class="qa-q-view-who-data">{{{$data['question']['handle']}}}</span>
								<span class="qa-q-view-who-points">
                                                                    <span class="qa-q-view-who-points-pad">(</span><span class="qa-q-view-who-points-data">290</span><span class="qa-q-view-who-points-pad"> points)</span>
								</span>
                                                                @if($data['question']['flagcount']>0)
                                                                <span class="qa-q-view-flags">
                                                                    <span class="qa-q-view-flags-data">{{$data['question']['flagcount']}}</span><span class="qa-q-view-flags-pad"> flag</span>
								</span>
                                                                @endif
							</span>
						</span>
					</span>
					
						<!--<div class="qa-q-view-buttons">
						<input type="submit" class="qa-form-light-button qa-form-light-button-flag" title="Flag this question as spam or inappropriate" value="flag" onclick="qa_show_waiting_after(this, false);" name="q_doflag">
						<input type="submit" class="qa-form-light-button qa-form-light-button-answer" title="Answer this question" value="answer" onclick="return qa_toggle_element('anew')" id="q_doanswer" name="q_doanswer">
						</div>-->
						{{SideButtons::getButtons(with(new ButtonsModel)->getButtons($data['question']))}}
					
					
					<div id="c11_list" style="display:none;" class="qa-q-view-c-list">
					</div> <!-- END qa-c-list -->
					
					<input type="hidden" value="0-1417695874-9452c9d45b4db935bd286630501135071a57016c" name="code">
					<input type="hidden" value="" name="qa_click">
				</form>
				<div class="qa-c-form">
				</div> <!-- END qa-c-form -->
				
			</div> <!-- END qa-q-view-main -->
			<div class="qa-q-view-clear">
			</div>
		</div> <!-- END qa-q-view -->
		
	</div>
	<div class="qa-part-a-form">
		@if ($errors->has('a_content'))
		<div id="anew" class="qa-a-form">
		@else
		<div id="anew" class="qa-a-form" style="display:none;">
		@endif
			<h2>Your answer</h2>
			<!--form start-->
			{{ Form::open(array('url' => URL::to('/doAnswer'))) }}
			{{ Form::hidden('qa',$data['question']['postid']) }}
				<table class="qa-form-tall-table">
					<tbody><tr>
						<td class="qa-form-tall-data">
							{{ Form::textarea('a_content', Input::old('a_content'), array('placeholder' => 'Answer','class'=>'qa-form-tall-text','size' => '40x12')) }}
							@if ($errors->has('a_content'))<div class="qa-form-tall-error">{{ $errors->first('a_content') }}</div> @endif
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-label">
							Your name to display (optional):
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<input type="text" class="qa-form-tall-text" value="" name="a_name">
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-label">
							<label>
								<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" onclick="if (document.getElementById('a_notify').checked) document.getElementById('a_email').focus();" id="a_notify" name="a_notify">
								<span id="a_email_shown">Email me at this address if my answer is selected or commented on:</span><span style="display:none;" id="a_email_hidden">Email me if my answer is selected or commented on</span>
							</label>
						</td>
					</tr>
					</tbody><tbody id="a_email_display">
						<tr>
							<td class="qa-form-tall-data">
								<input type="text" class="qa-form-tall-text" value="" id="a_email" name="a_email">
								<div class="qa-form-tall-note">Privacy: Your email address will only be used for sending these notifications.</div>
							</td>
						</tr>
					</tbody>
					<tbody><tr>
						<td class="qa-form-tall-buttons" colspan="1">
							<input type="submit" class="qa-form-tall-button qa-form-tall-button-answer" title="" value="Add answer" onclick="if (qa_ckeditor_a_content) qa_ckeditor_a_content.updateElement(); return qa_submit_answer(11, this);">
						</td>
					</tr>
				</tbody></table>
				<input type="hidden" value="WYSIWYG Editor" name="a_editor">
				<input type="hidden" value="1" name="a_doadd">
				<input type="hidden" value="0-1417695874-b89c70a841daa91cf04b679907dfd379ea475d4f" name="code">
			{{ Form::close() }}
		</div> <!-- END qa-a-form -->
		
	</div>
	<div class="qa-part-a-list">
		<h2 id="a_list_title">Answers</h2>
		<!-- Answer list start-->
		<div id="a_list" class="qa-a-list">
			@foreach($data['answers'] as $record)
			{{ ''; $ans = $record['postid'] }}
			{{ Form::hidden('qa',$record['postid']) }}
                        {{ Form::hidden('current_url',Request::url()) }}
			<!--Single Answer Block Start-->
                        @if(($record['userid']==Auth::user()->userid) && ($record['type']=='A_HIDDEN'))
                            <?php $class="qa-a-list-item-hidden";$style="";?>
                        @elseif($record['type']=='A')
                            <?php @$class='';$style="";?>
                        @else
                            <?php @$class="";$style="style='display:none'";?>
                        @endif
           
			<div id="a12" class="qa-a-list-item  hentry answer {{$class}}" {{$style}}>
				{{ Form::open(array('url' => URL::to('/votes'))) }}
				{{ Form::hidden('current_url',Request::url()) }}
				{{ Form::hidden('postid',$record['postid']) }}
				@if (Session::has('logintovote') && Session::get('logintovote')==$record['postid'])
				<div id="errorbox" class="qa-error" style="">Please <a href="{{URL::to('/login')}}">log in</a> or <a href="{{URL::to('/register')}}">register</a> to vote.</div>
				@else
				<div id="errorbox" class="qa-error" style="display:none">Please <a href="">log in</a> or <a href="">register</a> to vote.</div>
				@endif
					<div id="voting_12" class="qa-voting qa-voting-net">
						{{Votes::vote_buttons(with(new VotesModel)->getVotes($record))}}
						<div class="qa-vote-count qa-vote-count-net">
							<span class="qa-netvote-count">
								<span class="qa-netvote-count-data">{{$record['netvotes']}}<span class="votes-up"><span title="0" class="value-title"></span></span><span class="votes-down"><span title="0" class="value-title"></span></span></span><span class="qa-netvote-count-pad"> votes</span>
							</span>
						</div>
						<div class="qa-vote-clear">
						</div>
					</div>
					<input type="hidden" value="0-1417774325-2b86386f6a2db39f9393103823aaf6eb5f4e6a2b" name="code">
				</form>
				<div class="qa-a-item-main">
					{{ Form::open(array('url' => URL::to('/button'))) }}
                                        {{ Form::hidden('postid',$record['postid']) }}
                                        {{ Form::hidden('current_url',Request::url()) }}
						<div class="qa-a-selection">
						</div>
						<div class="qa-a-item-content">
							<a name="12"></a><div class="entry-content">{{$record['content']}}</div>
						</div>
						<span class="qa-a-item-avatar-meta">
							<span class="qa-a-item-meta">
								<a class="qa-a-item-what" href="./index.php?qa=11&amp;qa_1=what-is-your-filezilla&amp;show=12#a12">answered</a>
								<span class="qa-a-item-when">
									<span class="qa-a-item-when-data"><span class="published"><span title="2014-12-04T14:11:43+0000" class="value-title"></span>20 hours</span></span><span class="qa-a-item-when-pad"> ago</span>
								</span>
								<span class="qa-a-item-who">
									<span class="qa-a-item-who-pad">by </span>
									<span class="qa-a-item-who-data">me</span>
								</span>
                                                                 @if($record['flagcount']>0)
                                                                <span class="qa-q-view-flags">
                                                                    <span class="qa-q-view-flags-data">{{$record['flagcount']}}</span><span class="qa-q-view-flags-pad"> flag</span>
								</span>
                                                                @endif
							</span>
						</span>
						<div class="qa-a-item-buttons">
                        	<input type="submit" class="qa-form-light-button qa-form-light-button-edit" title="Edit this answer" value="edit" name="a12_doedit">
							<input type="submit" class="qa-form-light-button qa-form-light-button-hide" title="Hide this answer" value="hide" onclick="return qa_answer_click(12, 11, this);" name="a12_dohide">
							<a href="{{URL::to('/ask/follow/'.$ans)}}" class="qa-form-light-button qa-form-light-button-follow" title="Ask a new question relating to this answer" name="related_question">ask related question</a>
							<input type="submit" class="qa-form-light-button qa-form-light-button-comment" title="Add a comment on this answer" value="comment" onclick="return qa_toggle_element('c{{$ans}}')" name="a12_docomment">
                            {{SideButtons::getButtons(with(new ButtonsModel)->getAnswersButtons($record))}}
                        </div>
						
						@foreach($data['comments'][$record['postid']] as $record_comments)
						<!--Comment Section Start-->
						<div id="c12_list" class="qa-a-item-c-list">
							<div class="qa-c-list-item  hentry comment" id="c38">
								<div class="qa-c-item-content">
									<a name="38"></a><div class="entry-content">{{$record_comments['content']}}</div>
								</div>
								
								<div class="qa-c-item-footer">
									<span class="qa-c-item-avatar-meta">
										<span class="qa-c-item-meta">
											<span style="color:blue;">commented</span>
											<span class="qa-c-item-when">
												<span class="qa-c-item-when-data"><span class="published"><span class="value-title" title="2014-12-09T15:19:12+0000"></span>{{ Question::formattedCreatedDate($record_comments['created']) }}</span></span>
											</span>
											<span class="qa-c-item-who">
												<span class="qa-c-item-who-pad">by </span>
												<span class="qa-c-item-who-data">
													@if($record['handle']==NULL)
														me
													@else
														<a class="qa-user-link" href="">{{{ $record['handle'] }}}</a>
													@endif
												</span>
											</span>
										</span>
									</span>
									<div class="qa-c-item-buttons">
										<input name="c38_doflag" onclick="return qa_comment_click(38, 11, 12, this);" value="flag" title="Flag this comment as spam or inappropriate" type="submit" class="qa-form-light-button qa-form-light-button-flag">
										<input name="a12_docomment" onclick="return qa_toggle_element('c{{$ans}}')" value="reply" title="Reply to this comment" type="submit" class="qa-form-light-button qa-form-light-button-comment">
									</div>
								</div>
								<div class="qa-c-item-clear">
								</div>
							</div>
						</div> 
						<!--Comment Section End-->
						@endforeach
						
						<input type="hidden" value="0-1417774325-d11ee3d5b335bcf1ad1234f07222196aaf9c6c89" name="code">
						<input type="hidden" value="" name="qa_click">
					</form>
					<!-- form for comment-->
					@if ($errors->has('c'.$ans.'_content'))
					<div id="c{{$ans}}" class="qa-c-form">
					@else
					<div id="c{{$ans}}" style="display:none;" class="qa-c-form">
					@endif
						<h2>Your comment on this answer:</h2>
						{{ Form::open(array('url' => URL::to('/doComments'),'name' => 'c_form_'.$ans)) }}
						{{ Form::hidden('c_parentid',$record['postid']) }}
						{{ Form::hidden('c_questionid',$data['question']['postid']) }}
							<table class="qa-form-tall-table">
								<tbody><tr>
									<td class="qa-form-tall-data">
										<!--<textarea class="qa-form-tall-text" cols="40" rows="4" id="c{{$ans}}_content" name="c{{$ans}}_content"></textarea>-->
										{{ Form::textarea('c'.$ans.'_content', Input::old('c'.$ans.'_content'), array('placeholder' => 'Answer','class'=>'qa-form-tall-text','size' => '40x12')) }}
										@if ($errors->has('c'.$ans.'_content'))<div class="qa-form-tall-error">{{ $errors->first('c'.$ans.'_content') }}</div> @endif
									</td>
								</tr>
								<tr>
									<td class="qa-form-tall-label">
										Your name to display (optional):
									</td>
								</tr>
								<tr>
									<td class="qa-form-tall-data">
										<input type="text" class="qa-form-tall-text" value="" name="c{{$ans}}_name">
									</td>
								</tr>
								<tr>
									<td class="qa-form-tall-label">
										<label>
											<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" onclick="if (document.getElementById('{{$ans}}_notify').checked) document.getElementById('{{$ans}}_email').focus();" id="{{$ans}}_notify" name="{{$ans}}_notify">
											<span id="{{$ans}}_email_shown">Email me at this address if a comment is added after mine:</span><span style="display:none;" id="{{$ans}}_email_hidden">Email me if a comment is added after mine</span>
										</label>
									</td>
								</tr>
								</tbody><tbody id="c{{$ans}}_email_display">
									<tr>
										<td class="qa-form-tall-data">
											<input type="text" class="qa-form-tall-text" value="" id="c{{$ans}}_email" name="c{{$ans}}_email">
											<div class="qa-form-tall-note">Privacy: Your email address will only be used for sending these notifications.</div>
										</td>
									</tr>
								</tbody>
								<tbody><tr>
									<td class="qa-form-tall-buttons" colspan="1">
										<input type="submit" class="qa-form-tall-button qa-form-tall-button-comment" title="" value="Add comment" onclick=" return qa_submit_comment({{$data['question']['postid']}}, {{$record['postid']}}, this);">
										<input type="submit" class="qa-form-tall-button qa-form-tall-button-cancel" title="" value="Cancel" onclick="return qa_toggle_element()" name="docancel">
									</td>
								</tr>
							</tbody></table>
							<input type="hidden" value="" name="c{{$ans}}_editor">
							<input type="hidden" value="1" name="c{{$ans}}_doadd">
							<input type="hidden" value="0-1417774325-a05439a955136957b0b0f47d4663d8f69bf9bf98" name="c{{$ans}}_code">
						{{ Form::close() }}
					</div> <!-- END qa-c-form -->
					<!--Comment form end-->
					
				</div> <!-- END qa-a-item-main -->
				<div class="qa-a-item-clear">
				</div>
			</div> <!-- END qa-a-list-item -->
			@endforeach
			<!--Single Answer Block End-->

		</div> 
		<!-- END Answer list -->
		
	</div>
</div>
@stop