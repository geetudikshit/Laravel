<?php

class ProfileController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	
	*/	
	 /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except' => array('viewProfile','wall','activity','questions','answers')));          
    }

    public function viewProfile($handle) {
    	$html = '';	
    	$data = array();
    	//$handle = Input::except('handle');
    	$user = with(new User)->get_user_by_handle($handle);
    	$favoritemap = with(new User)->get_favorite($user->userid);
    	$favorite=isset($favoritemap['user'][$user->userid])?$favoritemap['user'][$user->userid]:false;	
		$title = isset($favorite) ? 'Remove '.$user->handle.' from my favorites' : 'Add user '.$user->handle.' to my favorites';

		$html .= with(new User)->qa_favorite_form($handle,"U",$user->userid,$favorite,$title);
		$calculated_time = time()-strtotime($user->created);
		$data['time_str'] = with(new User)->second_to_string($calculated_time);	
		$data['level'] = with(new User)->qa_user_level_string($user->level);
		$data['html'] = $html;
		$data['handle'] = $handle;
    	return View::make('profile.index')->with($data);
    }

	public function index(){	
		$html = '';			
		$favoritemap = with(new User)->get_favorite(Auth::user()->userid);		
		$favorite=isset($favoritemap['user'][Auth::user()->userid])?$favoritemap['user'][Auth::user()->userid]:false;	
		$title = isset($favorite) ? 'Remove '.Auth::user()->handle.' from my favorites' : 'Add user '.Auth::user()->handle.' to my favorites';
		
		$html .= with(new User)->qa_favorite_form(Auth::user()->handle,"U",Auth::user()->userid,$favorite,$title);
		//$navigation = with(new User)->qa_user_sub_navigation(Auth::user()->handle, 'profile',true); //True for logged in user.
		$calculated_time = time()-strtotime(Auth::user()->created);
		$data['time_str'] = with(new User)->second_to_string($calculated_time);	
		$data['level'] = with(new User)->qa_user_level_string(Auth::user()->level);
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.index')->with($data);	
	}

	public function account(){		
		$html = '';				
		$data = array();
		$calculated_time = time()-strtotime(Auth::user()->created);
		$data['time_str'] = with(new User)->second_to_string($calculated_time);
		$data['level'] = with(new User)->qa_user_level_string(Auth::user()->level);		
		$data['html'] = $html;
		$data['message'] = !(Auth::user()->flags & Config::get('constants.QA_USER_FLAGS_NO_MESSAGES'));
		$data['wall'] = !(Auth::user()->flags & Config::get('constants.QA_USER_FLAGS_NO_WALL_POSTS'));
		$data['user'] = Auth::user();
		
		//Get profile data.....
		$profile = with(new Profile)->getProfileByUserId(Auth::user()->userid);
		
		foreach ($profile as $key => $p_data) {
			if($p_data->title=="about"){
				$data['user']->field_4 = $p_data->content;
			}
			elseif($p_data->title=="location"){
				$data['user']->field_2 = $p_data->content;
			}
			elseif($p_data->title=="name"){
				$data['user']->field_1 = $p_data->content;
			}
			elseif($p_data->title=="website"){
				$data['user']->field_3 = $p_data->content;
			}
		}		
		return View::make('profile.account')->with($data);
	}
	public function doChangePassword(){
		$rules = array(
			'oldpassword'    => 'required', // make sure its required
			'newpassword1'    => 'required|alphaNum|min:3', // password can only be alphanumeric and has to be greater than 3 characters
			'newpassword2' => 'required|same:newpassword1|min:3',
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
                        Session::flash('message', 'Email/Password can not be blank!');
			return Redirect::to('account')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('oldpassword')); // send back the input (not the password) so that we can repopulate the form
		}
		else {
			try{
				echo Auth::user()->password;
				Session::flash('message', 'Profile Saved');
				return Redirect::to('account');
			}
			catch (ParseException $error) {
	            // The login failed. Check error to see why.
	            //echo "Error: " . $error->getCode() . " " . $error->getMessage();
	            Session::flash('message', 'Invalid Change Password Information!');
	            return Redirect::to('account');
            }
		}
	}
	public function doAccount() {
		$rules = array(
			'handle'    => 'required', // make sure its required
			'email'    => 'required|email', // password can only be alphanumeric and has to be greater than 3 characters
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
        	Session::flash('message', 'Email/Password can not be blank!');
			return Redirect::to('/account')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('oldpassword')); // send back the input (not the password) so that we can repopulate the form
		}
		else {
			try{die(' else');
				with(new Profile)->insertProfileById();
				Session::flash('message', 'Profile Saved');
				return Redirect::to('/account');
			}
			catch (ParseException $error) {
	            // The login failed. Check error to see why.
	            //echo "Error: " . $error->getCode() . " " . $error->getMessage();
	            Session::flash('success', 'Profile Saved!');
	            return Redirect::to('/account');
            }
		}
	}
	public function favorites(){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.favorites')->with($data);
	}
	public function wall(){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.wall')->with($data);
	}

	public function viewUpdates(){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.updates')->with($data);
	}

	public function viewWall($handle){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = $handle;
		return View::make('profile.wall')->with($data);
	}
	public function activity(){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.activity')->with($data);
	}
	public function viewActivity($handle){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = $handle;
		return View::make('profile.wall')->with($data);
	}
	public function questions(){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.questions')->with($data);
	}
	public function viewQuestions($handle){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = $handle;
		return View::make('profile.questions')->with($data);
	}
	public function answers(){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = Auth::user()->handle;
		return View::make('profile.answers')->with($data);
	}
	public function viewAnswers($handle){
		$html = '';	
		$data = array();
		$data['html'] = $html;
		$data['handle'] = $handle;
		return View::make('profile.questions')->with($data);
	}

	public function editProfile(){
		
	}
}