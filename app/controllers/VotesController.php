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
		    	if(Input::has('vote_up')){
					$post=DB::table('posts')->where('postid', Input::get('postid'));
		        	$post->increment('upvotes');
		        	$post->increment('netvotes');
		        	$votes="up";
		    	}
		    	elseif(Input::has('vote_down')){
		    		$post=DB::table('posts')
		            	->where('postid', Input::get('postid'));
		            $post->decrement('netvotes');
		            $post->increment('downvotes');
		            $votes="down";
		    	}
		    	elseif(Input::has('vote_up_remove')){
		    		$post=DB::table('posts')
		            	->where('postid', Input::get('postid'));
		            $post->decrement('netvotes');
		            $post->decrement('upvotes');
		            $votes="down";
		    	}
		    	elseif(Input::has('vote_down_remove')){
		    		$post=DB::table('posts')
		            	->where('postid', Input::get('postid'));
		            $post->increment('netvotes');
		            $post->decrement('downvotes');
		            $votes="up";
		    	}
		    	$uservotes = with(new VotesModel)->insertUpdateUserVotes(Input::get('postid'),$votes);
		    	return Redirect::to(Input::get('current_url'));
		    	//die('else');
		    }
		    catch(ParseException $error){

			}
		}
    }
}