@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Pages </h1>
	<div class="qa-part-form">
					@if(isset($page))
					{{ Form::model($page, ['url' => 'admin/doPage', 'method' => 'post']) }}
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
									{{ Form::label('Show_navigation_links','Show navigation links:') }}
								</td>
							</tr>
							
							<tr>
								<td class="qa-form-tall-label">
									<label>
										<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" name="option_nav_questions">-->
										{{ Form::checkbox('option_nav_questions', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
										<a href="./index.php?qa=questions">Questions</a>
									</label>
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-label">
									<label>
										<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" name="option_nav_hot">-->
										{{ Form::checkbox('option_nav_hot', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
										<a href="./index.php?qa=hot">Hot!</a>
									</label>
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-label">
									<label>
										<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" name="option_nav_unanswered">-->
										{{ Form::checkbox('option_nav_unanswered', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
										<a href="./index.php?qa=unanswered">Unanswered</a>
									</label>
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-label">
									<label>
										<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" name="option_nav_tags">-->
										{{ Form::checkbox('option_nav_tags', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
										<a href="./index.php?qa=tags">Tags</a>
									</label>
								</td>
							</tr>
							
							<tr>
								<td class="qa-form-tall-label">
									<label>
										<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" name="option_nav_users">-->
										{{ Form::checkbox('option_nav_users', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
										<a href="./index.php?qa=users">Users</a>
									</label>
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-label">
									<label>
										<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" name="option_nav_ask">-->
										{{ Form::checkbox('option_nav_ask', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
										<a href="./index.php?qa=ask">Ask a Question</a>
									</label>
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-spacer" colspan="1">
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td class="qa-form-tall-data">
								</td>
							</tr>
							<tr>
								<td class="qa-form-tall-buttons" colspan="1">
									<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Save Changes" name="dosaveoptions">-->
									{{ Form::submit('Save Changes', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
									
							</tr>
						</tbody></table>
						
					{{ Form::close() }}
		@endif
				</div>

</div>
@stop
