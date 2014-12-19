<?php 
/*
	|--------------------------------------------------------------------------
	| Model for Comments
	|--------------------------------------------------------------------------
	|
	| All Comments related Queries are to be there in this model. 
*/
class Comments extends Eloquent{
	
	public function getCommentsByParentId($id){
		DB::setFetchMode(PDO::FETCH_ASSOC);
			$records=DB::table('posts')
				->leftjoin('users', 'users.userid', '=', 'posts.userid')
	            ->where('parentid', $id)
	            ->where('type', 'C')
	            ->get(array('posts.*','users.handle'));
        DB::setFetchMode(PDO::FETCH_CLASS);
      	return $records;
	}

}