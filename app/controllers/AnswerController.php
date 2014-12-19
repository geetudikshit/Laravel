<?php

class AnswerController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	|  Answer Controller
	|--------------------------------------------------------------------------
	|  All the answer related work done in this controller
	|
	*/

	//Inserting answer of paticular question into database
	public function doAnswer(){
		$rules = array(
			'a_content'    => 'required|min:12', // make sure its required and min length of 12
		);
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			Session::flash('message', 'Email/Password can not be blank!');
			return Redirect::to('/question/'.Input::get('qa'))
				->withErrors($validator); // send back all errors to the login form
		}
		else{
			try{
				if (Auth::check())
				{
				   $userid = Auth::user()->userid;
				}
				else
					$userid =NULL;
				
				if(Input::get('a_notify'))
					$email=Input::get('a_email');
				else
					$email=NULL;
				
				$postid = DB::table('posts')->insertGetId(
				    array('type' => 'A',
				    	 'parentid' => Input::get('qa'),
		    	 		 'createip' => $_SERVER['REMOTE_ADDR'],
		    	 		 'created' =>date('Y-m-d H:i:s'),		    	 		
		    	 		 'content' => Input::get('a_content'),
		    	 		 'name' => Input::get('a_name'),
		    	 		 'userid' => $userid,	    	 		
			    	 	 'notify' => $email)
				);

				DB::table('posts')
            		->where('postid', Input::get('qa'))
            		->increment('acount');
		            
						
                return Redirect::to('/question/'.Input::get('qa'));
			}
			catch(ParseException $error){

			}
		}
	}

	//Inserting comments of paticular answer into database
	public function doComments(){
		$rules = array(
			'c'.Input::get('c_parentid').'_content'    => 'required|min:12', // make sure its required and min length of 12
		);
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {//die(' validation_fails');
			return Redirect::to('/question/'.Input::get('c_questionid'))
			->withErrors($validator); // send back all errors current page
		}
		else{
			try{
				if (Auth::check())
				{
				   $userid = Auth::user()->userid;
				}
				else
					$userid =NULL;
				
				if(Input::get('a_notify'))
					$email=Input::get('a_email');
				else
					$email=NULL;
				
				$postid = DB::table('posts')->insertGetId(
				    array('type' => 'C',
				    	 'parentid' => Input::get('c_parentid'),
		    	 		 'createip' => $_SERVER['REMOTE_ADDR'],
		    	 		 'created' =>date('Y-m-d H:i:s'),		    	 		
		    	 		 'content' => Input::get('c'.Input::get('c_parentid').'_content'),
		    	 		 'name' => Input::get('c'.Input::get('c_parentid').'_name'),
		    	 		 'userid' => $userid,	    	 		
			    	 	 'notify' => Input::get('c'.Input::get('c_parentid').'_name'))
				);

				return Redirect::to('/question/'.Input::get('c_questionid'));
			}
			catch(ParseException $error){

			}
		}
	}


}