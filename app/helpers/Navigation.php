<?php 
class Navigation {

	public static function nav_list($navigation, $class, $level=null) {	
		$html ="";	
		$html .= '<ul class="qa-'.$class.'-list'.(isset($level) ? (' qa-'.$class.'-list-'.$level) : '').'">';
		$index=0;			
		foreach ($navigation as $key => $navlink) {
			//$this->set_context('nav_key', $key);
			//$this->set_context('nav_index', $index++);
			$html .= Navigation::nav_item($key, $navlink, $class, $level);
		}
		//$this->clear_context('nav_key');
		//$this->clear_context('nav_index');			
		$html .= '</ul>';
		return $html;
	}

	public static function nav_item($key, $navlink, $class, $level=null) 	{	
		$html ="";	
		$suffix=strtr($key, array( // map special character in navigation key
			'$' => '',
			'/' => '-',
		));			
		$html .= '<li class="qa-'.$class.'-item'.(@$navlink['opposite'] ? '-opp' : '').
				(@$navlink['state'] ? (' qa-'.$class.'-'.$navlink['state']) : '').' qa-'.$class.'-'.$suffix.'">';
		$html .= Navigation::nav_link($navlink, $class);			
		if (count(@$navlink['subnav']))
			$this->nav_list($navlink['subnav'], $class, 1+$level);			
		$html .= '</li>';
		return $html;
	}

	public static function nav_link($navlink, $class) {
		$html = "";
		if (isset($navlink['url'])){
			$html .= '<a href="'.$navlink['url'].'" class="qa-'.$class.'-link'.
				(@$navlink['selected'] ? (' qa-'.$class.'-selected') : '').
				(@$navlink['favorited'] ? (' qa-'.$class.'-favorited') : '').
				'"'.(strlen(@$navlink['popup']) ? (' title="'.$navlink['popup'].'"') : '').
				(isset($navlink['target']) ? (' target="'.$navlink['target'].'"') : '').'>'.$navlink['label'].
				'</a>';
		}
		else{ //print_r($navlink);die;
			$html .= '<span class="qa-'.$class.'-nolink'.(@$navlink['selected'] ? (' qa-'.$class.'-selected') : '').
				(@$navlink['favorited'] ? (' qa-'.$class.'-favorited') : '').'"'.
				(strlen(@$navlink['popup']) ? (' title="'.$navlink['popup'].'"') : '').
				'>'.$navlink['label'].'</span>';		
		}

		if (isset($navlink['note']) && strlen($navlink['note'])){
			$html .= '<span class="qa-'.$class.'-note">'.$navlink['note'].'</span>';
		}				
		return $html;
	}

	public static function nav($navtype, $level=null,$handle) {
		$html = "";

		$navArray = $qa_content = app('qa_content');
		$navigation = array();		
		$navArray = $navArray['navigation'];
		if(!isset($navArray[$navtype]) && empty($navArray[$navtype]) && $navtype!="sub"){ 
			return $html;
		}

		if($navtype=='sub'){ //echo $handle;die;
			$routes = Route::currentRouteName();
			$routesArray = explode(" ", $routes);
			$tmpRoutesArray = array();
			$uri = Request::path(); 
			if(is_array($routesArray)){	
			//echo "<pre>"; print_r($routesArray);die;								
				$profile_routes = array('account','profile','favorites','wall','activity','questions','answers','profile/{handle}');
				$admin_routes = array('admin/general','admin/emails','admin/users','admin/posting','admin/viewing','admin/lists','admin/categories','admin/permissions','admin/pages','admin/points','admin/spam','admin/moderate','admin/flagged','admin/hidden');
				$question_routes = array('question','sort/hot');
				if(isset($routesArray[1]) && !empty($routesArray[1])&& in_array($routesArray[1],$profile_routes )){
					$navigation=User::qa_user_sub_navigation($handle, 'profile',true);
					//echo "<pre>"; print_r($navigation);die;
					//$navigation[$routesArray[1]]['selected'] = 1;
				}
				elseif(isset($uri) && !empty($uri) && preg_match('/question/',$uri)){
					$navigation=Question::qa_qs_sub_navigation(null,array());
				}
				elseif(isset($routesArray[1]) && !empty($routesArray[1])&&$routesArray[1]=="unanswered"){
					$navigation=Question::qa_unanswered_sub_navigation(null,array());
					//$navigation[$routesArray[1]]['selected'] = 1;
				}
				elseif(isset($routesArray[1]) && !empty($routesArray[1])&& in_array($routesArray[1],$admin_routes )){
					$navigation=User::qa_admin_sub_navigation();
				}			
			}						
		}		
		else { 
			$navigation=$navArray[$navtype];
		}
		if (($navtype=='user') || isset($navigation)) {
			$html .= '<div class="qa-nav-'.$navtype.'">';			
			if ($navtype=='user'){
				if(Auth::check()){
					$html .= '<div class="qa-logged-in">';
					$html .= '<span class="qa-logged-in-pad">Hello </span>';
					$html .= '<span class="qa-logged-in-data"><a class="qa-user-link" href="/profile">'.Auth::user()->handle.'</a></span></div>';
				}
			}
				
			// reverse order of 'opposite' items since they float right
			foreach (array_reverse($navigation, true) as $key => $navlink){
				if (@$navlink['opposite']) {
					unset($navigation[$key]);
					$navigation[$key]=$navlink;
				}
			}
			
			//$this->set_context('nav_type', $navtype);
			$html .= Navigation::nav_list($navigation, 'nav-'.$navtype, $level);
			//$this->nav_clear($navtype);
			//$this->clear_context('nav_type');

			$html .= '</div>';
			return $html;
		}
	}

