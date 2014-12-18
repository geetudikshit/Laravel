@extends('layouts.default')
@section('content')
<div class="qa-main">
	@if($data==NULL)
	<h1> No questions found  </h1>
	@else
	<h1> {{{$data[0]['head']}}} </h1>
	@endif
	<div class="qa-part-q-list">
		@if(isset($data))
			<div class="qa-q-list">
			@foreach($data as $record)
			{{ Form::open(array('url' => URL::to('/votes'))) }}
			{{ Form::hidden('current_url',Request::url()) }}
			{{ Form::hidden('postid',$record['postid']) }}
			@if (Session::has('logintovote') && Session::get('logintovote')==$record['postid'])
			<div id="errorbox" class="qa-error" style="">Please <a href="{{URL::to('/login')}}">log in</a> or <a href="{{URL::to('/register')}}">register</a> to vote.</div>
			@else
			<div id="errorbox" class="qa-error" style="display:none">Please <a href="">log in</a> or <a href="">register</a> to vote.</div>
			@endif	
				<div id="q{{$record['postid']}}" class="qa-q-list-item">
					<div class="qa-q-item-stats">
						<div id="voting_6" class="qa-voting qa-voting-net">
							{{Votes::vote_buttons(with(new VotesModel)->getVotes($record))}}
							<div class="qa-vote-count qa-vote-count-net">
								<span class="qa-netvote-count">
									<span class="qa-netvote-count-data">{{$record['netvotes']}}</span>
									<span class="qa-netvote-count-pad"> votes</span>
								</span>
							</div>
							<div class="qa-vote-clear">
							</div>
						</div>
					<span class="qa-a-count qa-a-count-zero">
						<span class="qa-a-count-data">{{{$record['acount']}}}</span>
						<span class="qa-a-count-pad"> answers</span>
					</span>
					</div>
				<div class="qa-q-item-main">
					<div class="qa-q-item-title">
						<a href="question/{{{ $record['postid'] }}}">{{{ $record['title'] }}}</a>
					</div>
					<span class="qa-q-item-avatar-meta">
						<span class="qa-q-item-meta">
							<span class="qa-q-item-what">asked</span>
							<span class="qa-q-item-when">
								<span class="qa-q-item-when-data">{{ Question::formattedCreatedDate($record['created']) }}</span><span class="qa-q-item-when-pad"> </span>
							</span>
							<span class="qa-q-item-who">
								<span class="qa-q-item-who-pad">by </span>
								<span class="qa-q-item-who-data">
									@if($record['handle']==NULL)
										me
									@else
										<a class="qa-user-link" href="">{{{ $record['handle'] }}}</a>
									@endif
								</span>
								<span class="qa-q-item-who-points">
									@if($record['points']!=NULL)
										<span class="qa-q-item-who-points-pad">(</span>
										<span class="qa-q-item-who-points-data">{{{ $record['points'] }}}</span>
										<span class="qa-q-item-who-points-pad"> points)</span>
									@endif
								</span>
							</span>
						</span>
					</span>
					@if($record['tags']!=NULL)
					<div class="qa-q-item-tags">
						<ul class="qa-q-item-tag-list">
							<li class="qa-q-item-tag-item"><a class="qa-tag-link" href="{{URL::to('/tag/'.$record['tags'])}}">{{{ $record['tags'] }}}</a></li>
						</ul>
					</div>
					@endif
				</div>
					<div class="qa-q-item-clear">
					</div>
				</div>
			{{ Form::close() }}
			@endforeach

				<div class="qa-suggest-next">
						Help get things started by <a href="./index.php?qa=ask">asking a question</a>.
				</div>

			</div>
		
	</div>
	@endif
</div>
@stop
