<?php 
class Setting {

	public static function qa_opt($name, $value=null){
		//Cache::forget('qa_settings');
		if (Cache::has('qa_settings')){	
			$qa_options_cache = Cache::get('qa_settings');		
			if ((!isset($value)) && isset($qa_options_cache[$name])){
				return $qa_options_cache[$name]; // quick shortcut to reduce calls to qa_get_options()
			}
		}
		if (isset($value)){
			Setting::qa_set_option($name, $value);		
		}
		$options=Setting::qa_get_options(array($name));
	}

	/*
	Set an option $name to $value (application level) in both cache and database, unless
	$todatabase=false, in which case set it in the cache only
	*/

	public static function  qa_set_option($name, $value, $todatabase=true){
		if ($todatabase && isset($value)){ //die("a");
			Option::qa_db_set_option($name, $value);
		}
		if (!Cache::has('qa_settings')){ //die("b");
			$options = array($name => $value);	
			Cache::put('qa_settings', $options, 15);
		}
		else{ //die("c");
			$qa_options_cache = Cache::get('qa_settings');
			$qa_options_cache[$name] = $value;
		}		
	}

	/*
	Return an array [name] => [value] of settings for each option in $names.
	If any options are missing from the database, set them to their defaults
	*/
	public static function qa_get_options($names){

		//Load all data into Cache.
		$db_options = Option::qa_db_get_options();		
		Cache::add('qa_settings', $db_options, 50); // Set all options into cache.

		$options=array();
		$qa_options_cache = array();

		if (Cache::has('qa_settings')){ 
			$qa_options_cache = Cache::get('qa_settings');
			//echo "<pre>";print_r($qa_options_cache);die;
		}

		//echo "<pre>"; print_r($qa_options_cache);die("vik");
		foreach ($names as $name) {
			if (!isset($qa_options_cache[$name])) {
				$todatabase=true;
				switch ($name) {
					case 'custom_sidebar':
					case 'site_title':
					case 'email_privacy':
					case 'answer_needs_login':
					case 'ask_needs_login':
					case 'comment_needs_login':
					case 'db_time':
						$todatabase=false;
						break;
				}
				Setting::qa_set_option($name,Setting::qa_default_option($name), $todatabase);
			}
			$options[$name]=$qa_options_cache[$name];
		}
		return $options;
	}

	/*
	Return the default value for option $name
	*/

