-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2014 at 06:08 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `q2a`
--

-- --------------------------------------------------------

--
-- Table structure for table `qa_blobs`
--

CREATE TABLE IF NOT EXISTS `qa_blobs` (
  `blobid` bigint(20) unsigned NOT NULL,
  `format` varchar(20) CHARACTER SET ascii NOT NULL,
  `content` mediumblob,
  `filename` varchar(255) DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `cookieid` bigint(20) unsigned DEFAULT NULL,
  `createip` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`blobid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_cache`
--

CREATE TABLE IF NOT EXISTS `qa_cache` (
  `type` char(8) CHARACTER SET ascii NOT NULL,
  `cacheid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `content` mediumblob NOT NULL,
  `created` datetime NOT NULL,
  `lastread` datetime NOT NULL,
  PRIMARY KEY (`type`,`cacheid`),
  KEY `lastread` (`lastread`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_categories`
--

CREATE TABLE IF NOT EXISTS `qa_categories` (
  `categoryid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(10) unsigned DEFAULT NULL,
  `title` varchar(80) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `content` varchar(800) NOT NULL DEFAULT '',
  `qcount` int(10) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL,
  `backpath` varchar(804) NOT NULL DEFAULT '',
  PRIMARY KEY (`categoryid`),
  UNIQUE KEY `parentid` (`parentid`,`tags`),
  UNIQUE KEY `parentid_2` (`parentid`,`position`),
  KEY `backpath` (`backpath`(200))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qa_categorymetas`
--

CREATE TABLE IF NOT EXISTS `qa_categorymetas` (
  `categoryid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL,
  PRIMARY KEY (`categoryid`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_contentwords`
--

CREATE TABLE IF NOT EXISTS `qa_contentwords` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL,
  `count` tinyint(3) unsigned NOT NULL,
  `type` enum('Q','A','C','NOTE') NOT NULL,
  `questionid` int(10) unsigned NOT NULL,
  KEY `postid` (`postid`),
  KEY `wordid` (`wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_contentwords`
--

INSERT INTO `qa_contentwords` (`postid`, `wordid`, `count`, `type`, `questionid`) VALUES
(12, 35, 1, 'A', 11),
(13, 22, 1, 'A', 10),
(13, 36, 1, 'A', 10),
(13, 25, 1, 'A', 10),
(13, 37, 1, 'A', 10),
(14, 38, 1, 'A', 10),
(14, 39, 1, 'A', 10),
(15, 38, 1, 'A', 10),
(15, 40, 1, 'A', 10),
(16, 41, 1, 'A', 10),
(16, 42, 1, 'A', 10),
(16, 43, 1, 'A', 10),
(16, 44, 1, 'A', 10),
(16, 45, 3, 'A', 10),
(17, 46, 1, 'C', 10),
(18, 47, 1, 'C', 10),
(18, 48, 1, 'C', 10),
(18, 49, 1, 'C', 10),
(18, 50, 1, 'C', 10),
(19, 51, 1, 'A', 4),
(19, 52, 1, 'A', 4),
(19, 53, 1, 'A', 4),
(19, 54, 1, 'A', 4),
(19, 55, 1, 'A', 4),
(20, 56, 1, 'A', 3),
(5, 13, 1, 'Q', 5),
(21, 57, 1, 'A', 5),
(22, 58, 1, 'A', 11),
(31, 59, 1, 'C', 11),
(32, 60, 1, 'C', 11),
(38, 61, 1, 'C', 11),
(39, 63, 1, 'Q', 39),
(41, 67, 1, 'Q', 41),
(44, 15, 1, 'Q', 44),
(44, 69, 1, 'Q', 44),
(44, 16, 1, 'Q', 44);

-- --------------------------------------------------------

--
-- Table structure for table `qa_cookies`
--

CREATE TABLE IF NOT EXISTS `qa_cookies` (
  `cookieid` bigint(20) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `createip` int(10) unsigned NOT NULL,
  `written` datetime DEFAULT NULL,
  `writeip` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`cookieid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_cookies`
--

INSERT INTO `qa_cookies` (`cookieid`, `created`, `createip`, `written`, `writeip`) VALUES
(6160334152228789066, '2014-12-03 15:09:02', 2130706433, '2014-12-10 20:16:49', 2130706433);

-- --------------------------------------------------------

--
-- Table structure for table `qa_iplimits`
--

CREATE TABLE IF NOT EXISTS `qa_iplimits` (
  `ip` int(10) unsigned NOT NULL,
  `action` char(1) CHARACTER SET ascii NOT NULL,
  `period` int(10) unsigned NOT NULL,
  `count` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `ip` (`ip`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_iplimits`
--

INSERT INTO `qa_iplimits` (`ip`, `action`, `period`, `count`) VALUES
(2130706433, 'A', 393825, 3),
(2130706433, 'C', 393927, 1),
(2130706433, 'L', 393977, 1),
(2130706433, 'Q', 393950, 1),
(2130706433, 'R', 393973, 1),
(2130706433, 'V', 393977, 11);

-- --------------------------------------------------------

--
-- Table structure for table `qa_messages`
--

CREATE TABLE IF NOT EXISTS `qa_messages` (
  `messageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('PUBLIC','PRIVATE') NOT NULL DEFAULT 'PRIVATE',
  `fromuserid` int(10) unsigned NOT NULL,
  `touserid` int(10) unsigned NOT NULL,
  `content` varchar(8000) NOT NULL,
  `format` varchar(20) CHARACTER SET ascii NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`messageid`),
  KEY `type` (`type`,`fromuserid`,`touserid`,`created`),
  KEY `touserid` (`touserid`,`type`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qa_options`
--

CREATE TABLE IF NOT EXISTS `qa_options` (
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_options`
--

INSERT INTO `qa_options` (`title`, `content`) VALUES
('allow_change_usernames', '1'),
('allow_close_questions', '1'),
('allow_login_email_only', ''),
('allow_multi_answers', '1'),
('allow_private_messages', '1'),
('allow_self_answer', '1'),
('allow_user_walls', '1'),
('allow_view_q_bots', '1'),
('approve_user_required', ''),
('avatar_allow_gravatar', '1'),
('avatar_allow_upload', '1'),
('avatar_default_blobid', ''),
('avatar_default_height', ''),
('avatar_default_show', ''),
('avatar_default_width', ''),
('avatar_message_list_size', '20'),
('avatar_profile_size', '200'),
('avatar_q_list_size', '0'),
('avatar_q_page_a_size', '40'),
('avatar_q_page_c_size', '20'),
('avatar_q_page_q_size', '50'),
('avatar_store_size', '400'),
('avatar_users_size', '30'),
('block_bad_words', ''),
('block_ips_write', ''),
('cache_acount', '11'),
('cache_ccount', '10'),
('cache_flaggedcount', ''),
('cache_qcount', '14'),
('cache_queuedcount', ''),
('cache_tagcount', '4'),
('cache_uapprovecount', '5'),
('cache_unaqcount', '4'),
('cache_unselqcount', '14'),
('cache_unupaqcount', '14'),
('cache_userpointscount', '6'),
('captcha_module', 'reCAPTCHA'),
('captcha_on_anon_post', '1'),
('captcha_on_feedback', '1'),
('captcha_on_register', '1'),
('captcha_on_reset_password', '1'),
('captcha_on_unapproved', ''),
('captcha_on_unconfirmed', '0'),
('columns_tags', '3'),
('columns_users', '2'),
('comment_on_as', '1'),
('comment_on_qs', '0'),
('confirm_user_emails', '1'),
('confirm_user_required', ''),
('custom_answer', ''),
('custom_ask', ''),
('custom_comment', ''),
('custom_footer', ''),
('custom_header', ''),
('custom_home_content', ''),
('custom_home_heading', ''),
('custom_in_head', ''),
('custom_register', ''),
('custom_sidepanel', ''),
('custom_welcome', ''),
('db_version', '56'),
('do_ask_check_qs', '0'),
('do_close_on_select', ''),
('do_complete_tags', '1'),
('do_count_q_views', '1'),
('do_example_tags', '1'),
('editor_for_as', 'WYSIWYG Editor'),
('editor_for_cs', ''),
('editor_for_qs', 'WYSIWYG Editor'),
('event_logger_to_database', ''),
('event_logger_to_files', ''),
('extra_field_active', ''),
('extra_field_display', ''),
('extra_field_label', ''),
('extra_field_prompt', ''),
('facebook_app_id', ''),
('feedback_email', 'admin@gmail.com'),
('feedback_enabled', '1'),
('feed_for_activity', '1'),
('feed_for_hot', ''),
('feed_for_qa', '1'),
('feed_for_questions', '1'),
('feed_for_search', ''),
('feed_for_tag_qs', ''),
('feed_for_unanswered', '1'),
('feed_full_text', '1'),
('feed_number_items', '50'),
('feed_per_category', '1'),
('flagging_hide_after', '5'),
('flagging_notify_every', '2'),
('flagging_notify_first', '1'),
('flagging_of_posts', '1'),
('follow_on_as', '1'),
('form_security_salt', '4kqxowdef5wg0nq18nv9ztoyiie4wf9o'),
('from_email', 'no-reply@example.com'),
('home_description', ''),
('hot_weight_answers', '100'),
('hot_weight_a_age', '100'),
('hot_weight_q_age', '100'),
('hot_weight_views', '100'),
('hot_weight_votes', '100'),
('links_in_new_window', ''),
('logo_height', ''),
('logo_show', ''),
('logo_url', ''),
('logo_width', ''),
('mailing_body', '\n\n\n--\nLocalhost Q&A\nhttp://localhost/petric/question2answer/'),
('mailing_enabled', ''),
('mailing_from_email', 'no-reply@example.com'),
('mailing_from_name', 'Localhost Q&A'),
('mailing_last_userid', ''),
('mailing_per_minute', '500'),
('mailing_subject', 'A message from Localhost Q&A'),
('match_ask_check_qs', '3'),
('match_example_tags', '3'),
('max_copy_user_updates', '10'),
('max_len_q_title', '120'),
('max_num_q_tags', '5'),
('max_rate_ip_as', '50'),
('max_rate_ip_cs', '40'),
('max_rate_ip_flags', '10'),
('max_rate_ip_logins', '20'),
('max_rate_ip_messages', '10'),
('max_rate_ip_qs', '20'),
('max_rate_ip_registers', '5'),
('max_rate_ip_uploads', '20'),
('max_rate_ip_votes', '600'),
('max_rate_user_as', '25'),
('max_rate_user_cs', '20'),
('max_rate_user_flags', '5'),
('max_rate_user_messages', '5'),
('max_rate_user_qs', '10'),
('max_rate_user_uploads', '10'),
('max_rate_user_votes', '300'),
('max_store_user_updates', '50'),
('min_len_a_content', '12'),
('min_len_c_content', '12'),
('min_len_q_content', '0'),
('min_len_q_title', '12'),
('min_num_q_tags', '0'),
('moderate_anon_post', ''),
('moderate_by_points', ''),
('moderate_edited_again', ''),
('moderate_notify_admin', '1'),
('moderate_points_limit', '150'),
('moderate_unapproved', ''),
('moderate_unconfirmed', ''),
('moderate_update_time', '1'),
('moderate_users', ''),
('mouseover_content_on', ''),
('nav_activity', '0'),
('nav_ask', '1'),
('nav_categories', '0'),
('nav_home', ''),
('nav_hot', '0'),
('nav_qa_is_home', '0'),
('nav_questions', '1'),
('nav_tags', '1'),
('nav_unanswered', '1'),
('nav_users', '1'),
('neat_urls', '1'),
('notice_visitor', ''),
('notice_welcome', ''),
('notify_admin_q_post', ''),
('notify_users_default', '1'),
('pages_prev_next', '3'),
('page_size_activity', '20'),
('page_size_ask_check_qs', '5'),
('page_size_ask_tags', '5'),
('page_size_home', '20'),
('page_size_hot_qs', '20'),
('page_size_qs', '20'),
('page_size_q_as', '10'),
('page_size_search', '10'),
('page_size_tags', '30'),
('page_size_tag_qs', '20'),
('page_size_una_qs', '20'),
('page_size_users', '20'),
('page_size_wall', '10'),
('permit_anon_view_ips', '70'),
('permit_anon_view_ips_points', ''),
('permit_close_q', '70'),
('permit_close_q_points', ''),
('permit_delete_hidden', '40'),
('permit_delete_hidden_points', ''),
('permit_edit_a', '100'),
('permit_edit_a_points', ''),
('permit_edit_c', '70'),
('permit_edit_c_points', ''),
('permit_edit_q', '70'),
('permit_edit_q_points', ''),
('permit_edit_silent', '40'),
('permit_edit_silent_points', ''),
('permit_flag', '110'),
('permit_flag_points', ''),
('permit_hide_show', '70'),
('permit_hide_show_points', ''),
('permit_moderate', '100'),
('permit_moderate_points', ''),
('permit_post_a', '150'),
('permit_post_a_points', ''),
('permit_post_c', '150'),
('permit_post_c_points', ''),
('permit_post_q', '150'),
('permit_post_q_points', ''),
('permit_post_wall', '110'),
('permit_post_wall_points', ''),
('permit_retag_cat', '70'),
('permit_retag_cat_points', ''),
('permit_select_a', '100'),
('permit_select_a_points', ''),
('permit_view_q_page', '150'),
('permit_view_voters_flaggers', '20'),
('permit_view_voters_flaggers_points', ''),
('permit_vote_a', '120'),
('permit_vote_a_points', ''),
('permit_vote_down', '120'),
('permit_vote_down_points', ''),
('permit_vote_q', '120'),
('permit_vote_q_points', ''),
('points_a_selected', '30'),
('points_a_voted_max_gain', '20'),
('points_a_voted_max_loss', '5'),
('points_base', '100'),
('points_multiple', '10'),
('points_per_a_voted', ''),
('points_per_a_voted_down', '2'),
('points_per_a_voted_up', '2'),
('points_per_q_voted', ''),
('points_per_q_voted_down', '1'),
('points_per_q_voted_up', '1'),
('points_post_a', '4'),
('points_post_q', '2'),
('points_q_voted_max_gain', '10'),
('points_q_voted_max_loss', '3'),
('points_select_a', '3'),
('points_to_titles', ''),
('points_vote_down_a', '1'),
('points_vote_down_q', '1'),
('points_vote_on_a', ''),
('points_vote_on_q', ''),
('points_vote_up_a', '1'),
('points_vote_up_q', '1'),
('q_urls_remove_accents', ''),
('q_urls_title_length', '50'),
('recaptcha_public_key', ''),
('register_notify_admin', ''),
('search_module', ''),
('show_a_c_links', '1'),
('show_a_form_immediate', 'if_no_as'),
('show_custom_answer', ''),
('show_custom_ask', ''),
('show_custom_comment', ''),
('show_custom_footer', ''),
('show_custom_header', ''),
('show_custom_home', ''),
('show_custom_in_head', ''),
('show_custom_register', ''),
('show_custom_sidebar', '1'),
('show_custom_sidepanel', ''),
('show_custom_welcome', '1'),
('show_c_reply_buttons', '1'),
('show_fewer_cs_count', '5'),
('show_fewer_cs_from', '10'),
('show_full_date_days', '7'),
('show_home_description', ''),
('show_message_history', '1'),
('show_notice_visitor', ''),
('show_notice_welcome', ''),
('show_selected_first', '1'),
('show_url_links', '1'),
('show_user_points', '1'),
('show_user_titles', '1'),
('show_view_counts', ''),
('show_view_count_q_page', ''),
('show_when_created', '1'),
('site_language', ''),
('site_maintenance', '0'),
('site_theme', 'Classic'),
('site_theme_mobile', 'Classic'),
('site_title', 'Localhost Q&A'),
('site_url', 'http://localhost/petric/question2answer/'),
('smtp_active', ''),
('smtp_address', ''),
('smtp_authenticate', ''),
('smtp_password', ''),
('smtp_port', '25'),
('smtp_secure', ''),
('smtp_username', ''),
('sort_answers_by', 'created'),
('suspend_register_users', ''),
('tags_or_categories', 'tc'),
('tag_separator_comma', ''),
('votes_separated', ''),
('voting_on_as', '1'),
('voting_on_qs', '1'),
('voting_on_q_page_only', ''),
('wysiwyg_editor_upload_images', '');

-- --------------------------------------------------------

--
-- Table structure for table `qa_pages`
--

CREATE TABLE IF NOT EXISTS `qa_pages` (
  `pageid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `nav` char(1) CHARACTER SET ascii NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `flags` tinyint(3) unsigned NOT NULL,
  `permit` tinyint(3) unsigned DEFAULT NULL,
  `tags` varchar(200) NOT NULL,
  `heading` varchar(800) DEFAULT NULL,
  `content` mediumtext,
  PRIMARY KEY (`pageid`),
  UNIQUE KEY `position` (`position`),
  KEY `tags` (`tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qa_postmetas`
--

CREATE TABLE IF NOT EXISTS `qa_postmetas` (
  `postid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL,
  PRIMARY KEY (`postid`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_posts`
--

CREATE TABLE IF NOT EXISTS `qa_posts` (
  `postid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('Q','A','C','Q_HIDDEN','A_HIDDEN','C_HIDDEN','Q_QUEUED','A_QUEUED','C_QUEUED','NOTE') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `categoryid` int(10) unsigned DEFAULT NULL,
  `catidpath1` int(10) unsigned DEFAULT NULL,
  `catidpath2` int(10) unsigned DEFAULT NULL,
  `catidpath3` int(10) unsigned DEFAULT NULL,
  `acount` smallint(5) unsigned NOT NULL DEFAULT '0',
  `amaxvote` smallint(5) unsigned NOT NULL DEFAULT '0',
  `selchildid` int(10) unsigned DEFAULT NULL,
  `closedbyid` int(10) unsigned DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `cookieid` bigint(20) unsigned DEFAULT NULL,
  `createip` int(10) unsigned DEFAULT NULL,
  `lastuserid` int(10) unsigned DEFAULT NULL,
  `lastip` int(10) unsigned DEFAULT NULL,
  `upvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `downvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `netvotes` smallint(6) NOT NULL DEFAULT '0',
  `lastviewip` int(10) unsigned DEFAULT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `hotness` float DEFAULT NULL,
  `flagcount` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `format` varchar(20) CHARACTER SET ascii NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
  `title` varchar(800) DEFAULT NULL,
  `content` varchar(8000) DEFAULT NULL,
  `tags` varchar(800) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `notify` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`postid`),
  KEY `type` (`type`,`created`),
  KEY `type_2` (`type`,`acount`,`created`),
  KEY `type_4` (`type`,`netvotes`,`created`),
  KEY `type_5` (`type`,`views`,`created`),
  KEY `type_6` (`type`,`hotness`),
  KEY `type_7` (`type`,`amaxvote`,`created`),
  KEY `parentid` (`parentid`,`type`),
  KEY `userid` (`userid`,`type`,`created`),
  KEY `selchildid` (`selchildid`,`type`,`created`),
  KEY `closedbyid` (`closedbyid`),
  KEY `catidpath1` (`catidpath1`,`type`,`created`),
  KEY `catidpath2` (`catidpath2`,`type`,`created`),
  KEY `catidpath3` (`catidpath3`,`type`,`created`),
  KEY `categoryid` (`categoryid`,`type`,`created`),
  KEY `createip` (`createip`,`created`),
  KEY `updated` (`updated`,`type`),
  KEY `flagcount` (`flagcount`,`created`,`type`),
  KEY `catidpath1_2` (`catidpath1`,`updated`,`type`),
  KEY `catidpath2_2` (`catidpath2`,`updated`,`type`),
  KEY `catidpath3_2` (`catidpath3`,`updated`,`type`),
  KEY `categoryid_2` (`categoryid`,`updated`,`type`),
  KEY `lastuserid` (`lastuserid`,`updated`,`type`),
  KEY `lastip` (`lastip`,`updated`,`type`),
  KEY `parentid_2` (`parentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `qa_posts`
--

INSERT INTO `qa_posts` (`postid`, `type`, `parentid`, `categoryid`, `catidpath1`, `catidpath2`, `catidpath3`, `acount`, `amaxvote`, `selchildid`, `closedbyid`, `userid`, `cookieid`, `createip`, `lastuserid`, `lastip`, `upvotes`, `downvotes`, `netvotes`, `lastviewip`, `views`, `hotness`, `flagcount`, `format`, `created`, `updated`, `updatetype`, `title`, `content`, `tags`, `name`, `notify`) VALUES
(1, 'Q', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, 1, NULL, 2130706433, NULL, NULL, 1, 0, 1, 2130706433, 1, 31063000000, 0, '', '2014-12-02 16:12:45', NULL, NULL, 'What is your name', 'sdfsdfdsf', 'fdsfdsfds', NULL, '@'),
(2, 'Q', NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31062700000, 0, '', '2014-12-03 14:04:05', NULL, NULL, 'what is your age', '', '', NULL, '@'),
(3, 'Q', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31096200000, 0, '', '2014-12-03 14:05:07', NULL, NULL, 'what is your spouse name', 'aa', '', NULL, '@'),
(4, 'Q', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31089800000, 0, '', '2014-12-03 14:05:54', NULL, NULL, 'what is your tailor name', '', '', NULL, '@'),
(5, 'Q', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, 2130706433, 0, 0, 0, 2130706433, 1, 31096600000, 0, '', '2014-12-03 15:09:02', '2014-12-05 14:35:45', 'H', 'what is your home town', 'af', '', '', NULL),
(6, 'Q', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, 21307064, 1, 31087100000, 0, '', '2014-12-03 15:09:28', NULL, NULL, 'what is your ra', '', '', '', NULL),
(7, 'Q', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31089100000, 0, '', '2014-12-03 20:40:25', NULL, NULL, 'test question', 'dff', 'first-second-third', '', NULL),
(8, 'A', 6, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 12:17:35', NULL, NULL, NULL, 'this is my answer', NULL, NULL, '@'),
(9, 'A', 7, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 12:28:45', NULL, NULL, NULL, 'test answer is good', NULL, NULL, '@'),
(10, 'Q', NULL, NULL, NULL, NULL, NULL, 5, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31146100000, 0, '', '2014-12-04 13:21:21', NULL, NULL, 'what is your life insurance', 'first-second-third', 'first-second-third', NULL, '@'),
(11, 'Q', NULL, NULL, NULL, NULL, NULL, 7, 0, NULL, NULL, 2, NULL, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31121300000, 0, '', '2014-12-04 15:20:31', NULL, NULL, 'what is your filezilla', 'fdsfdsfdsfds fsd fsdfsd fsdfdsfsffsfs fsfffaffsfsa fsfs', 'first-second-third', NULL, '@'),
(12, 'A', 11, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 19:41:43', NULL, NULL, NULL, 'sfsfsdfdsfdsfs', NULL, '', NULL),
(13, 'A', 10, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 19:47:43', NULL, NULL, NULL, 'this i good choice', NULL, '', NULL),
(14, 'A', 10, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 20:09:37', NULL, NULL, NULL, 'fsfafsdfasdf asfsfdsf', NULL, 'sdfdasfsdfsdfsdfs', 'fsfsfaaa@gmail.com'),
(15, 'A', 10, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 20:18:30', NULL, NULL, NULL, 'fsfafsdfasdf asfsfdsffdsfsds', NULL, 'sdfdasfsdfsdfsdfs', 'fsfsfaaa@gmail.com'),
(16, 'A', 10, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 20:42:52', NULL, NULL, NULL, 'dsfdsfsdf nnnnnnknnnnk kn k n       n n', NULL, 'sdfsf', 'dsffds@gmail.com'),
(17, 'C', 13, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 20:46:47', NULL, NULL, NULL, 'dgdsgfdasfsd', NULL, 'fsafsfs', 'test@gmail.com'),
(18, 'C', 13, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 20:47:12', NULL, NULL, NULL, 'conmsd dsfdas fdsfdas fdsfdsfasfas', NULL, 'fdsfasfsf', 'fsdfsfsa@gmail.com'),
(19, 'A', 4, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-04 21:00:46', NULL, NULL, NULL, 'fgdsfdsfs fds fsfdsaf sfdsfdsfsdfsfdsfdsfdsfdsfdsfs f', NULL, 'fsadfsdafdasfasf', 'fdsfdsfs@gmail.com'),
(20, 'A', 3, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-05 14:35:18', NULL, NULL, NULL, 'sssssssssssssssssssssssssssss', NULL, '', NULL),
(21, 'A', 5, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-05 14:37:43', NULL, NULL, NULL, 'fdsfdsfsfsfsfsfsfsfsfsfdsfdsfdsfs', NULL, '', NULL),
(22, 'A', 11, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-05 14:47:28', NULL, NULL, NULL, 'fsafdfasdfsdfdsfdsfdsfdsfdsfsdafdard', NULL, '', NULL),
(23, 'A', 11, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 13:37:43', NULL, NULL, NULL, 'this is second answer and i can manage it', NULL, 'amasnre', 'dsklfjdskfsdfdsf'),
(24, 'A', 11, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 13:41:43', NULL, NULL, NULL, 'fdasfdasf dasfdasfdasfdasfdas', NULL, 'fdasfdasfasfdasfdsf', 'safdsfdssda'),
(25, 'A', 2, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 14:27:04', NULL, NULL, NULL, 'fdsafsfdsfsfdsfsdfs', NULL, 'fdsfdasfdsfdsfsf', 'fdasfdasffsfsfsf@gmail.com'),
(26, 'A', 11, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 14:57:09', NULL, NULL, NULL, 'test filezilla is very goog\\d', NULL, 'filezilla', 'filezilla@gmail.com'),
(27, 'A', 11, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 15:06:07', NULL, NULL, NULL, 'test filezilla is very goog\\d', NULL, 'filezilla', 'filezilla@gmail.com'),
(28, 'A', 11, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 15:07:02', NULL, NULL, NULL, 'fdasfsfdsfdsfdsfdsfdsfsf', NULL, 'fdsfdsafdasfdsfdasfsff', 'fdsafsdfsdf@gmail.com'),
(29, 'A', 2, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 15:09:06', NULL, NULL, NULL, 'gfsgfdsfsfasfasfasfdasfs', NULL, 'fasfdasfdasfsdafwaesfs', NULL),
(30, 'A', 2, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-06 15:09:41', NULL, NULL, NULL, 'dsfsdfsdfsfdasfdasfdasfdasfdsfsafsdfs', NULL, 'fsfdsf', 'fdsfdsfs@gmail.com'),
(31, 'C', 26, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 15:36:51', NULL, NULL, NULL, 'fasfasfasfafs', NULL, 'fasfdasfasf', 'afds@gmail.com'),
(32, 'C', 26, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 15:50:59', NULL, NULL, NULL, 'safasdfasasfasd', NULL, 'asfasdfdasfdsaf', 'affdasfasfas@gmail.com'),
(33, 'C', 28, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 14:14:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'C', 23, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 14:15:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'C', 23, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 14:17:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'C', 23, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 14:20:23', NULL, NULL, NULL, 'this is good comment1111', NULL, 'comment1111', NULL),
(37, 'C', 28, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 14:36:53', NULL, NULL, NULL, 'dsssfffasdfasfsa', NULL, 'dsfdsfsfa', NULL),
(38, 'C', 12, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-09 20:49:12', NULL, NULL, NULL, 'gfasgfdasfgdasfdasf', NULL, 'fdsafsdafdasfdasfdsf', 'sdfasdf@gmail.com'),
(39, 'Q', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31185900000, 0, '', '2014-12-10 17:13:56', NULL, NULL, 'safasdfawsfsafsfsa', 'asfasdfsafasafasfasdfasfasfa', 'afasfasfas', 'aaaaa', 'akashbachhaniaakashbachhania@gmail.com'),
(40, 'Q', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31186200000, 0, '', '2014-12-10 17:35:17', NULL, NULL, 'fsdfdasfdsafasfdasfasfdsfdasfwasf', '', '', '', NULL),
(41, 'Q', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 0, 0, 0, 2130706433, 1, 31186400000, 0, '', '2014-12-10 17:54:16', NULL, NULL, 'fasfasfasfdasfasfdasfasfasfssfdsfsfsf', 'fsfsfdsfdsfsf', 'safsafasfsa', 'asfasf@gamil.com', NULL),
(42, 'Q', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, 1270, NULL, NULL, 0, 0, 0, 1270, 0, NULL, 0, '', '2014-12-10 12:46:34', NULL, NULL, 'Question is nothing than othere', 'sdfsafsdfsdff', 'sasfasfasf', 'afasfasfs', 's@gmail.com'),
(43, 'A', 42, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-10 12:47:47', NULL, NULL, NULL, 'fsdfdasfasfasfasfasfdasfdasfasfasfdasf', NULL, 'fasfasfdasfsa', 'fsafasfas'),
(44, 'Q', 13, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 6160334152228789066, 2130706433, NULL, NULL, 1, 0, 1, 2130706433, 1, 31204100000, 0, '', '2014-12-10 20:16:48', NULL, NULL, 'test follow question', 'test follow question', '', 'test follow question', 'test@gmail.com'),
(45, 'Q', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1270, NULL, NULL, 0, 0, 0, 1270, 0, NULL, 0, '', '2014-12-10 17:17:05', NULL, NULL, 'jjh jhjhjhbhbjhbjhbjhbhjbjnbjbjbnj', 'jhhkjhkh jnknkjnkknknknknknk', 'khkhk', 'kkkkk', 'kkk@gmail.com'),
(46, 'Q', 43, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1270, NULL, NULL, 0, 0, 0, 1270, 0, NULL, 0, '', '2014-12-10 17:17:13', NULL, NULL, 'sdfsdsfasfsdfdssfdasfdasfdsf', 'sfsfsfsdfsdfsafsf', '', '', ''),
(47, 'C', 24, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 3, NULL, 1270, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, '', '2014-12-11 12:29:21', NULL, NULL, NULL, 'this is the best comments of the year', NULL, 'sdafdasfdasfdasfsaff', 'sdafdasfdasfdasfsaff');

-- --------------------------------------------------------

--
-- Table structure for table `qa_posttags`
--

CREATE TABLE IF NOT EXISTS `qa_posttags` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL,
  `postcreated` datetime NOT NULL,
  KEY `postid` (`postid`),
  KEY `wordid` (`wordid`,`postcreated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_posttags`
--

INSERT INTO `qa_posttags` (`postid`, `wordid`, `postcreated`) VALUES
(39, 64, '2014-12-10 17:13:56'),
(41, 68, '2014-12-10 17:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `qa_sharedevents`
--

CREATE TABLE IF NOT EXISTS `qa_sharedevents` (
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `questionid` int(10) unsigned NOT NULL,
  `lastpostid` int(10) unsigned NOT NULL,
  `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
  `lastuserid` int(10) unsigned DEFAULT NULL,
  `updated` datetime NOT NULL,
  KEY `entitytype` (`entitytype`,`entityid`,`updated`),
  KEY `questionid` (`questionid`,`entitytype`,`entityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_sharedevents`
--

INSERT INTO `qa_sharedevents` (`entitytype`, `entityid`, `questionid`, `lastpostid`, `updatetype`, `lastuserid`, `updated`) VALUES
('Q', 1, 1, 1, NULL, 1, '2014-12-02 16:12:50'),
('U', 1, 1, 1, NULL, 1, '2014-12-02 16:12:51'),
('T', 6, 1, 1, NULL, 1, '2014-12-02 16:12:51'),
('Q', 2, 2, 2, NULL, 2, '2014-12-03 14:04:08'),
('U', 2, 2, 2, NULL, 2, '2014-12-03 14:04:08'),
('Q', 3, 3, 3, NULL, 2, '2014-12-03 14:05:12'),
('U', 2, 3, 3, NULL, 2, '2014-12-03 14:05:12'),
('Q', 4, 4, 4, NULL, 2, '2014-12-03 14:05:58'),
('U', 2, 4, 4, NULL, 2, '2014-12-03 14:05:58'),
('Q', 5, 5, 5, NULL, NULL, '2014-12-03 15:09:06'),
('Q', 6, 6, 6, NULL, NULL, '2014-12-03 15:09:32'),
('Q', 7, 7, 7, NULL, NULL, '2014-12-03 20:40:30'),
('T', 21, 7, 7, NULL, NULL, '2014-12-03 20:40:30'),
('Q', 6, 6, 8, NULL, 2, '2014-12-04 12:17:40'),
('U', 2, 6, 8, NULL, 2, '2014-12-04 12:17:40'),
('Q', 7, 7, 9, NULL, 2, '2014-12-04 12:28:48'),
('U', 2, 7, 9, NULL, 2, '2014-12-04 12:28:49'),
('U', 2, 10, 10, NULL, 2, '2014-12-04 13:21:23'),
('T', 21, 10, 10, NULL, 2, '2014-12-04 13:21:23'),
('U', 2, 11, 11, NULL, 2, '2014-12-04 15:20:34'),
('T', 21, 11, 11, NULL, 2, '2014-12-04 15:20:34'),
('Q', 11, 11, 12, NULL, NULL, '2014-12-04 19:41:43'),
('Q', 10, 10, 15, NULL, NULL, '2014-12-04 20:18:31'),
('Q', 10, 10, 16, NULL, NULL, '2014-12-04 20:42:53'),
('Q', 10, 10, 17, 'N', NULL, '2014-12-04 20:46:47'),
('Q', 10, 10, 18, 'N', NULL, '2014-12-04 20:47:12'),
('Q', 7, 7, 9, 'S', NULL, '2014-12-04 20:50:09'),
('Q', 4, 4, 19, NULL, NULL, '2014-12-04 21:00:47'),
('Q', 3, 3, 20, NULL, NULL, '2014-12-05 14:35:19'),
('Q', 5, 5, 5, 'H', NULL, '2014-12-05 14:35:47'),
('Q', 5, 5, 21, NULL, NULL, '2014-12-05 14:37:44'),
('Q', 11, 11, 22, NULL, NULL, '2014-12-05 14:47:28'),
('Q', 7, 7, 9, 'S', NULL, '2014-12-06 13:43:23'),
('Q', 11, 11, 31, 'N', NULL, '2014-12-09 15:36:51'),
('Q', 11, 11, 32, 'N', NULL, '2014-12-09 15:51:00'),
('Q', 11, 11, 38, 'N', NULL, '2014-12-09 20:49:12'),
('Q', 39, 39, 39, NULL, NULL, '2014-12-10 17:13:56'),
('T', 64, 39, 39, NULL, NULL, '2014-12-10 17:13:56'),
('Q', 40, 40, 40, NULL, NULL, '2014-12-10 17:35:21'),
('Q', 41, 41, 41, NULL, NULL, '2014-12-10 17:54:16'),
('T', 68, 41, 41, NULL, NULL, '2014-12-10 17:54:16'),
('Q', 10, 10, 44, 'F', NULL, '2014-12-10 20:16:49'),
('Q', 44, 44, 44, NULL, NULL, '2014-12-10 20:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `qa_tagmetas`
--

CREATE TABLE IF NOT EXISTS `qa_tagmetas` (
  `tag` varchar(80) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL,
  PRIMARY KEY (`tag`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_tagwords`
--

CREATE TABLE IF NOT EXISTS `qa_tagwords` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL,
  KEY `postid` (`postid`),
  KEY `wordid` (`wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_tagwords`
--

INSERT INTO `qa_tagwords` (`postid`, `wordid`) VALUES
(39, 64),
(41, 68);

-- --------------------------------------------------------

--
-- Table structure for table `qa_titlewords`
--

CREATE TABLE IF NOT EXISTS `qa_titlewords` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL,
  KEY `postid` (`postid`),
  KEY `wordid` (`wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_titlewords`
--

INSERT INTO `qa_titlewords` (`postid`, `wordid`) VALUES
(5, 1),
(5, 2),
(5, 3),
(5, 11),
(5, 12),
(39, 62),
(40, 65),
(41, 66),
(44, 15),
(44, 69),
(44, 16);

-- --------------------------------------------------------

--
-- Table structure for table `qa_userevents`
--

CREATE TABLE IF NOT EXISTS `qa_userevents` (
  `userid` int(10) unsigned NOT NULL,
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `questionid` int(10) unsigned NOT NULL,
  `lastpostid` int(10) unsigned NOT NULL,
  `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
  `lastuserid` int(10) unsigned DEFAULT NULL,
  `updated` datetime NOT NULL,
  KEY `userid` (`userid`,`updated`),
  KEY `questionid` (`questionid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_userevents`
--

INSERT INTO `qa_userevents` (`userid`, `entitytype`, `entityid`, `questionid`, `lastpostid`, `updatetype`, `lastuserid`, `updated`) VALUES
(2, '-', 0, 11, 12, NULL, NULL, '2014-12-04 19:41:47'),
(2, '-', 0, 10, 13, NULL, NULL, '2014-12-04 19:47:43'),
(2, '-', 0, 10, 14, NULL, NULL, '2014-12-04 20:09:42'),
(2, '-', 0, 10, 15, NULL, NULL, '2014-12-04 20:18:35'),
(2, '-', 0, 10, 16, NULL, NULL, '2014-12-04 20:42:56'),
(2, '-', 0, 7, 9, 'S', NULL, '2014-12-04 20:50:13'),
(2, '-', 0, 4, 19, NULL, NULL, '2014-12-04 21:00:51'),
(2, '-', 0, 3, 20, NULL, NULL, '2014-12-05 14:35:19'),
(2, '-', 0, 11, 22, NULL, NULL, '2014-12-05 14:47:28'),
(2, '-', 0, 7, 9, 'S', NULL, '2014-12-06 13:43:23'),
(3, '-', 0, 11, 31, 'N', NULL, '2014-12-09 15:36:51'),
(3, '-', 0, 11, 32, 'N', NULL, '2014-12-09 15:51:00'),
(5, 'Q', 41, 41, 41, NULL, NULL, '2014-12-10 17:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `qa_userfavorites`
--

CREATE TABLE IF NOT EXISTS `qa_userfavorites` (
  `userid` int(10) unsigned NOT NULL,
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `nouserevents` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`userid`,`entitytype`,`entityid`),
  KEY `userid` (`userid`,`nouserevents`),
  KEY `entitytype` (`entitytype`,`entityid`,`nouserevents`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_userfavorites`
--

INSERT INTO `qa_userfavorites` (`userid`, `entitytype`, `entityid`, `nouserevents`) VALUES
(5, 'Q', 41, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_userfields`
--

CREATE TABLE IF NOT EXISTS `qa_userfields` (
  `fieldid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `content` varchar(40) DEFAULT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `flags` tinyint(3) unsigned NOT NULL,
  `permit` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`fieldid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `qa_userfields`
--

INSERT INTO `qa_userfields` (`fieldid`, `title`, `content`, `position`, `flags`, `permit`) VALUES
(1, 'name', NULL, 1, 0, NULL),
(2, 'location', NULL, 2, 0, NULL),
(3, 'website', NULL, 3, 2, NULL),
(4, 'about', NULL, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qa_userlevels`
--

CREATE TABLE IF NOT EXISTS `qa_userlevels` (
  `userid` int(10) unsigned NOT NULL,
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `level` tinyint(3) unsigned DEFAULT NULL,
  UNIQUE KEY `userid` (`userid`,`entitytype`,`entityid`),
  KEY `entitytype` (`entitytype`,`entityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userlimits`
--

CREATE TABLE IF NOT EXISTS `qa_userlimits` (
  `userid` int(10) unsigned NOT NULL,
  `action` char(1) CHARACTER SET ascii NOT NULL,
  `period` int(10) unsigned NOT NULL,
  `count` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `userid` (`userid`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_userlimits`
--

INSERT INTO `qa_userlimits` (`userid`, `action`, `period`, `count`) VALUES
(1, 'Q', 393754, 1),
(1, 'V', 393977, 11),
(2, 'A', 393798, 2),
(2, 'Q', 393801, 1),
(2, 'V', 393776, 13),
(5, 'V', 393975, 11),
(6, 'V', 393973, 2);

-- --------------------------------------------------------

--
-- Table structure for table `qa_userlogins`
--

CREATE TABLE IF NOT EXISTS `qa_userlogins` (
  `userid` int(10) unsigned NOT NULL,
  `source` varchar(16) CHARACTER SET ascii NOT NULL,
  `identifier` varbinary(1024) NOT NULL,
  `identifiermd5` binary(16) NOT NULL,
  KEY `source` (`source`,`identifiermd5`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_usermetas`
--

CREATE TABLE IF NOT EXISTS `qa_usermetas` (
  `userid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL,
  PRIMARY KEY (`userid`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_usernotices`
--

CREATE TABLE IF NOT EXISTS `qa_usernotices` (
  `noticeid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `content` varchar(8000) NOT NULL,
  `format` varchar(20) CHARACTER SET ascii NOT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`noticeid`),
  KEY `userid` (`userid`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userpoints`
--

CREATE TABLE IF NOT EXISTS `qa_userpoints` (
  `userid` int(10) unsigned NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `qposts` mediumint(9) NOT NULL DEFAULT '0',
  `aposts` mediumint(9) NOT NULL DEFAULT '0',
  `cposts` mediumint(9) NOT NULL DEFAULT '0',
  `aselects` mediumint(9) NOT NULL DEFAULT '0',
  `aselecteds` mediumint(9) NOT NULL DEFAULT '0',
  `qupvotes` mediumint(9) NOT NULL DEFAULT '0',
  `qdownvotes` mediumint(9) NOT NULL DEFAULT '0',
  `aupvotes` mediumint(9) NOT NULL DEFAULT '0',
  `adownvotes` mediumint(9) NOT NULL DEFAULT '0',
  `qvoteds` int(11) NOT NULL DEFAULT '0',
  `avoteds` int(11) NOT NULL DEFAULT '0',
  `upvoteds` int(11) NOT NULL DEFAULT '0',
  `downvoteds` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `points` (`points`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_userpoints`
--

INSERT INTO `qa_userpoints` (`userid`, `points`, `qposts`, `aposts`, `cposts`, `aselects`, `aselecteds`, `qupvotes`, `qdownvotes`, `aupvotes`, `adownvotes`, `qvoteds`, `avoteds`, `upvoteds`, `downvoteds`, `bonus`) VALUES
(1, 130, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0),
(2, 290, 5, 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 120, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_userprofile`
--

CREATE TABLE IF NOT EXISTS `qa_userprofile` (
  `userid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL,
  UNIQUE KEY `userid` (`userid`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_userprofile`
--

INSERT INTO `qa_userprofile` (`userid`, `title`, `content`) VALUES
(3, 'about', ''),
(3, 'location', ''),
(3, 'name', ''),
(3, 'website', ''),
(5, 'about', ''),
(5, 'location', ''),
(5, 'name', ''),
(5, 'website', '');

-- --------------------------------------------------------

--
-- Table structure for table `qa_users`
--

CREATE TABLE IF NOT EXISTS `qa_users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `createip` int(10) unsigned NOT NULL,
  `email` varchar(80) NOT NULL,
  `handle` varchar(20) NOT NULL,
  `avatarblobid` bigint(20) unsigned DEFAULT NULL,
  `avatarwidth` smallint(5) unsigned DEFAULT NULL,
  `avatarheight` smallint(5) unsigned DEFAULT NULL,
  `passsalt` binary(16) DEFAULT NULL,
  `passcheck` binary(20) DEFAULT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `loggedin` datetime NOT NULL,
  `loginip` int(10) unsigned NOT NULL,
  `written` datetime DEFAULT NULL,
  `writeip` int(10) unsigned DEFAULT NULL,
  `emailcode` char(8) CHARACTER SET ascii NOT NULL DEFAULT '',
  `sessioncode` char(8) CHARACTER SET ascii NOT NULL DEFAULT '',
  `sessionsource` varchar(16) CHARACTER SET ascii DEFAULT '',
  `flags` smallint(5) unsigned NOT NULL DEFAULT '0',
  `wallposts` mediumint(9) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `email` (`email`),
  KEY `handle` (`handle`),
  KEY `level` (`level`),
  KEY `created` (`created`,`level`,`flags`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `qa_users`
--

INSERT INTO `qa_users` (`userid`, `created`, `createip`, `email`, `handle`, `avatarblobid`, `avatarwidth`, `avatarheight`, `passsalt`, `passcheck`, `level`, `loggedin`, `loginip`, `written`, `writeip`, `emailcode`, `sessioncode`, `sessionsource`, `flags`, `wallposts`, `username`, `password`, `id`, `remember_token`, `updated_at`) VALUES
(1, '2014-12-02 15:08:13', 2130706433, 'admin@gmail.com', 'admin', NULL, NULL, NULL, 'o7m9m8yorlemlrlo', 'ý~ýaGôõŽ©²ð‚^pg¿Wß', 120, '2014-12-11 22:31:08', 2130706433, '2014-12-11 22:33:04', 2130706433, '', 'ecs8u9gb', NULL, 0, 0, 'admin', '$2y$08$kzNV27azZBvXrTM/TQG0OOo4N1PWv4AdVMSlhdbI15YYln.oA6pb6', 0, 'kXceZiwBYzPlx6mqZlSRjUUYCwpQ2vS3wTib2a2eZ2Pk4pAvS9H5oFuk68A1', '2014-12-11 15:33:26'),
(2, '2014-12-03 13:57:13', 2130706433, 'hvis21akash.b@gmail.com', 'akash', NULL, NULL, NULL, 'bv5qtmuguwvy79np', '.Õ\rôpZK¤³s-"ÖT\ZðÃ', 0, '2014-12-11 22:29:04', 2130706433, '2014-12-04 15:20:33', 2130706433, '5pgczt81', 'hlcpfpot', NULL, 0, 0, '', '', 0, '', ''),
(3, '2014-12-04 11:26:22', 1270, 'test@gmail.com', 'test', NULL, NULL, NULL, NULL, '$2y$08$EJ/BTwx8.rJLN', 0, '2014-12-04 11:26:22', 1270, NULL, NULL, '', '', '', 0, 0, 'test', '$2y$08$kzNV27azZBvXrTM/TQG0OOo4N1PWv4AdVMSlhdbI15YYln.oA6pb6', 3, 'keeZ6ffK8VnwNd9bEg6unLoxqoINw860OljSqpIdWp8YuxSYAQ9FUEAa7woM', '2014-12-11 15:31:24'),
(4, '2014-12-09 08:05:20', 1270, 'admin1@gmail.com', 'admin1', NULL, NULL, NULL, NULL, '$2y$08$UHXYF5ovFWBdJ', 0, '2014-12-09 08:05:20', 1270, NULL, NULL, '', '', '', 0, 0, 'admin1', '$2y$08$bv/crEpzKWOL24P63bStduRweN7TpYSQ3NhPOOGjnnIR4mmDDMBkS', 0, '', ''),
(5, '2014-12-11 16:26:46', 2130706433, 'test_core@yahoo.com', 'test_core', NULL, NULL, NULL, 'tjryt2yhwchqq1le', ' ,úÊãÒ(;2â²+ûp2.Úa', 0, '2014-12-11 19:28:36', 2130706433, '2014-12-11 21:10:42', 2130706433, 'n2eoytco', 'mxv7xefk', NULL, 0, 0, '', '', 0, '', ''),
(6, '2014-12-11 19:12:38', 2130706433, 'Test1478@gmail.com', 'test_core1', NULL, NULL, NULL, 'ir9z0nl2swe1c3wk', '„-ÅamcÌkxÐu\0Bwþfm¹f', 0, '2014-12-11 19:12:39', 2130706433, '2014-12-11 19:12:47', 2130706433, 'svyx0rwf', 'fouap3ju', NULL, 0, 0, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `qa_uservotes`
--

CREATE TABLE IF NOT EXISTS `qa_uservotes` (
  `postid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `vote` tinyint(4) NOT NULL,
  `flag` tinyint(4) NOT NULL,
  UNIQUE KEY `userid` (`userid`,`postid`),
  KEY `postid` (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qa_uservotes`
--

INSERT INTO `qa_uservotes` (`postid`, `userid`, `vote`, `flag`) VALUES
(44, 1, 0, 0),
(1, 5, 1, 0),
(44, 5, 1, 0),
(44, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_widgets`
--

CREATE TABLE IF NOT EXISTS `qa_widgets` (
  `widgetid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `place` char(2) CHARACTER SET ascii NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `tags` varchar(800) CHARACTER SET ascii NOT NULL,
  `title` varchar(80) NOT NULL,
  PRIMARY KEY (`widgetid`),
  UNIQUE KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qa_words`
--

CREATE TABLE IF NOT EXISTS `qa_words` (
  `wordid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(80) NOT NULL,
  `titlecount` int(10) unsigned NOT NULL DEFAULT '0',
  `contentcount` int(10) unsigned NOT NULL DEFAULT '0',
  `tagwordcount` int(10) unsigned NOT NULL DEFAULT '0',
  `tagcount` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`wordid`),
  KEY `word` (`word`),
  KEY `tagcount` (`tagcount`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `qa_words`
--

INSERT INTO `qa_words` (`wordid`, `word`, `titlecount`, `contentcount`, `tagwordcount`, `tagcount`) VALUES
(1, 'what', 1, 0, 0, 0),
(2, 'is', 1, 2, 0, 0),
(3, 'your', 1, 0, 0, 0),
(4, 'name', 3, 0, 0, 0),
(5, 'sdfsdfdsf', 0, 1, 0, 0),
(6, 'fdsfdsfds', 0, 0, 1, 1),
(7, 'age', 1, 0, 0, 0),
(8, 'spouse', 1, 0, 0, 0),
(9, 'aa', 0, 1, 0, 0),
(10, 'tailor', 1, 0, 0, 0),
(11, 'home', 1, 0, 0, 0),
(12, 'town', 1, 0, 0, 0),
(13, 'af', 0, 1, 0, 0),
(14, 'ra', 1, 0, 0, 0),
(15, 'test', 1, 1, 0, 0),
(16, 'question', 1, 1, 0, 0),
(17, 'dff', 0, 1, 0, 0),
(18, 'first', 0, 1, 3, 0),
(19, 'second', 0, 1, 3, 0),
(20, 'third', 0, 1, 3, 0),
(21, 'first-second-third', 0, 0, 0, 3),
(22, 'this', 0, 1, 0, 0),
(23, 'my', 0, 1, 0, 0),
(24, 'answer', 0, 2, 0, 0),
(25, 'good', 0, 1, 0, 0),
(26, 'life', 1, 0, 0, 0),
(27, 'insurance', 1, 0, 0, 0),
(28, 'filezilla', 1, 0, 0, 0),
(29, 'fdsfdsfdsfds', 0, 1, 0, 0),
(30, 'fsd', 0, 1, 0, 0),
(31, 'fsdfsd', 0, 1, 0, 0),
(32, 'fsdfdsfsffsfs', 0, 1, 0, 0),
(33, 'fsfffaffsfsa', 0, 1, 0, 0),
(34, 'fsfs', 0, 1, 0, 0),
(35, 'sfsfsdfdsfdsfs', 0, 1, 0, 0),
(36, 'i', 0, 1, 0, 0),
(37, 'choice', 0, 1, 0, 0),
(38, 'fsfafsdfasdf', 0, 2, 0, 0),
(39, 'asfsfdsf', 0, 1, 0, 0),
(40, 'asfsfdsffdsfsds', 0, 1, 0, 0),
(41, 'dsfdsfsdf', 0, 1, 0, 0),
(42, 'nnnnnnknnnnk', 0, 1, 0, 0),
(43, 'kn', 0, 1, 0, 0),
(44, 'k', 0, 1, 0, 0),
(45, 'n', 0, 1, 0, 0),
(46, 'dgdsgfdasfsd', 0, 1, 0, 0),
(47, 'conmsd', 0, 1, 0, 0),
(48, 'dsfdas', 0, 1, 0, 0),
(49, 'fdsfdas', 0, 1, 0, 0),
(50, 'fdsfdsfasfas', 0, 1, 0, 0),
(51, 'fgdsfdsfs', 0, 1, 0, 0),
(52, 'fds', 0, 1, 0, 0),
(53, 'fsfdsaf', 0, 1, 0, 0),
(54, 'sfdsfdsfsdfsfdsfdsfdsfdsfdsfs', 0, 1, 0, 0),
(55, 'f', 0, 1, 0, 0),
(56, 'sssssssssssssssssssssssssssss', 0, 1, 0, 0),
(57, 'fdsfdsfsfsfsfsfsfsfsfsfdsfdsfdsfs', 0, 1, 0, 0),
(58, 'fsafdfasdfsdfdsfdsfdsfdsfdsfsdafdard', 0, 1, 0, 0),
(59, 'fasfasfasfafs', 0, 1, 0, 0),
(60, 'safasdfasasfasd', 0, 1, 0, 0),
(61, 'gfasgfdasfgdasfdasf', 0, 1, 0, 0),
(62, 'safasdfawsfsafsfsa', 1, 0, 0, 0),
(63, 'asfasdfsafasafasfasdfasfasfa', 0, 1, 0, 0),
(64, 'afasfasfas', 0, 0, 1, 1),
(65, 'fsdfdasfdsafasfdasfasfdsfdasfwasf', 1, 0, 0, 0),
(66, 'fasfasfasfdasfasfdasfasfasfssfdsfsfsf', 1, 0, 0, 0),
(67, 'fsfsfdsfdsfsf', 0, 1, 0, 0),
(68, 'safsafasfsa', 0, 0, 1, 1),
(69, 'follow', 1, 1, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `qa_categorymetas`
--
ALTER TABLE `qa_categorymetas`
  ADD CONSTRAINT `qa_categorymetas_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `qa_categories` (`categoryid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_contentwords`
--
ALTER TABLE `qa_contentwords`
  ADD CONSTRAINT `qa_contentwords_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_contentwords_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_postmetas`
--
ALTER TABLE `qa_postmetas`
  ADD CONSTRAINT `qa_postmetas_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_posts`
--
ALTER TABLE `qa_posts`
  ADD CONSTRAINT `qa_posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE SET NULL,
  ADD CONSTRAINT `qa_posts_ibfk_2` FOREIGN KEY (`parentid`) REFERENCES `qa_posts` (`postid`),
  ADD CONSTRAINT `qa_posts_ibfk_3` FOREIGN KEY (`categoryid`) REFERENCES `qa_categories` (`categoryid`) ON DELETE SET NULL,
  ADD CONSTRAINT `qa_posts_ibfk_4` FOREIGN KEY (`closedbyid`) REFERENCES `qa_posts` (`postid`),
  ADD CONSTRAINT `qa_posts_ibfk_5` FOREIGN KEY (`parentid`) REFERENCES `qa_posts` (`postid`);

--
-- Constraints for table `qa_posttags`
--
ALTER TABLE `qa_posttags`
  ADD CONSTRAINT `qa_posttags_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_posttags_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_tagwords`
--
ALTER TABLE `qa_tagwords`
  ADD CONSTRAINT `qa_tagwords_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_tagwords_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_titlewords`
--
ALTER TABLE `qa_titlewords`
  ADD CONSTRAINT `qa_titlewords_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_titlewords_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_userevents`
--
ALTER TABLE `qa_userevents`
  ADD CONSTRAINT `qa_userevents_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userfavorites`
--
ALTER TABLE `qa_userfavorites`
  ADD CONSTRAINT `qa_userfavorites_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userlevels`
--
ALTER TABLE `qa_userlevels`
  ADD CONSTRAINT `qa_userlevels_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userlimits`
--
ALTER TABLE `qa_userlimits`
  ADD CONSTRAINT `qa_userlimits_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userlogins`
--
ALTER TABLE `qa_userlogins`
  ADD CONSTRAINT `qa_userlogins_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_usermetas`
--
ALTER TABLE `qa_usermetas`
  ADD CONSTRAINT `qa_usermetas_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_usernotices`
--
ALTER TABLE `qa_usernotices`
  ADD CONSTRAINT `qa_usernotices_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userprofile`
--
ALTER TABLE `qa_userprofile`
  ADD CONSTRAINT `qa_userprofile_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_uservotes`
--
ALTER TABLE `qa_uservotes`
  ADD CONSTRAINT `qa_uservotes_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_uservotes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
