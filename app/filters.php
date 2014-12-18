<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{	//View::share('qa_content', app('qa_content'));

	App::singleton('qa_content', function(){
        $settings = array();
		
		// This is for making header.
		$qa_content = array();
		//$qa_content['settings'] = $settings;
		$logoshow = Setting::qa_opt('logo_show');		
		$logourl = Setting::qa_opt('logo_url');
		$logowidth = Setting::qa_opt('logo_width');
		$logoheight = Setting::qa_opt('logo_height');
		//echo Setting::qa_opt('site_title');die("vik007");
		if ($logoshow){
			$qa_content['logo']='<a href="/" class="qa-logo-link" title="'.$settings['site_title'].'">'.
					'<img src="'.(is_numeric(strpos($logourl, '://')) ? $logourl : $logourl).'"'.
					($logowidth ? (' width="'.$logowidth.'"') : '').($logoheight ? (' height="'.$logoheight.'"') : '').
					' border="0" alt="'.Setting::qa_opt('site_title').'"/></a>';
		}
		else {
			$qa_content['logo']='<a href="/" class="qa-logo-link">'.Setting::qa_opt('site_title').'</a>';
		}

				
		//$point_options = array('points_post_q', 'points_select_a', 'points_per_q_voted_up', 'points_per_q_voted_down', 'points_q_voted_max_gain', 'points_q_voted_max_loss',
									//	'points_post_a', 'points_a_selected', 'points_per_a_voted_up', 'points_per_a_voted_down', 'points_a_voted_max_gain', 'points_a_voted_max_loss',
									//	'points_vote_up_q', 'points_vote_down_q', 'points_vote_up_a', 'points_vote_down_a','points_multiple', 'points_base',);
		/*foreach ($point_options as $key => $point_option) {
			$qa_content['bonus_points'][$point_option] = Setting::qa_opt($point_option);
		}*/
		 
		// Search box
		$qa_content['search']=array(
			'form_tags' => 'method="post" action="/search"',
			'form_extra' => "",
			'title' => "Search results",
			'field_tags' => 'name="q"',
			'button_label' => "Search",
		);
		$custom_sidebar = str_replace($symbol='^',Setting::qa_opt('site_title'),"Welcome to ^, where you can ask questions and receive answers from other members of the community.");
		$qa_content['sidebar'] = Setting::qa_opt('show_custom_sidebar') ? $custom_sidebar : null;

		$qa_content['sidepanel'] = Setting::qa_opt('show_custom_sidepanel') ? Setting::qa_opt('custom_sidepanel') : null;

		//This is for menu.
		$qa_content['navigation'] = array('user' => array(),
											'main' => array(),
											'footer' => array('feedback' => array('url' => "",
															'label' => "Send feedback",
														),
											),
	
									);
		if (Setting::qa_opt('nav_home') && Setting::qa_opt('show_custom_home')){
			$qa_content['navigation']['main']['$']=array(
				'url' => "#",
				'label' => "Home",
			);
		}

		if (Setting::qa_opt('nav_activity')){
			$qa_content['navigation']['main']['activity']=array(
				'url' => "#",
				'label' => "All Activity",
			);
		}

		$hascustomhome = Setting::qa_opt('show_custom_home') || (array_search('', array())!==false);
		if (Setting::qa_opt($hascustomhome ? 'nav_qa_not_home' : 'nav_qa_is_home')){
			$qa_content['navigation']['main'][$hascustomhome ? 'qa' : '$']=array(
				'url' => ($hascustomhome ? 'qa' : ''),
				'label' => "Q&A",
			);
		}

		if (Setting::qa_opt('nav_questions')) {
			$qa_content['navigation']['main']['questions']=array(
				'url' => "/question",
				'label' => "Questions",
			);
		}

		if (Setting::qa_opt('nav_hot')){
			$qa_content['navigation']['main']['hot']=array(
				'url' => "#",
				'label' => "Hot!",
			);
		}

		if (Setting::qa_opt('nav_unanswered')){
			$qa_content['navigation']['main']['unanswered']=array(
				'url' => "/unanswered",
				'label' => "Unanswered",
			);
		}
			
		if ((strpos(Setting::qa_opt('tags_or_categories'), 't')!==false) && Setting::qa_opt('nav_tags')){
			$qa_content['navigation']['main']['tag']=array(
				'url' => "/tags",
				'label' => "Tags",
			);
		}
			
		if ((strpos(Setting::qa_opt('tags_or_categories'), 'c')!==false) && Setting::qa_opt('nav_categories')){
			$qa_content['navigation']['main']['categories']=array(
				'url' => "#",
				'label' => "Categories",
			);
		}

		if (Setting::qa_opt('nav_users')){
			$qa_content['navigation']['main']['user']=array(
				'url' => "/user",
				'label' => "Users",
			);
		}
		//&& (qa_user_maximum_permit_error('permit_post_q')!='level')
		//echo "<pre>";print_r(Setting::qa_opt('nav_ask'));die(' jreal');
		if (Setting::qa_opt('nav_ask')){
			$qa_content['navigation']['main']['ask']=array(
				'url' => "/ask",
				'label' => "Ask a Question",
			);
		}		
		if(Auth::check()){			
			if (
				(Auth::user()->level>=Config::get('constants.QA_USER_LEVEL_ADMIN')) ||
				(!User::qa_user_maximum_permit_error('permit_moderate')) ||
				(!User::qa_user_maximum_permit_error('permit_hide_show')) ||
				(!User::qa_user_maximum_permit_error('permit_delete_hidden'))
			)
			$qa_content['navigation']['main']['admin']=array(
				'url' => '/admin/general',
				'label' => 'Admin',
			);
		}
		
		if (!Setting::qa_opt('feedback_enabled')){
			unset($qa_content['navigation']['footer']['feedback']);
		}
		$navpages = array();
		foreach ($navpages as $page) {
			if ( ($page['nav']=='M') || ($page['nav']=='O') || ($page['nav']=='F') ){
				//qa_navigation_add_page($qa_content['navigation'][($page['nav']=='F') ? 'footer' : 'main'], $page);
			}
		}

		// Manage widgets section.
		$regioncodes=array(
			'F' => 'full',
			'M' => 'main',
			'S' => 'side',
		);
		
		$placecodes=array(
			'T' => 'top',
			'H' => 'high',
			'L' => 'low',
			'B' => 'bottom',
		);
		$widgets = array();
		/*foreach ($widgets as $widget){
			if (is_numeric(strpos(','.$widget['tags'].',', ','.$qa_template.',')) || is_numeric(strpos(','.$widget['tags'].',', ',all,'))) { // see if it has been selected for display on this template
				$region=@$regioncodes[substr($widget['place'], 0, 1)];
				$place=@$placecodes[substr($widget['place'], 1, 2)];
				
				if (isset($region) && isset($place)) { // check region/place codes recognized
					$module=qa_load_module('widget', $widget['title']);
					
					if (
						isset($module) &&
						method_exists($module, 'allow_template') &&
						$module->allow_template((substr($qa_template, 0, 7)=='custom-') ? 'custom' : $qa_template) &&
						method_exists($module, 'allow_region') &&
						$module->allow_region($region) &&
						method_exists($module, 'output_widget')
					)
						$qa_content['widgets'][$region][$place][]=$module; // if module loaded and happy to be displayed here, tell theme about it
				}
			}
		}*/

		$userlinks = array('login' => "/login",
							'register' => "/register",
							'confirm' => "/confirm",
							'logout' => "/logout",
						);
		if(Auth::check()){
			$qa_content['navigation']['user']['login']= array(
				'url' => '/updates',
				'label' => "My Updates",
			);
			$qa_content['navigation']['user']['logout']=array(
					'url' => '/logout',
					'label' => "Logout",
			);
		}
		else {
			if (!empty($userlinks['login'])){
				$qa_content['navigation']['user']['login']=array(
					'url' => "/login",
					'label' => "Login",
				);
			}
					
			if (!empty($userlinks['register'])){
				$qa_content['navigation']['user']['register']=array(
					'url' => "register",
					'label' => "Register",
				);
			}
		}
		return $qa_content;
    });
	$qa_content = App::make('qa_content');
    View::share('qa_content', $qa_content);
});




App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});