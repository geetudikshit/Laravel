<?php

use Carbon\Carbon;

class Option extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'options';
	public static $optiontype=array(
		'avatar_message_list_size' => 'number',
		'avatar_profile_size' => 'number',
		'avatar_q_list_size' => 'number',
		'avatar_q_page_a_size' => 'number',
		'avatar_q_page_c_size' => 'number',
		'avatar_q_page_q_size' => 'number',
		'avatar_store_size' => 'number',
		'avatar_users_size' => 'number',
		'columns_tags' => 'number',
		'columns_users' => 'number',
		'feed_number_items' => 'number',
		'flagging_hide_after' => 'number',
		'flagging_notify_every' => 'number',
		'flagging_notify_first' => 'number',
		'hot_weight_a_age' => 'number',
		'hot_weight_answers' => 'number',
		'hot_weight_q_age' => 'number',
		'hot_weight_views' => 'number',
		'hot_weight_votes' => 'number',
		'logo_height' => 'number-blank',
		'logo_width' => 'number-blank',
		'mailing_per_minute' => 'number',
		'max_len_q_title' => 'number',
		'max_num_q_tags' => 'number',
		'max_rate_ip_as' => 'number',
		'max_rate_ip_cs' => 'number',
		'max_rate_ip_flags' => 'number',
		'max_rate_ip_logins' => 'number',
		'max_rate_ip_messages' => 'number',
		'max_rate_ip_qs' => 'number',
		'max_rate_ip_registers' => 'number',
		'max_rate_ip_uploads' => 'number',
		'max_rate_ip_votes' => 'number',
		'max_rate_user_as' => 'number',
		'max_rate_user_cs' => 'number',
		'max_rate_user_flags' => 'number',
		'max_rate_user_messages' => 'number',
		'max_rate_user_qs' => 'number',
		'max_rate_user_uploads' => 'number',
		'max_rate_user_votes' => 'number',
		'min_len_a_content' => 'number',
		'min_len_c_content' => 'number',
		'min_len_q_content' => 'number',
		'min_len_q_title' => 'number',
		'min_num_q_tags' => 'number',
		'moderate_points_limit' => 'number',
		'page_size_activity' => 'number',
		'page_size_ask_check_qs' => 'number',
		'page_size_ask_tags' => 'number',
		'page_size_home' => 'number',
		'page_size_hot_qs' => 'number',
		'page_size_q_as' => 'number',
		'page_size_qs' => 'number',
		'page_size_related_qs' => 'number',
		'page_size_search' => 'number',
		'page_size_tag_qs' => 'number',
		'page_size_tags' => 'number',
		'page_size_una_qs' => 'number',
		'page_size_users' => 'number',
		'page_size_wall' => 'number',
		'pages_prev_next' => 'number',
		'q_urls_title_length' => 'number',
		'show_fewer_cs_count' => 'number',
		'show_fewer_cs_from' => 'number',
		'show_full_date_days' => 'number',
		'smtp_port' => 'number',
		
		'allow_change_usernames' => 'checkbox',
		'allow_close_questions' => 'checkbox',
		'allow_login_email_only' => 'checkbox',
		'allow_multi_answers' => 'checkbox',
		'allow_private_messages' => 'checkbox',
		'allow_user_walls' => 'checkbox',
		'allow_self_answer' => 'checkbox',
		'allow_view_q_bots' => 'checkbox',
		'approve_user_required' => 'checkbox',
		'avatar_allow_gravatar' => 'checkbox',
		'avatar_allow_upload' => 'checkbox',
		'avatar_default_show' => 'checkbox',
		'captcha_on_anon_post' => 'checkbox',
		'captcha_on_feedback' => 'checkbox',
		'captcha_on_register' => 'checkbox',
		'captcha_on_reset_password' => 'checkbox',
		'captcha_on_unapproved' => 'checkbox',
		'captcha_on_unconfirmed' => 'checkbox',
		'comment_on_as' => 'checkbox',
		'comment_on_qs' => 'checkbox',
		'confirm_user_emails' => 'checkbox',
		'confirm_user_required' => 'checkbox',
		'do_ask_check_qs' => 'checkbox',
		'do_close_on_select' => 'checkbox',
		'do_complete_tags' => 'checkbox',
		'do_count_q_views' => 'checkbox',
		'do_example_tags' => 'checkbox',
		'extra_field_active' => 'checkbox',
		'extra_field_display' => 'checkbox',
		'feed_for_activity' => 'checkbox',
		'feed_for_hot' => 'checkbox',
		'feed_for_qa' => 'checkbox',
		'feed_for_questions' => 'checkbox',
		'feed_for_search' => 'checkbox',
		'feed_for_tag_qs' => 'checkbox',
		'feed_for_unanswered' => 'checkbox',
		'feed_full_text' => 'checkbox',
		'feed_per_category' => 'checkbox',
		'feedback_enabled' => 'checkbox',
		'flagging_of_posts' => 'checkbox',
		'follow_on_as' => 'checkbox',
		'links_in_new_window' => 'checkbox',
		'logo_show' => 'checkbox',
		'mailing_enabled' => 'checkbox',
		'moderate_anon_post' => 'checkbox',
		'moderate_by_points' => 'checkbox',
		'moderate_edited_again' => 'checkbox',
		'moderate_notify_admin' => 'checkbox',
		'moderate_unapproved' => 'checkbox',
		'moderate_unconfirmed' => 'checkbox',
		'moderate_users' => 'checkbox',
		'neat_urls' => 'checkbox',
		'notify_admin_q_post' => 'checkbox',
		'notify_users_default' => 'checkbox',
		'q_urls_remove_accents' => 'checkbox',
		'register_notify_admin' => 'checkbox',
		'show_c_reply_buttons' => 'checkbox',
		'show_custom_answer' => 'checkbox',
		'show_custom_ask' => 'checkbox',
		'show_custom_comment' => 'checkbox',
		'show_custom_footer' => 'checkbox',
		'show_custom_header' => 'checkbox',
		'show_custom_home' => 'checkbox',
		'show_custom_in_head' => 'checkbox',
		'show_custom_register' => 'checkbox',
		'show_custom_sidebar' => 'checkbox',
		'show_custom_sidepanel' => 'checkbox',
		'show_custom_welcome' => 'checkbox',
		'show_home_description' => 'checkbox',
		'show_message_history' => 'checkbox',
		'show_notice_visitor' => 'checkbox',
		'show_notice_welcome' => 'checkbox',
		'show_selected_first' => 'checkbox',
		'show_url_links' => 'checkbox',
		'show_user_points' => 'checkbox',
		'show_user_titles' => 'checkbox',
		'show_view_counts' => 'checkbox',
		'show_view_count_q_page' => 'checkbox',
		'show_when_created' => 'checkbox',
		'site_maintenance' => 'checkbox',
		'smtp_active' => 'checkbox',
		'smtp_authenticate' => 'checkbox',
		'suspend_register_users' => 'checkbox',
		'tag_separator_comma' => 'checkbox',
		'votes_separated' => 'checkbox',
		'voting_on_as' => 'checkbox',
		'voting_on_q_page_only' => 'checkbox',
		'voting_on_qs' => 'checkbox',
		
		'smtp_password' => 'password',
	);
	public static $optionmaximum=array(
		'feed_number_items' => 50,
		'max_len_q_title' => 800,
		'page_size_activity' => 50,
		'page_size_ask_check_qs' => 50,
		'page_size_ask_tags' => 50,
		'page_size_home' => 50,
		'page_size_hot_qs' => 50,
		'page_size_qs' => 50,
		'page_size_related_qs' => 50,
		'page_size_search' => 50,
		'page_size_tag_qs' => 50,
		'page_size_tags' => 200,
		'page_size_una_qs' => 50,
		'page_size_users' => 200,
		'page_size_wall' => 20,
	);

	public static $optionminimum=array(
		'flagging_hide_after' => 2,
		'flagging_notify_every' => 1,
		'flagging_notify_first' => 1,
		'max_num_q_tags' => 2,
		'max_rate_ip_logins' => 1,
		'page_size_activity' => 1,
		'page_size_ask_check_qs' => 3,
		'page_size_ask_tags' => 3,
		'page_size_home' => 1,
		'page_size_hot_qs' => 1,
		'page_size_q_as' => 1,
		'page_size_qs' => 1,
		'page_size_search' => 1,
		'page_size_tag_qs' => 1,
		'page_size_tags' => 1,
		'page_size_users' => 1,
		'page_size_wall' => 1,
	);

	/*
	Set option $name to $value in the database
	*/	

	public static function qa_db_set_option($name, $value){		
		DB::select('REPLACE '.DB::getTablePrefix().'options (title, content) VALUES (?, ?)',array($name,$value));
		//Update in cache..
		if (Cache::has('qa_settings')){
			$db_options = Cache::get('qa_settings');
			$db_options[$name] = $value;
			Cache::put('qa_settings', $db_options, 100);
		}
	}

	//Get all options from database.
	public static function qa_db_get_options(){		
		$options = DB::table('options')->get();		
		$tmp_options = array();
		foreach ($options as $key => $option) {
			$tmp_options[$option->title] = $option->content;
		}
		return $tmp_options;
	}

	public static function qa_db_set_options_in_cache(){
		$db_options = Option::qa_db_get_options();
		Cache::put('qa_settings', $db_options, 100);
	}

	public static function get_options(){
		$db_options = array();
		//Cache::forget('qa_settings');
		if (Cache::has('qa_settings')){ 
	    		$db_options = Cache::get('qa_settings');
	    	}
	    	else {
	    		$db_options = Option::qa_db_get_options();		
				Cache::put('qa_settings', $db_options, 100);
	    	}
	    	return $db_options;
	}

	/** 
	All Points related functions 
	**/

	/*
	Returns an array of option names required to perform calculations in userpoints table
	*/

	public static function qa_db_points_option_names() {
		return array(
			'points_post_q', 'points_select_a', 'points_per_q_voted_up', 'points_per_q_voted_down', 'points_q_voted_max_gain', 'points_q_voted_max_loss',
			'points_post_a', 'points_a_selected', 'points_per_a_voted_up', 'points_per_a_voted_down', 'points_a_voted_max_gain', 'points_a_voted_max_loss',
			'points_vote_up_q', 'points_vote_down_q', 'points_vote_up_a', 'points_vote_down_a','points_multiple', 'points_base',
		);
	}

	/*
	Set an option $name to $value (application level) in both cache and database, unless
	$todatabase=false, in which case set it in the cache only
	*/

	public static function qa_set_option($name, $value, $todatabase=true){
		if ($todatabase && isset($value)){
			Option::qa_db_set_option($name, $value);
			//$qa_options_cache[$name]=$value;
		}
	}

	/**
	All list option related function
	**/

	public static function qa_lists_option_names(){
		$list = array('page_size_home', 'page_size_activity', 'page_size_qs', 'page_size_hot_qs', 'page_size_una_qs');
		if (Option::qa_using_tags()){
			$list[]='page_size_tag_qs';
		}
		$list[] = '';

		if (Option::qa_using_tags()){
			array_push($list, 'page_size_tags', 'columns_tags');
		}

		array_push($list, 'page_size_users', 'columns_users', '');
		//echo "<pre>"; print_r($list);die;
		$searchmodules=array('search');//qa_load_modules_with('search', 'process_search');
		if (count($searchmodules)){
			$list[]='search_module';
		}
		$list[]='page_size_search';
		array_push($list, '', 'admin/hotness_factors', 'hot_weight_q_age', 'hot_weight_a_age', 'hot_weight_answers', 'hot_weight_votes');
		if (Setting::qa_opt('do_count_q_views')){
			$list[]='hot_weight_views';
		}	
		$getoptions = Option::qa_get_options_data($list);
		//echo "<pre>"; print_r($getoptions);die;
		return $getoptions;		
	}

	public static function qa_get_options_data($options) {
		$getoptions=array();
		foreach ($options as $optionname){
			if (strlen($optionname) && (strpos($optionname, '/')===false)){ // empties represent spacers in forms
				$getoptions[]=$optionname;
			}
		}
		return $getoptions;
	}
	/*
		Return whether the option is set to classify questions by tags
	*/
	public static function qa_using_tags(){
		return strpos(Setting::qa_opt('tags_or_categories'), 't')!==false;
	}

	/*
	Reset the options in $names to their defaults
	*/

	public static function qa_reset_options($names){
		foreach ($names as $name){
			Option::qa_set_option($name, Setting::qa_default_option($name));
		}
	}

	/**
	All general data....
	**/

	public static function qa_general_option_names(){
		$generals = array('site_title','site_url');
		return $generals;
	}

	/**
	All emails options.
	**/

	public static function qa_email_option_names(){
		$emails = array('from_email','feedback_email');
		return $emails;
	}

	/**
	All viewing options..
	**/
	public static function qa_viewing_option_names(){
		$viewings = array('q_urls_title_length', 'q_urls_remove_accents', 'do_count_q_views', 'show_view_counts', 'show_view_count_q_page', '', 'voting_on_qs', 'voting_on_q_page_only', 'voting_on_as', 'votes_separated', '', 'show_url_links', 'links_in_new_window', 'show_when_created', 'show_full_date_days');
		//if (count(qa_get_points_to_titles())){
			//$viewings[]='show_user_titles';
		//}
		array_push($viewings, 'show_user_points', '', 'sort_answers_by', 'show_selected_first', 'page_size_q_as', 'show_a_form_immediate');
		if (Setting::qa_opt('comment_on_qs') || Setting::qa_opt('comment_on_as')){
			array_push($viewings, 'show_fewer_cs_from', 'show_fewer_cs_count', 'show_c_reply_buttons');
		}
		$viewings[]='';
		$viewings[]='pages_prev_next';
		$getoptions = Option::qa_get_options_data($viewings);
		return $getoptions;
	}

	/**
	All posting options.
	**/
	public static function qa_posting_option_names() {
		$postings = array('do_close_on_select', 'allow_close_questions', 'allow_self_answer', 'allow_multi_answers', 'follow_on_as', 'comment_on_qs', 'comment_on_as', '');
		/*if (count(qa_list_modules('editor'))>1){ */
			//array_push($postings, 'editor_for_qs', 'editor_for_as', 'editor_for_cs', '');
		/*}*/
		array_push($postings, 'show_custom_ask', 'custom_ask', 'extra_field_active', 'extra_field_prompt', 'extra_field_display', 'extra_field_label', 'show_custom_answer', 'custom_answer', 'show_custom_comment', 'custom_comment', '');
		array_push($postings, 'min_len_q_title', 'max_len_q_title', 'min_len_q_content');
		if (Option::qa_using_tags()) {
			array_push($postings, 'min_num_q_tags', 'max_num_q_tags', 'tag_separator_comma');
		}
		array_push($postings, 'min_len_a_content', 'min_len_c_content', 'notify_users_default');
		array_push($postings, '', 'block_bad_words', '', 'do_ask_check_qs', 'match_ask_check_qs', 'page_size_ask_check_qs', '');
		if (Option::qa_using_tags()){
			array_push($postings, 'do_example_tags', 'match_example_tags', 'do_complete_tags', 'page_size_ask_tags');
		}
		$getoptions = Option::qa_get_options_data($postings);
		return $getoptions;
		//echo "<pre>"; print_r($postings);die;
	}

	/** 
	All Spam options....
	**/

	public static function qa_spam_option_names(){
		$spams=array();
		$getoptions=Setting::qa_get_options(array('feedback_enabled', 'permit_post_q', 'permit_post_a', 'permit_post_c'));
		if (!Config::get('constants.QA_FINAL_EXTERNAL_USERS')){
			array_push($spams, 'confirm_user_emails', 'confirm_user_required', 'moderate_users', 'approve_user_required', 'register_notify_admin', 'suspend_register_users', '');
		}
		$captchamodules = array('reCAPTCHA');
		$maxpermitpost=max(Setting::qa_opt('permit_post_q'), Setting::qa_opt('permit_post_a'));
		if (Setting::qa_opt('comment_on_qs') || Setting::qa_opt('comment_on_as')){
			$maxpermitpost=max($maxpermitpost, Setting::qa_opt('permit_post_c'));
		}

		if (count($captchamodules)) {
			if (!Config::get('constants.QA_FINAL_EXTERNAL_USERS')){
				array_push($spams, 'captcha_on_register', 'captcha_on_reset_password');
			}			
			if ($maxpermitpost > Config::get('constants.QA_PERMIT_USERS')){
				$spams[]='captcha_on_anon_post';
			}				
			if ($maxpermitpost > Config::get('constants.QA_PERMIT_APPROVED')){
				$spams[]='captcha_on_unapproved';
			}				
			if ($maxpermitpost > Config::get('constants.QA_PERMIT_CONFIRMED')){
				$spams[]='captcha_on_unconfirmed';
			}				
			if ($getoptions['feedback_enabled']){
				$spams[]='captcha_on_feedback';
			}				
			$spams[]='captcha_module';
		}

		$spams[]='';
		if ($maxpermitpost > Config::get('constants.QA_PERMIT_USERS')){
			$spams[]='moderate_anon_post';
		}
		if ($maxpermitpost > Config::get('constants.QA_PERMIT_APPROVED')) {
			$spams[]='moderate_unapproved';
		}	

		if ($maxpermitpost > Config::get('constants.QA_PERMIT_CONFIRMED')){
			$spams[]='moderate_unconfirmed';
		}				
		if ($maxpermitpost > Config::get('constants.QA_PERMIT_EXPERTS')){
			array_push($spams, 'moderate_by_points', 'moderate_points_limit', 'moderate_edited_again', 'moderate_notify_admin', 'moderate_update_time', '');
		}	

		array_push($spams, 'flagging_of_posts', 'flagging_notify_first', 'flagging_notify_every', 'flagging_hide_after', '');
		array_push($spams, 'block_ips_write', '');

		if (!Config::get('constants.QA_FINAL_EXTERNAL_USERS')){
			array_push($spams, 'max_rate_ip_registers', 'max_rate_ip_logins', '');
		}
		array_push($spams, 'max_rate_ip_qs', 'max_rate_user_qs', 'max_rate_ip_as', 'max_rate_user_as');
		if (Setting::qa_opt('comment_on_qs') || Setting::qa_opt('comment_on_as')){
			array_push($spams, 'max_rate_ip_cs', 'max_rate_user_cs');
		}			
		$spams[]='';			
		if (Setting::qa_opt('voting_on_qs') || Setting::qa_opt('voting_on_as')){
			array_push($spams, 'max_rate_ip_votes', 'max_rate_user_votes');
		}
		array_push($spams, 'max_rate_ip_flags', 'max_rate_user_flags', 'max_rate_ip_uploads', 'max_rate_user_uploads');
		if (Setting::qa_opt('allow_private_messages') || Setting::qa_opt('allow_user_walls')){
			array_push($spams, 'max_rate_ip_messages', 'max_rate_user_messages');
		}
		$getoptions = Option::qa_get_options_data($spams);
		return $getoptions;
		//echo "<pre>"; print_r($getoptions);die;
	}

	//	For non-text options, lists of option types, minima and maxima
	public static function qa_convert_value_into_type($optionname,$optionvalue){		
		if ((@Option::$optiontype[$optionname]=='number') ||(@Option::$optiontype[$optionname]=='checkbox') || ((@Option::$optiontype[$optionname]=='number-blank') && strlen($optionvalue))){
			$optionvalue=(int)$optionvalue;			
		}
		if (isset(Option::$optionmaximum[$optionname])){ 
			$optionvalue=min(Option::$optionmaximum[$optionname], $optionvalue);
		}	
		if (isset(Option::$optionminimum[$optionname])){ 
			$optionvalue=max(Option::$optionminimum[$optionname], $optionvalue);
		}
		return $optionvalue;
	}

	public static function qa_permissions_option_names(){
		$permitoptions = Option::qa_get_permit_options();
		$permissions = array();
		foreach ($permitoptions as $permitoption) {
			$permissions[] = $permitoption;
			if ($permitoption=='permit_view_q_page') {
				$permissions[]='allow_view_q_bots';
				//$checkboxtodisplay['allow_view_q_bots']='option_permit_view_q_page<'.qa_js(QA_PERMIT_ALL);
				
			} else {
				$permissions[] = $permitoption.'_points';
				//$checkboxtodisplay[$permitoption.'_points']='(option_'.$permitoption.'=='.qa_js(QA_PERMIT_POINTS).
					//')||(option_'.$permitoption.'=='.qa_js(QA_PERMIT_POINTS_CONFIRMED).')||(option_'.$permitoption.'=='.qa_js(QA_PERMIT_APPROVED_POINTS).')';
			}
		}
		//echo "<pre>"; print_r($permissions);die;
		return $permissions;
	}

	public static function qa_page_option_names(){
		return array('nav_questions','nav_hot','nav_unanswered','nav_tags','nav_users','nav_ask');
	}

	public static function qa_category_option_names(){
		return array('allow_no_category','allow_no_sub_category');
	}

	public static function qa_user_option_names(){
		$users = array('show_notice_visitor', 'notice_visitor');
		if (!Config::get('constants.QA_FINAL_EXTERNAL_USERS')) {				
			array_push($users, 'show_custom_register', 'custom_register', 'show_notice_welcome', 'notice_welcome', 'show_custom_welcome', 'custom_welcome');
			array_push($users, '' ,'allow_login_email_only', 'allow_change_usernames', 'allow_private_messages', 'show_message_history', 'allow_user_walls', 'page_size_wall', '', 'avatar_allow_gravatar');
			//if (qa_has_gd_image()){
				array_push($users, 'avatar_allow_upload', 'avatar_store_size', 'avatar_default_show');
			//}
		}
		$users[] = '';
		if (!Config::get('constants.QA_FINAL_EXTERNAL_USERS')){
			$users[]='avatar_profile_size';
		}
		array_push($users, 'avatar_users_size', 'avatar_q_page_q_size', 'avatar_q_page_a_size', 'avatar_q_page_c_size','avatar_q_list_size', 'avatar_message_list_size');
		$getoptions = Option::qa_get_options_data($users);
		return $getoptions;
	}

	public static function qa_convert_spam_value_into_type(){
		$checkboxtodisplay=array(
				'confirm_user_required' => 'option_confirm_user_emails',
				'approve_user_required' => 'option_moderate_users',
				'captcha_on_unapproved' => 'option_moderate_users',
				'captcha_on_unconfirmed' => 'option_confirm_user_emails && !(option_moderate_users && option_captcha_on_unapproved)',
				'captcha_module' => 'option_captcha_on_register || option_captcha_on_anon_post || (option_confirm_user_emails && option_captcha_on_unconfirmed) || (option_moderate_users && option_captcha_on_unapproved) || option_captcha_on_reset_password || option_captcha_on_feedback',
				'moderate_unapproved' => 'option_moderate_users',
				'moderate_unconfirmed' => 'option_confirm_user_emails && !(option_moderate_users && option_moderate_unapproved)',
				'moderate_points_limit' => 'option_moderate_by_points',
				'moderate_points_label_off' => '!option_moderate_by_points',
				'moderate_points_label_on' => 'option_moderate_by_points',
				'moderate_edited_again' => 'option_moderate_anon_post || (option_confirm_user_emails && option_moderate_unconfirmed) || (option_moderate_users && option_moderate_unapproved) || option_moderate_by_points',
				'flagging_hide_after' => 'option_flagging_of_posts',
				'flagging_notify_every' => 'option_flagging_of_posts',
				'flagging_notify_first' => 'option_flagging_of_posts',
				'max_rate_ip_flags' =>  'option_flagging_of_posts',
				'max_rate_user_flags' => 'option_flagging_of_posts',
			);			
			$checkboxtodisplay['moderate_notify_admin']=$checkboxtodisplay['moderate_edited_again'];
			$checkboxtodisplay['moderate_update_time']=$checkboxtodisplay['moderate_edited_again'];
	}
	/*
	Return an array of relevant permissions settings, based on other options
	*/

	public static function qa_get_permit_options(){
		$permits=array('permit_view_q_page', 'permit_post_q', 'permit_post_a');		
		if (Setting::qa_opt('comment_on_qs') || Setting::qa_opt('comment_on_as')){
			$permits[]='permit_post_c';
		}		
		if (Setting::qa_opt('voting_on_qs')){
			$permits[]='permit_vote_q';
		}			
		if (Setting::qa_opt('voting_on_as')){
			$permits[]='permit_vote_a';
		}			
		if (Setting::qa_opt('voting_on_qs') || Setting::qa_opt('voting_on_as')){
			$permits[]='permit_vote_down';
		}			
		if (Option::qa_using_tags() || Setting::qa_using_categories()){
			$permits[]='permit_retag_cat';
		}		
		array_push($permits, 'permit_edit_q', 'permit_edit_a');		
		if (Setting::qa_opt('comment_on_qs') || Setting::qa_opt('comment_on_as')){
			$permits[]='permit_edit_c';
		}			
		$permits[]='permit_edit_silent';		
		if (Setting::qa_opt('allow_close_questions')){
			$permits[]='permit_close_q';
		}		
		array_push($permits, 'permit_select_a', 'permit_anon_view_ips');		
		if (Setting::qa_opt('voting_on_qs') || Setting::qa_opt('voting_on_as') || Setting::qa_opt('flagging_of_posts')){
			$permits[]='permit_view_voters_flaggers';
		}		
		if (Setting::qa_opt('flagging_of_posts')){
			$permits[]='permit_flag';
		}		
		$permits[]='permit_moderate';
		array_push($permits, 'permit_hide_show', 'permit_delete_hidden');		
		if (Setting::qa_opt('allow_user_walls')){
			$permits[]='permit_post_wall';
		}		
		return $permits;
	}
}
