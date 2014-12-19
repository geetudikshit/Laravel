<?php

class ButtonController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Button Controller
	|--------------------------------------------------------------------------
	|
	*/
    public function index(){//echo "<pre>";print_r(Input::all());die;
        if((Input::has('flag')) || (Input::has('unflag'))){
    	$userid="";
		if(!Auth::check()){
			Session::flash('logintoflag', Input::get('postid'));
			return Redirect::to(Input::get('current_url'));
		}
		else{
		    try{
		    	$userid=Auth::user()->userid;
		    	if(Input::has('flag')){
					$post=DB::table('posts')->where('postid', Input::get('postid'));
		        	$post->increment('flagcount');
		        	$flag="flag";
		    	}
		    	elseif(Input::has('unflag')){
		    		$post=DB::table('posts')
		            	->where('postid', Input::get('postid'));
		            $post->decrement('flagcount');
		            $flag="unflag";
		    	}
		    	
		    	$uservotes = with(new VotesModel)->insertUpdateUserFlags(Input::get('postid'),$flag);
		    	return Redirect::to(Input::get('current_url'));
		    	//die('else');
		    }
		    catch(ParseException $error){

			}
		}
    }
    elseif((Input::has('edit'))){
        return Redirect::to('/edit/'.Input::get('postid'));
        
    }
    elseif((Input::has('hide'))){
        DB::table('posts')
            ->where('postid',Input::get('postid'))
            ->update(array('type' => 'A_HIDDEN'));
        return Redirect::to(Input::get('current_url'));
    }
    elseif((Input::has('reshow'))){
        DB::table('posts')
            ->where('postid',Input::get('postid'))
            ->update(array('type' => 'A'));
        return Redirect::to(Input::get('current_url'));
    }
    }
}