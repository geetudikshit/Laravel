<?php 
/*
	|--------------------------------------------------------------------------
	| Model for Questions
	|--------------------------------------------------------------------------
	|
	| All Answer related Queries are to be there in this model. 
*/
class Answer extends Eloquent{
	public function getAnswer($postid){//echo $postid;die;
		//$categoryids="CONCAT_WS(',', ^posts.catidpath1, ^posts.catidpath2, ^posts.catidpath3, ^posts.categoryid)";
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$data = DB::table('posts')
	    ->leftjoin('users', 'users.userid', '=', 'posts.userid')
	    ->leftjoin('userpoints', 'userpoints.userid', '=', 'posts.userid')
	    ->leftjoin('categories', 'categories.categoryid', '=', 'posts.categoryid')
	    ->orderBy('postid', 'desc')
	    ->where('type', '=', 'A')
	    ->where('posts.parentid', '=', $postid)
	    ->get(array('posts.*', 'categories.title as categoryname', 
	    			'categories.backpath as categorybackpath',
	    			'userpoints.points',
	    			'users.flags',
	    			'users.level',
	    			'users.email',
	    			'users.handle',
	    			'users.avatarblobid',
	    			'users.avatarwidth',
	    			'users.avatarheight'
	    			));
	    DB::setFetchMode(PDO::FETCH_CLASS);
	    return $data;
	}
}