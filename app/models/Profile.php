<?php

use Carbon\Carbon;

class Profile extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'userprofile';
	protected $primaryKey = 'userid';

	public function getProfileByUserId($user_id){
		return DB::table('userprofile')->select('title','content')->where('userid', $user_id)->get();
	}

	public function insertProfileById(){
		
		$profile_data = array('about' => Input::get('field_4') ,
							'location' => Input::get('field_2') ,
							'name' => Input::get('field_1') ,
							'website' => Input::get('field_3'));		
		
		//Update profile data....
		$profile = DB::table('userprofile')->where('userid', '=', Auth::user()->userid)->get();
		foreach ($profile as $key => $p) {			
			DB::table('userprofile')
            ->where('userid', Auth::user()->userid)
            ->where('title',$p->title)
            ->update(array('content' => $profile_data[$p->title]));
            unset($profile_data[$p->title]);
		}
		
		//If not available then add profile data......
		foreach ($profile_data as $title => $content) {
			//echo $title; print_r($content);die;
			DB::table('userprofile')->insert(
			    array('title' => $title,
			    		'content' => $content,
			    		'userid' => Auth::user()->userid
	    	 	)
			);
		}
	}	
}