<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'userid';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('passcheck');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	public function getRememberToken() {
    	return $this->remember_token;
	}

	public function setRememberToken($value) {
	    $this->remember_token = $value;
	}

	public function getRememberTokenName() {
	    return 'remember_token';
	}

	public function qa_get_one_user_html($handle, $microformats=false, $favorited=false){ 
		return strlen($handle) ? ('<a href="/profile/'.$handle.'" class="qa-user-link'
				.($favorited ? ' qa-user-favorited' : '').($microformats ? ' url nickname' : '').'">'.($handle).'</a>') : '';
	}

	function get_user_by_handle($handle){
		return DB::table('users')->select('userid','handle','created','level')->where('handle', $handle)->first();
	}

	public function get_favorite($user_id){		
		$qa_favorite_non_qs_map = array();		
		$favoritenonqs = DB::select('select `qa_userfavorites`.`entitytype`,`entityid`, `qa_categories`.`backpath`, `qa_words`.`word` from `qa_userfavorites` left join `qa_words` on `qa_userfavorites`.`entitytype` = ? and `qa_words`.`wordid` = `qa_userfavorites`.`entityid` left join `qa_categories` on `qa_userfavorites`.`entitytype` = ? and `qa_userfavorites`.`entitytype` = ? where `userid` = ? and `entitytype` != ?',array("T","T","C",$user_id,"Q"));
		foreach ($favoritenonqs as $favorite){ 
			switch ($favorite->entitytype) {
				case "U":
					$qa_favorite_non_qs_map['user'][$favorite->entityid]=true;
					break;
				
				case "T":
					$qa_favorite_non_qs_map['tag'][qa_strtolower($favorite->word)]=true;
					break;
				
				case "C":
					$qa_favorite_non_qs_map['category'][$favorite->backpath]=true;
					break;
			}
		}
		return $qa_favorite_non_qs_map;
	}

	public function get_all_users(){
		return DB::table('users')->join('userpoints', 'users.userid', '=', 'userpoints.userid')
		->select('users.userid', 'users.handle', 'userpoints.points','users.flags','users.email','users.avatarblobid','users.avatarwidth','avatarheight')
		->orderBy('userpoints.points', 'desc')->get();
	}

	public function qa_favorite_form($handle,$entitytype, $entityid, $favorite, $title){
		$html = '<form method="post" action="#"><h1><span id="favoriting" class="qa-favoriting">';
		$html .= '<input type="submit" class="qa-unfavorite-button" value="" onclick="return qa_favorite_click(this);" name="favorite_'.$entitytype.'_'.$entityid.'_'.(int)!$favorite.'" title="'.$title.'"> </span>';
		$html .= 'User '.$handle.'</h1></form>';
		return $html;
	}

	public static function qa_user_sub_navigation($handle, $selected, $ismyuser=false){		
		$navigation['profile'] =  array('label' => 'User '.$handle,	'url' => '/profile');
		if(Auth::check()){
			$navigation['account'] = array('label' => "My Account",'url' => "account");
			$navigation['favorites'] = array('label' => "My favorites",	'url' => "favorites");
		}
		$navigation['wall'] = array('label' => 'Wall','url' => 'wall');
		$navigation['activity'] = array('label' => 'Recent activity','url' =>'activity');
		$navigation['questions'] = array('label' => 'All questions',	'url' => 'questions');
		$navigation['answers'] = array('label' => 'All answers','url' => 'answers');
		if (isset($navigation[$selected])){
			$navigation[$selected]['selected']=true;
		}
		//$qa_content = app('qa_content');	
		if (!Setting::qa_opt('allow_user_walls')){
			unset($navigation['wall']);
		}			
		if (!$ismyuser){
			unset($navigation['account']);
		}			
		if (!$ismyuser){
			unset($navigation['favorites']);
		}		
		return $navigation;		
	}

	public function second_to_string($seconds){
		$seconds=max($seconds, 1);		
		$scales=array(
			31557600 => array( '1 year'   , ' years'   ),
			 2629800 => array( '1 month'  , ' months'  ),
			  604800 => array( '1 week'   , ' weeks'   ),
			   86400 => array( '1 day'    , ' days'    ),
			    3600 => array( '1 hour'   , ' hours'   ),
			      60 => array( '1 minute' , ' minutes' ),
			       1 => array( '1 second' , ' seconds' ),
		);		
		foreach ($scales as $scale => $phrases){
			if ($seconds>=$scale) {
				$count=floor($seconds/$scale);
			
				if ($count==1){
					$string=($phrases[0]);
				}
				else {
					$string=($count.$phrases[1]);
				}					
				break;
			}
		}		
		return $string;
	}

	function qa_user_level_string($level){
		//echo Config::get('QA_USER_LEVEL_SUPER');die;
		if ($level>=Config::get('constants.QA_USER_LEVEL_SUPER')){
			$string='Super Administrator';
		}
		elseif ($level>=Config::get('constants.QA_USER_LEVEL_ADMIN')){
			$string='Administrator';
		}
		elseif ($level>=Config::get('constants.QA_USER_LEVEL_MODERATOR')){
			$string='Moderator';
		}
		elseif ($level>=Config::get('constants.QA_USER_LEVEL_EDITOR')){
			$string='Editor';
		}
		elseif ($level>=Config::get('constants.QA_USER_LEVEL_EXPERT')){
			$string='Expert';
		}
		elseif ($level>=Config::get('constants.QA_USER_LEVEL_APPROVED')){
			$string='Approved user';
		}
		else{
			$string='Registered user';
		}		
		return ($string);
	}

	// All function for checking permissions of user.
	
	/**
	*Check whether the logged in user would have permittion to perform $permitoption in any context (i.e. for any category)
	*Other parameters and the return value are as for qa_user_permit_error(...)
	**/

	public static function qa_user_maximum_permit_error($permitoption, $limitaction=null, $checkblocks=true){		
		return User::qa_user_permit_error($permitoption, $limitaction, User::qa_user_level_maximum(), $checkblocks);
	}

	/*
		Return the sub navigation structure common to admin pages
	*/

	public static function qa_admin_sub_navigation(){
		$navigation=array();
		$level=Auth::user()->level;		
		if ($level>=Config::get('constants.QA_USER_LEVEL_ADMIN')) {
			$navigation['admin/general']=array(
				'label' => "General",
				'url' => '/admin/general',
			);			
			$navigation['admin/emails']=array(
				'label' => "Emails",
				'url' => '/admin/emails',
			);			
			$navigation['admin/user']=array(
				'label' => 'Users',
				'url' => '/admin/users',
			);			
			$navigation['admin/posting']=array(
				'label' => 'Posting',
				'url' => '/admin/posting',
			);			
			$navigation['admin/viewing']=array(
				'label' => 'Viewing',
				'url' => '/admin/viewing',
			);
			
			$navigation['admin/lists']=array(
				'label' => 'Lists',
				'url' => '/admin/lists',
			);			
			if (User::qa_using_categories()){
				$navigation['admin/categories']=array(
					'label' => 'Categories',
					'url' => '/admin/categories',
				);
			}			
			$navigation['admin/permissions']=array(
				'label' => 'Permissions',
				'url' => '/admin/permissions',
			);			
			$navigation['admin/pages']=array(
				'label' => 'Pages',
				'url' => '/admin/pages',
			);			
			$navigation['admin/points']=array(
				'label' => 'Points',
				'url' => '/admin/points',
			);			
			$navigation['admin/spam']=array(
				'label' => 'Spam',
				'url' => '/admin/spam',
			);			
		}
		if (!User::qa_user_maximum_permit_error('permit_moderate')) {			
			$count=User::qa_user_permit_error('permit_moderate') ? null : Setting::qa_opt('cache_queuedcount'); // if only in some categories don't show cached count
			$navigation['admin/moderate']=array(
				'label' => "Moderate".($count ? (' ('.$count.')') : ''),
				'url' => '/admin/moderate',
			);
		}
		if (Setting::qa_opt('flagging_of_posts') && !User::qa_user_maximum_permit_error('permit_hide_show')) {
			$count=User::qa_user_permit_error('permit_hide_show') ? null : Setting::qa_opt('cache_flaggedcount'); // if only in some categories don't show cached count
			
			$navigation['admin/flagged']=array(
				'label' => "Flagged".($count ? (' ('.$count.')') : ''),
				'url' => '/admin/flagged',
			);
		}
		if ((!User::qa_user_maximum_permit_error('permit_hide_show')) || (!User::qa_user_maximum_permit_error('permit_delete_hidden'))){
			$navigation['admin/hidden']=array(
				'label' => 'Hidden',
				'url' => '/admin/hidden',
			);
		}
		return $navigation;
	}

	/*
		Return whether the option is set to classify questions by categories
	*/
	public static function qa_using_categories(){
		return strpos(Setting::qa_opt('tags_or_categories'), 'c')!==false;
	}
	/*
		Edit username and pass....
	*/
	public function update_profile(){		
		DB::table('users')
            	->where('userid', Auth::user()->userid)            
            	->update(array('password' => Hash::make(Input::get('newpassword1'))));
	}

	/*
		Change password successfully..
	*/
	public function change_password() {
		DB::table('users')
            	->where('userid', Auth::user()->userid)            
            	->update(array('handle' => Input::get('handle'),'username' => Input::get('handle'),'email' => Input::get('email')));
	}

	/*
		Return the maximum possible level of the logged in user in any context (i.e. for any category)
	*/
	public static function qa_user_level_maximum(){
		$level=Auth::user()->level;
		$userlevels = User::qa_get_logged_in_levels();		
		foreach ($userlevels as $userlevel){ 
			$level=max($level, $userlevel['level']);
		}		
		return $level;
	}

	/*
		Return an array of all the specific (e.g. per category) level privileges for the logged in user, retrieving from the database if necessary
	*/
	public static function qa_get_logged_in_levels(){ 
		return User::qa_db_user_levels_selectspec(Auth::user()->userid,true);
	}

	/*
		Return the selectspec to retrieve all of the context specific (currently per-categpry) levels for the user identified by
		$identifier, which is treated as a userid if $isuserid is true, otherwise as a handle. Set $full to true to obtain extra
		information about these contexts (currently, categories).
	*/

	public static function qa_db_user_levels_selectspec($identifier, $isuserid=false, $full=false){
		$sql = 'Select entityid,entitytype,level FROM qa_userlevels '.($full ? ' LEFT JOIN qa_categories ON qa_userlevels.entitytype=? AND qa_userlevels.entityid=qa_categories.categoryid' : '').' WHERE userid='.($isuserid ? '?' : '(SELECT userid FROM ^users WHERE handle=? LIMIT 1)');
		return DB::select($sql,array($identifier));		
	}

	/*
		Check whether the logged in user has permission to perform $permitoption. If $permitoption is null, this simply
		checks whether the user is blocked. Optionally provide an $limitaction (see top of qa-app-limits.php) to also check
		against user or IP rate limits. You can pass in a QA_USER_LEVEL_* constant in $userlevel to consider the user at a
		different level to usual (e.g. if they are performing this action in a category for which they have elevated
		privileges). To ignore the user's blocked status, set $checkblocks to false.

		Possible results, in order of priority (i.e. if more than one reason, the first will be given):
		'level' => a special privilege level (e.g. expert) or minimum number of points is required
		'login' => the user should login or register
		'userblock' => the user has been blocked
		'ipblock' => the ip address has been blocked
		'confirm' => the user should confirm their email address
		'approve' => the user needs to be approved by the site admins
		'limit' => the user or IP address has reached a rate limit (if $limitaction specified)
		false => the operation can go ahead
	*/
	public static function qa_user_permit_error($permitoption=null, $limitaction=null, $userlevel=null, $checkblocks=true){
		$userid=Auth::user()->userid;
		if (!isset($userlevel)){
			$userlevel=Auth::user()->level;
		}

		$flags=Auth::user()->flags;
		if (!$checkblocks){
			$flags&=~Config::get('constants.QA_USER_FLAGS_USER_BLOCKED');
		}
		//$myApp = App::make('qa_content');
		//$qa_content = app('qa_content')['settings'];
		//die("a");
		//echo "<pre>"; print_r($qa_content);die;																																																																																																																																																																																																																			
		$error=User::qa_permit_error($permitoption, $userid, $userlevel, $flags);
		if ($checkblocks && (!$error) && false){ //if ($checkblocks && (!$error) && qa_is_ip_blocked()){
			$error='ipblock';																							
		}
		if ((!$error) && isset($userid) && ($flags & Config::get('constants.QA_USER_FLAGS_MUST_CONFIRM')) && Setting::qa_opt('confirm_user_emails')){
			$error='confirm';
		}
		if ((!$error) && isset($userid) && ($flags & Config::get('constants.QA_USER_FLAGS_MUST_APPROVE')) && Setting::qa_opt('moderate_users')){
			$error='approve';
		}
		if (isset($limitaction) && !$error){
			if (qa_user_limits_remaining($limitaction)<=0){
				$error='limit';
			}
		}
		return $error;
	}

	/*
		Check whether $userid (null for no user) can perform $permitoption. Result as for qa_user_permit_error(...).
		If appropriate, pass the user's level in $userlevel, flags in $userflags and points in $userpoints.
		If $userid is currently logged in, you can set $userpoints=null to retrieve them only if necessary.
	*/

	public static function qa_permit_error($permitoption, $userid, $userlevel, $userflags, $userpoints=null){
		$permit=isset($permitoption) ? Setting::qa_opt($permitoption) : Config::get('constants.QA_PERMIT_ALL');
		if (isset($userid) && (($permit==Config::get('constants.QA_PERMIT_POINTS')) || ($permit==Config::get('constants.QA_PERMIT_POINTS_CONFIRMED')) || ($permit==Config::get('constants.QA_PERMIT_APPROVED_POINTS')))){
				// deal with points threshold by converting as appropriate
			
			if((!isset($userpoints)) && ($userid==qa_get_logged_in_userid())){
				$userpoints=qa_get_logged_in_points(); // allow late retrieval of points (to avoid unnecessary DB query when using external users)
			}		
			if($userpoints>=Setting::qa_opt($permitoption.'_points')){
				$permit=($permit==Config::get('constants.QA_PERMIT_APPROVED_POINTS')) ? Config::get('constants.QA_PERMIT_APPROVED') :
					(($permit==Config::get('constants.QA_PERMIT_POINTS_CONFIRMED')) ? Config::get('constants.QA_PERMIT_CONFIRMED') : Config::get('constants.QA_PERMIT_USERS')); // convert if user has enough points
			}
			else{
				$permit=Config::get('constants.QA_PERMIT_EXPERTS'); // otherwise show a generic message so they're not tempted to collect points just for this
			}
		}		
		return User::qa_permit_value_error($permit, $userid, $userlevel, $userflags);
	}

	/*
		Check whether $userid of level $userlevel with $userflags can reach the permission level in $permit
		(generally retrieved from an option, but not always). Result as for qa_user_permit_error(...).
	*/
	
	public static function qa_permit_value_error($permit, $userid, $userlevel, $userflags){
		//print_r($permit);die;	
		//echo Config::get('constants.QA_PERMIT_EXPERTS');die;	
		if ($permit>=Config::get('constants.QA_PERMIT_ALL')){
			$error=false;
		}			
		elseif ($permit>=Config::get('constants.QA_PERMIT_USERS')){
			$error=isset($userid) ? false : 'login';
		}			
		elseif ($permit>=Config::get('constants.QA_PERMIT_CONFIRMED')) {
			if (!isset($userid)){
				$error='login';
			}			
			elseif (
				Config::get('constants.QA_FINAL_EXTERNAL_USERS') || // not currently supported by single sign-on integration
				($userlevel>=Config::get('constants.QA_PERMIT_APPROVED')) || // if user approved or assigned to a higher level, no need
				($userflags & Config::get('constants.QA_USER_FLAGS_EMAIL_CONFIRMED')) || // actual confirmation
				(!qa_opt('confirm_user_emails')) // if this option off, we can't ask it of the user
			){
				$error=false;
			}
			else {
				$error='confirm';
			}

		} elseif ($permit>=Config::get('constants.QA_PERMIT_APPROVED')) {
			if (!isset($userid)){
				$error='login';
			}
				
			elseif (
				($userlevel>=Config::get('constants.QA_USER_LEVEL_APPROVED')) || // user has been approved
				(!qa_opt('moderate_users')) // if this option off, we can't ask it of the user
			){
				$error=false;
			}				
			else{
				$error='approve';
			}
		
		} elseif ($permit>=Config::get('constants.QA_PERMIT_EXPERTS')){
			$error=(isset($userid) && ($userlevel>=Config::get('constants.QA_USER_LEVEL_EXPERT'))) ? false : 'level';
		}			
		elseif ($permit>=Config::get('constants.QA_PERMIT_EDITORS')){
			$error=(isset($userid) && ($userlevel>=Config::get('constants.QA_USER_LEVEL_EDITOR'))) ? false : 'level';
		}			
		elseif ($permit>=Config::get('constants.QA_PERMIT_MODERATORS')){
			$error=(isset($userid) && ($userlevel>=Config::get('constants.QA_USER_LEVEL_MODERATOR'))) ? false : 'level';
		}			
		elseif ($permit>=Config::get('constants.QA_PERMIT_ADMINS')){
			$error=(isset($userid) && ($userlevel>=Config::get('constants.QA_USER_LEVEL_ADMIN'))) ? false : 'level';
		}			
		else {
			$error=(isset($userid) && ($userlevel>=Config::get('constants.QA_USER_LEVEL_SUPER'))) ? false : 'level';
		}		
		if (isset($userid) && ($userflags & Config::get('constants.QA_USER_FLAGS_USER_BLOCKED')) && ($error!='level')){
			$error='userblock';
		}
		//echo $error;die;		
		return $error;
	}

	//manage front end point calculations.........
	
	/*
		Update the userpoints table in the database for $userid and $columns, plus the summary points column.
		Set $columns to true for all, empty for none, an array for several, or a single value for one.
		This dynamically builds some fairly crazy looking SQL, but it works, and saves repeat calculations.
	*/
	public static function qa_db_points_update_ifuser($userid, $columns) { 
		if (isset($userid)) {
			$calculations = Option::qa_db_points_calculations();			
			$keycolumns = array();
			if ($columns===true){
				$keycolumns=$calculations;
			}
			elseif (empty($columns)){
				$keycolumns=array();
			}
			elseif (is_array($columns)){
				$keycolumns=array_flip($columns);
			}
			else{
				$keycolumns=array($columns => true);
			}			
			$insertfields='userid, ';
			$insertvalues='?, ';
			$insertpoints=(int)Setting::qa_opt('points_base');
			$updates='';
			$updatepoints=$insertpoints;
			foreach ($calculations as $field => $calculation) {
				$multiple=(int)$calculation['multiple'];				
				if (isset($keycolumns[$field])) {
					$insertfields.=$field.', ';
					$insertvalues.='@_'.$field.':=(SELECT '.$calculation['formula'].'), ';
					$updates.=$field.'=@_'.$field.', ';
					$insertpoints.='+('.(int)$multiple.'*@_'.$field.')';
				}				
				$updatepoints.='+('.$multiple.'*'.(isset($keycolumns[$field]) ? '@_' : '').$field.')';
			}
			$query='INSERT INTO ^userpoints ('.$insertfields.'points) VALUES ('.$insertvalues.$insertpoints.') '.
				'ON DUPLICATE KEY UPDATE '.$updates.'points='.$updatepoints.'+bonus';				
			$sql_raw = str_replace('~', "='".($userid)."'", ($query));
			$final_sql = str_replace('^',DB::getTablePrefix(), $sql_raw);
			DB::select($final_sql,array($userid));
		}
	}
}
