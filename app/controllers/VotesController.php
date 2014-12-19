<?php

class VotesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Votess Controller
	|--------------------------------------------------------------------------
	|
	*/
    public function index(){
    	$userid="";
		if(!Auth::check()){
			Session::flash('logintovote', Input::get('postid'));
			return Redirect::to(Input::get('current_url'));
		}
		else{
		    try{
		    	$userid=Auth::user()->userid;
		    	$postid = Input::get('postid');
		    	$post=DB::table('posts')->where('postid', $postid);	
		    	$post_result = $post->get();	   
		    	$post_result = $post_result[0]; 	
		    	$postisanswer=($post_result->type=='A');
		    	$columns=array();
		    	$vote = 0;
		    	if(Input::has('vote_up')){					
		        	$post->increment('upvotes');
		        	$post->increment('netvotes');
		        	$votes="up";
		        	$vote = 1;
		    	}
		    	elseif(Input::has('vote_down')){		    		
		            $post->decrement('netvotes');
		            $post->increment('downvotes');
		            $votes="down";
		            $vote = -1;
		    	}
		    	elseif(Input::has('vote_up_remove')){		    		
		            $post->decrement('netvotes');
		            $post->decrement('upvotes');
		            $votes="down";
		            $vote = -1;
		    	}
		    	elseif(Input::has('vote_down_remove')){		    		
		            $post->increment('netvotes');
		            $post->decrement('downvotes');
		            $votes="up";
		            $vote = 1;
		    	}
		    	$uservotes = with(new VotesModel)->insertUpdateUserVotes(Input::get('postid'),$votes);
		    	$oldvote=(int)VotesModel::qa_db_uservote_get($postid, $userid);
		    	if ( ($vote>0) || ($oldvote>0) ){
		    		$columns[]=$postisanswer ? 'aupvotes' : 'qupvotes';
		    	}
		    	if ( ($vote<0) || ($oldvote<0) ){
		    		$columns[]=$postisanswer ? 'adownvotes' : 'qdownvotes';
		    	}		   
		    	//echo "<pre>"; print_r($columns);die; 	
		    	User::qa_db_points_update_ifuser($userid, $columns);
		    	User::qa_db_points_update_ifuser($userid, array($postisanswer ? 'avoteds' : 'qvoteds', 'upvoteds', 'downvoteds'));
		    	return Redirect::to(Input::get('current_url'));
		    	//die('else');
		    }
		    catch(ParseException $error){

			}
		}
    }
}