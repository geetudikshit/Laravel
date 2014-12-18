<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected $qa_content;

 	public function __construct(){
 		
 		
 		$this->qa_content=array('content_type' => 'text/html; charset=utf-8',
								'site_title' => "",//$this->qa_html($this->qa_opt('site_title')),
								'head_lines' => array(),
								'navigation' => array('user' => array(),
														'main' => array(),
														'footer' => array('feedback' => array('url' => "/feedback",
																							'label' => "Send feedback",
																		),
														),
	
												),			
			'sidebar' => $this->qa_opt('show_custom_sidebar') ? $this->qa_opt('custom_sidebar') : null,
			
			'sidepanel' => array(),//$this->qa_opt('show_custom_sidepanel') ? $this->qa_opt('custom_sidepanel') : null,
			
			'widgets' => array(),
		);
		$options = DB::select('select * from qa_options where 1 = ?', array("1"));
		foreach ($options as $key => $option) {
			$this->qa_content[$option->title] = $option->content;
		}
		//echo "<pre>"; print_r($options);die;
 	}
	
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}	

	private function qa_opt($name){
		$options = $this->qa_get_options($name);
		//echo "<pre>"; print_r($options);die;
		return $options[$name];
	}

	private function qa_get_options($name){
		$value = "";
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
			'neat_urls' => "QA_URL_FORMAT_SAFEST",
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
			'permit_anon_view_ips' => "QA_PERMIT_EDITORS",
			'permit_close_q' => "QA_PERMIT_EDITORS",
			'permit_delete_hidden' => 'QA_PERMIT_MODERATORS',
			'permit_edit_a' => 'QA_PERMIT_EXPERTS',
			'permit_edit_c' => 'QA_PERMIT_EDITORS',
			'permit_edit_q' => 'QA_PERMIT_EDITORS',
			'permit_edit_silent' => 'QA_PERMIT_MODERATORS',
			'permit_flag' => 'QA_PERMIT_CONFIRMED',
			'permit_hide_show' => 'QA_PERMIT_EDITORS',
			'permit_moderate' => 'QA_PERMIT_EXPERTS',
			'permit_post_wall' => 'QA_PERMIT_CONFIRMED',
			'permit_select_a' => 'QA_PERMIT_EXPERTS',
			'permit_view_q_page' => 'QA_PERMIT_ALL',
			'permit_view_voters_flaggers' => 'QA_PERMIT_ADMINS',
			'permit_vote_a' => 'QA_PERMIT_USERS',
			'permit_vote_down' => 'QA_PERMIT_USERS',
			'permit_vote_q' => 'QA_PERMIT_USERS',
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
				case 'site_url':
					$value='http://'.@$_SERVER['HTTP_HOST'].strtr(dirname($_SERVER['SCRIPT_NAME']), '\\', '/').'/';
					break;
					
				case 'site_title':
					$value = "Site Title";//qa_default_site_title();
					break;
					
				case 'site_theme_mobile':
					$value= $this->qa_opt('site_theme');
					break;
					
				case 'from_email': // heuristic to remove short prefix (e.g. www. or qa.)
					$parts=explode('.', @$_SERVER['HTTP_HOST']);
					
					if ( (count($parts)>2) && (strlen($parts[0])<5) && !is_numeric($parts[0]) )
						unset($parts[0]);
						
					$value='no-reply@'.((count($parts)>1) ? implode('.', $parts) : 'example.com');
					break;
					
				case 'email_privacy':
					$value=qa_lang_html('options/default_privacy');
					break;
				
				case 'show_custom_sidebar':
					$value=strlen($this->qa_opt('custom_sidebar')) ? true : false;
					break;
					
				case 'show_custom_header':
					$value=strlen($this->qa_opt('custom_header')) ? true : false;
					break;
					
				case 'show_custom_footer':
					$value=strlen($this->qa_opt('custom_footer')) ? true : false;
					break;
					
				case 'show_custom_in_head':
					$value=strlen($this->qa_opt('custom_in_head')) ? true : false;
					break;
					
				case 'custom_sidebar':
					$value= array("custom_sidebar"=>"site bar");//qa_lang_html_sub('options/default_sidebar', qa_html(qa_opt('site_title')));
					break;
					
				case 'editor_for_qs':
				case 'editor_for_as':
					//require_once QA_INCLUDE_DIR.'qa-app-format.php';
					
					$value='-'; // to match none by default, i.e. choose based on who is best at editing HTML
					//qa_load_editor('', 'html', $value);
					break;
				
				case 'permit_post_q': // convert from deprecated option if available
					$value=$this->qa_opt('ask_needs_login') ? QA_PERMIT_USERS : QA_PERMIT_ALL;
					break;
					
				case 'permit_post_a': // convert from deprecated option if available
					$value=$this->qa_opt('answer_needs_login') ? QA_PERMIT_USERS : QA_PERMIT_ALL;
					break;
				
				case 'permit_post_c': // convert from deprecated option if available
					$value=qa_opt('comment_needs_login') ? QA_PERMIT_USERS : QA_PERMIT_ALL;
					break;
					
				case 'permit_retag_cat': // convert from previous option that used to contain it too
					$value=qa_opt('permit_edit_q');
					break;
					
				case 'points_vote_up_q':
				case 'points_vote_down_q':
					$oldvalue=qa_opt('points_vote_on_q');
					$value=is_numeric($oldvalue) ? $oldvalue : 1;
					break;
					
				case 'points_vote_up_a':
				case 'points_vote_down_a':
					$oldvalue=qa_opt('points_vote_on_a');
					$value=is_numeric($oldvalue) ? $oldvalue : 1;
					break;
					
				case 'points_per_q_voted_up':
				case 'points_per_q_voted_down':
					$oldvalue=qa_opt('points_per_q_voted');
					$value=is_numeric($oldvalue) ? $oldvalue : 1;
					break;
					
				case 'points_per_a_voted_up':
				case 'points_per_a_voted_down':
					$oldvalue=qa_opt('points_per_a_voted');
					$value=is_numeric($oldvalue) ? $oldvalue : 2;
					break;
					
				case 'captcha_module':
					$captchamodules=qa_list_modules('captcha');
					if (count($captchamodules))
						$value=reset($captchamodules);
					else
						$value='';
					break;
				
				case 'mailing_from_name':
					$value=qa_opt('site_title');
					break;
					
				case 'mailing_from_email':
					$value=qa_opt('from_email');
					break;
				
				case 'mailing_subject':
					$value=qa_lang_sub('options/default_subject', qa_opt('site_title'));
					break;
				
				case 'mailing_body':
					$value="\n\n\n--\n".qa_opt('site_title')."\n".qa_opt('site_url');
					break;
					
				case 'form_security_salt':
					require_once QA_INCLUDE_DIR.'qa-util-string.php';
					$value=qa_random_alphanum(32);
					break;
				
				default: // call option_default method in any registered modules
					$moduletypes=qa_list_module_types();
					
					//foreach ($moduletypes as $moduletype) {
						//$modules=qa_load_modules_with($moduletype, 'option_default');
						
						//foreach ($modules as $module) {
						//	$value=$module->option_default($name);
						//	if (strlen($value))
							//	return $value;
						//}
					//}
					$value='';
					break;
			}		
		}
		return $value;
	}

	private function qa_html($string, $multiline=false)	{
		$html=htmlspecialchars((string)$string);		
		if ($multiline) {
			$html=preg_replace('/\r\n?/', "\n", $html);
			$html=preg_replace('/(?<=\s) /', '&nbsp;', $html);
			$html=str_replace("\t", '&nbsp; &nbsp; ', $html);
			$html=nl2br($html);
		}		
		return $html;
	}


}