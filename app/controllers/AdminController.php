<?php
class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/	
	 /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except' => array('viewProfile','wall','activity','questions','answers')));          
    }

    public function index(){
    	$general_option = with(new Option);
    	$db_options = Option::get_options();
    	$general_options = Option::qa_general_option_names();    	
    	foreach ($general_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$general_option->$tmp_option = $db_options[$option];
    	}   	
    	$data['general'] = $general_option;
    	return View::make('admin.index')->with($data);
    }

    public function doGeneral(){
    	try {	
    		$general_options = Option::qa_general_option_names();
    		if(Input::get('doresetoptions')) {
				Option::qa_reset_options($general_options); 
				Session::flash('success', 'Options reset');
    		}	
    		else {					
				foreach ($general_options as $key => $general_option) {
					Option::qa_db_set_option($general_option,Input::get('option_'.$general_option));
				}		
	        	Session::flash('success', 'Options Saved!');
	        }
        	return Redirect::to('admin/general');                            
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/general');
        }
    }

    public function emails(){
    	$email_option = with(new Option);
    	$db_options = Option::get_options();
    	$email_options = Option::qa_email_option_names();    	
    	foreach ($email_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$email_option->$tmp_option = $db_options[$option];
    	}   	
    	$data['email'] = $email_option;
    	return View::make('admin.emails')->with($data);
    }

    public function doEmails(){
    	try {			
			$email_options = Option::qa_email_option_names();
			if(Input::get('doresetoptions')) {
				Option::qa_reset_options($email_options);
				Session::flash('success', 'Options reset');
    		}	
    		else {
				foreach ($email_options as $key => $email_option) {
					Option::qa_db_set_option($email_option,Input::get('option_'.$email_option));
				}
				Session::flash('success', 'Options Saved!');		
			}	        	
        	return Redirect::to('admin/emails');                            
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/emails');
        }
    }

    public function users(){
    	$user_option = with(new Option);
    	$db_options = Option::get_options();
    	$user_options = Option::qa_user_option_names();
    	//echo "<pre>"; print_r($db_options);die;
    	foreach ($user_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$user_option->$tmp_option = $db_options[$option];
    	}   	
    	$data['user'] = $user_option;

    	//This section is for user fields ..
    	$userfields = Userfield::get_userfields();    	
    	$userfields_html = '';		
    	foreach ($userfields as $key => $userfield) {
		$userfields_html .= '<li><b>'.$userfield->label.'</b>';	
		$userfields_html .= ' - <a href="/admin/userfields/'.$userfield->fieldid.'">edit field</a>';
		$userfields_html .= '</li>';
    	}
    	$data['userfields'] = $userfields_html;

    	//This section is for user titles....
    	$titlefields_html = '';    	
    	$db_options = Option::get_options();
    	$titles = $db_options['points_to_titles'];
    	$title_array = explode(",", $titles);
    	foreach ($title_array as $key => $options) {
		if(isset($options) && !empty($options)){
	    		$preg = preg_split('#\s+#', $options,2);    		
	    		$titlefields_html .= '<li><b>'.$preg[1].'</b> - '.$preg[0].' Points';
	    		$titlefields_html .= ' - <a href="/admin/usertitles/'.$preg[0].'">edit title</a>';
	    		$titlefields_html .= '</li>';
		}
    	}
    	$data['titlefields_html'] = $titlefields_html;
    	return View::make('admin.users')->with($data);
    }

    public function doUsers(){
    	try {
    		$user_options = Option::qa_user_option_names();
    		if(Input::get('doresetoptions')) {
    			Option::qa_reset_options($user_options);
				Session::flash('success', 'Options reset');
    		}
    		else {
    			foreach ($user_options as $key => $user_option) {
    				$option_value = Option::qa_convert_value_into_type($user_option,Input::get('option_'.$user_option));
					Option::qa_db_set_option($user_option,$option_value);
				}		
	        	Session::flash('success', 'Options Saved!');
    		}
    		return Redirect::to('admin/users');
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/users');
        }
    }

	

    public function userTitles($point=0){
    	$title_field_obj = with(new Option); 
    	$db_options = Option::get_options();
    	$titles = $db_options['points_to_titles'];
    	$title_array = explode(",", $titles);
    	foreach ($title_array as $key => $options) {
		if(isset($options) && !empty($options)){
	    		$preg = preg_split('#\s+#', $options,2);
	    		if($preg[0]==$point){
	    			$title_field_obj->title = $preg[1];
	    			$title_field_obj->points = $preg[0];
	    		} 
		}   		
    	}    	
    	$data['usertitles'] = $title_field_obj;
    	return View::make('admin.user_titles')->with($data);
    }

    public function doUsertitles(){
    	try {
    		//concat(content,'d')
    		$errors = new stdClass();
    		$errors->points = 'This value is already being used by another title';
    		return Redirect::to('admin/usertitles/20')->withErrors($errors);
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.
            //echo "Error: " . $error->getCode() . " " . $error->getMessage();
            Session::flash('error', 'Error in fields Saved!');
            return Redirect::to('admin/userfields');
        }
    }

    public function doUserfields() {
		try {
			if(!Input::get('docancel')) {
				if(Input::get('fieldid')){ 
					Userfield::update_userfields();
				}
				else {
					Userfield::add_userfields();
				}
			}
			return Redirect::to('admin/users');
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.
            //echo "Error: " . $error->getCode() . " " . $error->getMessage();
            Session::flash('error', 'Error in fields Saved!');
            return Redirect::to('admin/userfields');
        }
    }


    public function posting(){    	
		$posting_option = with(new Option);
    	$db_options = Option::get_options();
    	$posting_options = Option::qa_posting_option_names();
    	foreach ($posting_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$posting_option->$tmp_option = $db_options[$option];
    	}    	
    	$data['posting'] = $posting_option;
    	return View::make('admin.posting')->with($data);
    }

    public function doPosting(){
    	try {
    		$posting_options = Option::qa_posting_option_names();
    		if(Input::get('doresetoptions')) { 
    			Option::qa_reset_options($posting_options);
				Session::flash('success', 'Options reset');
    		}
    		else { 
    			foreach ($posting_options as $key => $posting_option) {
    				$option_value = Option::qa_convert_value_into_type($posting_option,Input::get('option_'.$posting_option));
					Option::qa_db_set_option($posting_option,$option_value);
				}		
	        	Session::flash('success', 'Options Saved!');
    		}
    		return Redirect::to('admin/posting');
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/posting');
        }
    }

    public function viewing(){    	
    	$viewing_option = with(new Option);
    	$db_options = Option::get_options();
    	$viewing_options = Option::qa_viewing_option_names();
    	foreach ($viewing_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$viewing_option->$tmp_option = $db_options[$option];
    	}
    	$data['viewing'] = $viewing_option;
    	return View::make('admin.viewing')->with($data);
    }

    public function doViewing(){
    	try {
    		$viewing_options = Option::qa_viewing_option_names();
    		if(Input::get('doresetoptions')) {
    			Option::qa_reset_options($viewing_options);
				Session::flash('success', 'Options reset');				
    		}
    		else {
    			//Option::qa_convert_value_into_type();die;
    			foreach ($viewing_options as $key => $viewing_option) {
    				$option_value = Option::qa_convert_value_into_type($viewing_option,Input::get('option_'.$viewing_option));
					Option::qa_db_set_option($viewing_option,$option_value);
				}		
	        	Session::flash('success', 'Options Saved!');	        	
    		}
    		return Redirect::to('admin/viewing');
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/viewing');
        }
    }

    public function lists(){
    	$list_option =  with(new Option);    	
    	$db_options = Option::get_options();
    	$list_options = Option::qa_lists_option_names();   	 	
    	foreach ($list_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$list_option->$tmp_option = $db_options[$option];
    	}      	 	
    	$data['list'] = $list_option;    	
    	return View::make('admin.lists')->with($data);
    }

    public function doList(){
    	try {
    		$list_options = Option::qa_lists_option_names();
	    	if(Input::get('doresetoptions')) {
	        	//echo "<pre>"; print_r($list_options);die;
	        	Option::qa_reset_options($list_options);
				Session::flash('success', 'Options reset');				
	        }
	        else {
	        	foreach ($list_options as $key => $list_option) {
					Option::qa_db_set_option($list_option,Input::get('option_'.$list_option));
				}		
	        	Session::flash('success', 'Options Saved!');	        	                          
			}
			return Redirect::to('admin/lists');
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/lists');
        }        
    }

    public function categories(){
    	$category_option =  with(new Option);
    	$category_options = Option::qa_category_option_names();
    	$db_options = Option::get_options();
    	foreach ($category_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$category_option->$tmp_option = $db_options[$option];
    	} 
    	$data['categories'] =  Category::get_categories();    	   	
    	$data['categories_opt'] = $category_option;
    	return View::make('admin.categories')->with($data);
    }

    public function category(){
    	$category =  with(new Category);
		$data['category'] = $category;
	 	$options = array(1 => 'First');
		$categories = Category::get_categories();
		//echo "<pre>"; print_r($categories);die;
		foreach ($categories as $key => $categorie) {
			$options += array(($categorie->categoryid+1) => $categorie->title);
		}
		$data['options'] = $options;
		return View::make('admin.add_categories')->with($data);
    }

    public function userFields($fieldId=null) {
    	$user_field_obj = null; 
    	$position = array(1 => 'First');
		$userfields = Userfield::get_userfields();   
			
    	if(isset($fieldId) && $fieldId){
    		$user_field_obj =  Userfield::find($fieldId);
    		$user_field_obj->name = isset($user_field_obj->content)?$user_field_obj->content:$user_field_obj->title;
    		$user_field_obj->type = $user_field_obj->flags;
    		$user_field_obj->onregister = ($user_field_obj->flags>=Config::get('constants.QA_FIELD_FLAGS_ON_REGISTER'))?1:0;    		
    	}
    	else {
    		$user_field_obj = null;
    	}    			
		foreach ($userfields as $key => $userfield) {
			if(($user_field_obj && $user_field_obj->name!=$userfield->label) || !$user_field_obj){
				$position += array(($userfield->fieldid+1) => 'After "'.$userfield->label.'"');
			}
		}    	
    	$data['position'] = $position;
    	$data['userfield'] = $user_field_obj;
		return View::make('admin.user_fields')->with($data);
    }

   /* public function doUserfields() {
		try {
			if(Input::get('docancel')) {
				return Redirect::to('admin/users');
			}
			else {
				Userfield::update_userfields();
			}
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.
            //echo "Error: " . $error->getCode() . " " . $error->getMessage();
            Session::flash('error', 'Error in fields Saved!');
            return Redirect::to('admin/category');
        }
    } */

    public function doCategory(){	
		try{
			if(!Input::get('docancel')) { 
				$rules = array(
					'tags'    => 'required|unique:categories', // make sure its required			
				);
				$validator = Validator::make(Input::all(), $rules);
				if ($validator->fails()) {
		        	Session::flash('message', 'Category name should not be empty!');
					return Redirect::to('admin/category')
						->withErrors($validator);		
				}
				else {
					Category::add_category();
				}									
			}
			return Redirect::to('admin/categories');				
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.
            //echo "Error: " . $error->getCode() . " " . $error->getMessage();
            Session::flash('error', 'Error in Profile Saved!');
            return Redirect::to('admin/category');
        }
    }

    public function doCategories(){ 
    	$category_options = Option::qa_category_option_names();
    	try {
    		if(Input::get('doresetoptions')) {
    			return Redirect::to('admin/category');
    		}
    		else { 
    			foreach ($category_options as $key => $category_option) {
					Option::qa_db_set_option($category_option,(int)Input::get('option_'.$category_option));
				}		
	        	Session::flash('success', 'Options Saved!');
	        	return Redirect::to('admin/categories');
    		}
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/categories');
        }
    }

    public function permissions(){
    	$permission_option =  with(new Option); 
    	$permission_options = Option::qa_permissions_option_names();
    	//echo "<pre>"; print_r($permission_options);die;
    	$db_options = Option::get_options();
    	foreach ($permission_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$permission_option->$tmp_option = $db_options[$option];
    	} 
    	//echo "<pre>"; print_r($permission_option);die;     	 	
    	$data['permissions'] = $permission_option;
    	return View::make('admin.permissions')->with($data);
    }

    public function doPermission(){
    	try {
    		$permission_options = Option::qa_permissions_option_names();
    		if(Input::get('doresetoptions')) {
    			Option::qa_reset_options($permission_options);
				Session::flash('success', 'Options reset');	
    		}
    		else {
    			foreach ($permission_options as $key => $permission_option) {
					Option::qa_db_set_option($permission_option,Input::get('option_'.$permission_option));
				}		
	        	Session::flash('success', 'Options Saved!');
    		}
    		return Redirect::to('admin/permissions');
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/permissions');
        }
    }
   

    public function pages(){
    	$page =  with(new Option);
    	$db_options = Option::get_options();
    	$page_options = Option::qa_page_option_names();
    	foreach ($page_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$page->$tmp_option = $db_options[$option];
    	}    	
    	$data['page'] = $page;
    	return View::make('admin.pages')->with($data);
    }

    public function doPage(){
    	try {
    		$page_options = Option::qa_page_option_names();
    		foreach ($page_options as $key => $page_option) {
				Option::qa_db_set_option($page_option,((int)Input::get('option_'.$page_option)));
			}		
        	Session::flash('success', 'Options Saved!');
        	return Redirect::to('admin/pages');
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/pages');
        } 
    }

    public function points(){    	
    	$point =  with(new Option); 	
    	$db_options = Option::get_options();
    	$point_options = Option::qa_db_points_option_names();    	
    	foreach ($point_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$point->$tmp_option = $db_options[$option];
    	}    	
    	$data['point'] = $point;
    	return View::make('admin.points')->with($data);
    }
    //Do action of points.    
    public function dopoints() {
    	//check which submit was clicked on.
    	try {
    		$point_options = Option::qa_db_points_option_names();
	        if(Input::get('doshowdefaults')) {
	        	//echo "<pre>"; print_r($point_options);die;
	        	Option::qa_reset_options($point_options);
				Session::flash('success', 'Options reset');				
	        }
	        else {				
				foreach ($point_options as $key => $point_option) {
					Option::qa_db_set_option($point_option,Input::get('option_'.$point_option));
				}		
	        	Session::flash('success', 'Options Saved!');	        	                         
			}
			return Redirect::to('admin/points');
		}
		catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/points');
        }        
    }

    public function spam(){
    	$point =  with(new Option); 	
    	$db_options = Option::get_options();
    	$spam_options = Option::qa_spam_option_names();    	
    	foreach ($spam_options as $index => $option) {
    		$tmp_option = 'option_'.$option;
			$point->$tmp_option = $db_options[$option];
    	}    	
    	$data['spam'] = $point;    	    	
    	return View::make('admin.spam')->with($data);
    }

    public function doSpam(){
    	try {
    		$spam_options = Option::qa_spam_option_names(); 
    		if(Input::get('doshowdefaults')) {
    			Option::qa_reset_options($spam_options);
				Session::flash('success', 'Options reset');
    		}
    		else {
    			foreach ($spam_options as $key => $spam_option) {
    				$option_value = Option::qa_convert_value_into_type($spam_option,Input::get('option_'.$spam_option));
					Option::qa_db_set_option($spam_option,$option_value);
				}		
	        	Session::flash('success', 'Options Saved!');
    		}
    		return Redirect::to('admin/spam');
    	}
    	catch (ParseException $error) {
            // The login failed. Check error to see why.	            
            Session::flash('error', 'Error in saving options!');
            return Redirect::to('admin/spam');
        }
    }

    public function moderate(){
    	$data['html'] = "";
    	return View::make('admin.moderate')->with($data);
    }

    public function flagged(){
        $post=new Question;
        $data=$post->getPostByPositiveFlag();
        //echo "<pre>";print_r($data);die;
    	return View::make('admin.flagged')->with(array('data'=>$data));
    }

    public function hidden(){
    	$data['html'] = "";
    	return View::make('admin.hidden')->with($data);
    }
}
