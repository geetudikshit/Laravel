@extends('layouts.default')
@section('content')

<div class="qa-main">
	{{$html}}

	<div class="qa-part-form-profile">
		{{ Form::open(array('url' => '/account')) }}
				<table class="qa-form-wide-table">
					<tbody>
						<tr id="duration">
							<td class="qa-form-wide-label">
								Member for:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static">{{$time_str}}</span>
							</td>
						</tr>
						<tr id="level">
							<td class="qa-form-wide-label">
								Type:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static">{{$level}}</span>
							</td>
						</tr>
						<tr id="userfield-1">
							<td class="qa-form-wide-label">
								Full name:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"></span>
							</td>
						</tr>
						<tr id="userfield-2">
							<td class="qa-form-wide-label">
								Location:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"></span>
							</td>
						</tr>
						<tr id="userfield-3">
							<td class="qa-form-wide-label">
								Website:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"></span>
							</td>
						</tr>
						<tr id="userfield-4">
							<td style="vertical-align:top;" class="qa-form-wide-label">
								About:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"></span>
							</td>
						</tr>
						@if(Auth::check())
						<tr>
							<td class="qa-form-wide-buttons" colspan="3">
								<input type="submit" class="qa-form-wide-button qa-form-wide-button-account" title="" value="Edit my Profile" name="doaccount">
							</td>
						</tr>
						@endif
					</tbody>
				</table>
		{{ Form::close() }}
	</div>
	<div class="qa-part-form-activity">
					<h2><a name="activity">Activity by {{$handle}}</a></h2>
					<table class="qa-form-wide-table">
						<tbody><tr id="points">
							<td class="qa-form-wide-label">
								Score:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-points">100</span> points (ranked #<span class="qa-uf-user-rank">1</span>)</span>
							</td>
						</tr>
						<tr id="questions">
							<td class="qa-form-wide-label">
								Questions:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-q-posts">0</span></span>
							</td>
						</tr>
						<tr id="answers">
							<td class="qa-form-wide-label">
								Answers:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-a-posts">0</span></span>
							</td>
						</tr>
						<tr id="comments">
							<td class="qa-form-wide-label">
								Comments:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-c-posts">0</span></span>
							</td>
						</tr>
						<tr id="votedon">
							<td class="qa-form-wide-label">
								Voted on:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-q-votes">0</span> questions, <span class="qa-uf-user-a-votes">0</span> answers</span>
							</td>
						</tr>
						<tr id="votegave">
							<td class="qa-form-wide-label">
								Gave out:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-upvotes">0</span> up votes, <span class="qa-uf-user-downvotes">0</span> down votes</span>
							</td>
						</tr>
						<tr id="votegot">
							<td class="qa-form-wide-label">
								Received:
							</td>
							<td class="qa-form-wide-data">
								<span class="qa-form-wide-static"><span class="qa-uf-user-upvoteds">0</span> up votes, <span class="qa-uf-user-downvoteds">0</span> down votes</span>
							</td>
						</tr>
					</tbody></table>
				</div>

</div>

@stop