	public static function navData(){
		$qa_content = app('qa_content');
		//echo "<pre>"; print_r($qa_content);die;
		//Dynamic navigation..
		return array("user" => array("login" => array("url" => "./index.php?qa=updates",
														"label" => "Login"),
									"register" => array("url" => "./index.php?qa=updates",
														"label" => "Register")),
					"main" => array("questions" => array("url" => "./index.php?qa=updates",
														"label" => "Questions") ,
									"unanswered" => array("url" => "./index.php?qa=updates",
														"label" => "unanswered"),
									"tag" => array("url" => "./index.php?qa=updates",
														"label" => "tag"),
									"user" => array("url" => "./index.php?qa=updates",
														"label" => "Users"),
									"ask" => array("url" => "./index.php?qa=updates",
														"label" => "Ask a Question"),
									"admin" => array("url" => "./index.php?qa=updates",
														"label" => "admin")
									),
					"footer" => array("feedback" => array("url" => "./index.php?qa=updates",
														"label" => "Send feedback"))
				);
	}

	public static function test(){		
		//$qa_content = app('qa_content1');
		//return $qa_content['vik'];
	}

	public static function header($handle=null) { //echo $handle;die;
		$header_html = "";
		$qa_content = app('qa_content');
		//echo "<pre>";print_r($qa_content);die;

		// Logo html section.
		$header_html .= '<div class="qa-logo">';
		$header_html .= $qa_content['logo'];
		$header_html .= '</div>';

		//Top section of user
		$header_html .= Navigation::nav('user',null,$handle);
		

		// Search section.
		$search = $qa_content['search'];
		
		$header_html .= '<div class="qa-search">'.'<form '.$search['form_tags'].'>'.$search['form_extra'];
		$header_html .=  '<input type="text" '.$search['field_tags'].' value="'.@$search['value'].'" class="qa-search-field"/>';
		$header_html .= '<input type="submit" value="'.$search['button_label'].'" class="qa-search-button"/>';
		$header_html .= '</form>'.'</div>';

		// Main Navigation HTML.
		$header_html .= Navigation::nav('main',null,$handle);
		$header_html .= '<div class="qa-nav-main-clear"></div>';

		//Sub Navigation.	
		$header_html .= Navigation::nav('sub',null,$handle);	
		$header_html .= '<div class="qa-header-clear">'.'</div>';
		return $header_html;
 		
	}

	public static function sidepanel(){
		$sidepanel_html = '';
		$sidepanel_html .= '<div class="qa-sidepanel">';

		//Side bar
		$qa_content = app('qa_content');

		//$this->widgets('side', 'top');
		$sidebar=$qa_content['sidebar'];			
		if (!empty($sidebar)) {
			$sidepanel_html .= '<div class="qa-sidebar">';
			$sidepanel_html .= $sidebar;
			$sidepanel_html .= '</div>';
		}
		//$this->widgets('side', 'high');
		$sidepanel_html .= Navigation::nav('cat', 1,null);
		//$this->widgets('side', 'low');
		$sidepanel_html .= $qa_content['sidepanel'];
		//$this->feed();
		//$feed=$qa_content['feed'];
			
		//if (!empty($feed)) {
			$sidepanel_html .= '<div class="qa-feed">';
			$sidepanel_html .= '<a href="" class="qa-feed-link">Recent questions and answers</a>';
			$sidepanel_html .= '</div>';
		//}
		//$this->widgets('side', 'bottom');
		$sidepanel_html .= '</div>';
		return $sidepanel_html;
	}
}