	public static function qa_default_option($name){
		$value = '';
		$fixed_defaults=array(
			'allow_change_usernames' => 1,
			'allow_close_questions' => 1,
			'allow_multi_answers' => 1,
			'allow_private_messages' => 1,
			'allow_user_walls' => 1,
			'allow_self_answer' => 1,
			'allow_view_q_bots' => 1,
			'avatar_allow_gravatar' => 1,
			'avatar_allow_upload' => 1,
			'avatar_message_list_size' => 20,
			'avatar_profile_size' => 200,
			'avatar_q_list_size' => 0,
			'avatar_q_page_a_size' => 40,
			'avatar_q_page_c_size' => 20,
			'avatar_q_page_q_size' => 50,
			'avatar_store_size' => 400,
			'avatar_users_size' => 30,
			'captcha_on_anon_post' => 1,
			'captcha_on_feedback' => 1,
			'captcha_on_register' => 1,
			'captcha_on_reset_password' => 1,
			'captcha_on_unconfirmed' => 0,
			'columns_tags' => 3,
			'columns_users' => 2,
			'comment_on_as' => 1,
			'comment_on_qs' => 0,
			'confirm_user_emails' => 1,
			'do_ask_check_qs' => 0,
			'do_complete_tags' => 1,
			'do_count_q_views' => 1,
			'do_example_tags' => 1,
			'feed_for_activity' => 1,
			'feed_for_qa' => 1,
			'feed_for_questions' => 1,
			'feed_for_unanswered' => 1,
			'feed_full_text' => 1,
			'feed_number_items' => 50,
			'feed_per_category' => 1,
			'feedback_enabled' => 1,
			'flagging_hide_after' => 5,
			'flagging_notify_every' => 2,
			'flagging_notify_first' => 1,
			'flagging_of_posts' => 1,
			'follow_on_as' => 1,
			'hot_weight_a_age' => 100,
			'hot_weight_answers' => 100,
			'hot_weight_q_age' => 100,
			'hot_weight_views' => 100,
			'hot_weight_votes' => 100,
			'mailing_per_minute' => 500,
			'match_ask_check_qs' => 3,
			'match_example_tags' => 3,
			'match_related_qs' => 3,
			'max_copy_user_updates' => 10,
			'max_len_q_title' => 120,
			'max_num_q_tags' => 5,
			'max_rate_ip_as' => 50,
			'max_rate_ip_cs' => 40,
			'max_rate_ip_flags' => 10,
			'max_rate_ip_logins' => 20,
			'max_rate_ip_messages' => 10,
			'max_rate_ip_qs' => 20,
			'max_rate_ip_registers' => 5,
			'max_rate_ip_uploads' => 20,
			'max_rate_ip_votes' => 600,
			'max_rate_user_as' => 25,
			'max_rate_user_cs' => 20,
			'max_rate_user_flags' => 5,
			'max_rate_user_messages' => 5,
			'max_rate_user_qs' => 10,
			'max_rate_user_uploads' => 10,
			'max_rate_user_votes' => 300,
			'max_store_user_updates' => 50,
			'min_len_a_content' => 12,
			'min_len_c_content' => 12,
			'min_len_q_content' => 0,
			'min_len_q_title' => 12,
			'min_num_q_tags' => 0,
			'moderate_notify_admin' => 1,
			'moderate_points_limit' => 150,
			'moderate_update_time' => 1,
			'nav_ask' => 1,
			'nav_qa_not_home' => 1,
			'nav_questions' => 1,
			'nav_tags' => 1,
			'nav_unanswered' => 1,
			'nav_users' => 1,
			'neat_urls' => Config::get('constants.QA_URL_FORMAT_SAFEST'),
			'notify_users_default' => 1,
			'page_size_activity' => 20,
			'page_size_ask_check_qs' => 5,
			'page_size_ask_tags' => 5,
			'page_size_home' => 20,
			'page_size_hot_qs' => 20,
			'page_size_q_as' => 10,
			'page_size_qs' => 20,
			'page_size_related_qs' => 5,
			'page_size_search' => 10,
			'page_size_tag_qs' => 20,
			'page_size_tags' => 30,
			'page_size_una_qs' => 20,
			'page_size_users' => 20,
			'page_size_wall' => 10,
			'pages_prev_next' => 3,
			'permit_anon_view_ips' => Config::get('constants.QA_PERMIT_EDITORS'),
			'permit_close_q' => Config::get('constants.QA_PERMIT_EDITORS'),
			'permit_delete_hidden' => Config::get('constants.QA_PERMIT_MODERATORS'),
			'permit_edit_a' => Config::get('constants.QA_PERMIT_EXPERTS'),
			'permit_edit_c' => Config::get('constants.QA_PERMIT_EDITORS'),
			'permit_edit_q' => Config::get('constants.QA_PERMIT_EDITORS'),
			'permit_edit_silent' => Config::get('constants.QA_PERMIT_MODERATORS'),
			'permit_flag' => Config::get('constants.QA_PERMIT_CONFIRMED'),
			'permit_hide_show' => Config::get('constants.QA_PERMIT_EDITORS'),
			'permit_moderate' => Config::get('constants.QA_PERMIT_EXPERTS'),
			'permit_post_wall' => Config::get('constants.QA_PERMIT_CONFIRMED'),
			'permit_select_a' => Config::get('constants.QA_PERMIT_EXPERTS'),
			'permit_view_q_page' => Config::get('constants.QA_PERMIT_ALL'),
			'permit_view_voters_flaggers' => Config::get('constants.QA_PERMIT_ADMINS'),
			'permit_vote_a' => Config::get('constants.QA_PERMIT_USERS'),
			'permit_vote_down' => Config::get('constants.QA_PERMIT_USERS'),
			'permit_vote_q' => Config::get('constants.QA_PERMIT_USERS'),
			'points_a_selected' => 30,
			'points_a_voted_max_gain' => 20,
			'points_a_voted_max_loss' => 5,
			'points_base' => 100,
			'points_multiple' => 10,
			'points_post_a' => 4,
			'points_post_q' => 2,
			'points_q_voted_max_gain' => 10,
			'points_q_voted_max_loss' => 3,
			'points_select_a' => 3,
			'q_urls_title_length' => 50,
			'show_a_c_links' => 1,
			'show_a_form_immediate' => 'if_no_as',
			'show_c_reply_buttons' => 1,
			'show_custom_welcome' => 1,
			'show_fewer_cs_count' => 5,
			'show_fewer_cs_from' => 10,
			'show_full_date_days' => 7,
			'show_message_history' => 1,
			'show_selected_first' => 1,
			'show_url_links' => 1,
			'show_user_points' => 1,
			'show_user_titles' => 1,
			'show_when_created' => 1,
			'site_theme' => 'Snow',
			'smtp_port' => 25,
			'sort_answers_by' => 'created',
			'tags_or_categories' => 'tc',
			'voting_on_as' => 1,
			'voting_on_qs' => 1,
		);
		if (isset($fixed_defaults[$name])){
			$value=$fixed_defaults[$name];
		}
		else {
			switch ($name) {
				case 'custom_sidebar':
					$value='Welcome to ^, where you can ask questions and receive answers from other members of the community.';
					break;
			}
		}		
		return $value;
	}
}