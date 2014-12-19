<?php 
/*
	|--------------------------------------------------------------------------
	| Model for Votes
	|--------------------------------------------------------------------------
	|
	| All Votes related Queries are to be there in this model. 
*/
class VotesModel extends Eloquent{

	public function getVotes($single_post){
		$userid="";
		if(Auth::check()){
			$userid=Auth::user()->userid;
			DB::setFetchMode(PDO::FETCH_ASSOC);
			$uservotes=DB::table('uservotes')
				->where('postid', $single_post['postid'])
	            ->where('userid', $userid)
	            ->get();
	        DB::setFetchMode(PDO::FETCH_CLASS);
		}
		//if(!(1)){echo "yes";die;}
		//echo DB::last_query();die;
		//echo "<pre>";print_r($uservotes);die;
		//ip2long(Request::getClientIp()) //getting ip address
		//echo "<pre>";print_r($post);die;
		if(($single_post['userid']==$userid)){
			$post['vote_view']="net";
			$post['vote_state']="disabled";
			$post['vote_up_tags']='title="You cannot vote on your own questions"';
			$post['vote_down_tags']='title="You cannot vote on your own questions"';
			return $post;
		}
		elseif(($single_post['netvotes']) && !empty($uservotes) && ($uservotes[0]['vote']==1)){
			$post['vote_view']="net";
			$post['vote_state']="voted_up";
			$post['vote_up_tags']='title="You have voted this up - click to remove vote" name="vote_up_remove"';
			$post['vote_down_tags']='';
			return $post;	
		}
		elseif(($single_post['netvotes']) && !empty($uservotes) && ($uservotes[0]['vote']==-1)){
			$post['vote_view']="net";
			$post['vote_state']="voted_down";
			$post['vote_up_tags']='';
			$post['vote_down_tags']='title="You have voted this down - click to remove vote" name="vote_down_remove"';
			return $post;	
		}
		else{
			$post['vote_view']="net";
			$post['vote_state']="enabled";
			$post['vote_up_tags']='title="Click to vote up" name="vote_up"';
			$post['vote_down_tags']='title="Click to vote down" name="vote_down"';
			return $post;
		}
	}

	public function insertUpdateUserVotes($postid,$votes){
		//Query for checking uservotes table with given postid and login user
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$record=DB::table('uservotes')
			->where('postid', $postid)
			->where('userid', Auth::user()->userid)
			->get();
		DB::setFetchMode(PDO::FETCH_CLASS);
		//if there is no record in uservotes table the insert it else update it
		//die($votes);
		if(empty($record)){
			if($votes=="up")
				$vote=1;
			elseif($votes=="down")
				$vote=-1;
			$post=DB::table('uservotes')->insert(
			    array('postid' => $postid,
			    	'userid' => Auth::user()->userid,
	    	 		'vote' => $vote)
			);
		}
		else{
			$post=DB::table('uservotes')
            	->where('postid', $postid)
            	->where('userid', Auth::user()->userid);
            if($votes=="up"){
				$post->increment('vote');
            }
			elseif($votes=="down"){
				$post->decrement('vote');
			}
		}
	}
        
        public function insertUpdateUserFlags($postid,$flag){
		//Query for checking uservotes table with given postid and login user
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$record=DB::table('uservotes')
			->where('postid', $postid)
			->where('userid', Auth::user()->userid)
			->get();
		DB::setFetchMode(PDO::FETCH_CLASS);
		//if there is no record in uservotes table the insert it else update it
		//die($votes);
		if(empty($record)){
			$post=DB::table('uservotes')->insert(
			    array('postid' => $postid,
			    	'userid' => Auth::user()->userid,
	    	 		'flag' => 1)
			);
		}
		else{
			$post=DB::table('uservotes')
                            ->where('postid', $postid)
                            ->where('userid', Auth::user()->userid);
                        if($flag=="flag"){
                            $post->increment('flag');
                        }
			elseif($flag=="unflag"){
                            $post->decrement('flag');
			}
		}
	}

	/*
	Get the vote for $userid on $postid from the database (or NULL if none)
	*/

	public static function qa_db_uservote_get($postid, $userid){
		$result = DB::table('uservotes')->select('vote')->where('postid', $postid)->where('userid',$userid)->first();		
		return $result->vote;
	}
}